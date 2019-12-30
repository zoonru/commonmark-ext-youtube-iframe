<?php

namespace Zoon\CommonMark\Ext\YouTubeIframe;

final class YouTubeShortUrlParser implements YouTubeUrlParserInterface {

	private const HOST = 'youtu.be';
	private const TIMESTAMP_GET = 't';

	/**
	 * @param string $url
	 * @return YouTubeUrlInterface|null
	 */
	public function parse(string $url): ?YouTubeUrlInterface {
		if (parse_url($url, PHP_URL_HOST) !== self::HOST) {
			return null;
		}

		$videoId = substr((string)parse_url($url, PHP_URL_PATH), 1);
		if ($videoId === '') {
			return null;
		}

		parse_str((string)parse_url($url, PHP_URL_QUERY), $getParams);

		if (!array_key_exists(self::TIMESTAMP_GET, $getParams) || $getParams[self::TIMESTAMP_GET] === '') {
			return new YouTubeUrl($videoId);
		}

		return new YouTubeUrl($videoId, $getParams[self::TIMESTAMP_GET]);
	}

}
