<?php
/**
 * Description of User class
 *
 * author: Daniel Yamada
 * 
 * Tables: users
 * 
 */

require_once VCLASSES."Connection.php";  
require_once VCLASSES."Crud.php"; 

class User {
    
    private $pdo;
    private $crud;  
    private static $user;

    protected $table = 'ialbooks.sys_users';
    protected $save_id=0;

    //table columns 
    protected $id;
    protected $profile_id=20;
    protected $name='';
    protected $login;
    protected $password;
    protected $email;
    protected $mustChangePassword='N';
    protected $mustUpdateContact='N';

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
    public function setProfileId( $var ) {
        $this->profile_id = $var;
    }
    public function getProfileId() {
        return $this->profile_id;
    }
    public function setName( $var ) {
        $this->name = $var;
    }
    public function getName() {
        return $this->name;
    }
    public function setLogin( $var ) {
        $this->login =  mb_strtolower($var, 'UTF-8');
    }
    public function getLogin() {
        return $this->login;
    }
    public function setPassword( $var ) {
        $this->password = $var;
    }
    public function getPassword() {
        return $this->password;
    }
    public function setEmail( $var ) {
        $this->email = $var;
    }
    public function getEmail() {
        return $this->email;
    }
    public function setMustChangePassword( $var ) {
        $this->mustChangePassword = $var;
    }
    public function getMustChangePassword() {
        return $this->mustChangePassword;
    }
    public function setMustUpdateContact( $var ) {
        $this->mustUpdateContact = $var;
    }
    public function getMustUpdateContact() {
        return $this->mustUpdateContact;
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

    private function __construct()
    {   
        $this->pdo = Connection::getInstance();  
        $this->crud = Crud::getInstance($this->pdo, $this->table);
    }  

    public static function getInstance()
    {  
        if(!isset(self::$user)) {
           try {   
              self::$user = new User();
           } catch (Exception $e) {
              echo "Erro: ".$e->getMessage();
           }   
        }   
        return self::$user;   
    }
  
    public static function createTable()
    {
        $sql = "";
    }

    public function insert()
    {
		$this->crud->setTablename($this->table);

        //verifica se existe login na tabela, se não existir gera um novo login
        $this->login = $this->loginGenerate($this->login);

        $array = array('profile_id' => $this->profile_id, 'name' => $this->name, 'login' => $this->login, 'password' => $this->passwordCrypt($this->password), 'email' => $this->email, 'createdby' => $this->save_id, );
        $id = 0;
        $result = $this->crud->insert($array);
        if($result){
            $id = $this->selectGeneric("SELECT LAST_INSERT_ID() as lastId", NULL, NULL);
        }
        return ['id'=> $id['lastId'], 'login'=> $this->login,];
    }

    public function update()
    {
		$this->crud->setTablename($this->table);

        $array = array('profile_id' => $this->profile_id, 'name' => $this->name, 'login' => $this->login, 'password' => $this->passwordCrypt($this->password), 'email' => $this->email, 'mustChangePassword' => $this->mustChangePassword, 'mustUpdateContact' => $this->mustUpdateContact, 'active' => $this->active, 'modifiedby' => $this->save_id, );

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

    public function passwordCheck()
    {
        $pwd = $this->passwordCrypt($this->password, 'e');
        $sql = "SELECT * FROM {$this->table} WHERE login = '{$this->login}' AND password = '{$pwd}' ";
        //echo '<br>query: '.$sql.'<br>';

        $result = array();
        $result = $this->crud->getSQLGeneric($sql, NULL, TRUE);

        if(count($result) > 0)
            return TRUE;
        else
            return FALSE;
    }

    public function passwordUpdate()
    {
		$this->crud->setTablename($this->table);

        $array = array('password' => $this->passwordCrypt($this->password), 'modifiedby' => $this->save_id, );
        $condition = array('login=' => $this->login);

        return $this->crud->update($array, $condition); 
    }

    public function mustChangePasswordOff()
    {
		$this->crud->setTablename($this->table);

        $array = array( 'mustChangePassword' => 'N', 'modifiedby' => $this->save_id, );
        $condition = array('id=' => $this->id);  
        
        return $this->crud->update($array, $condition); 
    }
     
    public function mustChangePasswordOn()
    {
		$this->crud->setTablename($this->table);

        $array = array( 'mustChangePassword' => 'Y', 'modifiedby' => $this->save_id, );
        $condition = array('id=' => $this->id);  

        return $this->crud->update($array, $condition); 
    }
     
    public function mustContactUpdateOff()
    {
		$this->crud->setTablename($this->table);

        $array = array( 'mustUpdateContact' => 'N', 'modifiedby' => $this->save_id, );
        $condition = array('id=' => $this->id);  

        return $this->crud->update($array, $condition); 
    }

    public function mustContactUpdateOn()
    {
		$this->crud->setTablename($this->table);

        $array = array( 'mustUpdateContact' => 'Y', 'modifiedby' => $this->save_id, );
        $condition = array('id=' => $this->id);  

        return $this->crud->update($array, $condition); 
    }

    public function passwordCrypt( $string, $action = 'e' ) 
    {
        // you may change these values to your own
        $secret_key = 'alphalumen-2014-key';
        $secret_iv = 'alphalumen-2014-iv';
     
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
     
        if( $action == 'e' ) {
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        }
        else if( $action == 'd' ){
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }
     
        return $output;
    }

    public function loginGenerate($login, $tail=NULL)
    {
        $result = array();

        if($tail != NULL)
            $compose = $login.$tail;
        else
            $compose = $login;
            
        $result = $this->selectAll("login='{$compose}'");

        if(count($result) == 0)
            return $compose;

        if($tail == NULL)
            $tail = '1';
        else
            $tail++;

        return $this->loginGenerate($login, $tail);
    }

    public function codeGenerate($size=8) 
    {
        $alphabet = "abcdefghijkmnopqrstuwxyzABCDEFGHJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        if($size < 8) //tamanho mínimo é 8
          $size = 8;
        for ($i = 0; $i < $size; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

}

?>