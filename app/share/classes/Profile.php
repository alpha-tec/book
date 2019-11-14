<?php
/**
 * Description of Profile class
 *
 * author: Daniel Yamada
 */

require_once VCLASSES."Connection.php";  
require_once VCLASSES."Crud.php"; 

class Profile {

    private $pdo;
    private $crud;
    private static $profile;  
 
    protected $table = 'ialbooks.sys_profiles';
    protected $save_id=0;

    //table columns
    protected $id;
    protected $name;
    protected $fullname;

    protected $active='Y';
    protected $created;
    protected $createdby;
    protected $modified;
    protected $modifiedby;

    public function setSaveId( $var ) {
        $this->save_id = $var;
    }
    public function setId( $var ) {
        $this->id = $var;
    }
    public function getId() {
        return $this->id;
    }
    public function setName( $var ) {
        $this->name = $var;
    }
    public function getName() {
        return $this->name;
    }
    public function setFullName( $var ) {
        $this->fullname = $var;
    }
    public function getFullName() {
        return $this->fullname;
    }
    public function setActive( $var ) {
        $this->active = $var;
    }
    public function getActive() {
        return $this->active;
    }
    public function setCreated( $var ) {
        $this->created = $var;
    }
    public function getCreated() {
        return $this->created;
    }
    public function setCreatedBy( $var ) {
        $this->createdby = $var;
    }
    public function getCreatedBy() {
        return $this->createdby;
    }
    public function setModified( $var ) {
        $this->modified = $var;
    }
    public function getModified() {
        return $this->modified;
    }
    public function setModifiedBy( $var ) {
        $this->modifiedby = $var;
    }
    public function getModifiedBy() {
        return $this->modifiedby;
    }

    private function __construct(){   
        $this->pdo = Connection::getInstance();  
        $this->crud = Crud::getInstance($this->pdo, $this->table);
    }  
  
    public static function getInstance()
    {  
        if(!isset(self::$profile)) {
            try {   
               self::$profile = new Profile();
            } catch (Exception $e) {
               echo "Erro: ".$e->getMessage();
            }   
        }   
        return self::$profile;   
    }
   
    public static function createTable()
    {
        $sql = "";
    }

    public function insert()
    {
		$this->crud->setTablename($this->table);

        $array = array('name'=> $this->name, 'fullname'=> $this->fullname, 'createdby' => $this->save_id, );

        $id = 0;
        $result = $this->crud->insert($array);

        if($result){
            $id = $this->selectGeneric("SELECT LAST_INSERT_ID() as lastId", NULL, NULL);
            return $id['lastId'];
        }

        return 0;
    }
    
    public function update()
    {
		$this->crud->setTablename($this->table);

        $array = array('name'=> $this->name, 'fullname'=> $this->fullname, 'active' => $this->active, 'modifiedby' => $this->save_id, );

        $condition = array('id=' => $this->id);  

        return $this->crud->update($array, $condition); 
    }
     
    public function selectAll($c=NULL)
    {
        $conditions = "";
  
        if (!empty($c))
           $conditions = "WHERE {$c}";
  
        $sql = "SELECT * FROM {$this->table} {$conditions} ";
        return $this->crud->getSQLGeneric($sql, NULL, TRUE);
    }

    public function select($c=NULL)
    {
        $conditions = "";
  
        if (!empty($c))
           $conditions = "WHERE {$c}";
        
        $sql = "SELECT * FROM {$this->table} {$conditions} LIMIT 1";
        
        return $this->crud->getSQLGeneric($sql, NULL, TRUE);
    }

    public function selectGeneric($sql, $parameters, $fetch)
    {
        return $this->crud->getSQLGeneric($sql, $parameters, $fetch);
    }
    
    
    public function reset()
    {
        $this->id = 0;
        $this->name = '';
        $this->fullname = '';
    
        $this->active = '';
        $this->created = '';
        $this->createdby = 0;
        $this->modified = '';
        $this->modifiedby = 0;
    }

}

?>