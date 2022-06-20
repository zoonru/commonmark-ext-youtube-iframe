<?php

namespace Zoon\CommonMark\Ext\YouTubeIframe;

interface YouTubeUrlParserInterface
{
	/**
	 * @param string $url
	 * @return YouTubeUrlInterface|null
	 */
	public function parse(string $url): ?YouTubeUrlInterface;
}
