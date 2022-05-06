<?php

namespace Zoon\CommonMark\Ext\YouTubeIframe;

use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use TypeError;

final class YouTubeIframeProcessor
{
	private array $youTubeUrlParsers = [];

	/**
	 * YouTubeIframeProcessor constructor.
	 * @param YouTubeUrlParserInterface[] $youTubeUrlParsers
	 */
	public function __construct(array $youTubeUrlParsers)
    {
		foreach ($youTubeUrlParsers as $parser) {
			if (!($parser instanceof YouTubeUrlParserInterface)) {
				throw new TypeError();
			}
		}

		$this->youTubeUrlParsers = $youTubeUrlParsers;
	}

	/**
	 * @param DocumentParsedEvent $e
	 */
	public function __invoke(DocumentParsedEvent $e)
    {
		$walker = $e->getDocument()->walker();

		while ($event = $walker->next()) {
			if ($event->getNode() instanceof Link && $event->isEntering()) {
				/** @var Link $link */
				$link = $event->getNode();

				/** @var YouTubeUrlParserInterface $parser */
				foreach ($this->youTubeUrlParsers as $youTubeParser) {
					$youTubeUrl = $youTubeParser->parse($link->getUrl());

					if ($youTubeUrl === null) {
						continue;
					}

					$link->replaceWith((new YouTubeIframe())->setUrl($youTubeUrl));
				}
			}
		}
	}
}
