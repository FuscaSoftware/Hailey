<?php

/*
 * The MIT License
 *
 * Copyright 2015 s.kalski.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Description of HAILEY_Strings
 *
 * @author s.kalski
 */
abstract class HAILEY_Strings {

    //put your code here
    function base64urlEncode($plainText) {
        $base64 = base64_encode($plainText);
        $base64url = strtr($base64, '+/=', '-_,');
        return $base64url;
    }

    function base64urlDecode($plainText) {
        $base64url = strtr($plainText, '-_,', '+/=');
        $base64 = base64_decode($base64url);
        return $base64;
    }

    function secsToStr($secs) {
        if ($secs >= 86400) {
            $days = floor($secs / 86400);
            $secs = $secs % 86400;
            $r = $days . ' day';
            if ($days <> 1) {
                $r.='s';
            }if ($secs > 0) {
                $r.=', ';
            }
        }
        if ($secs >= 3600) {
            $hours = floor($secs / 3600);
            $secs = $secs % 3600;
            $r.=$hours . ' hour';
            if ($hours <> 1) {
                $r.='s';
            }if ($secs > 0) {
                $r.=', ';
            }
        }
        if ($secs >= 60) {
            $minutes = floor($secs / 60);
            $secs = $secs % 60;
            $r.=$minutes . ' minute';
            if ($minutes <> 1) {
                $r.='s';
            }if ($secs > 0) {
                $r.=', ';
            }
        }
        $r.=$secs . ' second';
        if ($secs <> 1) {
            $r.='s';
        }
        return $r;
    }

    function textToLinks($str = '') {
        if ($str == '' or ! preg_match('/(http|www\.|@)/i', $str)) {
            return $str;
        }
        $lines = explode("\n", $str);
        $new_text = '';
        while (list($k, $l) = each($lines)) {
            $l = preg_replace("/([ \t]|^)www\./i", "\\1http://www.", $l);
            $l = preg_replace("/([ \t]|^)ftp\./i", "\\1ftp://ftp.", $l);
            $l = preg_replace("/(http:\/\/[^ )\r\n!]+)/i", "<a href=\"\\1\">\\1</a>", $l);
            $l = preg_replace("/(https:\/\/[^ )\r\n!]+)/i", "<a href=\"\\1\">\\1</a>", $l);
            $l = preg_replace("/(ftp:\/\/[^ )\r\n!]+)/i", "<a href=\"\\1\">\\1</a>", $l);
            $l = preg_replace(
                    "/([-a-z0-9_]+(\.[_a-z0-9-]+)*@([a-z0-9-]+(\.[a-z0-9-]+)+))/i", "<a href=\"mailto:\\1\">\\1</a>", $l);
            $new_text .= $l . "\n";
        }
        return $new_text;
    }

    function startsWith($Haystack, $Needle) {
        return strpos($Haystack, $Needle) === 0;
    }

    function endsWith($Haystack, $Needle) {
        return strrpos($Haystack, $Needle) === strlen($Haystack) - strlen($Needle);
    }

    function strMiddleReduceWordSensitive($string, $max = 50, $rep = '[...]') {
        $strlen = strlen($string);
        if ($strlen <= $max)
            return $string;
        $lengthtokeep = $max - strlen($rep);
        $start = 0;
        $end = 0;
        if (($lengthtokeep % 2) == 0) {
            $start = $lengthtokeep / 2;
            $end = $start;
        } else {
            $start = intval($lengthtokeep / 2);
            $end = $start + 1;
        }
        $i = $start;
        $tmp_string = $string;
        while ($i < $strlen) {
            if (isset($tmp_string[$i]) and $tmp_string[$i] == ' ') {
                $tmp_string = substr($tmp_string, 0, $i) . $rep;
                $return = $tmp_string;
            }
            $i++;
        }
        $i = $end;
        $tmp_string = strrev($string);
        while ($i < $strlen) {
            if (isset($tmp_string[$i]) and $tmp_string[$i] == ' ') {
                $tmp_string = substr($tmp_string, 0, $i);
                $return .= strrev($tmp_string);
            }
            $i++;
        }
        return $return;
        return substr($string, 0, $start) . $rep . substr($string, - $end);
    }

    function randString($len) {
        $randstr = '';
        srand((double) microtime() * 1000000);
        for ($i = 0; $i < $len; $i++) {
            $n = rand(48, 120);
            while (($n >= 58 && $n <= 64) || ($n >= 91 && $n <= 96)) {
                $n = rand(48, 120);
            }
            $randstr .= chr($n);
        }
        return $randstr;
    }

    function numberSuffix($number) {
        if (is_numeric($number)) {
            $n = $number % 100;
        } else {
            if (preg_match('/[0-9]?[0-9]$/', $number, $matches)) {
                $n = array_pop($matches);
            } else {
                return $number;
            }
        }
        if ($n > 3 && $n < 21)
            return $number . 'th';
        switch ($n % 10) {
            case '1': return $number . 'st';
            case '2': return $number . 'nd';
            case '3': return $number . 'rd';
            default: return $number . 'th';
        }
    }

    function getBetween($content, $start, $end) {
        $r = explode($start, $content);
        if (isset($r[1])) {
            $r = explode($end, $r[1]);
            return $r[0];
        }
        return '';
    }

}
