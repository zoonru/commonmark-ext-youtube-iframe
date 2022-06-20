<?php

namespace Zoon\CommonMark\Ext\YouTubeIframe;

use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\ConfigurableExtensionInterface;
use League\Config\ConfigurationBuilderInterface;
use Nette\Schema\Expect;

class YouTubeIframeExtension implements ConfigurableExtensionInterface
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
            'wrapper_class' => Expect::string()->nullable(),
            'allow_full_screen' => Expect::bool(true),
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

        $environment->addRenderer(YouTubeIframe::class, new YouTubeIframeRenderer([
            'width' => $configuration->get('youtube_iframe.width'),
            'height' => $configuration->get('youtube_iframe.height'),
            'wrapper_class' => $configuration->get('youtube_iframe.wrapper_class'),
            'allow_full_screen' => $configuration->get('youtube_iframe.allow_full_screen'),
        ]));
    }
}
