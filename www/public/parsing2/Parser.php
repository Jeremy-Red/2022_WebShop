<?php
namespace parsing;

class Parser
{
    private string $remoteUrl;
    public function __construct($remoteUrl)
    {
        $this->remoteUrl = $remoteUrl;
    }
    public function start()
    {
        $file = file_get_contents($this->remoteUrl);
        $datePattern = '#(<lastBuildDate>|<pubDate>).*?(\d+ \w+ \d+ \d+:\d+:\d+).*?(</lastBuildDate>|</pubDate>)#';
        $file = preg_replace($datePattern, '$1$2$3', $file);
        $descPattern = '#(<description>)<!.*?</p>.*?<p>(.*?)</p>.*?>(</description>)#s';
        $file = preg_replace($descPattern, '$1$2$3', $file);
        $titlePattern = '#(<title>)<!\[\w+\[\s*(\[.+?\])?\s*(.*?)\s*\]\]>(</title>)#s';
        $file = preg_replace($titlePattern, '$1$3$4', $file);
        $xml = @simplexml_load_string($file);
        // print_r($xml);
        $buildDate = $xml->channel->lastBuildDate;
        $items = $xml->channel->item;
        foreach ($items as $item) {
            echo $item->title . PHP_EOL;
            echo $item->description . PHP_EOL;
            echo $item->category . str_repeat(PHP_EOL, 3);
        }
    }
    private function match(string $pattern, string $subject, string $property): string|false
    {
        preg_match($pattern, $subject, $matches);
        $result = $matches[$property] ?? false;
        return $result;
    }
}