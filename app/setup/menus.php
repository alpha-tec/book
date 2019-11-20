<?php
	include("share/login-secure.php");

    $linkHome = $menu->getPageNumber('home/welcome.php');

    $estrutura_menu = Menu::getInstance();
    $estrutura_menu->setSaveId($contact_id);

?>

<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Configuração > Menus </a></li>
        </ul>
    </div>
</div>

<form class="form form-validate"  method="post" action="">
    <section class="forms form-inline" >
        <div class="container-fluid " >

            <div class="row mt-2">


                <div class="form-group col-sm-4 col-md-3 col-lg-3 col-xl-2">
                    <label class="form-control-label mr-2">Status</label>
                    <select name="inStatus" data-msg="Informe o status no processo" class="form-control form-control-sm " >
                        <option value="Y" >Ativo</option>
                        <option value="N" >Inativo</option>
                    </select>
                </div>

                <div class="form-group col-sm-7 col-md-4 col-lg-4 col-xl-3">
                    <label class="form-control-label mr-2">Tipo</label>
                    <select name="inType" data-msg="Informe o tipo da escola" class="form-control form-control-sm " >
                        <option value=" 1 " >Todos </option>
                        <option value=" num in (0, 1)" >Somente Menus </option>
                        <option value=" num>2 AND CHAR_LENGTH(menu_label)>1 " >Somente Submenu </option>
                        <option value=" num>2 " >Todas as Páginas </option>
                        <option value=" num>2 AND menu_label IS NULL " >Páginas sem Menu </option>
                    </select>
                </div>

                <div class="form-group col-sm-6 col-md-5 col-lg-5 col-xl-3 mt-1 mt-sm-2 mt-md-0 mt-lg-0 mt-xl-0 ">
                    <button class="btn btn-sm btn-info " name="pesquisar" value="10" type="submit" data-toggle="tooltip" data-placement="top" title="Pesquisar"><i class="fa fa-search"></i> Pesquisar</button>

                    <span title="Criar um novo item" data-toggle="tooltip" data-placement="top"><button type="button" class="btn btn-sm btn-success ml-2" aria-hidden="true" data-toggle="modal" data-target="#addMenu" ><i class="fas fa-plus"></i> Novo Item</button></span>
                </div>

            </div>

            <hr class="my-3">
            
            <?php
                if(isset($_POST['addMenu'])){
                    $estrutura_menu->reset();
                    if(isset($_POST['inSequence']))
                        $estrutura_menu->setSequence($_POST['inSequence']);
                    if(isset($_POST['inNumber']))
                        $estrutura_menu->setNum($_POST['inNumber']);
                    if(isset($_POST['inFolder']))
                        $estrutura_menu->setFolder($_POST['inFolder']);
                    if(isset($_POST['inPage']))
                        $estrutura_menu->setPageName($_POST['inPage']);
                    if(isset($_POST['inLabel']))
                        $estrutura_menu->setMenuLabel($_POST['inLabel']);
                    if(isset($_POST['inIcon']))
                        $estrutura_menu->setIcon($_POST['inIcon']);
                    if(isset($_POST['inTooltip']))
                        $estrutura_menu->setTooltip($_POST['inTooltip']);

                    if($estrutura_menu->insert() > 0){
                        echo '<div class="alert alert-success alert-dismissible fade show text-left" role="alert">';
                        echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                        echo "Novo item adicionado!";
                        echo '</div>';
                    }
                    else
                    {
                        echo '<div class="alert alert-danger alert-dismissible fade show text-left" role="alert">';
                        echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                        echo "Erro na criação! Tente novamente.";
                        echo '</div>';
                    }
                    unset($_POST['inSequence']);
                    unset($_POST['inNumber']);
                    unset($_POST['inFolder']);
                    unset($_POST['inPage']);
                    unset($_POST['addMenu']);
                    unset($_POST['inLabel']);
                    unset($_POST['inIcon']);
                    unset($_POST['inTooltip']);
                    unset($_POST['addMenu']);
                }
                if(isset($_POST['updateMenu'])){
                    $estrutura_menu->reset();
                    if(isset($_POST['inId']))
                        $estrutura_menu->setId($_POST['inId']);
                    if(isset($_POST['inStatus']))
                        $estrutura_menu->setActive($_POST['inStatus']);
                    if(isset($_POST['inSequence']))
                        $estrutura_menu->setSequence($_POST['inSequence']);
                    if(isset($_POST['inNumber']))
                        $estrutura_menu->setNum($_POST['inNumber']);
                    if(isset($_POST['inFolder']))
                        $estrutura_menu->setFolder($_POST['inFolder']);
                    if(isset($_POST['inPage']))
                        $estrutura_menu->setPageName($_POST['inPage']);
                    if(isset($_POST['inLabel']))
                        $estrutura_menu->setMenuLabel($_POST['inLabel']);
                    if(isset($_POST['inIcon']))
                        $estrutura_menu->setIcon($_POST['inIcon']);
                    if(isset($_POST['inTooltip']))
                        $estrutura_menu->setTooltip($_POST['inTooltip']);

                    if($estrutura_menu->update() > 0){
                        echo '<div class="alert alert-success alert-dismissible fade show text-left" role="alert">';
                        echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                        echo "Novo item adicionado!";
                        echo '</div>';
                    }
                    else
                    {
                        echo '<div class="alert alert-danger alert-dismissible fade show text-left" role="alert">';
                        echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                        echo "Erro na criação! Tente novamente.";
                        echo '</div>';
                    }
                    unset($_POST['inSequence']);
                    unset($_POST['inNumber']);
                    unset($_POST['inFolder']);
                    unset($_POST['inPage']);
                    unset($_POST['addMenu']);
                    unset($_POST['inLabel']);
                    unset($_POST['inIcon']);
                    unset($_POST['inTooltip']);
                    unset($_POST['updateMenu']);
                }
                if(isset($_POST['delMenu'])){
                    $estrutura_menu->setId($_POST['delMenu']);
                    
                    if($estrutura_menu->delete() > 0){
                        echo '<div class="alert alert-success alert-dismissible fade show text-left" role="alert">';
                        echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                        echo "Item foi apagado com sucesso!";
                        echo '</div>';
                    }
                    else
                    {
                        echo '<div class="alert alert-danger alert-dismissible fade show text-left" role="alert">';
                        echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                        echo "Erro na remoção! Tente novamente.";
                        echo '</div>';
                    }
                    unset($_POST['delMenu']);
                }

            ?>

            <table id="example" class="table table-sm table-striped table-bordered" style="width:100%;" > 
            
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">ID</th>
                        <th class="text-center">Ação</th>
                        <th class="text-center">Sequência</th>
                        <th class="text-center">Ordem</th>
                        <th class="text-center">Pasta</th>
                        <th class="text-center">Página</th>
                        <th class="text-center">Ícone</th>  
                        <th class="text-center">Menu</th>
                        <th class="text-center">Dica</th> 
                        <th class="text-center">Ativo</th>
                        <th class="text-center">Criado</th>
                        <th class="text-center">Modificado</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        $where = '1 ORDER BY sequence, num ';
                        if(isset($_POST['inType']))
                            $where = $_POST['inType'].'ORDER BY sequence, num';

                        $lista = $estrutura_menu->selectAll($where);

                        foreach($lista as $key => $value){
                            $value = (object) $value;

                            echo ' <tr> ';

                            echo ' <td class="text-center"> ';
                            echo ($key+1);
                            echo ' </td> ';

                            echo ' <td class="text-center"> ';
                            echo $value->id;
                            echo ' </td> ';

                            echo ' <td class="text-center"> ';

                            echo ' <span title="Editar Menu" data-toggle="tooltip" data-placement="top"><button type="button" class="btn btn-sm btn-info " aria-hidden="true" data-toggle="modal" data-target="#editMenu" data-whateverid="'.$value->id.'" data-whateverstatus="'.$value->active.'" data-whateversequence="'.$value->sequence.'" data-whatevernumber="'.$value->num.'" data-whateverfolder="'.$value->folder.'" data-whateverpage="'.$value->page_name.'" data-whateverlabel="'.$value->menu_label.'" data-whatevericon="'.$value->icon.'" data-whatevertooltip="'.$value->tooltip.'" ><i class="fas fa-edit"></i> </button></span> ';

                            //echo '<button type="button" class="btn btn-sm btn-warning ml-2 " data-toggle="tooltip" data-placement="top" title="Mover para baixo"><i class="fas fa-arrow-down"></i> </button>';

                            //echo '<button type="button" class="btn btn-sm btn-warning ml-2 " data-toggle="tooltip" data-placement="top" title="Mover para cima"><i class="fas fa-arrow-up"></i> </button>';

                            echo '<button class="btn btn-sm btn-danger ml-2" name="delMenu" value="'.$value->id.'" type="submit" data-toggle="tooltip" data-placement="top" title="Apagar registro" onclick="return confirm(\' Tem certeza que quer APAGAR a página <'.$value->folder.' / '.$value->page_name.'> (#'.$value->id.') ?\');"><i class="fas fa-times"></i></button>';

                            echo ' </td> ';

                            echo ' <td class="text-center"> ';
                            echo $value->sequence;
                            echo ' </td> ';

                            echo ' <td class="text-center"> ';
                            echo $value->num;
                            echo ' </td> ';

                            echo ' <td class="text-center"> ';
                            echo $value->folder;
                            echo ' </td> ';

                            echo ' <td class="text-center"> ';
                            echo $value->page_name;
                            echo ' </td> ';

                            echo ' <td class="text-center"> ';
                            echo $value->icon;
                            echo ' </td> ';

                            echo ' <td class="text-center"> ';
                            echo $value->menu_label;
                            echo ' </td> ';

                            echo ' <td class="text-center"> ';
                            echo $value->tooltip;
                            echo ' </td> ';

                            echo ' <td class="text-center"> ';
                            echo $value->active;
                            echo ' </td> ';

                            echo ' <td class="text-center"> ';
                            echo $value->createdby;
                            echo ' </td> ';

                            echo ' <td class="text-center"> ';
                            echo $value->modifiedby;
                            echo ' </td> ';

                            //echo ' <td class="text-center"> ';
                            //echo '<a class="btn btn-info btn-sm" href="index.php?link='.$linkDetails.'&id='.$value->id.'" role="button" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a> ';
                            //echo ' </td> ';


                            echo ' </tr> ';
                        }
                    ?>
                </tbody>

            </table>
                       

        </div>
    </section>
