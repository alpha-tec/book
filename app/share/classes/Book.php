<?php 

/**
 * Description of Book class
 *
 * author: Daniel Yamada
 * 
 * 
 */


require_once "Connection.php";  
require_once "Crud.php"; 


class Book {
   private $pdo;
   private $crud;  
   private $arrayBook = array();
   protected $table = 'ialbooks.books';
   private static $book;  

   protected $id;
   protected $name;
   protected $genre;


   private function __construct(){   
      $this->pdo = Connection::getInstance();  
      $this->crud = Crud::getInstance($this->pdo, $this->table);
   }  

   public static function createTable(){

   }


   public static function getInstance(){  
      if(!isset(self::$book)) {
         try {   
            self::$book = new Book();
         } catch (Exception $e) {
            echo "Erro: ".$e->getMessage();
         }   
      }   
      return self::$book;   
   }

   public function setId($var){
      $this->id = $var;
   }
   public function setName($var){
      $this->name = $var;
   }
   public function setGenero($var){
      $this->genero = $var;
   }

   public function insert(){
      $arrayBook = array('name' => $this->name, 'genre' => $this->genero);
      $this->crud->insert($arrayBook);
   }

   public function update(){
      $arrayBook = array('name' => $this->name, 'genre' => $this->genero);
      $arrayCond = array('id=' => $this->id);  
      return $this->crud->update($arrayBook, $arrayCond); 
   }
   
   public function selectAll($condition=NULL){
      $flag_conditions = "";

      if (!empty($condition))
         $flag_conditions = "WHERE {$condition}";

      $sql = "SELECT * FROM {$this->table} {$flag_conditions} ";
      return $this->crud->getSQLGeneric($sql, NULL, TRUE);
   }

   public function selectGeneric($sql, $parameters, $fetch){
      return $this->crud->getSQLGeneric($sql, $parameters, $fetch);
   }

}

 ?>
