<?php

namespace Classes\Dns;

use Classes\Traits\DnsTrait;
use Exception;
use Symfony\Component\VarDumper\VarDumper;

class Domain
{
    use DnsTrait;
    
    public $name = '';
    public $domain = '';
    public $subdomain = '';
    public $sufix = '';
    public $is_subdomain = false;
    public $parts = [];
    public $subdivisions = [];
    public $subdomains = [];
    
    /**
     * @param string $name Full name os domain or subdomain
     * @param bool   $punycode Convert to punycode ?
     */
    public function __construct($name, $punycode = true)
    {

        if(!$name) throw new Exception("Domain name should not be empty!");

        // Sanitize name
        // $name = $this->sanitizeDomainName($name);
        
        $this->name  = $punycode ? $this->convertToAscii($name) : $name;
        $this->parts = $this->splitDomainInParts($this->name);
        $this->sufix = (new Sufix())->getDomainSufix($this->name);
        $this->subdivisions = $this->getDomainSubdivisions($this->name);

        // set other vars
        $this->setVars();
    }

    /**
     * Set the class vars 
     * Created to keep the constructor organized
     */
    private function setVars()
    {
        $sufix  = ".".$this->sufix;
        $target = $this->splitDomainInParts(str_replace($sufix, "", $this->name));
        
        // find domain
        $domain = "";
        if(!empty($target))
        {
            $domain = end($target).$sufix;
        }

        // find subdomain
        $subdomain  = str_replace($domain, "", $this->name);
        if($subdomain)
        {
            $subdomain = str_replace(".".$domain, "", $this->name);
        }

        $this->domain       = $domain;
        $this->subdomain    = $subdomain;
        $this->subdomains   = $this->splitDomainInParts($subdomain);
        $this->is_subdomain = count($this->subdomains) > 0;
    }
}