</form>



<!-- Modal Adicionar Menu -->
<div  class="modal fade text-left" id="addMenu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content">

            <form class="form form-validate"  method="post" action="#div_view">

                <div class="modal-header">
                    <h4 class="modal-title">Novo Item</h4>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label class="form-control-label form-control-label-sm"><strong>Sequência</strong></label>
                            <input name="inSequence" id="inSequence" type="number" data-msg="Sequência do menu" class="form-control form-control-sm" value="" required>
                        </div>

                        <div class="form-group col-sm-3">
                            <label class="form-control-label form-control-label-sm"><strong>Ordem</strong></label>
                            <input name="inNumber" id="inNumber" type="number" data-msg="Ordem dentro do menu" class="form-control form-control-sm" value="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label class="form-control-label form-control-label-sm"><strong>Pasta</strong></label>
                            <input name="inFolder" id="inFolder" type="text" data-msg="Local da página" class="form-control form-control-sm" value="" required>
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="form-control-label form-control-label-sm"><strong>Página</strong></label>
                            <input name="inPage" id="inPage" type="text" data-msg="Nome da página" class="form-control form-control-sm" value="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label class="form-control-label form-control-label-sm"><strong>Rótulo do Menu</strong></label>
                            <input name="inLabel" id="inLabel" type="text" data-msg="Rótulo do item de menu" class="form-control form-control-sm" value="" >
                        </div>
                        
                        <div class="form-group col-sm-6">
                            <label class="form-control-label form-control-label-sm"><strong>Ícone </strong></label>
                            <input name="inIcon" id="inIcon" type="text" data-msg="Ícone do Font Awesonme" class="form-control form-control-sm" value="" >
                        </div>

                        <div class="form-group col-sm-8">
                            <label class="form-control-label form-control-label-sm"><strong>Dicas</strong></label>
                            <input name="inTooltip" id="inTooltip" type="text" data-msg="Dica sobre o item de menu" class="form-control form-control-sm" value="" >
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning"><i class="fas fa-times" aria-hidden="true"></i> Cancelar</button>
                    <button name="addMenu" type="submit" class="btn btn-primary ml-3 md-3" value="create" ><i class="fas fa-plus" aria-hidden="true"></i> Criar</button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- Modal Adicionar Menu -->
