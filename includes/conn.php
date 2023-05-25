<?php
/**
 * 
 */
class Database
{
	private $server="mysql:host=sql100.epizy.com;dbname=epiz_34034811_blog";
	private $username="epiz_34034811";
	private $password="29bx8671";
	private $options =array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
	protected $conn;
	public function open(){
try {
	$this->conn = new PDO($this->server,$this->username,$this->password,$this->options);
	return $this->conn;
	
} catch (PDOException $e) {
	echo "There is some problem in the connection:". $e->getMessage();
}
	}
	public function close(){
$this->conn =null;
	}
	
}
$pdo= new Database();
?>