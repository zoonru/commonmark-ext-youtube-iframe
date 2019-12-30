<?php

namespace Zoon\CommonMark\Ext\YouTubeIframe;

interface YouTubeUrlInterface {

	/**
	 * @return string
	 */
	public function getVideoId(): string;

	/**
	 * @return string|null
	 */
	public function getStartTimestamp(): ?string;

}