# YouTube iframe extension

Extension for [league/commonmark](https://github.com/thephpleague/commonmark) to replace youtube link with iframe.

## Install

``` bash
composer require zoon/commonmark-ext-youtube-iframe
```

## Test
```
./vendor/bin/phpunit
```

## Example

``` php
use League\CommonMark\CommonMarkConverter;
use Zoon\CommonMark\Ext\YouTubeIframe\YouTubeIframeExtension;

$converter = new CommonMarkConverter([
    'youtube_iframe' => [
        'width' => '600',
        'height' => '300',
        'allow_full_screen' => true,
    ],
]);

$converter->getEnvironment()->addExtension(new YouTubeIframeExtension());

echo $converter->convert('Check this: [](https://youtu.be/mVnSpPMgoWM?t=10)')->getContent();
echo $converter->convert('Check this: [](https://www.youtube.com/watch?v=mVnSpPMgoWM&t=10)')->getContent();
```

``` bash
<p>Check this: <iframe width="600" height="300" src="https://www.youtube.com/embed/mVnSpPMgoWM?start=10" frameborder="0" allowfullscreen="1"></iframe></p>
<p>Check this: <iframe width="600" height="300" src="https://www.youtube.com/embed/mVnSpPMgoWM?start=10" frameborder="0" allowfullscreen="1"></iframe></p>
```