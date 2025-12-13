<?php

if (!function_exists('getYoutubeId')) {
    /**
     * Extract YouTube video ID from any YouTube URL
     *
     * @param string $url
     * @return string|null
     */
    function getYoutubeId($url)
    {
        preg_match(
            '/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/|shorts\/))([^\&\?\/]+)/',
            $url,
            $matches
        );
        return $matches[1] ?? null;
    }
}
