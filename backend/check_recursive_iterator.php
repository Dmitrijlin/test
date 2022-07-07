<?php

require_once './vendor/autoload.php';

use Symfony\Component\Finder\Iterator\FileTypeFilterIterator;

$dir = '/var/www/backend/app';

$iterator = new \RecursiveDirectoryIterator($dir, \RecursiveDirectoryIterator::SKIP_DOTS);
$iterator = new \RecursiveIteratorIterator($iterator, \RecursiveIteratorIterator::SELF_FIRST);
$iterator = new FileTypeFilterIterator($iterator, FileTypeFilterIterator::ONLY_FILES);

print_r(array_keys(iterator_to_array($iterator)));

foreach ($iterator as $file) {
    echo $file->getFilename() . PHP_EOL;
}