
<script type="text/javascript">

    $(function(){
        var e=$("#datatable1").DataTable( {
            lengthChange: false,
            buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
            responsive:{ details:!1 }
            
        });

        $(document).on("sidebarChanged", function(){
            e.columns.adjust(),
            e.responsive.recalc(),
            e.responsive.rebuild()
        });
    });

    $(document).ready(function(){
        $('#simpleTable').DataTable({
            searching: false,
            bInfo: false,
            responsive: true,
            lengthChange: false,
            scrollCollapse: false,
            scrollX: false,
            scrollY: false,
            paging: false
            });
        });

    $(document).ready(function() {
        $('#example').DataTable({
            responsive: true,
            dom: "<'row'<'col-md-3 text-left'f><'col-md-5'l><'col-md-4 text-right'B>>" + "<'row'<'col-md-12'tr>>" + "<'row'<'col-md-5'i><'col-md-7'p>>",
            lengthChange: false,
            buttons: [ 
                {   
                    extend:'excel',
                    title: 'ial360-export'
                }, 
                {
                    extend: 'pdf',
                    title: 'ial360-export',
                    orientation: 'landscape'
                } ],
            scrollCollapse: true,
            scrollX:        false,
            paging:         true,
            language: {
                sEmptyTable: "Nenhum registro encontrado",
                sInfo: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                sInfoEmpty: "Mostrando 0 até 0 de 0 registros",
                sInfoFiltered: "(Filtrados de _MAX_ registros)",
                sInfoPostFix: "",
                sInfoThousands: ".",
                sLengthMenu: "_MENU_ &nbsp; resultados por página",
                sLoadingRecords: "Carregando...",
                sProcessing: "Processando...",
                sZeroRecords: "Nenhum registro encontrado",
                sSearch: "Filtro",
                oPaginate: {
                    sNext: "Próximo",
                    sPrevious: "Anterior",
                    sFirst: "Primeiro",
                    sLast: "Último"
                    },
                oAria: {
                    sSortAscending: ": Ordenar colunas de forma ascendente",
                    sSortDescending: ": Ordenar colunas de forma descendente"
                    },
                select: {
                    rows: {
                        "_": "Selecionado %d linhas",
                        "0": "Nenhuma linha selecionada",
                        "1": "Selecionado 1 linha"
                        }
                    }
                }
            });
        });
</script>

<script> //MODAL
    $('#editProfile').on('show.bs.modal', function (event) { 
        var button = $(event.relatedTarget) 
        var recipientId = button.data('whateverid') 

        var recipientStatus = button.data('whateverstatus')
        var recipientProfile = button.data('whateverprofile')
        var recipientShortName = button.data('whatevershortname')

        var modal = $(this) 

        //if($lista->recipientActive == 'Y')
        //    echo " modal.find('#inActive').prop('checked', true) ";
        //else
        //    echo " modal.find('#inActive').prop('checked', false) ";

        modal.find('#inId').val(recipientId)
        modal.find('#inStatus').val(recipientStatus)
        modal.find('#inProfile').val(recipientProfile) 
        modal.find('#inShortName').val(recipientShortName)
    })

    $('#editMenu').on('show.bs.modal', function (event) { 
        var button = $(event.relatedTarget) 
        var recipientId = button.data('whateverid') 
        var recipientStatus = button.data('whateverstatus')
        var recipientSequence = button.data('whateversequence')
        var recipientNumber = button.data('whatevernumber')
        var recipientFolder = button.data('whateverfolder') 
        var recipientPage = button.data('whateverpage') 
        var recipientLabel = button.data('whateverlabel') 
        var recipientIcon = button.data('whatevericon') 
        var recipientTooltip = button.data('whatevertooltip') 

        var modal = $(this) 

        //if($lista->recipientActive == 'Y')
        //    echo " modal.find('#inActive').prop('checked', true) ";
        //else
        //    echo " modal.find('#inActive').prop('checked', false) ";

        modal.find('#inId').val(recipientId)
        modal.find('#inStatus').val(recipientStatus)
        modal.find('#inSequence').val(recipientSequence)
        modal.find('#inNumber').val(recipientNumber)
        modal.find('#inFolder').val(recipientFolder)
        modal.find('#inPage').val(recipientPage)
        modal.find('#inLabel').val(recipientLabel)
        modal.find('#inIcon').val(recipientIcon)
        modal.find('#inTooltip').val(recipientTooltip)
    })

