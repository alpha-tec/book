<?php
/**
 * Description of Menu class
 *
 * author: Daniel Yamada
 */

require_once VCLASSES."Connection.php";  
require_once VCLASSES."Crud.php"; 

class Menu {

    private $pdo;
    private $crud;
    private static $menu;  
 
    protected $table = 'ialbooks.sys_menus';
    protected $save_id=0;

    //table columns
    protected $id;
    protected $sequence;
    protected $num;
    protected $menu_label;
    protected $icon='';
    protected $tooltip='';
    protected $folder;
    protected $page_name;

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
    public function setMenuLabel( $var ) {
        $this->menu_label = $var;
    }
    public function getMenuLabel() {
        return $this->menu_label;
    }
    public function setIcon( $var ) {
        $this->icon = $var;
    }
    public function getIcon() {
        return $this->icon;
    }
    public function setTooltip( $var ) {
        $this->tooltip = $var;
    }
    public function getTooltip() {
        return $this->tooltip;
    }
    public function setFolder( $var ) {
        $this->folder = $var;
    }
    public function getFolder() {
        return $this->folder;
    }
    public function setPageName( $var ) {
        $this->page_name = $var;
    }
    public function getPageName() {
        return $this->page_name;
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
        $sql = "";
    }

    public function insert()
    {
		$this->crud->setTablename($this->table);

        $array = array('sequence'=> $this->sequence, 'num'=> $this->num, 'menu_label'=> $this->menu_label, 'icon'=> $this->icon, 'tooltip'=> $this->tooltip, 'folder'=> $this->folder, 'page_name'=> $this->page_name, 'createdby' => $this->save_id, );

        print_r($array);
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

        $array = array('sequence'=> $this->sequence, 'num'=> $this->num, 'menu_label'=> $this->menu_label, 'icon'=> $this->icon, 'tooltip'=> $this->tooltip, 'folder'=> $this->folder, 'page_name'=> $this->page_name, 'active' => $this->active, 'modifiedby' => $this->save_id, );

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