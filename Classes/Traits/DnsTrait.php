<?php

namespace Classes\Traits;

trait DnsTrait
{
    /**
     * Convert text to IDNA ASCII form
     *  @param string $text
     *  @return string
     */
    public function convertToAscii($text)
    {
        $converted = idn_to_ascii($text, 0, INTL_IDNA_VARIANT_UTS46);
        return $converted != false ? $converted : $text;
    }
}