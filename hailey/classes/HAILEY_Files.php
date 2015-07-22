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
 * Description of HAILEY_Files
 *
 * @author s.kalski
 */
abstract class HAILEY_Files {

    function unzip($location, $newLocation) {
        if (exec("unzip $location", $arr)) {
            mkdir($newLocation);
            for ($i = 1; $i < count($arr); $i++) {
                $file = trim(preg_replace("~inflating: ~", "", $arr[$i]));
                copy($location . '/' . $file, $newLocation . '/' . $file);
                unlink($location . '/' . $file);
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function showDir($dir) {
        $filelist = array();
        if (is_dir($dir)) {
            if ($handle = opendir($dir)) {
                while (($file = readdir($handle)) !== false) {
                    if ($file != "." && $file != "..") {
                        array_push($filelist, $dir . $file);
                    }
                }
                closedir($handle);
            }
            return $filelist;
        }
    }

    function getFilesByExt($path, $ext) {
        $files = array();
        if (is_dir($path)) {
            $handle = opendir($path);
            while ($file = readdir($handle)) {
                if ($file[0] == '.') {
                    continue;
                }
                if (is_file($path . $file) and preg_match('/\.' . $ext . '$/', $file)) {
                    $files[] = $file;
                }
            }
            closedir($handle);
            sort($files);
        }
        return $files;
    }

    function countFiles($path) {
        $file_count = 0;
        $dir_handle = opendir($path);
        if (!$dir_handle)
            return -1;
        while ($file = readdir($dir_handle)) {
            if ($file == '.' || $file == '..')
                continue;
            if (is_dir($path . $file)) {
                $file_count += count_files($path . $file . DIRECTORY_SEPARATOR);
            } else {
                $file_count++; // increase file count
            }
        }
        closedir($dir_handle);
        return $file_count;
    }

    function pathGetLastDir($path) {
        $path = str_replace('\\', '/', $path);
        $path = preg_replace('/\/+$/', '', $path);
        $path = explode('/', $path);
        $l = count($path) - 1;
        return isset($path[$l]) ? $path[$l] : '';
    }

    function readableFilesize($file) {
        $size = filesize($file);
        $mod = 1024;
        $units = explode(' ', 'B KB MB GB TB PB');
        for ($i = 0; $size > $mod; $i++) {
            $size /= $mod;
        }
        return round($size, 2) . ' ' . $units[$i];
    }

    function CalcDirectorySize($DirectoryPath) {
        $Size = 0;
        $Dir = opendir($DirectoryPath);
        if (!$Dir)
            return false;
        while (($File = readdir($Dir)) !== false) {
            if ($File[0] == '.')
                continue;
            if (is_dir($DirectoryPath . $File))
                $Size += CalcDirectorySize($DirectoryPath . $File . DIRECTORY_SEPARATOR);
            else
                $Size += filesize($DirectoryPath . $File);
        }
        closedir($Dir);
        return $Size;
    }

}
