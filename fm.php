<?php

class Files {

    private static $instance = null;

    public $files;

    public static function getInstance($dir)
    {
        if (null === self::$instance)
        {
            self::$instance = new self($dir);
        }
        return self::$instance;
    }

    private function __clone() {}

    private function __construct($dir)
    {
        $this->files = $this->get_directory($dir);
    }

    private function get_directory($dir)
    {
        $files = array();

        if ($dir[strlen($dir)-1] !== '/') $dir .= '\\';

        if ($handle = opendir($dir)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".." && $entry != ".git" && $entry != ".idea") {
                    $temp = array(
                        'name' => pathinfo($entry)['filename'],
                        'size' => round((filesize($dir.$entry)/1024), 2),
                        'type' => filetype($dir.$entry),
                        'extension' => pathinfo($entry)['extension'],
                    );
                    $files[] = $temp;
                }
            }
            closedir($handle);
        }
        return $files;
    }

    public function sort($data, $sort, $order)
    {
        usort($data, function ($arr1, $arr2) {
            global $sort;
            return strcmp($arr1[$sort], $arr2[$sort]);
        });
        if ($order == 'desc') {
            usort($data, function ($arr1, $arr2) {
                global $sort;
                return strcmp($arr2[$sort], $arr1[$sort]);
            });
        }
        return $data;
    }
}




