<?php 
/**
 * Description: Contact User class
 *
 * author: Daniel Yamada
 * 
 * 
 */

require_once "Connection.php";  
require_once "Crud.php"; 

class ContactUser {
	private $pdo;
	private $crud;  
	private static $contact_user;  

	protected $table = 'ial360.contact_users';
	protected $save_id=0;

	protected $id;
	protected $contact_id;
	protected $user_id;

	protected $active='Y';
	protected $created;
	protected $createdby;
	protected $modified;
	protected $modifiedby;

	private function __construct(){   
		$this->pdo = Connection::getInstance();  
		$this->crud = Crud::getInstance($this->pdo, $this->table);
	}  

	public static function createTable(){
		$sql = "CREATE TABLE `contact_users` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `contact_id` int(11) NOT NULL,
            `user_id` int(11) NOT NULL,
            `active` char(1) NOT NULL DEFAULT 'Y',
            `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `createdby` int(11) NOT NULL DEFAULT '0',
            `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
            `modifiedby` int(11) DEFAULT '0',
            PRIMARY KEY (`id`)
           ) ENGINE=MyISAM DEFAULT CHARSET=utf8";
	}

   	public static function getInstance(){  
      if(!isset(self::$contact_user)) {
         try {   
            self::$contact_user = new ContactUser();
         } catch (Exception $e) {
            echo "<br>Erro: ".$e->getMessage();
         }   
      }   
      return self::$contact_user;   
   	}

	public function setSaveId( $var ) {
        $this->save_id = $var;
    }

	public function setId( $var ) {
		$this->id = $var;
	}
	public function getId() {
		return $this->id;
	}
	public function setContactId( $var ) {
		$this->contact_id = $var;
	}
	public function getContactId() {
		return $this->contact_id;
	}
	public function setUserId( $var ) {
		$this->user_id = $var;
	}
	public function getUserId() {
		return $this->user_id;
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

	
	public function insert()
	{
		$this->crud->setTablename($this->table);
		$array = array('contact_id'=> $this->contact_id, 'user_id'=> $this->user_id, 'createdby'=> $this->save_id, );
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
		$array = array('contact_id'=> $this->contact_id, 'user_id'=> $this->user_id, 'active'=> $this->active, 'modifiedby'=> $this->save_id, );
		$arrayCond = array('id=' => $this->id);
      	return $this->crud->update($array, $arrayCond); 
	}
	   
	public function selectAll($cond=NULL)
	{
		$conditions = "";
		if (!empty($cond))
			$conditions = "WHERE {$cond}";
		$sql = "SELECT * FROM {$this->table} {$conditions} ";
		return $this->crud->getSQLGeneric($sql, NULL, TRUE);
   	}

	public function selectGeneric($sql, $parameters, $fetch)
	{
		return $this->crud->getSQLGeneric($sql, $parameters, $fetch);
   	}

	public function select($c=NULL)
	{
		$condition = "";
		if (!empty($c))
			$condition = "WHERE {$c}";
		$sql = "SELECT * FROM {$this->table} {$condition} LIMIT 1 ";
		return $this->crud->getSQLGeneric($sql, NULL, TRUE);
	}

		
}

?>
