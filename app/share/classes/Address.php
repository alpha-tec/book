<?php
/**
 * Description of Address class
 *
 * author: Daniel Yamada
 * 
 * Tables: address
 * 
 */

require_once VCLASSES."Connection.php";  
require_once VCLASSES."Crud.php"; 

class Address {
    
    private $pdo;
    private $crud;  
    private static $address;

    protected $table = 'ialbooks.addresses';
    protected $save_id=0;

    //table columns 
    protected $id;
    protected $postal_code='';
    protected $name='';
    protected $number='';
    protected $complement='';
    protected $neighborhood='';
    protected $city='';
    protected $state='';
    protected $country='';
    protected $description='';

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
    public function setPostalCode( $var ) {
        $this->postal_code = $var;
    }
    public function getPostalCode() {
        return $this->postal_code;
    }
    public function setName( $var ) {
        $this->name = mb_strtoupper($var, 'UTF-8');
    }
    public function getName() {
        return $this->name;
    }
    public function setNumber( $var ) {
        $this->number =  $var;
    }
    public function getNumber() {
        return $this->number;
    }
    public function setComplement( $var ) {
        $this->complement = mb_strtoupper($var, 'UTF-8');
    }
    public function getComplement() {
        return $this->complement;
    }
    public function setNeighborhood( $var ) {
        $this->neighborhood = mb_strtoupper($var, 'UTF-8');
    }
    public function getNeighborhood() {
        return $this->neighborhood;
    }
    public function setCity( $var ) {
        $this->city = mb_strtoupper($var, 'UTF-8');
    }
    public function getCity() {
        return $this->city;
    }
    public function setState( $var ) {
        $this->state = mb_strtoupper($var, 'UTF-8');
    }
    public function getState() {
        return $this->state;
    }
    public function setCountry( $var ) {
        $this->country = mb_strtoupper($var, 'UTF-8');
    }
    public function getCountry() {
        return $this->country;
    }
    public function setDescription( $var ) {
        $this->description = $var;
    }
    public function getDescription() {
        return $this->description;
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
        if(!isset(self::$address)) {
           try {   
              self::$address = new Address();
           } catch (Exception $e) {
              echo "Erro: ".$e->getMessage();
           }   
        }   
        return self::$address;   
    }
  
    public static function createTable()
    {
        $sql = "";
    }

    public function insert()
    {
		$this->crud->setTablename($this->table);

        $array = array('postal_code' => $this->postal_code, 'name' => $this->name, 'number' => $this->number, 'complement' => $this->complement, 'neighborhood' => $this->neighborhood, 'city' => $this->city, 'state' => $this->state, 'country' => $this->country, 'description' => $this->description, 'createdby' => $this->save_id, );
        
        $result = $this->crud->insert($array);
        if($result){
            $id = $this->selectGeneric("SELECT LAST_INSERT_ID() as lastId", NULL, NULL);
        }
        //print_r($id);
        return ['id'=> $id['lastId'], ];
    }

    public function update()
    {
		$this->crud->setTablename($this->table);

        $array = array('postal_code' => $this->postal_code, 'name' => $this->name, 'number' => $this->number, 'complement' => $this->complement, 'neighborhood' => $this->neighborhood, 'city' => $this->city, 'state' => $this->state, 'country' => $this->country, 'description' => $this->description, 'active' => $this->active, 'modifiedby' => $this->save_id, );

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
        //echo '<br>select :'.$sql.'<br>';
        return $this->crud->getSQLGeneric($sql, NULL, TRUE);
    }

    public function selectGeneric($sql, $parameters, $fetch)
    {
        return $this->crud->getSQLGeneric($sql, $parameters, $fetch);
    }

    public function searchPostalCode( $cep )
    {
        $busca = array();
        
        $resultado = @file_get_contents('http://republicavirtual.com.br/web_cep.php?cep='.urlencode($cep).'&formato=query_string');  
        
       if( $resultado )
       {  
          parse_str($resultado, $tmpretorno);
          
          $busca[] = ['postal_code' => $cep, 'name' => utf8_encode(htmlentities($tmpretorno['tipo_logradouro'], NULL, 'ISO-8859-1' ).' '.htmlentities($tmpretorno['logradouro'], NULL, 'ISO-8859-1' )), 'number' => '', 'complement' => '', 'neighborhood' => utf8_encode(htmlentities($tmpretorno['bairro'], NULL, 'ISO-8859-1' )), 'city' => utf8_encode(htmlentities($tmpretorno['cidade'], NULL, 'ISO-8859-1' )), 'state' => $tmpretorno['uf'], 'country' => 'BRASIL', ];
       } else
            $busca[] = ['postal_code' => $cep, 'name' => '', 'number' => '', 'complement' => '', 'neighborhood' => '', 'city' => '', 'state' => '', 'country' => 'BRASIL', ];

        return $busca;
    }
    
    
}

?>