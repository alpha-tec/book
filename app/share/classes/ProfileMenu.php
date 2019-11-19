<?php
/**
 * Description of ProfileMenu class
 *
 * author: Daniel Yamada
 */

require_once VCLASSES."Connection.php";  
require_once VCLASSES."Crud.php"; 

class ProfileMenu {

    private $pdo;
    private $crud;
    private static $profile_menu;  
 
    protected $table = 'ialbooks.sys_profile_menus';
    protected $table_profile = 'ialbooks.sys_profiles';
    protected $table_menu = 'ialbooks.sys_menus';
    protected $save_id=0;

    //table columns
    protected $id;
    protected $profile_id;
    protected $menu_id;
    protected $sequence;
    protected $num;

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
    public function setMenuId( $var ) {
        $this->menu_id = $var;
    }
    public function getMenuId() {
        return $this->menu_id;
    }
    public function setSequence( $var ) {
        $this->sequence = $var;
    }
    public function getSequence() {
        return $this->sequence;
    }
    public function setNum( $var ) {
        $this->num = $var;
    }
    public function getNum() {
        return $this->num;
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
        if(!isset(self::$proflie_menu)) {
            try {   
               self::$profile_menu = new ProfileMenu();
            } catch (Exception $e) {
               echo "Erro: ".$e->getMessage();
            }   
        }   
        return self::$profile_menu;   
    }
   
    public static function createTable()
    {
        $sql = "";
    }

    public function insert()
    {
		$this->crud->setTablename($this->table);

        $array = array('profile_id'=> $this->profile_id, 'menu_id'=> $this->menu_id, 'sequence'=> $this->sequence, 'num'=> $this->num, 'createdby' => $this->save_id, );

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

        $array = array('profile_id'=> $this->profile_id, 'menu_id'=> $this->menu_id, 'sequence'=> $this->sequence, 'num'=> $this->num, 'active' => $this->active, 'modifiedby' => $this->save_id, );

        $condition = array('id=' => $this->id);  

        return $this->crud->update($array, $condition); 
    }
     
    public function delete()
    {
		$this->crud->setTablename($this->table);

        $condition = array('id=' => $this->id);  

        return $this->crud->delete($condition); 
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

    public function selectMenus($c=NULL)
    {

        $sql = "SELECT * FROM {$this->table} a, {$this->table_profile} b, {$this->table_menu} c WHERE a.profile_id = b.id AND a.menu_id = c.id {$c} ";

        return $this->crud->getSQLGeneric($sql, NULL, TRUE);
    }

    public function selectGeneric($sql, $parameters, $fetch)
    {
        return $this->crud->getSQLGeneric($sql, $parameters, $fetch);
    }
    
    
    public function reset()
    {
        $this->id = 0;
        $this->sequence = 0;
        $this->num = 0;
        $this->menu_label = '';
        $this->icon = '';
        $this->tooltip = '';
        $this->folder = '';
        $this->page_name = '';
    
        $this->active = '';
        $this->created = '';
        $this->createdby = 0;
        $this->modified = '';
        $this->modifiedby = 0;
    }

}

?>