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
 *
 * @author s.kalski
 */
abstract class HAILEY_Arrays {

    /**
     * arrayMostUsedValue returns the most used string or number from an array
     * 
     * @param array $array the array with several values
     * @return integer with key of most used value
     */
    function arrayMostUsedValue($array) {
        $c = array_count_values($array);
        return array_search(max($c), $c);
    }

    /**
     *  recursiveArrayFieldSearch returns the key of an searched value in selected fields of an array
     * 
     * @param array $array the array with several values
     * @param string $field the fieldname where to find the value
     * @param string $needle the searchterm you hope to find
     * @return integer with key of the the array or flase
     */
    function recursiveArrayFieldSearch($array, $field, $needle) {
        foreach ($array as $key => $array) {
            if ($array[$field] === $needle) {
                return $key;
            }
        }
        return false;
    }

    /**
     *   recursiveArraySearch returns the key of an searched value in all fields of an array
     * 
     * @param array $array the array with several values
     * @param string $needle the searchterm you hope to find
     * @return integer with key of the the array or flase
     */
    function recursiveArraySearch($needle, $haystack) {
        foreach ($haystack as $key => $value) {
            $current_key = $key;
            if ($needle === $value OR ( is_array($value) && recursive_array_search($needle, $value) !== false)) {
                return $current_key;
            }
        }
        return false;
    }

    function randomArrayOutput($array) {
        if (!is_array($array)) {
            return array();
        }
        srand((float) microtime() * 10000000);
        $keys = array_rand($array, count($array));
        $result = array();
        foreach ($keys as $v) {
            $result[$v] = $array[$v];
        }
        return $result;
    }

    function arrayRepeatedReturn($array) {
        if (!is_array($array))
            return false;
        $repeated_values = Array();
        $array_unique = array_unique($array);
        if (count($array) - count($array_unique)) {
            for ($i = 0; $i < count($array); $i++) {
                if (!array_key_exists($i, $array_unique))
                    $repeated_values[] = $array[$i];
            }
        }
        return $repeated_values;
    }

    function values2keys($arr, $value = 1) {
        $new = array();
        while (list($k, $v) = each($arr)) {
            $v = trim($v);
            if ($v != '') {
                $new[$v] = $value;
            }
        }
        return $new;
    }

    function arrayGetPath($data, $path, &$result) {
        $found = true;
        $path = explode("/", $path);
        for ($x = 0; ($x < count($path) and $found); $x++) {
            $key = $path[$x];
            if (isset($data[$key])) {
                $data = $data[$key];
            } else {
                $found = false;
            }
        }
        $result = $data;
        return $found;
    }

    /**
     *   removeDuplicate remove all duplicted values from an array
     * 
     * @param array $array the array with several values
     * @return array without duplicates
     */
    function removeDuplicate($arr) {
        $_a = array();
        while (list($key, $val) = each($arr)) {
            $_a[$val] = 1;
        }
        return array_keys($_a);
    }

}
