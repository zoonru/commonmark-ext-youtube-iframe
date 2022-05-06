<?php

namespace Zoon\CommonMark\Ext\YouTubeIframe;

use InvalidArgumentException;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

final class YouTubeIframeRenderer implements NodeRendererInterface
{
	private string $width;
	private string $height;
	private bool $allowFullScreen;

	/**
	 * YouTubeIframeRenderer constructor.
	 * @param string $width
	 * @param string $height
	 * @param bool $allowFullScreen
	 */
	public function __construct(string $width, string $height, bool $allowFullScreen)
    {
		$this->width = $width;
		$this->height = $height;
		$this->allowFullScreen = $allowFullScreen;
	}

	/**
	 * @inheritDoc
	 */
	public function render(Node $node, ChildNodeRendererInterface $childRenderer) {
		if (!($node instanceof YouTubeIframe)) {
			throw new InvalidArgumentException('Incompatible inline type: ' . get_class($node));
		}

		$src = "https://www.youtube.com/embed/{$node->getUrl()->getVideoId()}";
		$startTimestamp = $node->getUrl()->getStartTimestamp();

		if ($startTimestamp !== null) {
			$src .= "?start=$startTimestamp";
		}

		return new HtmlElement('iframe', array_merge([
            'width' => $this->width,
            'height' => $this->height,
            'src' => $src,
            'frameborder' => "0",
        ], $this->allowFullScreen ? [
            'allowfullscreen' => "1",
        ] : []));
	}
}
