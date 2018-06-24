<?php

require('fm.php');

isset($_GET['to']) ? $to = $_GET['to'] : $to = getcwd();
isset($_GET['sort']) ? $sort = $_GET['sort'] : $sort = 'name';
isset($_GET['order']) ? $order = $_GET['order'] : $order = 'asc';
isset($_GET['to']) ? $path = $_GET['to'] : $path = dirname(__FILE__);

$filemanager = Files::getInstance($to);
$files = $filemanager->files;

if (isset($_GET['sort']) && isset($_GET['order'])) {
    $files = $filemanager->sort($files, $sort, $order);
}
