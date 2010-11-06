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
    $dir = realpath(dirname($_SERVER['SCRIPT_FILENAME']));
    $files = array();
    while (substr($dir, 0, $rootLen) == $root)
    {
      if (is_file("$dir/.config.php"))
      {
        $files[] = "$dir/.config.php";
      }
      $dir = realpath(dirname($dir));
    }
    return array_reverse($files);
  }
  
}

