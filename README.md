# YouTube iframe extension

Extension for [league/commonmark](https://github.com/thephpleague/commonmark) to replace youtube link with iframe.

## Install

``` bash
composer require zoon/commonmark-ext-youtube-iframe
```

## Example

``` php
$environment = \League\CommonMark\Environment::createCommonMarkEnvironment();
$environment->addExtension(new \Zoon\CommonMark\Ext\YouTubeIframe\YouTubeIframeExtension());

$converter = new \League\CommonMark\CommonMarkConverter([
	'youtube_iframe_width' => 600,
	'youtube_iframe_height' => 300,
	'youtube_iframe_allowfullscreen' => true,
], $environment);

echo $converter->convertToHtml('Check this: [](https://youtu.be/mVnSpPMgoWM)');
echo $converter->convertToHtml('Check this: [](https://www.youtube.com/watch?v=mVnSpPMgoWM)');
```

``` bash
<p>Check this: <iframe width="600" height="300" src="https://www.youtube.com/embed/mVnSpPMgoWM" frameborder="0" allowfullscreen="1"></iframe></p>
<p>Check this: <iframe width="600" height="300" src="https://www.youtube.com/embed/mVnSpPMgoWM" frameborder="0" allowfullscreen="1"></iframe></p>
```