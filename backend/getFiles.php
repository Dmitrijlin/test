<?php

require_once './vendor/autoload.php';

$dir = '/var/www/backend/app';
$finder = new \Symfony\Component\Finder\Finder();
$finder->files()->in($dir);
print_r(array_keys(iterator_to_array($finder->getIterator())));

foreach ($finder as $file) {
    echo $file->getFilename() . PHP_EOL;
}