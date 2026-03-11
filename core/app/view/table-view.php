<div class="container">
<div class="row">
<div class="col-md-12">

<h1>Tablas</h1>
<?php

$data = array(
	"header"=>array("","Nombre","Apellidos","Telefono",""),
	"body"=> array(
		array("","Agustin","Ramos","+5219141183199","<a href='./?view=item&id=1' class='btn btn-xs btn-primary'>Ver</a>"),
		array("","Agustin","Ramos","+5219141183199","<a href='./?view=item&id=1' class='btn btn-xs btn-primary'>Ver</a>"),
		array("","Agustin","Ramos","+5219141183199","<a href='./?view=item&id=1' class='btn btn-xs btn-primary'>Ver</a>")
		)
	);
echo Table::render($data);
?>
</div>
</div>
</div>