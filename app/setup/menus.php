<?php
	include("share/login-secure.php");

    $linkHome = $menu->getPageNumber('home/welcome.php');

    $estrutura_menu = Menu::getInstance();
    $estrutura_menu->setSaveId($contact_id);

    $lista = $estrutura_menu->selectAll('1 ORDER BY sequence, num ');

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

            <div class="form-group col-sm-4 col-lg-2">
                <label class="form-control-label "><strong>Tipo</strong></label>
                <select name="inType" data-msg="Informe o tipo da escola" class="form-control form-control-sm " >
                    <option value="" >Todos </option>
                    <option value="'A'"  >Particular </option>
                    <option value="'B','C'" >Pública </option>
                </select>
            </div>

            <div class="form-group col-sm-4 col-lg-2">
                <label class="form-control-label "><strong>Etapa no Processo</strong></label>
                <select name="inEtapa" data-msg="Informe a etapa no processo" class="form-control form-control-sm " >
                    <option value=""  >Todos </option>
                </select>
            </div>

            <div class="form-group col-sm-4 col-lg-2">
                <label class="form-control-label "><strong>Status</strong></label>
                <select name="inStatus" data-msg="Informe o status no processo" class="form-control form-control-sm " >
                    <option value="Y" >Ativo</option>
                    <option value="N" >Inativo (Desistiu ou Não Passou)</option>
                </select>
            </div>

            <div class="form-group col-sm-4 col-lg-2">
                <button class="btn btn-sm btn-info mt-3 mr-2" name="pesquisar" value="10" type="submit" data-toggle="tooltip" data-placement="top" title="Pesquisar"><i class="fa fa-search"></i>Pesquisar</button>
            </div>

        </div>

        <hr class="my-2">

        <div class="row mt-1">

            <table id="example" class="table table-sm table-striped table-bordered" style="width:100%" > 
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">id</th>
                        <th class="text-center">Seq</th>
                        <th class="text-center">Num</th>
                        <th class="text-center">Label</th>
                        <th class="text-center">Icon</th>  
                        <th class="text-center">Tooltip</th> 
                        <th class="text-center">Folder</th>
                        <th class="text-center">Page</th>
                        <th class="text-center">Active</th>
                        <th class="text-center">Created</th>
                        <th class="text-center">Created By</th>
                        <th class="text-center">Modified</th>
                        <th class="text-center">Modified By</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
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
                            echo $value->sequence;
                            echo ' </td> ';

                            echo ' <td class="text-center"> ';
                            echo $value->num;
                            echo ' </td> ';

                            echo ' <td class="text-center"> ';
                            echo $value->menu_label;
                            echo ' </td> ';

                            echo ' <td class="text-center"> ';
                            echo $value->icon;
                            echo ' </td> ';

                            echo ' <td class="text-center"> ';
                            echo $value->tooltip;
                            echo ' </td> ';

                            echo ' <td class="text-center"> ';
                            echo $value->folder;
                            echo ' </td> ';

                            echo ' <td class="text-center"> ';
                            echo $value->page_name;
                            echo ' </td> ';

                            echo ' <td class="text-center"> ';
                            echo $value->active;
                            echo ' </td> ';

                            echo ' <td class="text-center"> ';
                            echo $value->created;
                            echo ' </td> ';

                            echo ' <td class="text-center"> ';
                            echo $value->createdby;
                            echo ' </td> ';

                            echo ' <td class="text-center"> ';
                            echo $value->modified;
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




