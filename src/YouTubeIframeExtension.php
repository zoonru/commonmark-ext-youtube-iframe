<?php

namespace Zoon\CommonMark\Ext\YouTubeIframe;

use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\ConfigurableExtensionInterface;
use League\Config\ConfigurationBuilderInterface;
use Nette\Schema\Expect;

final class YouTubeIframeExtension implements ConfigurableExtensionInterface
{
    /**
     * @param ConfigurationBuilderInterface $builder
     * @return void
     */
    public function configureSchema(ConfigurationBuilderInterface $builder): void
    {
        $builder->addSchema('youtube_iframe', Expect::structure([
            'width' => Expect::string('640'),
            'height' => Expect::string('480'),
            'allowfullscreen' => Expect::bool(true),
        ]));
    }

    /**
     * @param EnvironmentBuilderInterface $environment
     * @return void
     */
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $configuration = $environment->getConfiguration();

        $environment->addEventListener(DocumentParsedEvent::class, new YouTubeIframeProcessor([
            new YouTubeLongUrlParser(),
            new YouTubeShortUrlParser(),
        ]));

        $environment->addRenderer(YouTubeIframe::class, new YouTubeIframeRenderer(
            $configuration->get('youtube_iframe.width'),
            $configuration->get('youtube_iframe.height'),
            $configuration->get('youtube_iframe.allowfullscreen'),
        ));
    }
}
