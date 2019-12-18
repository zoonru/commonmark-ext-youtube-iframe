<?php

namespace Zoon\CommonMark\Ext\YouTubeIframe;

use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Inline\Element\Link;

final class YouTubeIframeProcessor {

	private const PATTERN = '%^https://(?:www\.youtube\.com/watch\?v=|youtu\.be/)([^&#]+)%';

	/**
	 * @param DocumentParsedEvent $e
	 */
	public function __invoke(DocumentParsedEvent $e) {
		$walker = $e->getDocument()->walker();
		while ($event = $walker->next()) {
			if ($event->getNode() instanceof Link && !$event->isEntering()) {
				/** @var Link $link */
				$link = $event->getNode();

				$matched = preg_match(
					self::PATTERN,
					$link->getUrl(),
					$matches
				);

				if ($matched !== 1) {
					continue;
				}

				$link->replaceWith(new YouTubeIframe($matches[1]));
			}
		}
	}

}
