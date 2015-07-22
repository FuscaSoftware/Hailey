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
 *
 * @author s.kalski
 */
abstract class HAILEY_Validator {

    function email($string = '') {
        if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+\.[A-Za-z]{2,6}$/", $string))
            return true;
    }

    function positiveInteger($id = '') {
        if (is_bool($id)) {
            return false;
        }
        $id = trim($id);
        $options = array('options' => array('min_range' => 0));
        if (!filter_var($id, FILTER_VALIDATE_INT, $options)) {
            return false;
        }
        return true;
    }

    function Iban($value = '', $countryCode = '') {
        $iban = false;
        $value = strtoupper(trim($value));
        if ($countryCode == '') {
            $countryCode = substr($value, 0, 1);
        }
        if (preg_match('/^' . strtoupper($countryCode) . '\d{7}0[A-Z0-9]{16}$/', $value) && ctype_alpha($countryCode)) {
            $number = substr($value, 4, 22) . '2927' . substr($value, 2, 2);
            $number = str_replace(
                    array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'), array(10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35), $number
            );
            $iban = (1 == bcmod($number, 97)) ? true : false;
        }
        return $iban;
    }

    function luhn_check($number) {
        $number = preg_replace('/\D/', '', $number);
        $number_length = strlen($number);
        $parity = $number_length % 2;
        $total = 0;
        for ($i = 0; $i < $number_length; $i++) {
            $digit = $number[$i];
            if ($i % 2 == $parity) {
                $digit*=2;
                if ($digit > 9) {
                    $digit-=9;
                }
            }
            $total+=$digit;
        }
        return ($total % 10 == 0) ? TRUE : FALSE;
    }

    function checkDateFormat($date) {
        if (preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date, $parts)) {
            if (checkdate($parts[2], $parts[3], $parts[1]))
                return true;
            else
                return false;
        } else
            return false;
    }

    function IsIPValid($ip) {
        if (preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $ip)) {
            return true;
        }
        return false;
    }

}
