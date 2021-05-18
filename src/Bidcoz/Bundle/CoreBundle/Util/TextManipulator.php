<?php

namespace Bidcoz\Bundle\CoreBundle\Util;

class TextManipulator
{
    public static function parseEmails($str)
    {
        preg_match_all('/([A-Z0-9._%+]+@[A-Z0-9.-]+\.[A-Z]{2,6})/i', $str, $matches);

        return $matches[0];
    }

    public static function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        return $text;
    }

    public static function escape($str)
    {
        return trim(preg_replace('/ +/', ' ', preg_replace('/[[:^print:]]/', '', urldecode(html_entity_decode(strip_tags($str))))));
    }

    public static function textToBool($str)
    {
        $str = strtolower(trim($str));
        if ('y' == $str) {
            $str = 'yes';
        }

        return filter_var($str, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * turncateText
     * Truncates a string at a word boundary
     * String return will be at most the maxLength size + the length of the additionalText.
     *
     * @param string $text           - The string to truncate
     * @param int    $maxLength      - The maximum length of the returned string
     * @param string $additionalText - If the length of the string is larger than maxLength, what will be appeneded
     */
    public static function truncateText(string $text, int $maxLen, string $additionalText = '...'): string
    {
        $textLen = strlen($text);

        if ($textLen <= $maxLen) {
            return $text;
        }

        $maxTextLen = $maxLen - strlen($additionalText);

        return preg_replace('/\s+?(\S+)$/', '', rtrim(substr($text, 0, $maxTextLen))).$additionalText;
    }

    public static function normalizePhoneNumber(string $number = null): ? string
    {
        if (!$number) {
            return null;
        }

        $number = str_replace(['-', ' ', '+1'], '', $number);

        if (11 === strlen($number) && '1' === $number[0]) {
            $number = substr($number, 1);
        }

        return $number;
    }
}
