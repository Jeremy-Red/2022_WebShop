<?php
class P
{
    private const FILE_STATE = './assets/state.txt';
    private static $url;
    private static $keys;
    private static $charsets;
    public static $timeUpdate;
    public static $title;
    public static $parsedDate;
    public static $currentDate;
    public static $keysList;
    public static $list;
    public static $updated;
    public static function set($url, $keys, $charsets, $timeUpdate)
    {
        self::$keys = $keys;
        self::$url = $url;
        self::$charsets = $charsets;
        self::$timeUpdate = self::getTimeUpdate($timeUpdate);
    }
    public static function start()
    {
        $sourceCode = self::fetch();
        if (!$sourceCode)
            die('Error fetch code from ' . self::$url);
        $latestBlock = self::match('#(?P<html><h2.*?)<h2#s', $sourceCode, 'html');
        if (!$latestBlock)
            die('Error parse latestBlock');
        $latestBlock = preg_replace('#</?strong>#', '', $latestBlock);
        $latestBlock = preg_replace('# rel=".+?"#', '', $latestBlock);
        $title = self::match('#<h2.*?>(?P<title>.*?)</h2>#', $latestBlock, 'title');
        if (!$title)
            die('Error parse title');
        self::$title = $title;
        $parsedDate = self::match('#(?P<date>\d+ \w+ \d+)#', $title, 'date');
        if (!$parsedDate)
            die('Error parse date');
        self::$parsedDate = $parsedDate;
        $list = self::getlist('#<li.*?>.+?</li>#s', $latestBlock, 0);
        if (!$list)
            die('Error parse list');
        self::$list = $list;
        $keysList = self::getlist('#<li.*?>.*?(' . self::$keys . ').*?</li>#', $list, 0);
        if (!$keysList)
            $keysList = 'Nothing';
        self::$keysList = $keysList;
        $currentDate = date('d M Y'); //
        // $currentDate = '21 May 2024';
        self::$currentDate = $currentDate;
        $updated = self::updateDate($parsedDate, $currentDate);
        self::$updated = $updated;
    }
    private static function getTimeUpdate($time)
    {
        $timestring = date('Y-m-d') . 'T' . $time;
        return $timestring;
    }
    private static function updateDate($parsedDate, $currentDate)
    {
        $isSameDate = $parsedDate === $currentDate;
        if (!$isSameDate)
            return false;
        $logs = file_get_contents(self::FILE_STATE);
        $isFileUpdated = (bool) self::match("#{$currentDate}#s", $logs, 0);
        if ($isFileUpdated)
            return true;
        $currentTime = date('H:i:s');
        $line = "{$currentDate} {$currentTime}" . PHP_EOL;
        $state = file_put_contents(self::FILE_STATE, $line, FILE_APPEND); // TODO:
        // $state = false;
        $state = $state !== false;
        return $state;
    }
    private static function getlist($pattern, $subject, $property)
    {
        $array = self::matchAll($pattern, $subject, $property);
        if (!$array)
            return null;
        $result = implode(PHP_EOL, $array);
        return $result;
    }
    private static function matchAll($pattern, $subject, $property)
    {
        preg_match_all($pattern, $subject, $matches);
        $result = $matches[$property] ?? null;
        return $result;
    }
    private static function match($pattern, $subject, $property)
    {
        preg_match($pattern, $subject, $matches);
        $result = $matches[$property] ?? null;
        return $result;
    }
    private static function fetch(): string|null
    {
        $channel = curl_init();
        curl_setopt($channel, CURLOPT_URL, self::$url);
        curl_setopt($channel, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($channel, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($channel, CURLOPT_ENCODING, 'gzip');
        curl_setopt($channel, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0');
        $data = curl_exec($channel);
        curl_close($channel);
        if (!$data)
            return null;
        $data = mb_convert_encoding($data, self::$charsets['to'], self::$charsets['from']);
        return $data;
    }
}