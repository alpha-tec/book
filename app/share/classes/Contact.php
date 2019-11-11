<?php 
/**
 * Description of Contacts class
 *
 * author: Daniel Yamada
 * 
 * 
 */

require_once "Connection.php";  
require_once "Crud.php"; 

class Contact {
	private $pdo;
	private $crud;  
	protected $table = 'ialbooks.contacts';
	private static $contact;  
	protected $save_id=0;

	//table contacts
	protected $id;
	protected $user_id=0;
	protected $address_id=0;
	protected $name;
	protected $email;
	protected $gender='';
	protected $birthdate='';
	protected $birthplace='';
	protected $phone='';
	protected $mobile='';
	protected $rg='';
	protected $rg_emissor='';
	protected $cpf='';
	protected $marital_status='';
	protected $deceased='N';
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
		$sql = "";
	}

   	public static function getInstance(){  
      if(!isset(self::$contact)) {
         try {   
            self::$contact = new Contact();
         } catch (Exception $e) {
            echo "<br>Erro: ".$e->getMessage();
         }   
      }   
      return self::$contact;   
   	}

	public function setSaveId( $var ) {
        $this->save_id = $var;
    }

	//TABLE contacts
	public function setId( $var ) {
		$this->id = $var;
	}
	public function getId() {
		return $this->id;
	}
	public function setUserId( $var ) {
		$this->user_id = $var;
	}
	public function getUserId() {
		return $this->profile_id;
	}
	public function setAddressId( $var ){
		$this->address_id = $var;
	}
	public function getAddressId() {
		return $this->address_id;
	}
	public function setName( $var ) {
		$this->name = mb_convert_case($var, MB_CASE_TITLE, "UTF-8");
	}
	public function getName() {
		return $this->name;
	}
	public function setEmail( $var ) {
		$this->email = mb_strtolower($var, 'UTF-8');
	}
	public function getEmail() {
		return $this->email;
	}
	public function setGender( $var ) {
		$this->gender = $var;
	}
	public function getGender() {
		return $this->gender;
	}
	public function setBirthdate( $var ) {
		$this->birthdate = $var;
	}
	public function getBirthdate() {
		return $this->birthdate;
	}
	public function setPhone( $var ) {
		$this->phone = $var;
	}
	public function getPhone() {
		return $this->phone;
	}
	public function setMobile( $var ) {
		$this->mobile = $var;
	}
	public function getMobile() {
		return $this->mobile;
	}
	public function setRG( $var ) {
		$this->rg = $var;
	}
	public function getRG() {
		return $this->rg;
	}
	public function setRGEmissor( $var ) {
		$this->rg_emissor = $var;
	}
	public function getRGEmissor() {
		return $this->rg_emissor;
	}
	public function setCPF( $var ) {
		$this->cpf = $var;
	}
	public function getCPF() {
		return $this->cpf;
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

	
	public function insertQuick()
	{
		$this->crud->setTablename($this->table);

		$array = array('user_id'=> $this->user_id, 'name'=> $this->name, 'email'=> $this->email, 'createdby'=> $this->save_id, );

		$id = array();
        $result = $this->crud->insert($array);

		if($result){
            $id = $this->selectGeneric("SELECT LAST_INSERT_ID() as lastId", NULL, NULL);
		}

		if(count($id)> 0){
			$this->contact_id = $id['lastId'];
			return ['id'=> $id['lastId'], 'name'=> $this->name,];
		}
		
		return ['id'=> 0, 'name'=> $this->name,];
	}
	 
	public function insert()
	{
		$this->crud->setTablename($this->table);

		$array = array('user_id'=> $this->user_id, 'address_id'=> $this->address_id, 'name'=> $this->name, 'email'=> $this->email, 'gender'=> $this->gender, 'birthdate'=> $this->birthdate, 'phone'=> $this->phone, 'mobile'=> $this->mobile, 'rg'=> $this->rg, 'rg_emissor'=> $this->rg_emissor, 'cpf'=> $this->cpf, 'active'=> $this->active, 'createdby'=> $this->save_id, );
		
		$id = array();
        $result = $this->crud->insert($array);

		if($result){
            $id = $this->selectGeneric("SELECT LAST_INSERT_ID() as lastId", NULL, NULL);
		}

		if(count($id)> 0){
			$this->contact_id = $id['lastId'];
			return ['id'=> $id['lastId'], 'name'=> $this->name,];
		}
		
		return ['id'=> 0, 'name'=> $this->name,];
	}
	   
	public function update()
	{
		$this->crud->setTablename($this->table);

		$array = array('user_id'=> $this->user_id, 'address_id'=> $this->address_id, 'name'=> $this->name, 'email'=> $this->email, 'gender'=> $this->gender, 'birthdate'=> $this->birthdate, 'phone'=> $this->phone, 'mobile'=> $this->mobile, 'rg'=> $this->rg, 'rg_emissor'=> $this->rg_emissor, 'cpf'=> $this->cpf, 'active'=> $this->active, 'modifiedby'=> $this->save_id, );
		  
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

	public function cpfCheck($cpf){
        // determina um valor inicial para o digito $d1 e $d2
        // pra manter o respeito ;)
        $d1 = 0;
        $d2 = 0;
        // remove tudo que não seja número
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        // lista de cpf inválidos que serão ignorados
        $ignore_list = array(
            '00000000000',
            '01234567890',
            '11111111111',
            '22222222222',
            '33333333333',
            '44444444444',
            '55555555555',
            '66666666666',
            '77777777777',
            '88888888888',
            '99999999999'
          );
        // se o tamanho da string for dirente de 11 ou estiver
        // na lista de cpf ignorados já retorna false
        if(strlen($cpf) != 11 || in_array($cpf, $ignore_list)){
            return false;
        }else{
            // inicia o processo para achar o primeiro
            // número verificador usando os primeiros 9 dígitos
            for($i = 0; $i < 9; $i++){
                // inicialmente $d1 vale zero e é somando.
                // O loop passa por todos os 9 dígitos iniciais
                $d1 += $cpf[$i] * (10 - $i);
            }
            // acha o resto da divisão da soma acima por 11
            $r1 = $d1 % 11;
            // se $r1 maior que 1 retorna 11 menos $r1 se não
            // retona o valor zero para $d1
            $d1 = ($r1 > 1) ? (11 - $r1) : 0;
            // inicia o processo para achar o segundo
            // número verificador usando os primeiros 9 dígitos
            for($i = 0; $i < 9; $i++) {
                // inicialmente $d2 vale zero e é somando.
                // O loop passa por todos os 9 dígitos iniciais
                $d2 += $cpf[$i] * (11 - $i);
            }
            // $r2 será o resto da soma do cpf mais $d1 vezes 2
            // dividido por 11
            $r2 = ($d2 + ($d1 * 2)) % 11;
            // se $r2 mair que 1 retorna 11 menos $r2 se não
            // retorna o valor zeroa para $d2
            $d2 = ($r2 > 1) ? (11 - $r2) : 0;
            // retona true se os dois últimos dígitos do cpf
            // forem igual a concatenação de $d1 e $d2 e se não
            // deve retornar false.
            return (substr($cpf, -2) == $d1 . $d2) ? true : false;
        } 
    }

		
}

?>
