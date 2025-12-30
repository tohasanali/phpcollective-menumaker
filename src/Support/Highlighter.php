<?php

namespace PhpCollective\MenuMaker\Support;

class Highlighter
{
    public static function apply($text, $search = null)
    {
        $text = e($text);

        if (!$search)
            return $text;

        $safeSearch = preg_quote(e($search), '/');

        return preg_replace(
            "/($safeSearch)/i",
            '<mark class="menu-maker-search-highlight">$1</mark>',
            $text
        );
    }
}
