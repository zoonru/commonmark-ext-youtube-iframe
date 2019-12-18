<?php

namespace Zoon\CommonMark\Ext\YouTubeIframe;

use League\CommonMark\Inline\Element\AbstractInline;

final class YouTubeIframe extends AbstractInline {

	private $videoId;

	/**
	 * YouTubeIframe constructor.
	 * @param string $videoId
	 */
	public function __construct(string $videoId) {
		$this->videoId = $videoId;
	}

	/**
	 * @return string
	 */
	public function getVideoId(): string {
		return $this->videoId;
	}

}
