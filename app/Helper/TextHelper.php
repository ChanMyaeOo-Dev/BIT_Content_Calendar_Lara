<?php

if (!function_exists('cleanMarkdown')) {
    function cleanMarkdown(string $text): string
    {
        // Remove headings (#, ##, ###)
        $text = preg_replace('/^#+\s*/m', '', $text);

        // Remove bold/italic symbols (** or __ or *)
        $text = preg_replace('/(\*\*|__|\*)/', '', $text);

        // Remove arrows or other common markdown symbols
        $text = str_replace(['=>', '`', '---'], '', $text);

        // Remove extra empty lines at start and end
        $text = trim($text);

        return $text;
    }
}
