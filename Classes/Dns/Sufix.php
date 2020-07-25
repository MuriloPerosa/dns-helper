<?php

namespace Classes\Dns;

use Classes\Traits\DnsTrait;
use Symfony\Component\VarDumper\VarDumper;

class Sufix
{
    use DnsTrait;
    
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
                $line = preg_replace('/\s+/', ' ', trim($line));
                if(!empty($line) && strpos($line, '//') === false) array_push($sufixes, $line);
            }
        
        }
        
        fclose($file);

        return $sufixes;
    }
   
    /**
     * Return the sufix for a domain
     * @param string $domain
     * @return string
     */
    public function getDomainSufix($domain)
    {
        $divisions = $this->getDomainSubdivisions($domain);
        foreach ($divisions as $divison) {
            if(in_array($divison, $this->list)) return $divison;
        }

        return '';
    }
}
