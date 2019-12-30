<?php

namespace Zoon\CommonMark\Ext\YouTubeIframe;

use League\CommonMark\ElementRendererInterface;
use League\CommonMark\HtmlElement;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Renderer\InlineRendererInterface;

final class YouTubeIframeRenderer implements InlineRendererInterface {

	private $width;
	private $height;
	private $allowFullScreen;

	/**
	 * YouTubeIframeRenderer constructor.
	 * @param string $width
	 * @param string $height
	 * @param bool $allowFullScreen
	 */
	public function __construct(string $width, string $height, bool $allowFullScreen) {
		$this->width = $width;
		$this->height = $height;
		$this->allowFullScreen = $allowFullScreen;
	}

	/**
	 * @inheritDoc
	 */
	public function render(AbstractInline $inline, ElementRendererInterface $htmlRenderer) {
		if (!($inline instanceof YouTubeIframe)) {
			throw new \InvalidArgumentException('Incompatible inline type: ' . get_class($inline));
		}
		$src = "https://www.youtube.com/embed/{$inline->getUrl()->getVideoId()}";
		$startTimestamp = $inline->getUrl()->getStartTimestamp();
		if ($startTimestamp !== null) {
			$src .= "?start={$startTimestamp}";
		}
		return new HtmlElement('iframe', [
			'width' => $this->width,
			'height' => $this->height,
			'src' => $src,
			'frameborder' => 0,
			'allowfullscreen' => $this->allowFullScreen,
		]);
	}
}
