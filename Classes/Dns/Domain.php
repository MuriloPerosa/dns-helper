<?php

namespace Classes\Dns;

use Classes\Traits\DnsTrait;

class Domain
{
    use DnsTrait;
    
    public $original = '';
    public $full     = '';
    
    public function __construct($name)
    {
        $this->original = $name;
        $this->full     = $this->convertToAscii($name); 
    }
}