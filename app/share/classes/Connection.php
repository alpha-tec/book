<?php
/**
 * Description of Connection class
 *
 * author: Daniel Yamada
 * 
 * 
 */
class Connection {  
   private static $pdo;  
   private $date;

   private function __construct() {   
      $this->date = date("d-m-Y H:m:s"); 
   }  

   public function getDate(){
      return $this->date;
   }

   public static function getInstance() {  
      if(!isset(self::$pdo)) {
         try {   
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_PERSISTENT => TRUE);   
            self::$pdo = new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME . "; charset=" . DB_CHARSET . ";", DB_USER, DB_PASS, $options);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
         } catch (PDOException $e) {   
            print "Erro: " . $e->getMessage();   
         }   
      }   
      return self::$pdo;   
   }   

   
}

?>