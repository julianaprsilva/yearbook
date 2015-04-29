<?php

class Banco {
	var $sgbd;
	var $host;
	var $user;
	var $passwd;
	var $dbname;
	var $conn;
	
	public function __construct($sgbd='mysql', $host='localhost', $user='daw', $passwd='daw2014',
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
