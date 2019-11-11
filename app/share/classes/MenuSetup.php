<?php

/**
 * Description of MenuSetup class
 *
 * author: Daniel Yamada
 */

require_once VCLASSES."Connection.php";  
require_once VCLASSES."Crud.php"; 

class MenuSetup {

    private $pdo;
    private $crud;
    private static $menu_setup;

    protected $table1 = "ialbooks.sys_menus";
    protected $table2 = "ialbooks.sys_profile_menus";  
    
 
	private $lista  = array();
    private $page = array();

    private $menu;
    private $firstMenuItem;
    protected $activeMenuNumber;
    protected $activeMenuItem;

    protected $name;
    protected $image;
    protected $image_alt;
    protected $title;
    protected $small_title;

    public function setName( $var){
        $this->name = $var;
    }
    public function setImage( $var ){
        $this->image = $var;
    }
    public function setImageAlt( $var){
        $this->image_alt = $var;
    }
    public function setTitle( $var){
        $this->title = $var;
    }
    public function setSmallTitle( $var ){
        $this->small_title = $var;
    }

    private function __construct(){   
        $this->pdo = Connection::getInstance();  
        $this->crud = Crud::getInstance($this->pdo, $this->table1);
    }  
  
    public static function getInstance()
    {  
        if(!isset(self::$menu_setup)) {
            try {   
               self::$menu_setup = new MenuSetup();
            } catch (Exception $e) {
               echo "Erro: ".$e->getMessage();
            }   
        }   
        return self::$menu_setup;   
    }
   
  	public function create( $profile_id ) {
        //carrega os itens do menu
        $sql = "SELECT p.sequence, p.num, m.id as menu_id, m.menu_label as menu, m.icon, m.tooltip, m.folder, m.page_name as page FROM {$this->table1} m, {$this->table2} p WHERE p.profile_id = {$profile_id} AND m.id = p.menu_id AND p.active = 'Y' AND m.active = 'Y' ORDER BY 1, 2";
 
        $lista = $this->crud->getSQLGeneric($sql, NULL, TRUE);

        $this->activeMenuNumber = 100;
        $this->activeMenuItem = 100;

        $menuNumber = 100;
        $firstOK = 1;
        
        foreach ($lista as $key => $value) {
            $value = (object) $value;
            $sequence = $value->sequence;
            //insere os dados da página no array lista
            $i = $value->sequence * 100 + $value->num;
            $this->lista[$i] = $value;

            //se primeira linha
            if( $firstOK == 1 ){
                $this->firstMenuItem = $value->sequence * 100 + $value->num ;
                $firstOK = 0;
            }

            //se for Menu 
            if( ( $value->num == 0 ) or ( $value->num == 1 ) ) {
                $menuNumber = $value->sequence * 100 + $value->num ;
            }

            //se for Item de Menu
            if($value->menu != 'separator'){
                if(strlen($value->folder) > 0)
                    $file = $value->folder.'/'.$value->page.'.php';
                else 
                    $file = $value->page.'.php';
            } else
                $file = $value->menu;

            //insere dados do arquivo no array page
            $this->page[$i] = [ "file" => $file, "id" => $menuNumber, "num" => $i, ];

        }

        $sequence++;
        $this->page[$sequence*100+1] = [ "file"=> "user/reset.php", "id"=> ($sequence*100+1), "num" => ($sequence*100+1), ];
        $this->page[$sequence*100+2] = [ "file"=> "user/edit.php", "id"=> ($sequence*100+2), "num" => ($sequence*100+2), ];

        return 1;
	}


    public function setActiveMenu( $num ) {

        if( $num == 1 ){
            $this->activeMenuNumber = $this->page[$this->firstMenuItem]["id"];
            $this->activeMenuItem = $this->page[$this->firstMenuItem]["id"];
        }else{
            $this->activeMenuNumber = $this->page[$num]["id"];
            $this->activeMenuItem = $num;
        }

    }

    public function getPage( $num ) {

        if( $num == 1 )
            return $this->page[$this->firstMenuItem]["file"];
        else
            return $this->page[$num]["file"];
    }

    public function getPageArray() {

        return $this->page;
    }

    public function getPageNumber( $file ) {

        foreach ($this->page as $key => $value) {
            if($value['file'] == $file){
                return $key;
            }
        }

        return 'nenhum';
    }

