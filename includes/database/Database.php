<?php

// Permet la connexion à la base de données
class Database{

    private $config;
    public $connexion;
    
    function __construct($path_config) {

	$fp = fopen($path_config,"r");
	$xml = '';
	while (!feof($fp)) {
	  $xml .= fgets($fp, 4096); 
	}
	$parameters = new SimpleXMLElement($xml);
	
        $this->config = array(
            "host" => $parameters->host,
            "user" => $parameters->user,
            "pass" => $parameters->pass,
            "port" => $parameters->port,
            "db"   => $parameters->db
            );

        try{  

        $this->connexion = new PDO('mysql:host='.$this->config['host'].';dbname='.$this->config['db'], $this->config['user'], $this->config['pass']); 
        

        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }

}


?>
