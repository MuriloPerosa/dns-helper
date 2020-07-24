<?php

namespace Classes\Dns;

class Sufix
{
    public $list = [];
    protected const PATH = '.\dataset\public_sufix_list.dat';

    public function __construct()
    {
        $this->list = $this->getList();
    }

    /**
     * Returns public sufix list
     * @return array
     */
    private function getList()
    {
        $sufixes = [];
        $file    = @fopen(self::PATH, "r");

        if ($file)
        {
            while (($line = fgets($file)) !== false) 
            {
                if(!empty($line) && strpos($line, '//') === false) array_push($sufixes, $line);
            }
        
        }
        
        fclose($file);

        return $sufixes;
    }
}
