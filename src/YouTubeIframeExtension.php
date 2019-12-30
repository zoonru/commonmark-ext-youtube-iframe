<?php

namespace Zoon\CommonMark\Ext\YouTubeIframe;

use League\CommonMark\ConfigurableEnvironmentInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\ExtensionInterface;

final class YouTubeIframeExtension implements ExtensionInterface {

	/**
	 * @param ConfigurableEnvironmentInterface $environment
	 */
	public function register(ConfigurableEnvironmentInterface $environment) {
		$environment
			->addEventListener(DocumentParsedEvent::class, new YouTubeIframeProcessor([
				new YouTubeLongUrlParser(),
				new YouTubeShortUrlParser(),
			]))
			->addInlineRenderer(YouTubeIframe::class, new YouTubeIframeRenderer(
				(string) $environment->getConfig('youtube_iframe_width', 640),
				(string) $environment->getConfig('youtube_iframe_height', 480),
				(bool) $environment->getConfig('youtube_iframe_allowfullscreen', true)
			))
		;
	}

}
