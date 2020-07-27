<?php

namespace DnsTools\Traits;

use Symfony\Component\VarDumper\VarDumper;

trait DnsTrait
{
    /**
     * Convert text to IDNA ASCII form
     *  @param string $text
     *  @return string
     */
    public function convertToAscii($text)
    {
        $converted = idn_to_ascii($text, 0, INTL_IDNA_VARIANT_UTS46);
        return $converted != false ? $converted : $text;
    }

    /**
     * Split domain in parts
     * @param string $domain
     * @return array
     */
    public function splitDomainInParts($domain)
    {
        if(!$domain) return [];
        
        $parts = explode('.', $domain);
        return $parts;
    }

    /**
     * Return all domain subdivisions
     * @param string $domain
     * @return array
     */
    public function getDomainSubdivisions($domain)
    {
        $divisions = [];
        $parts = $this->splitDomainInParts($domain);

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
        
                array_push($divisions, $suf);
                $key--;
            }while(array_key_exists ($key, $parts));    
        
            $divisions = array_reverse($divisions);
        }

        return $divisions;
    }

    /**
     * Sanitize a domain name to ruturn it clean
     * @param string $domain
     * @return string
     */
    public function sanitizeDomainName($domain)
    {
        VarDumper::dump(parse_url($domain));

        // trim domain
        $domain = trim($domain, ['/', '\'', '']);
        
        // Keep the correct order
        $remove_start = ['http://', 'http://', 'www.'];


        return $domain;
    }
}