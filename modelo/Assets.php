<?php 

class Assets{



function nav($ruta,$titulo)
{

  include''.$ruta.'/templates/nav.php';

}


function breadcrumbs($menu='',$submenu='')
{

echo '
<!-- Inicio  Breadcrumbs-->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="#">'.$menu.'</a>
</li>
<li class="breadcrumb-item active">'.$submenu.'</li>
</ol>
<!-- Fin  Breadcrumbs-->

';



}


function footer($ruta)
{
  include''.$ruta.'/templates/footer.php';
}


function datatables()
{
echo '<!-- Datatables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>';
}


function datatables_export()
{
echo '<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
';
}



function sweetalert()
{
echo '  
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
';
}
function selectize()
{
echo '<link rel="stylesheet" href="https://selectize.github.io/selectize.js/css/selectize.default.css" >
<script src="https://selectize.github.io/selectize.js/js/selectize.js"></script>';
}
function jqueryiu()
{
	echo '<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">';
}


function prism()
{

echo '<link rel="stylesheet" href="'.URL.'assets/prism/prism.css">
     <script src="'.URL.'assets/prism/prism.js"></script>';  
}

function codemirror_sql()
{

echo '
<link rel="stylesheet" href="https://codemirror.net/lib/codemirror.css" />
<script src="https://codemirror.net/lib/codemirror.js"></script>
<script src="https://codemirror.net/mode/sql/sql.js"></script>
<script src="https://codemirror.net/addon/hint/show-hint.js"></script>
<script src="https://codemirror.net/addon/hint/sql-hint.js"></script>
<link rel="stylesheet" href="https://codemirror.net/theme/monokai.css">
<script src="https://codemirror.net/keymap/sublime.js"></script>';

}


function select_bootstrap()
{

echo '
<script src="https://silviomoreto.github.io/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<link rel="stylesheet" href="https://silviomoreto.github.io/bootstrap-select/dist/css/bootstrap-select.min.css">
 ';


}

function summernote()
{

echo ' 
<!-- include summernote css/js -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>';

}




function clipboard()
{

echo '<script src="https://norfipc.com/js/clipboard.min.js"></script>';

}




}




 ?>