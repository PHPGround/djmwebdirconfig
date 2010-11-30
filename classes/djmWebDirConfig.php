<?php

class djmWebDirConfig
{
    
    /**
     * Return an array of all .config.php files from the current directory up to
     * the document root.
     * 
     * e.g.
     * www/.config.php
     * www/dir/.config.php
     * www/dir/subdir/.config.php
     * 
     * @return array
     */
    public static function getFiles()
    {
        $root = realpath($_SERVER['DOCUMENT_ROOT']);
        $rootLen = strlen($root);
        
        if (defined('WEBDIRCONFIG_FILENAME')) {
            $dir = dirname(WEBDIRCONFIG_FILENAME);
        } else {
            $dir = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . $_SERVER['REQUEST_URI'];
            if (($pos = strpos($dir, '?')) !== false) {
                $dir = substr($dir, 0, $pos - 1);
            }
            if (substr($dir, -1) != '/' || is_file($dir)) {
                $dir = dirname($dir);
            }
        }
        
        $files = array();
        while (substr($dir, 0, $rootLen) == $root) {
            if (is_file("$dir/.config.php")) {
                $files[] = "$dir/.config.php";
            }
            $dir = dirname($dir);
        }
        return array_reverse($files);
    }
    
}
