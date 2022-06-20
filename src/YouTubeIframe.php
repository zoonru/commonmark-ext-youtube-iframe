<?php

namespace Zoon\CommonMark\Ext\YouTubeIframe;

use League\CommonMark\Node\Node;

final class YouTubeIframe extends Node
{
	private YouTubeUrlInterface $url;

    /**
     * @param YouTubeUrlInterface $url
     * @return $this
     */
    public function setUrl(YouTubeUrlInterface $url): YouTubeIframe
    {
        $this->url = $url;

        return $this;
    }

	/**
	 * @return YouTubeUrlInterface
	 */
	public function getUrl(): YouTubeUrlInterface
    {
		return $this->url;
	}
}