</script>


<script>
    $('#mySelect option').each(function() {
        var myString = $(this).text();
        if(myString.length > 49){
            $(this).text(myString.substring(0, 49) + ' ...');
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#summernote').summernote({
            height: "300px",
            styleWithSpan: false
            //toolbar: [
                // [groupName, [list of button]]
                //['style', ['bold', 'italic', 'underline', 'clear']],
                //['font', ['strikethrough', 'superscript', 'subscript']],
                //['fontsize', ['fontsize']],
                //['color', ['color']],
                //['para', ['ul', 'ol', 'paragraph']],
                //['height', ['height']],
                //['fontsytle': ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New']]
                //]
            });
        });
    var postForm = function() {
        var content = $('textarea[name="inContent"]').html($('#summernote').code());
        }
</script>



<script>
    var $input = $(".typeahead3");

    $input.typeahead({
        source: [
            <?php
                if(!empty($school_list))
                    if(isset($school_list)){
                        $i = 0; $qty = count($school_list);
                        while( $i < $qty ){
                            //echo '{ id: "'.$school_list[$i]->id.'", name: "'.mb_strtolower($school_list[$i]->name, 'UTF-8').'" }';
                            echo '{ id: "'.$school_list[$i]->id.'", name: "'.stripslashes($school_list[$i]->name).' ('.mb_strtolower    ($school_list[$i]->segment, 'UTF-8').')" }';
                            $i++;
                            if( $i < $qty)
                                echo ", ";
                        }
                    }
            ?>
            ],
        afterSelect: function(args){
            $('#inSchoolId').val(args.id );
            }
        });

    $input.on('typeahead3:selected', function (e, datum) {
        console.log(datum);
        $('#item_code').val(datum.value);
    });

    $input.change(function() {
        var current = $input.typeahead("getActive");
        if (current) {
            // Some item from your model is active!
            if (current.name == $input.val()) {
                // This means the exact match is found. Use toLowerCase() if you want case insensitive match.
            } else {
                // This means it is only a partial match, you can either add a new item
                // or take the active if you don't want new items
                }
        } else {
            // Nothing is active so it is a new value (or maybe empty value)
            }
        });
    
</script>                  

<script>
    var $input = $(".typeahead2");

    $input.typeahead({
        source: [
            <?php
                if(!empty($subgrouping))
                    if(isset($subgrouping)){
                        $i = 0; $qty = count($subgrouping);
                        while( $i < $qty ){
                            echo '{id: "'.($i+1).'", name: "'.$subgrouping[$i]->subgrouping.'"}';
                            $i++;
                            if( $i < $qty)
                                echo ", ";
                        }
                    }
            ?>
            ],
        autoSelect: true
        });

    $input.change(function() {
        var current = $input.typeahead("getActive");
        if (current) {
            // Some item from your model is active!
            if (current.name == $input.val()) {
                // This means the exact match is found. Use toLowerCase() if you want case insensitive match.
            } else {
                // This means it is only a partial match, you can either add a new item
                // or take the active if you don't want new items
                }
        } else {
            // Nothing is active so it is a new value (or maybe empty value)
            }
        });

</script>                  

<script  type="text/javascript">
    function printDiv(div) {    
        // Create and insert new print section
        var elem = document.getElementById(div);
        var domClone = elem.cloneNode(true);
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        $printSection.appendChild(domClone);
        document.body.insertBefore($printSection, document.body.firstChild);

        window.print(); 

        // Clean up print section for future use
        var oldElem = document.getElementById("printSection");
        if (oldElem != null) { oldElem.parentNode.removeChild(oldElem); } 
                            //oldElem.remove() not supported by IE

        return true;
    }
</script>
