<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin 
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2016
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

/**
 * Class Filesystem
 * 
 * This class offers some required functionality needed by the tests in order to 
 * setup a proper test-environment that will execute operations upon the "ea-src"
 * source files ("install", "bridge").
 */
class Filesystem {
    /**
     * Recursive copy of source path to destination path. 
     * 
     * @param string $src Source directory path. 
     * @param string $dst Destination directory (does not have to exist).
     *
     * @link http://stackoverflow.com/a/2050909/1718162 
     */
    public static function copy($src, $dst) {
        $dir = opendir($src); 
        @mkdir($dst); 
        while(false !== ($file = readdir($dir))) { 
            if (($file != '.') && ($file != '..')) { 
                if (is_dir($src . '/' . $file)) 
                    $this->_recursiveCopy($src . '/' . $file,$dst . '/' . $file); 
                else 
                    copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
        closedir($dir); 
    }

    /**
     * Recursive removal of a directory. 
     * 
     * @param string @dir Directory path to be deleted.
     * 
     * @link http://stackoverflow.com/a/3338133/1718162
     */
    public static function delete($dir) {
        if (is_dir($dir)) { 
            $objects = scandir($dir); 
            foreach ($objects as $object) { 
                if ($object != "." && $object != "..") { 
                    if (filetype($dir . "/" . $object) == "dir") 
                        self::delete($dir . "/" . $object); 
                    else 
                        unlink($dir . "/" . $object); 
                } 
            } 
            reset($objects); 
            rmdir($dir); 
        } 
    }
}