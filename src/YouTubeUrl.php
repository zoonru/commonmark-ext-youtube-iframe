<?php

namespace Zoon\CommonMark\Ext\YouTubeIframe;

final class YouTubeUrl implements YouTubeUrlInterface {

	private string $videoId;
	private ?string $startTimestamp;

	/**
	 * YouTubeUrl constructor.
	 * @param string $videoId
	 * @param string|null $startTimestamp
	 */
	public function __construct(string $videoId, ?string $startTimestamp = null)
    {
		$this->videoId = $videoId;
		$this->startTimestamp = $startTimestamp;
	}

	/**
	 * @return string
	 */
	public function getVideoId(): string
    {
		return $this->videoId;
	}

	/**
	 * @return string|null
	 */
	public function getStartTimestamp(): ?string
    {
		return $this->startTimestamp;
	}
}