	public function setMenu() {

        //Barra de navegação lateral
        $this->menu .= ' <nav class="side-navbar"> ';
        $this->menu .= ' <div class="side-navbar-wrapper"> ';
        $this->menu .= ' <div class="sidenav-header d-flex align-items-center justify-content-center"> ';

        $this->menu .= ' <div class="sidenav-header-inner text-center">
        <a href="index.php"><img src="'.$this->image.'" alt="'.$this->image_alt.'" class="img-fluid rounded-circle"></a> ';
        $this->menu .= ' </div> ';

        //logo
        $this->menu .= ' <div class="sidenav-header-logo"> <a href="index.php" class="brand-small text-center">'.$this->small_title.'</a></div> ';
        $this->menu .= ' </div> ';

        // menu de navegação
        $this->menu .= ' <div class="main-menu"> ';
        $this->menu .= ' <ul id="side-main-menu" class="side-menu list-unstyled"> ';

        //$link=1;
        $menuNumber = 100;
        $menuNumber2 = 100;
        //$seq = 0;
        $drop = 0;
        $menuOne = 1;

        foreach ($this->lista as $key => $value) {
            $sequence = $value->sequence;
            switch ($value->num) {
                case 0: // Não tem item de Menu
                    if($drop){
                        $this->menu .= ' </ul> </li> ';
                        $drop = 0;
                    }
                    $this->menu .= ' <li';

                    if($menuNumber2 == $this->activeMenuNumber){
                        $this->menu .= ' class="active" ';
                    }

                    $this->menu .= '><a href="index.php';
                    $this->menu .= '?link='.($value->sequence * 100 + $value->num).'" data-toggle="tooltip" ';
                    $this->menu .= 'data-placement="top" title="'.$value->tooltip.'">';
                    $this->menu .= $value->icon;
                    $this->menu .= $value->menu;
                    $this->menu .= '</a></li> ';

                    $menuNumber += 100;
                    $menuNumber2 += 100;
                    break;
                case 1: // Tem item de Menu
                    if($drop){
                        $this->menu .= ' </ul> </li> ';
                        $drop = 0;
                    }
                    $this->menu .= '<li';

                    if($menuNumber == $this->activeMenuNumber){
                        $this->menu .= ' class="active" ';
                    }

                    $this->menu .= '><a href="#Dropdown'.($value->sequence * 100 + $value->num).'" aria-expanded="';
                    if($menuNumber == $this->activeMenuNumber)
                        $this->menu .= 'true';
                    else
                        $this->menu .= 'false';

                    $this->menu .= '" data-toggle="collapse" data-toggle="tooltip" ';
                    $this->menu .= 'data-placement="top" title="'.$value->tooltip.'">';
                    $this->menu .= $value->icon;
                    $this->menu .= $value->menu.'</a> ';
                    $this->menu .= '<ul id="Dropdown'.($value->sequence * 100 + $value->num).'" class="collapse list-unstyled ';

                    if($menuNumber == $this->activeMenuNumber)
                        $this->menu .= 'show';
                    $this->menu .= '"> ';

                    $drop = 1;
                    $menuNumber += 100;
                    $menuNumber2 += 100;
                    break;
                default:
                    if( is_null($value->menu) )
                        break;
                    if( $value->menu == 'separator'){
                        $this->menu .= ' <div class="dropdown-divider"></div> ';
                    } else {
                        $this->menu .= '<li';

                        $menuItem = $value->sequence * 100 + $value->num;

                        if($menuItem == $this->activeMenuItem){
                            $this->menu .= ' class="active" ';
                        }

                        $this->menu .= '><a href="index.php?';
                        $this->menu .= 'link='.($value->sequence * 100 + $value->num).'">';
                        $this->menu .= $value->icon;
                        $this->menu .= $value->menu;
                        $this->menu .= '</a></li> ';
                    }

                    $drop = 1;
                    break;
            }
            if($menuOne){
                $menuNumber++;
                $menuOne = 0;
            } 
        }
        if($drop){
            $this->menu .= '</ul> </li> ';
        }

        $sequence++;
        $this->menu .= '</ul> ';
        $this->menu .= '</div> ';

        $this->menu .= '</div> ';
        $this->menu .= '</nav> ';

        $this->menu .= ' <div class="page"> ';
        $this->menu .= ' <header class="header"> ';
        $this->menu .= ' <nav class="navbar"> ';
        $this->menu .= ' <div class="container-fluid"> ';
        $this->menu .= ' <div class="navbar-holder d-flex align-items-center justify-content-between"> ';
        $this->menu .= ' <div class="navbar-header"> ';
        $this->menu .= ' <a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="index.php" class="navbar-brand"> ';
        $this->menu .= ' <div class="brand-text d-none d-md-inline-block">'.$this->title.'</div></a></div> ';

        $this->menu .= ' <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center"> ';

        // usuário
        $this->menu .= ' <li class="nav-item dropdown"> ';
        $this->menu .= ' <a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle"><span class="d-none d-sm-inline-block"><i class="fa fa-cog" aria-hidden="true"></i> '.$this->name.'</span></a> ';
        $this->menu .= ' <ul aria-labelledby="languages" class="dropdown-menu"> ';
        $this->menu .= ' <li> ';
        $this->menu .= ' <a rel="nofollow" href="index.php?link='.($sequence * 100 + 1).'" class="dropdown-item"><i class="fa fa-lock" aria-hidden="true"></i><span>Alterar Senha</span></a> ';
        $this->menu .= ' </li> ';
        $this->menu .= ' <li> ';
        $this->menu .= ' <a rel="nofollow" href="index.php?link='.($sequence * 100 + 2).'" class="dropdown-item"><i class="fa fa-id-badge" aria-hidden="true"></i><span>Meus Dados</span></a> ';
        $this->menu .= ' </li> ';
        $this->menu .= ' </ul> ';
        $this->menu .= ' </li> ';
        $this->menu .= ' <li class="nav-item"> ';
        $this->menu .= ' <a href="logout.php" class="nav-link logout"> ';
        $this->menu .= ' <span class="d-none d-sm-inline-block">Sair</span><i class="fa fa-sign-out" aria-hidden="true"></i> ';
        $this->menu .= ' </a> ';
        $this->menu .= ' </li> ';
        $this->menu .= ' </ul> ';

        $this->menu .= ' </div> ';
        $this->menu .= ' </div> ';
        $this->menu .= ' </nav> ';
        $this->menu .= ' </header> ';

		return $this->menu;
	}

}

?>