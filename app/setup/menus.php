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
    <section class="forms" >
        <div class="container-fluid " >

            <div class="row mt-1">

                <div class="form-group col-sm-4 col-md-3 col-lg-2">
                    <label class="form-control-label "><strong>Tipo</strong></label>
                    <select name="inType" data-msg="Informe o tipo da escola" class="form-control form-control-sm " >
                        <option value=" 1 " >Todos </option>
                        <option value=" num in (0, 1)" >Soente Menus </option>
                        <option value=" num>2 AND CHAR_LENGTH(menu_label)>1 " >Somente Submenu </option>
                        <option value=" num>2 AND menu_label IS NULL " >Somente Páginas </option>
                    </select>
                </div>

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

            <table id="example" class="table table-sm table-striped table-bordered" style="width:100%;" > 
            
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Ação</th>
                        <th class="text-center">Sequência</th>
                        <th class="text-center">Ordem</th>
                        <th class="text-center">Menu</th>
                        <th class="text-center">Ícone</th>  
                        <th class="text-center">Dica</th> 
                        <th class="text-center">Pasta</th>
                        <th class="text-center">Página</th>
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

                            echo ' <span title="Editar Menu" data-toggle="tooltip" data-placement="top"><button type="button" class="btn btn-sm btn-info " aria-hidden="true" data-toggle="modal" data-target="#editMenu" ><i class="fas fa-edit"></i> </button></span> ';

                            echo '<button type="button" class="btn btn-sm btn-warning ml-2 " data-toggle="tooltip" data-placement="top" title="Mover para baixo"><i class="fas fa-arrow-down"></i> </button>';

                            echo '<button type="button" class="btn btn-sm btn-warning ml-2 " data-toggle="tooltip" data-placement="top" title="Mover para cima"><i class="fas fa-arrow-up"></i> </button>';

                            echo '<button type="button" class="btn btn-sm btn-danger ml-2 " data-toggle="tooltip" data-placement="top" title="Desativar este menu"><i class="fas fa-times"></i> </button>';

                            //echo $value->id;
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
                    <h4 class="modal-title">Criar Menu</h4>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="form-group col-sm-12">
                            <label class="form-control-label form-control-label-sm"><strong>Nome da Escola</strong></label>
                            <input name="inSchoolName" id="inSchoolName" type="text" data-msg="Informe o nome completo da escola" class="form-control form-control-sm" value="" required>
                        </div>

                        <div class="form-group col-sm-4">
                            <label class="form-control-label "><strong>Tipo</strong></label>
                            <select name="inSchoolType" id="inSchoolType" data-msg="Informe o tipo da escola" class="form-control form-control-sm" required>
                                <option></option>
                                <option value="A">Particular</option>
                                <option value="C">Pública</option>
                            </select>
                        </div>

                        <div class="form-group col-sm-4">
                            <label class="form-control-label "><strong>Segmento</strong></label>
                            <select name="inSchoolSegment" id="inSchoolSegment" data-msg="Informe o segmento de atuação da escola" class="form-control form-control-sm" required>
                                <option></option>
                                <option value="INFANTIL">ENSINO INFANTIL</option>
                                <option value="INFANTIL/FUNDAMENTAL">ENSINO INFANTIL/FUNDAMENTAL</option>
                                <option value="INFANTIL/FUNDAMENTAL/MÉDIO">ENSINO INFANTIL/FUNDAMENTAL/MÉDIO</option>
                                <option value="INFANTIL/FUNDAMENTAL/MÉDIO/TÉCNICO">ENSINO INFANTIL/FUNDAMENTAL/MÉDIO/TÉCNICO</option>
                                <option value="FUNDAMENTAL">ENSINO FUNDAMENTAL</option>
                                <option value="FUNDAMENTAL/MÉDIO">ENSINO FUNDAMENTAL/MÉDIO</option>
                                <option value="FUNDAMENTAL/MÉDIO/TÉCNICO">ENSINO FUNDAMENTAL/MÉDIO/TÉCNICO</option>
                                <option value="MÉDIO">ENSINO MÉDIO</option>
                                <option value="MÉDIO/TÉCNICO">ENSINO MÉDIO/TÉCNICO</option>
                                <option value="TÉCNICO">ENSINO TÉCNICO</option>
                            </select>
                        </div>

                        <div class="form-group col-sm-4">
                            <label class="form-control-label form-control-label-sm"><strong>Telefone da Escola</strong></label>
                            <input name="inSchoolContactPhone" id="inSchoolContactPhone" type="text" data-msg="Informe o telefone de contato da escola" class="form-control form-control-sm" value="" >
                        </div>

                        <div class="form-group col-sm-6">
                            <label class="form-control-label form-control-label-sm"><strong>Contato da Escola</strong></label>
                            <input name="inSchoolContactName" id="inSchoolContactName" type="text" data-msg="Informe o nome de contato da escola" class="form-control form-control-sm" value="" >
                        </div>

                        <div class="form-group col-sm-6">
                            <label class="form-control-label form-control-label-sm"><strong>E-mail da Escola</strong></label>
                            <input name="inSchoolContactEmail" id="inSchoolContactEmail" type="text" data-msg="Informe o e-mail de contato da escola" class="form-control form-control-sm" value="" >
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning"><i class="fas fa-times" aria-hidden="true"></i> Cancelar</button>
                    <button name="add" type="submit" class="btn btn-primary ml-3 md-3" value="create" ><i class="fas fa-check" aria-hidden="true"></i> Criar</button>
                </div>

            </form>

        </div>
    </div>
</div>
