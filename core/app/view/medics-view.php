<?php 
if(isset($_GET["opt"]) && $_GET["opt"]=="all"):?>
<section class="">
<div class="row">
	<div class="col-md-12">
<div class="card">
  <div class="card-header text-white bg-primary">Medicos</div>
  <div class="card-body">
	<a href="./?view=medics&opt=new" class="btn btn-secondary"><i class='bi-plus'></i> Nuevo Medico</a>
<br><br>
		<?php
		$users = MedicData::getAll();
		if(count($users)>0){
			?>
			<div class="box box-primary">
			<table class="table datatable table-bordered datatable table-hover">
			<thead>
			<th>Nombre completo</th>
			<th>Direccion</th>
			<th>Email</th>
			<th>Telefono</th>
			<th>Area</th>
			<th></th>
			</thead>
			<?php
			foreach($users as $user):
				?>
				<tr>
				<td><?php echo $user->name." ".$user->lastname; ?></td>
				<td><?php echo $user->address; ?></td>
				<td><?php echo $user->email; ?></td>
				<td><?php echo $user->phone; ?></td>
				<td><?php if($user->category_id!=null){ echo $user->getCategory()->name; } ?></td>
				<td style="width:280px;">
				<a href="index.php?view=medics&opt=history&id=<?php echo $user->id;?>" class="btn btn-secondary btn-sm"><i class="bi-clock-history"></i> Historial</a>
				<a href="index.php?view=medics&opt=edit&id=<?php echo $user->id;?>" class="btn btn-warning btn-sm"><i class="bi-pencil"></i></a>
				<a href="index.php?action=medics&opt=del&id=<?php echo $user->id;?>" class="btn btn-danger btn-sm"><i class="bi-trash"></i></a>
				</td>
				</tr>
				<?php

			endforeach; ?>
</table>
</div>
<?php		}else{
			?>
			<p class="alert alert-warning">No hay medicos.</p>
			<?php
		}

		?>
  </div>
</div>

	</div>
</div>
</section>
<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="new"):
$categories = CategoryData::getAll();
?>
<section class="">
<div class="row">
	<div class="col-md-12">
<div class="card">
  <div class="card-header text-white bg-success">Nuevo Medico</div>
  <div class="card-body">
	<br>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?action=medics&opt=add" role="form">

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Area*</label>
    <div class="col-md-6">
    <select name="category_id" class="form-control" required>
    <option value="">-- SELECCIONE --</option>      
    <?php foreach($categories as $cat):?>
    <option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>      
    <?php endforeach;?>
    </select>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" required class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Apellido*</label>
    <div class="col-md-6">
      <input type="text" name="lastname" required class="form-control" id="lastname" placeholder="Apellido">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Direccion*</label>
    <div class="col-md-6">
      <input type="text" name="address" required class="form-control"  id="address" placeholder="Direccion">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Email*</label>
    <div class="col-md-6">
      <input type="text" name="email" class="form-control" id="email" placeholder="Email">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Telefono*</label>
    <div class="col-md-6">
      <input type="text" name="phone" class="form-control" id="phone" placeholder="Telefono">
    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Agregar Medico</button>
    </div>
  </div>
</form>
</div>
</div>
	</div>
</div>
</section>
<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="edit"):
$user = MedicData::getById($_GET["id"]);
$categories = CategoryData::getAll();
?>
<div class="">
<div class="row">
	<div class="col-md-12">
<div class="card">
  <div class="card-header text-white bg-info">Editar Medico</div>
  <div class="card-body">
	<br>
		<form class="form-horizontal" method="post" id="editproduct" action="index.php?action=medics&opt=upd" role="form">

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Area*</label>
    <div class="col-md-6">
    <select name="category_id" class="form-control" required>
    <option value="">-- SELECCIONE --</option>      
    <?php foreach($categories as $cat):?>
    <option value="<?php echo $cat->id; ?>" <?php if($user->category_id==$cat->id){ echo "selected"; }?>><?php echo $cat->name; ?></option>      
    <?php endforeach;?>
    </select>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" value="<?php echo $user->name;?>" class="form-control" required id="name" placeholder="Nombre">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Apellido*</label>
    <div class="col-md-6">
      <input type="text" name="lastname" value="<?php echo $user->lastname;?>" required class="form-control" id="lastname" placeholder="Apellido">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Direccion*</label>
    <div class="col-md-6">
      <input type="text" name="address" value="<?php echo $user->address;?>" class="form-control" required id="address" placeholder="Direccion">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Email*</label>
    <div class="col-md-6">
      <input type="text" name="email" value="<?php echo $user->email;?>" class="form-control" id="email" placeholder="Email">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Telefono</label>
    <div class="col-md-6">
      <input type="text" name="phone" value="<?php echo $user->phone;?>" class="form-control" id="phone" placeholder="Telefono">
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
      <button type="submit" class="btn btn-primary">Actualizar Medico</button>
    </div>
  </div>
</form>

</div>
</div>
	</div>
</div>
</div>
<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="history"):
$pacient = MedicData::getById($_GET["id"]);
?>
<section class="">
<div class="row">
	<div class="col-md-12">
<div class="card">
  <div class="card-header text-white bg-primary">Historial de Citas del Medico</div>
  <div class="card-body">
	<p>Medico: <?php echo $pacient->name." ".$pacient->lastname;?></p>
	<br>
		<?php
		$users = ReservationData::getAllByMedicId($_GET["id"]);
		if(count($users)>0){
			?>
			<table class="table table-bordered table-hover">
			<thead>
			<th>Asunto</th>
			<th>Paciente</th>
			<th>Medico</th>
			<th>Fecha</th>
			</thead>
			<?php
			foreach($users as $user){
				$pacient_item  = $user->getPacient();
				$medic_item = $user->getMedic();
				?>
				<tr>
				<td><?php echo $user->title; ?></td>
				<td><?php echo $pacient_item->name." ".$pacient_item->lastname; ?></td>
				<td><?php echo $medic_item->name." ".$medic_item->lastname; ?></td>
				<td><?php echo $user->date_at." ".$user->time_at; ?></td>
				</tr>
				<?php

			}
?>
</table>
<?php

		}else{
			echo "<p class='alert alert-warning'>No hay citas</p>";
		}
		?>

</div>
</div>
	</div>
</div>
</section>
<?php endif; ?>
