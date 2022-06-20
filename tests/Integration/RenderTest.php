<?php

declare(strict_types=1);

namespace Zoon\CommonMark\Ext\YouTubeIframe\Tests\Integration;

use League\CommonMark\CommonMarkConverter;
use PHPUnit\Framework\TestCase;
use Zoon\CommonMark\Ext\YouTubeIframe\YouTubeIframeExtension;

final class RenderTest extends TestCase
{
    public function testShortUrlConversion(): void
    {
        $converter = new CommonMarkConverter([
            'youtube_iframe' => [
                'width' => '600',
                'height' => '300',
                'allow_full_screen' => true,
            ],
        ]);

        $converter->getEnvironment()->addExtension(new YouTubeIframeExtension());
        $output = $converter->convert('Check this: [](https://youtu.be/mVnSpPMgoWM?t=10)');

        $this->assertEquals(
            '<p>Check this: <iframe width="600" height="300" src="https://www.youtube.com/embed/mVnSpPMgoWM?start=10" frameborder="0" allowfullscreen="1"></iframe></p>' . PHP_EOL,
            $output->getContent(),
        );
    }

    public function testLongUrlConversion(): void
    {
        $converter = new CommonMarkConverter([
            'youtube_iframe' => [
                'width' => '600',
                'height' => '300',
                'allow_full_screen' => true,
            ],
        ]);

        $converter->getEnvironment()->addExtension(new YouTubeIframeExtension());
        $output = $converter->convert('Check this: [](https://www.youtube.com/watch?v=mVnSpPMgoWM&t=10)');

        $this->assertEquals(
            '<p>Check this: <iframe width="600" height="300" src="https://www.youtube.com/embed/mVnSpPMgoWM?start=10" frameborder="0" allowfullscreen="1"></iframe></p>' . PHP_EOL,
            $output->getContent(),
        );
    }

    public function testShortUrlNoFullScreenConversion(): void
    {
        $converter = new CommonMarkConverter([
            'youtube_iframe' => [
                'width' => '600',
                'height' => '300',
                'allow_full_screen' => false,
            ],
        ]);

        $converter->getEnvironment()->addExtension(new YouTubeIframeExtension());
        $output = $converter->convert('Check this: [](https://youtu.be/mVnSpPMgoWM?t=10)');

        $this->assertEquals(
            '<p>Check this: <iframe width="600" height="300" src="https://www.youtube.com/embed/mVnSpPMgoWM?start=10" frameborder="0"></iframe></p>' . PHP_EOL,
            $output->getContent(),
        );
    }

    public function testShortUrlWrapperDivConversion(): void
    {
        $converter = new CommonMarkConverter([
            'youtube_iframe' => [
                'width' => '600',
                'height' => '300',
                'allow_full_screen' => false,
                'wrapper_class' => 'youtube-embed',
            ],
        ]);

        $converter->getEnvironment()->addExtension(new YouTubeIframeExtension());
        $output = $converter->convert('Check this: [](https://youtu.be/mVnSpPMgoWM?t=10)');

        $this->assertEquals(
            '<p>Check this: <div class="youtube-embed"><iframe width="600" height="300" src="https://www.youtube.com/embed/mVnSpPMgoWM?start=10" frameborder="0"></iframe></div></p>' . PHP_EOL,
            $output->getContent(),
        );
    }
}
