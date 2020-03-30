<!-- Bootstrap CSS-->
<link rel="stylesheet" href="../publico/vendor/bootstrap/css/bootstrap.min.css">
<!-- Font Awesome CSS-->
<link rel="stylesheet" href="../publico/vendor/font-awesome/css/all.min.css">
<!-- Fontastic Custom icon font-->
<link rel="stylesheet" href="../publico/css/fontastic.css">
<!-- Google fonts - Roboto -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
<!-- Bootstrap Select CSS-->
<link rel="stylesheet" href="../publico/vendor/bootstrap-select/css/bootstrap-select.min.css">
<!-- Bootstrap Touchspin CSS-->
<link rel="stylesheet" href="../publico/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css">
<!-- Bootstrap Datepicker CSS-->
<link rel="stylesheet" href="../publico/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css">
<!-- Bootstrap Tags input CSS-->
<link rel="stylesheet" href="../publico/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css">
<!-- No UI Slider-->
<link rel="stylesheet" href="../publico/vendor/nouislider/nouislider.css">

<!-- DataTables CSS-->
<link rel="stylesheet" href="../publico/vendor/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../publico/vendor/datatables/css/buttons.bootstrap4.min.css">

<!--    
<link rel="stylesheet" href="../publico/vendor/datatables/css/responsive.bootstrap4.min.css">

<link rel="stylesheet" href="https://d19m59y37dris4.cloudfront.net/dashboard-premium/1-4-4/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://d19m59y37dris4.cloudfront.net/dashboard-premium/1-4-4/vendor/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
-->

<!-- Summernote -->
<link href="../publico/vendor/summernote/dist/summernote-bs4.css" / rel="stylesheet">

<!-- jQuery Circle-->
<link rel="stylesheet" href="../publico/css/grasp_mobile_progress_circle-1.0.0.min.css">
<!-- Custom Scrollbar-->
<link rel="stylesheet" href="../publico/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
<!-- theme stylesheet-->
<link rel="stylesheet" href="../publico/css/style_ial.css" id="theme-stylesheet">
<!-- Custom stylesheet - for your changes-->
<link rel="stylesheet" href="../publico/css/custom.css">
<!-- <link rel="stylesheet" href="../publico/css/print.css"> -->

<!-- Favicon-->
<link rel="apple-touch-icon" sizes="57x57" href="../publico/img/projeto/ico/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="../publico/img/projeto/ico/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="../publico/img/projeto/ico/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="../publico/img/projeto/ico/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="../publico/img/projeto/ico/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="../publico/img/projeto/ico/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="../publico/img/projeto/ico/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="../publico/img/projeto/ico/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="../publico/img/projeto/ico/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="../publico/img/projeto/ico/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="../publico/img/projeto/ico/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="../publico/img/projeto/ico/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="../publico/img/projeto/ico/favicon-16x16.png">
<link rel="manifest" href="../publico/img/projeto/ico/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="../publico/img/projeto/ico/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<style type="text/css">
    @media screen { 
        #printSection {
            display: none;
        }
    }

    @media print {
        body > *:not(#printSection) {
            display: none;
        }
        #printSection, #printSection * {
            visibility: visible;
        }
        #printSection {
            position:absolute;
            left:0;
            top:0;
        }
    }
</style>


<!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]
oncopy="return false" oncut="return false"
oncopy="return false" oncut="return false"
-->

<?php 
    if($profile_id > 5){
        echo '<script language=JavaScript> ';
        //Disable right mouse click Script
        //By Maximus (maximus@nsimail.com) w/ mods by DynamicDrive
        //For full source code, visit http://www.dynamicdrive.com
        echo 'var message="Função desabilitada!"; ';
    
        echo 'function clickIE4(){
                if(event.button == 2){
                    alert(message);
                    return false;
                }
              } ';
    
        echo 'function clickNS4(e){
                if(document.layers || document.getElementById && !document.all){
                    if(e.which == 2 || e.which == 3){
                        alert(message);
                        return false;
                    }
                }
              } ';
    
        echo 'if(document.layers){
                document.captureEvents(Event.MOUSEDOWN);
                document.onmousedown=clickNS4;
              }else if(document.all && !document.getElementById){
                document.onmousedown = clickIE4;
              }
              document.oncontextmenu = new Function("alert(message);return false") ';
    
        echo '</script> ';
    }  
?>

 