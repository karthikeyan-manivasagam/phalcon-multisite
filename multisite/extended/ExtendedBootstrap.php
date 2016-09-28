<?php
namespace Extended;

use Phalcon\Config\Adapter\Ini as ConfigIni;

Class ExtendedBootstrap {

	 public $config, $environment, $sites, $sitename, $server_name, $approot; 

   public function __construct() {
   	$this->server_name =   $_SERVER['HTTP_HOST'];
 		$this->approot = realpath('..') . '/';
 		$env = new ConfigIni($this->approot . 'extended/environment.ini');
 		$this->environment = $env->environment;
 		$this->config = $this->getConfig();
 		$this->sites = $this->getSites(); 
 		$this->setSite();
   }

   public function getConfig() {
     $settings = new ConfigIni($this->approot . 'extended/config_'.$this->environment.'.ini');
     return $settings;
   }

   public function getSites() {
   	 $settings = json_decode(json_encode($this->config->sites), true);
     $sites = array_flip($settings);
     return  $sites;
   }

   public function setSite() {

   if(preg_match('/www/', $_SERVER['HTTP_HOST']))
   {
   	  $this->sitename = $this->sites['www'.$this->server_name];
   }else{
      $this->sitename = $this->sites[$this->server_name];
   }

   }

   public function getBaseUri() {
    return $this->config->application->baseuri;
   }
}
