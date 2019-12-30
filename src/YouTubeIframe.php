<?php

namespace Zoon\CommonMark\Ext\YouTubeIframe;

use League\CommonMark\Inline\Element\AbstractInline;

final class YouTubeIframe extends AbstractInline {

	private $url;

	/**
	 * YouTubeIframe constructor.
	 * @param YouTubeUrlInterface $youTubeUrl
	 */
	public function __construct(YouTubeUrlInterface $youTubeUrl) {
		$this->url = $youTubeUrl;
	}

	/**
	 * @return YouTubeUrlInterface
	 */
	public function getUrl(): YouTubeUrlInterface {
		return $this->url;
	}

}
