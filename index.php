<?php

use Classes\Dns\Domain;
use Symfony\Component\VarDumper\VarDumper;

require __DIR__ . '/vendor/autoload.php';


$domain = new Domain('aç~o.xyz');

$domains = [
    'dsamurilo.com',
    'http://teste2.com',
    'https://teste3.com',
    'https://www.teste3.com',
];
foreach ($domains as $d) {
   VarDumper::dump($domain->sanitizeDomain($d));
}