<div  class="modal fade text-left" id="editMenu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content">

            <form class="form form-validate"  method="post" action="#div_view">

                <div class="modal-header">
                    <h4 class="modal-title">Editar Item</h4>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label class="form-control-label form-control-label-sm">ID</label>
                            <input name="inId" id="inId" type="number" data-msg="Sequência do menu" class="form-control form-control-sm" value="" readonly>
                        </div>
                        <div class="form-group col-md-3 ">
                            <label class="form-control-label">Status</label>
                            <select name="inStatus" id="inStatus" class="form-control form-control-sm " data-msg="Status do item" required>
                                <option></option>
                                <option value='Y'>Ativo</option>
                                <option value='N'>Inativo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label class="form-control-label form-control-label-sm">Sequência</label>
                            <input name="inSequence" id="inSequence" type="number" data-msg="Sequência do menu" class="form-control form-control-sm" value="" >
                        </div>

                        <div class="form-group col-sm-2">
                            <label class="form-control-label form-control-label-sm">Ordem</label>
                            <input name="inNumber" id="inNumber" type="number" data-msg="Ordem dentro do menu" class="form-control form-control-sm" value="" >
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="form-control-label form-control-label-sm">Pasta</label>
                            <input name="inFolder" id="inFolder" type="text" data-msg="Local da página" class="form-control form-control-sm" value="" >
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="form-control-label form-control-label-sm">Página</label>
                            <input name="inPage" id="inPage" type="text" data-msg="Nome da página" class="form-control form-control-sm" value="" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-5">
                            <label class="form-control-label form-control-label-sm">Rótulo do Menu</label>
                            <input name="inLabel" id="inLabel" type="text" data-msg="Rótulo do item de menu" class="form-control form-control-sm" value="" >
                        </div>
                        
                        <div class="form-group col-sm-7">
                            <label class="form-control-label form-control-label-sm">Ícone</label>
                            <input name="inIcon" id="inIcon" type="text" data-msg="Ícone do Font Awesonme" class="form-control form-control-sm" value="" >
                        </div>

                        <div class="form-group col-sm-12">
                            <label class="form-control-label form-control-label-sm">Dicas</label>
                            <input name="inTooltip" id="inTooltip" type="text" data-msg="Dica sobre o item de menu" class="form-control form-control-sm" value="" >
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning"><i class="fas fa-times" aria-hidden="true"></i> Cancelar</button>
                    <button name="updateMenu" type="submit" class="btn btn-primary ml-3 md-3" value="create" ><i class="fas fa-check" aria-hidden="true"></i> Salvar</button>
                </div>

            </form>

        </div>
    </div>
</div>
