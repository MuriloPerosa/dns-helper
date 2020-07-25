<?php

use Classes\Dns\Domain;
use Symfony\Component\VarDumper\VarDumper;

require __DIR__ . '/vendor/autoload.php';

$sufix_options = [];
$domain = "brigadeiro.queimado.preto.com";
$class = new Domain($domain, true);
VarDumper::dump($class);

// adcionar tratamentos