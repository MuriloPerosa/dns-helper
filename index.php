<?php

use Symfony\Component\VarDumper\VarDumper;

require __DIR__ . '/vendor/autoload.php';

$sufix_options = [];
$domain = "murilo.perosa.com.br";

$parts = explode('.', $domain);
if(!empty($parts))
{   
    $suf = '';
    
    $key   = array_key_last($parts);
    $last  = array_key_last($parts);

    do{
        if($key == $last)
        {
            $suf = $parts[$key];
        }
        else
        {
            $suf = $parts[$key].'.'.$suf;
        }

        array_push($sufix_options, $suf);
        $key--;
    }while(array_key_exists ($key, $parts));    

    $sufix_options = array_reverse($sufix_options);
}

VarDumper::dump($sufix_options);
