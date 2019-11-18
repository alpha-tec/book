<?php
	include("share/login-secure.php");

    $linkHome = $menu->getPageNumber('home/welcome.php');

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
    <section class="forms" >
        <div class="container-fluid " >

            <div class="row mt-1">

                <div class="form-group col-sm-3 col-lg-2">
                    <label class="form-control-label "><strong>Status</strong></label>
                    <select name="inStatus" data-msg="Informe o status no processo" class="form-control form-control-sm " >
                        <option value="Y" >Ativo</option>
                        <option value="N" >Inativo</option>
                    </select>
                </div>

                <div class="form-group col-sm-2 col-lg-1">
                    <button class="btn btn-sm btn-info mt-3" name="pesquisar" value="10" type="submit" data-toggle="tooltip" data-placement="top" title="Pesquisar"><i class="fa fa-search"></i> Pesquisar</button>
                </div>

                <div class="form-group col-sm-2 col-lg-2">
                    <button class="btn btn-sm btn-success ml-4 mt-3" name="criar" value="10" type="submit" data-toggle="tooltip" data-placement="top" title="Criar novo item"><i class="fas fa-plus"></i> Criar</button>
                </div>

            </div>
            <hr class="my-2">


            <table id="example" class="table table-sm table-striped table-bordered" style="width:100%" > 
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Ação</th>
                        <th class="text-center">Nome</th>
                        <th class="text-center">Nome Completo</th>
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

                            echo ' <span title="Editar Perfil" data-toggle="tooltip" data-placement="top"><button type="button" class="btn btn-sm btn-info " aria-hidden="true" data-toggle="modal" data-target="#editMenu" ><i class="fas fa-edit"></i> </button></span> ';

                            echo '<button type="button" class="btn btn-sm btn-danger ml-2 " data-toggle="tooltip" data-placement="top" title="Desativar este perfil"><i class="fas fa-times"></i> </button>';

                            //echo $value->id;
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




