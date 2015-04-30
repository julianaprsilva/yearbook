<?php

class Banco {
	var $sgbd;
	var $host;
	var $user;
	var $passwd;
	var $dbname;
	var $conn;
	
	public function __construct($sgbd='mysql', $host='br-cdbr-azure-south-a.cloudapp.net', $user='b596cd610f2e85', $passwd='49f9e82c',
$dbname='u946044087daw') {
		$this->sgbd = $sgbd;
		$this->host = $host;
		$this->user = $user;
		$this->passwd = $passwd;
		$this->dbname = $dbname;
		
		$dns = $this->sgbd.":host=".$this->host.";dbname=".$this->dbname.";charset=utf8"; 
        $this->conn = new PDO($dns, $this->user, $this->passwd, array(PDO::ATTR_PERSISTENT => false));
	}
}
?>