<?php

namespace App\Traits;

trait SanitizeString
{
    public function SanitizeString($string)
    {
        $heading = "<h1><h2><h3><h4><h5><h6>";
        $lineBreak = "<br><hr>";
        $list = "<ul><ol><li>";
        // $link = "<a>";
        $divSpan = "<div><span>";
        $text = "<p><b><i><strong><em><mark><small><del><ins><sub><sup><code><pre>";

        $allowedTags = $heading . $lineBreak . $list . $divSpan . $text;

        $string = strip_tags($string, $allowedTags);

        return $string;
    }
}
