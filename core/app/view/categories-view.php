<?php
if(isset($_GET["opt"]) && $_GET["opt"]=="all"):?>
<section class="">
<div class="row">
	<div class="col-md-12">
<div class="card">
  <div class="card-header text-white bg-primary">Categorias</div>
  <div class="card-body">
	<a href="./?view=categories&opt=new" class="btn btn-secondary"><i class='bi-plus'></i> Nueva Categoria</a>


	<br><br>
		<?php
		$users = CategoryData::getAll();
		if(count($users)>0){
			?>
			<div class="box box-primary">
			<table class="table datatable table-bordered datatable table-hover">
			<thead>
			<th>Nombre</th>
			<th></th>
			</thead>
			<?php
			foreach($users as $user):
				?>
				<tr>
				<td><?php echo $user->name; ?></td>
				<td style="width:200px;">
				<a href="index.php?view=categories&opt=edit&id=<?php echo $user->id;?>" class="btn btn-warning btn-sm"><i class="bi-pencil"></i></a>
				<a href="index.php?action=categories&opt=del&id=<?php echo $user->id;?>" class="btn btn-danger btn-sm"><i class="bi-trash"></i></a>
				</td>
				</tr>
				<?php

			endforeach; ?>
</table>
</div>
<?php		}else{
			?>
			<p class="alert alert-warning">No hay categorias.</p>
			<?php
		}

		?>
  </div>
</div>

	</div>
</div>
</section>
<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="new"):?>
<section class="">
<div class="row">
	<div class="col-md-12">
<div class="card">
  <div class="card-header text-white bg-success">Agregar Categoria</div>
  <div class="card-body">
	<br>
		<form class="form-horizontal" method="post" id="addcategory" action="index.php?action=categories&opt=add" role="form">
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" required class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
<br>
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Agregar Categoria</button>
    </div>
  </div>
</form>
</div>
</div>
	</div>
</div>
</section>
<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="edit"):?>
<div class="">
<?php $user = CategoryData::getById($_GET["id"]);?>
<div class="row">
	<div class="col-md-12">
<div class="card">
  <div class="card-header text-white bg-info">Editar Categoria</div>
  <div class="card-body">
	<br>
		<form class="form-horizontal" method="post" id="editcategory" action="index.php?action=categories&opt=upd" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" value="<?php echo $user->name;?>" class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
<br>
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
      <button type="submit" class="btn btn-primary">Actualizar Categoria</button>
    </div>
  </div>
</form>

</div>
</div>
	</div>
</div>
</div>
<?php endif; ?>
