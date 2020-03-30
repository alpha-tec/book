<?php
/**
 * Description: Menu class
 *
 * author: Daniel Yamada
 */

require_once VCLASSES."Connection.php";  
require_once VCLASSES."Crud.php"; 

class Menu {

    private $pdo;
    private $crud;
    private static $menu;  
 
    protected $table = 'ial360.sys_menus';
    protected $save_id=0;

    //table columns
    protected $id;
    protected $module_id;
    protected $profile_id;
    protected $page_id;
    protected $sequence;
    protected $num;
    protected $label;

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
    public function setModuleId( $var ) {
        $this->module_id = $var;
    }
    public function getModuleId() {
        return $this->module_id;
    }
    public function setProfileId( $var ) {
        $this->profile_id = $var;
    }
    public function getProfileId() {
        return $this->profile_id;
    }
    public function setPageId( $var ) {
        $this->page_id = $var;
    }
    public function getPageId() {
        return $this->page_id;
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
    public function setLabel( $var ) {
        $this->label = $var;
    }
    public function getLabel() {
        return $this->label;
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
        if(!isset(self::$menu)) {
            try {   
               self::$menu = new Menu();
            } catch (Exception $e) {
               echo "Erro: ".$e->getMessage();
            }   
        }   
        return self::$menu;   
    }
   
    public static function createTable()
    {
        $sql = "CREATE TABLE `sys_menus` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `module_id` int(11) NOT NULL,
            `profile_id` int(11) NOT NULL,
            `page_id` int(11) NOT NULL,
            `sequence` int(11) NOT NULL,
            `num` int(11) NOT NULL,
            `label` varchar(100) DEFAULT NULL,
            `active` char(1) NOT NULL DEFAULT 'Y',
            `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `createdby` int(11) NOT NULL DEFAULT '0',
            `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
            `modifiedby` int(11) DEFAULT '0',
            PRIMARY KEY (`id`)
           ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8";
    }

    public function insert()
    {
		$this->crud->setTablename($this->table);

        $array = array('module_id'=> $this->module_id, 'profile_id'=> $this->profile_id, 'page_id'=> $this->page_id, 'sequence'=> $this->sequence, 'num'=> $this->num, 'label'=> $this->label, 'createdby' => $this->save_id, );
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
        $label = NULL;
        if(strlen($this->menu_label) > 0 )
            $label = $this->menu_label;
        $array = array('module_id'=> $this->module_id, 'profile_id'=> $this->profile_id, 'page_id'=> $this->page_id, 'sequence'=> $this->sequence, 'num'=> $this->num, 'label'=> $label, 'active' => $this->active, 'modifiedby' => $this->save_id, );
        $condition = array('id=' => $this->id);  
        return $this->crud->update($array, $condition); 
    }

    public function delete()
    {
		$this->crud->setTablename($this->table);
        if($this->id == 0)
            return 0;
        $condition = array('id=' => $this->id, );
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

    public function selectGeneric($sql, $parameters, $fetch)
    {
        return $this->crud->getSQLGeneric($sql, $parameters, $fetch);
    }
    
    public function reset()
    {
        $this->id = 0;
        $this->module_id = 0;
        $this->profile_id = 0;
        $this->page_id = 0;
        $this->sequence = 0;
        $this->num = 0;
        $this->label = '';
        $this->icon = '';
        $this->tooltip = '';
        $this->folder = '';
    
        $this->active = '';
        $this->created = '';
        $this->createdby = $this->save_id;
        $this->modified = '';
        $this->modifiedby = $this->save_id;
    }

}

?>