<?php

if (! function_exists('linkify')) {
    /**
     * Find possible links in string and linkify them
     *
     * @param  string  $text
     *
     * @return string
     */
    function linkify($text)
    {
        $text = preg_replace("/((https?:\/\/)[^ ]+)/", '<a target="_blank" href="$1">$1</a>', $text);
        $text = preg_replace("/(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+)+)/i", "$1&lt;a href=\"mailto:$2@$3\"&gt;$2@$3&lt;/a&gt;", $text);

        return html_entity_decode($text);
    }
}
