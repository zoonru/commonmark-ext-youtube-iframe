<?php

namespace Zoon\CommonMark\Ext\YouTubeIframe;

final class YouTubeLongUrlParser implements YouTubeUrlParserInterface {

	private const HOST = 'www.youtube.com';
	private const PATH = '/watch';
	private const TIMESTAMP_GET = 't';
	private const ID_GET = 'v';

	/**
	 * @param string $url
	 * @return YouTubeUrlInterface|null
	 */
	public function parse(string $url): ?YouTubeUrlInterface {
		if (parse_url($url, PHP_URL_HOST) !== self::HOST || parse_url($url, PHP_URL_PATH) !== self::PATH) {
			return null;
		}

		parse_str((string)parse_url($url, PHP_URL_QUERY), $getParams);

		if (!array_key_exists(self::ID_GET, $getParams) || $getParams[self::ID_GET] === '') {
			return null;
		}

		if (!array_key_exists(self::TIMESTAMP_GET, $getParams) || $getParams[self::TIMESTAMP_GET] === '') {
			return new YouTubeUrl($getParams[self::ID_GET]);
		}

		return new YouTubeUrl($getParams[self::ID_GET], $getParams[self::TIMESTAMP_GET]);
	}

}
