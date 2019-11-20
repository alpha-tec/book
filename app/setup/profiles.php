<?php
	include("share/login-secure.php");

    $linkHome = $menu->getPageNumber('home/welcome.php');
    $linkProfileMenus = $menu->getPageNumber('setup/profile-menus.php');

    $estrutura_perfil = Profile::getInstance();
    $estrutura_perfil->setSaveId($contact_id);

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

                <div class="form-group col-sm-5 col-md-4 col-lg-3 col-xl-2">
                    <label class="form-control-label mr-2"><strong>Status</strong></label>
                    <select name="inStatus" data-msg="Informe o status no processo" class="form-control form-control-sm " >
                        <option value="Y" >Ativo</option>
                        <option value="N" >Inativo</option>
                    </select>
                </div>

                <div class="form-group col-sm-7 col-md-6 col-lg-4 col-xl-3 mt-1 mt-sm-0 mt-md-0 mt-lg-0 mt-xl-0">
                    <button class="btn btn-sm btn-info " name="pesquisar" value="10" type="submit" data-toggle="tooltip" data-placement="top" title="Pesquisar"><i class="fa fa-search"></i> Pesquisar</button>

                    <span title="Criar um novo item" data-toggle="tooltip" data-placement="top"><button type="button" class="btn btn-sm btn-success ml-2" aria-hidden="true" data-toggle="modal" data-target="#addProfile" ><i class="fas fa-plus"></i> Novo Item</button></span>
                </div>

            </div>
            <hr class="my-3">
            <?php
                if(isset($_POST['addProfile'])){
                    $estrutura_perfil->reset();
                    if(isset($_POST['inProfile']))
                        $estrutura_menu->setFullname($_POST['inProfile']);
                    if(isset($_POST['inShortName']))
                        $estrutura_menu->setName($_POST['inShortName']);

                    if($estrutura_perfil->insert() > 0){
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
                    unset($_POST['inProfile']);
                    unset($_POST['inShortName']);
                    unset($_POST['addProfile']);
                }
                if(isset($_POST['updateProfile'])){
                    $estrutura_perfil->reset();
                    if(isset($_POST['inId']))
                        $estrutura_perfil->setId($_POST['inId']);
                    if(isset($_POST['inStatus']))
                        $estrutura_perfil->setActive($_POST['inStatus']);
                    if(isset($_POST['inProfile']))
                        $estrutura_perfil->setFullname($_POST['inProfile']);
                    if(isset($_POST['inShortName']))
                        $estrutura_perfil->setName($_POST['inShortName']);

                    if($estrutura_perfil->update() > 0){
                        echo '<div class="alert alert-success alert-dismissible fade show text-left" role="alert">';
                        echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                        echo "Item <b>#{$_POST['inId']}</b> foi atualizado!";
                        echo '</div>';
                    }
                    else
                    {
                        echo '<div class="alert alert-danger alert-dismissible fade show text-left" role="alert">';
                        echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                        echo "Erro na atualização! Tente novamente.";
                        echo '</div>';
                    }
                    unset($_POST['inId']);
                    unset($_POST['inStatus']);
                    unset($_POST['inProfile']);
                    unset($_POST['inShortName']);
                    unset($_POST['updateProfile']);
                }
                if(isset($_POST['delProfile'])){
                    $estrutura_perfil->setId($_POST['delProfile']);
                    
                    if($estrutura_perfil->delete() > 0){
                        echo '<div class="alert alert-success alert-dismissible fade show text-left" role="alert">';
                        echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                        echo "Item #{$_POST['delProfile']} foi apagado com sucesso!";
                        echo '</div>';
                    }
                    else
                    {
                        echo '<div class="alert alert-danger alert-dismissible fade show text-left" role="alert">';
                        echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                        echo "Erro na remoção! Tente novamente.";
                        echo '</div>';
                    }
                    unset($_POST['delProfile']);
                }
            ?>
            <table id="example" class="table table-sm table-striped table-bordered" style="width:100%" > 
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">ID</th>
                        <th class="text-center">Ação</th>
                        <th class="text-center">Abreviação</th>
                        <th class="text-center">Nome</th>
                        <th class="text-center">Ativo</th>
                        <th class="text-center">Criado</th>
                        <th class="text-center">Modificado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $where = '1 ORDER BY name ';
                        $lista = $estrutura_perfil->selectAll($where);
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

                            echo ' <span title="Editar Perfil" data-toggle="tooltip" data-placement="top"><button type="button" class="btn btn-sm btn-info " aria-hidden="true" data-toggle="modal" data-target="#editProfile" data-whateverid="'.$value->id.'" data-whateverstatus="'.$value->active.'" data-whateverprofile="'.$value->fullname.'" data-whatevershortname="'.$value->name.'" ><i class="fas fa-edit"></i> </button></span> ';
                            
                            echo '<span title="Editar Menus" data-toggle="tooltip" data-placement="top"><a class="btn btn-sm btn-secondary ml-2" href="index.php?link='.$linkProfileMenus.'&id='.$value->id.'" target="_blank"><i class="fas fa-bars"></i></a></span>';

                            //echo '<button type="button" class="btn btn-sm btn-danger ml-2 " data-toggle="tooltip" data-placement="top" title="Desativar este perfil"> </button>';

                            echo '<button class="btn btn-sm btn-danger ml-2" name="delProfile" value="'.$value->id.'" type="submit" data-toggle="tooltip" data-placement="top" title="Apagar perfil" onclick="return confirm(\' Tem certeza que quer APAGAR o perfil <'.$value->fullname.'> (#'.$value->id.') ?\');"><i class="fas fa-times"></i></button>';

                            echo ' </td> ';

                            echo ' <td class="text-center"> ';
                            echo $value->name;
                            echo ' </td> ';

                            echo ' <td class="text-center"> ';
                            echo $value->fullname;
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


<!-- Modal Adicionar Perfil -->
<div  class="modal fade text-left" id="addProfile" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog " role="document" >
        <div class="modal-content">

            <form class="form form-validate"  method="post" action="#div_view">

                <div class="modal-header">
                    <h4 class="modal-title">Novo Item</h4>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="form-group col-sm-7">
                            <label class="form-control-label form-control-label-sm"><strong>Perfil</strong></label>
                            <input name="inProfile" id="inProfile" type="text" data-msg="Nome do Perfil" class="form-control form-control-sm" value="" required >
                        </div>
                        <div class="form-group col-sm-5">
                            <label class="form-control-label form-control-label-sm"><strong>Abreviação</strong></label>
                            <input name="inSortName" id="inSortName" type="text" data-msg="Abreviação do Perfil" class="form-control form-control-sm" value="" required >
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning"><i class="fas fa-times" aria-hidden="true"></i> Cancelar</button>
                    <button name="addProfile" type="submit" class="btn btn-primary ml-3 md-3" value="create" ><i class="fas fa-plus" aria-hidden="true"></i> Criar</button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- Modal Adicionar Menu -->
<div  class="modal fade text-left" id="editProfile" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog " role="document" >
        <div class="modal-content">

            <form class="form form-validate"  method="post" action="#div_view">

                <div class="modal-header">
                    <h4 class="modal-title">Editar Item</h4>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label class="form-control-label form-control-label-sm">ID</label>
                            <input name="inId" id="inId" type="number" data-msg="Sequência do menu" class="form-control form-control-sm" value="" readonly>
                        </div>
                        <div class="form-group col-md-4 ">
                            <label class="form-control-label">Status</label>
                            <select name="inStatus" id="inStatus" class="form-control form-control-sm " data-msg="Status do item" required>
                                <option></option>
                                <option value='Y'>Ativo</option>
                                <option value='N'>Inativo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-7">
                            <label class="form-control-label form-control-label-sm">Perfil</label>
                            <input name="inProfile" id="inProfile" type="text" data-msg="Nome do Perfil" class="form-control form-control-sm" value="" >
                        </div>

                        <div class="form-group col-sm-5">
                            <label class="form-control-label form-control-label-sm">Abreviação</label>
                            <input name="inShortName" id="inShortName" type="text" data-msg="Abreviação do Perfil" class="form-control form-control-sm" value="" >
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning"><i class="fas fa-times" aria-hidden="true"></i> Cancelar</button>
                    <button name="updateProfile" type="submit" class="btn btn-primary ml-3 md-3" value="create" ><i class="fas fa-check" aria-hidden="true"></i> Salvar</button>
                </div>

            </form>

        </div>
    </div>
</div>


