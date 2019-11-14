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
    <section class="forms" style="width: 100%;">
        <div class="container-fluid " style="width: 100%;">

        <div class="row mt-1">

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
                            echo $value->id;
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

        </div>
    </section>
</form>




