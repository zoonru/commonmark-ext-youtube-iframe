<?php

declare(strict_types=1);

namespace Zoon\CommonMark\Ext\YouTubeIframe\Tests\Integration;

use PHPUnit\Framework\TestCase;

final class RenderTest extends TestCase
{
    public function testShortUrlConversion(): void
    {
        $environment = \League\CommonMark\Environment::createCommonMarkEnvironment();
        $environment->addExtension(new \Zoon\CommonMark\Ext\YouTubeIframe\YouTubeIframeExtension());

        $converter = new \League\CommonMark\CommonMarkConverter([
            'youtube_iframe_width' => 600,
            'youtube_iframe_height' => 300,
            'youtube_iframe_allowfullscreen' => true,
        ], $environment);

        $output = $converter->convertToHtml('Check this: [](https://youtu.be/mVnSpPMgoWM?t=10)');

        $this->assertEquals(
            '<p>Check this: <iframe width="600" height="300" src="https://www.youtube.com/embed/mVnSpPMgoWM?start=10" frameborder="0" allowfullscreen="1"></iframe></p>' . PHP_EOL,
            $output
        );
    }

    public function testLongUrlConversion(): void
    {
        $environment = \League\CommonMark\Environment::createCommonMarkEnvironment();
        $environment->addExtension(new \Zoon\CommonMark\Ext\YouTubeIframe\YouTubeIframeExtension());

        $converter = new \League\CommonMark\CommonMarkConverter([
            'youtube_iframe_width' => 600,
            'youtube_iframe_height' => 300,
            'youtube_iframe_allowfullscreen' => true,
        ], $environment);

        $output = $converter->convertToHtml('Check this: [](https://www.youtube.com/watch?v=mVnSpPMgoWM&t=10)');

        $this->assertEquals(
            '<p>Check this: <iframe width="600" height="300" src="https://www.youtube.com/embed/mVnSpPMgoWM?start=10" frameborder="0" allowfullscreen="1"></iframe></p>' . PHP_EOL,
            $output
        );
    }
}
