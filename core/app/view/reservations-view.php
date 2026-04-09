<?php 
if(isset($_GET["opt"]) && $_GET["opt"]=="all"):?>
<section class="">
<div class="row">
	<div class="col-md-12">
<div class="card">
  <div class="card-header text-white bg-primary">Citas</div>
  <div class="card-body">
	<a href="./?view=reservations&opt=new" class="btn btn-secondary"><i class='bi-plus'></i> Nueva Cita</a>
	<a href="./?view=reservations&opt=old" class="btn btn-default"><i class='bi-clock-history'></i> Citas Anteriores</a>
<br><br>
<form class="form-horizontal" role="form">
<input type="hidden" name="view" value="reservations">
<input type="hidden" name="opt" value="all">
        <?php
$pacients = PacientData::getAll();
$medics = MedicData::getAll();
        ?>

  <div class="row form-group">
    <div class="col-lg-2">
		<div class="input-group">
		  <span class="input-group-text"><i class="bi-search"></i></span>
		  <input type="text" name="q" value="<?php if(isset($_GET["q"]) && $_GET["q"]!=""){ echo $_GET["q"]; } ?>" class="form-control" placeholder="Palabra clave">
		</div>
    </div>
    <div class="col-lg-2">
		<div class="input-group">
		  <span class="input-group-text"><i class="bi-person"></i></span>
<select name="pacient_id" class="form-control">
<option value="">PACIENTE</option>
  <?php foreach($pacients as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if(isset($_GET["pacient_id"]) && $_GET["pacient_id"]==$p->id){ echo "selected"; } ?>><?php echo $p->id." - ".$p->name." ".$p->lastname; ?></option>
  <?php endforeach; ?>
</select>
		</div>
    </div>
    <div class="col-lg-2">
		<div class="input-group">
		  <span class="input-group-text"><i class="bi-person-badge"></i></span>
<select name="medic_id" class="form-control">
<option value="">MEDICO</option>
  <?php foreach($medics as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if(isset($_GET["medic_id"]) && $_GET["medic_id"]==$p->id){ echo "selected"; } ?>><?php echo $p->id." - ".$p->name." ".$p->lastname; ?></option>
  <?php endforeach; ?>
</select>
		</div>
    </div>
    <div class="col-lg-4">
		<div class="input-group">
		  <span class="input-group-text"><i class="bi-calendar"></i></span>
		  <input type="date" name="date_at" value="<?php if(isset($_GET["date_at"]) && $_GET["date_at"]!=""){ echo $_GET["date_at"]; } ?>" class="form-control" placeholder="Palabra clave">
		</div>
    </div>

    <div class="col-lg-2">
    <button class="btn btn-primary d-block w-100">Buscar</button>
    </div>

  </div>
</form>
<br>

		<?php
$users= array();
if((isset($_GET["q"]) && isset($_GET["pacient_id"]) && isset($_GET["medic_id"]) && isset($_GET["date_at"])) && ($_GET["q"]!="" || $_GET["pacient_id"]!="" || $_GET["medic_id"]!="" || $_GET["date_at"]!="") ) {
$sql = "select * from reservation where ";
if($_GET["q"]!=""){
	$sql .= " title like '%$_GET[q]%' and note like '%$_GET[q] %' ";
}

if($_GET["pacient_id"]!=""){
if($_GET["q"]!=""){
	$sql .= " and ";
}
	$sql .= " pacient_id = ".$_GET["pacient_id"];
}

if($_GET["medic_id"]!=""){
if($_GET["q"]!=""||$_GET["pacient_id"]!=""){
	$sql .= " and ";
}

	$sql .= " medic_id = ".$_GET["medic_id"];
}



if($_GET["date_at"]!=""){
if($_GET["q"]!=""||$_GET["pacient_id"]!="" ||$_GET["medic_id"]!="" ){
	$sql .= " and ";
}

	$sql .= " date_at = \"".$_GET["date_at"]."\"";
}

		$users = ReservationData::getBySQL($sql);

}else{
		$users = ReservationData::getAll();

}
		if(count($users)>0){
			?>
			<div class="box box-primary">
			<table class="table datatable table-bordered datatable table-hover">
			<thead>
			<th>Asunto</th>
			<th>Paciente</th>
			<th>Medico</th>
			<th>Fecha</th>
			<th></th>
			</thead>
			<?php
			foreach($users as $user):
				$pacient  = $user->getPacient();
				$medic = $user->getMedic();
				?>
				<tr>
				<td><?php echo $user->title; ?></td>
				<td><?php echo $pacient->name." ".$pacient->lastname; ?></td>
				<td><?php echo $medic->name." ".$medic->lastname; ?></td>
				<td><?php echo $user->date_at." ".$user->time_at; ?></td>
				<td style="width:300px;">
				<a href="reservation.php?id=<?php echo $user->id;?>" target="_blank" class="btn btn-secondary btn-sm"><i class="bi-file-earmark-pdf"></i> VER PDF</a>
				<a href="index.php?view=reservations&opt=edit&id=<?php echo $user->id;?>" class="btn btn-warning btn-sm"><i class="bi-pencil"></i> Editar</a>
				<a href="index.php?action=reservations&opt=del&id=<?php echo $user->id;?>" class="btn btn-danger btn-sm"><i class="bi-trash"></i> Eliminar</a>
				</td>
				</tr>
				<?php

			endforeach; ?>
</table>
</div>
<?php		}else{
			?>
			<p class="alert alert-warning">No hay citas.</p>
			<?php
		}

		?>
  </div>
</div>

	</div>
</div>
</section>
<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="new"):
$pacients = PacientData::getAll();
$medics = MedicData::getAll();
$statuses = StatusData::getAll();
$payments = PaymentData::getAll();
?>
<section class="">
<div class="row">
	<div class="col-md-12">
<div class="card">
  <div class="card-header text-white bg-success">Nueva Cita</div>
  <div class="card-body">
	<br>
<form class="form-horizontal" role="form" method="post" action="./?action=reservations&opt=add">
  <div class="form-group row mb-3">
    <label for="inputEmail1" class="col-lg-2 control-label">Asunto</label>
    <div class="col-lg-10">
      <input type="text" name="title" required class="form-control" id="inputEmail1" placeholder="Asunto">
    </div>
  </div>
  <div class="form-group row mb-3">
    <label for="inputEmail1" class="col-lg-2 control-label">Paciente</label>
    <div class="col-lg-10">
<select name="pacient_id" class="form-control" required>
<option value="">-- SELECCIONE --</option>
  <?php foreach($pacients as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->id." - ".$p->name." ".$p->lastname; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
  <div class="form-group row mb-3">
    <label for="inputEmail1" class="col-lg-2 control-label">Medico</label>
    <div class="col-lg-10">
<select name="medic_id" class="form-control" required>
<option value="">-- SELECCIONE --</option>
  <?php foreach($medics as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->id." - ".$p->name." ".$p->lastname; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
  <div class="form-group row mb-3">
    <label for="inputEmail1" class="col-lg-2 control-label">Fecha/Hora</label>
    <div class="col-lg-5">
      <input type="date" name="date_at" required class="form-control" id="inputEmail1" placeholder="Fecha">
    </div>
    <div class="col-lg-5">
      <input type="time" name="time_at" required class="form-control" id="inputEmail1" placeholder="Hora">
    </div>
  </div>
  <div class="form-group row mb-3">
    <label for="inputEmail1" class="col-lg-2 control-label">Nota</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="note" placeholder="Nota"></textarea>
    </div>
  </div>
    <div class="form-group row mb-3">
    <label for="inputEmail1" class="col-lg-2 control-label">Enfermedad</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="sick" placeholder="Enfermedad"></textarea>
    </div>
  </div>
      <div class="form-group row mb-3">
    <label for="inputEmail1" class="col-lg-2 control-label">Sintomas</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="symtoms" placeholder="Sintomas"></textarea>
    </div>
  </div>
        <div class="form-group row mb-3">
    <label for="inputEmail1" class="col-lg-2 control-label">Medicamentos</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="medicaments" placeholder="Medicamentos"></textarea>
    </div>
  </div>
  <div class="form-group row mb-3">
    <label for="inputEmail1" class="col-lg-2 control-label">Estado de la cita</label>
    <div class="col-lg-10">
<select name="status_id" class="form-control" required>
  <?php foreach($statuses as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
  <div class="form-group row mb-3">
    <label for="inputEmail1" class="col-lg-2 control-label">Estado del pago</label>
    <div class="col-lg-10">
<select name="payment_id" class="form-control" required>
  <?php foreach($payments as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>

    <div class="form-group row mb-3">
    <label for="inputEmail1" class="col-lg-2 control-label">Costo</label>
    <div class="col-lg-10">
<div class="input-group">
  <span class="input-group-text"><i class="bi-currency-dollar"></i></span>
  <input type="text" class="form-control" name="price" placeholder="Costo">
</div>
    </div>
  </div>
  <div class="form-group row mb-3">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Agregar Cita</button>
    </div>
  </div>
</form>
</div>
</div>
	</div>
</div>
</section>
<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="edit"):
$reservation = ReservationData::getById($_GET["id"]);
$pacients = PacientData::getAll();
$medics = MedicData::getAll();
$statuses = StatusData::getAll();
$payments = PaymentData::getAll();
?>
<div class="">
<div class="row">
	<div class="col-md-12">
<div class="card">
  <div class="card-header text-white bg-info">Modificar Cita</div>
  <div class="card-body">
	<br>
<form class="form-horizontal" role="form" method="post" action="./?action=reservations&opt=upd">
  <div class="form-group row mb-3">
    <label for="inputEmail1" class="col-lg-2 control-label">Asunto</label>
    <div class="col-lg-10">
      <input type="text" name="title" value="<?php echo $reservation->title; ?>" required class="form-control" id="inputEmail1" placeholder="Asunto">
    </div>
  </div>
  <div class="form-group row mb-3">
    <label for="inputEmail1" class="col-lg-2 control-label">Paciente</label>
    <div class="col-lg-4">
<select name="pacient_id" class="form-control" required>
<option value="">-- SELECCIONE --</option>
  <?php foreach($pacients as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($p->id==$reservation->pacient_id){ echo "selected"; }?>><?php echo $p->id." - ".$p->name." ".$p->lastname; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    <label for="inputEmail1" class="col-lg-2 control-label">Medico</label>
    <div class="col-lg-4">
<select name="medic_id" class="form-control" required>
<option value="">-- SELECCIONE --</option>
  <?php foreach($medics as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($p->id==$reservation->medic_id){ echo "selected"; }?>><?php echo $p->id." - ".$p->name." ".$p->lastname; ?></option>
  <?php endforeach; ?>
</select>
    </div>

  </div>

  <div class="form-group row mb-3">
    <label for="inputEmail1" class="col-lg-2 control-label">Fecha/Hora</label>
    <div class="col-lg-5">
      <input type="date" name="date_at" value="<?php echo $reservation->date_at; ?>" required class="form-control" id="inputEmail1" placeholder="Fecha">
    </div>
    <div class="col-lg-5">
      <input type="time" name="time_at" value="<?php echo $reservation->time_at; ?>" required class="form-control" id="inputEmail1" placeholder="Hora">
    </div>
  </div>
  <div class="form-group row mb-3">
    <label for="inputEmail1" class="col-lg-2 control-label">Nota</label>
    <div class="col-lg-4">
    <textarea class="form-control" name="note" placeholder="Nota"><?php echo $reservation->note;?></textarea>
    </div>
    <label for="inputEmail1" class="col-lg-2 control-label">Enfermedad</label>
    <div class="col-lg-4">
    <textarea class="form-control" name="sick" placeholder="Enfermedad"><?php echo $reservation->sick;?></textarea>
    </div>

  </div>

      <div class="form-group row mb-3">
    <label for="inputEmail1" class="col-lg-2 control-label">Sintomas</label>
    <div class="col-lg-4">
    <textarea class="form-control" name="symtoms" placeholder="Sintomas"><?php echo $reservation->symtoms;?></textarea>
    </div>
    <label for="inputEmail1" class="col-lg-2 control-label">Medicamentos</label>
    <div class="col-lg-4">
    <textarea class="form-control" name="medicaments" placeholder="Medicamentos"><?php echo $reservation->medicaments;?></textarea>
    </div>

  </div>
  <div class="form-group row mb-3">
    <label for="inputEmail1" class="col-lg-2 control-label">Estado de la cita</label>
    <div class="col-lg-4">
<select name="status_id" class="form-control" required>
  <?php foreach($statuses as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($p->id==$reservation->status_id){ echo "selected"; }?>><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    <label for="inputEmail1" class="col-lg-2 control-label">Estado del pago</label>
    <div class="col-lg-4">
<select name="payment_id" class="form-control" required>
  <?php foreach($payments as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($p->id==$reservation->payment_id){ echo "selected"; }?>><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>

    <div class="form-group row mb-3">
    <label for="inputEmail1" class="col-lg-2 control-label">Costo</label>
    <div class="col-lg-10">
<div class="input-group">
  <span class="input-group-text"><i class="bi-currency-dollar"></i></span>
  <input type="text" class="form-control" value="<?php echo $reservation->price;?>" name="price" placeholder="Costo">
</div>
    </div>
  </div>

  <div class="form-group row mb-3">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="id" value="<?php echo $reservation->id; ?>">
      <button type="submit" class="btn btn-primary">Actualizar Cita</button>
    </div>
  </div>
</form>

</div>
</div>
	</div>
</div>
</div>
<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="old"):
?>
<section class="">
<div class="row">
	<div class="col-md-12">
<div class="card">
  <div class="card-header text-white bg-primary">Citas Anteriores</div>
  <div class="card-body">
	<p>Historial de citas.</p>
	<br>
		<?php
		$users = ReservationData::getOld();
		if(count($users)>0){
			?>
			<table class="table table-bordered table-hover">
			<thead>
			<th>Asunto</th>
			<th>Paciente</th>
			<th>Medico</th>
			<th>Fecha</th>
			<th></th>
			</thead>
			<?php
			foreach($users as $user){
				$pacient  = $user->getPacient();
				$medic = $user->getMedic();
				?>
				<tr>
				<td><?php echo $user->title; ?></td>
				<td><?php echo $pacient->name." ".$pacient->lastname; ?></td>
				<td><?php echo $medic->name." ".$medic->lastname; ?></td>
				<td><?php echo $user->date_at." ".$user->time_at; ?></td>
				<td style="width:180px;">
				<a href="reservation.php?id=<?php echo $user->id;?>" target="_blank" class="btn btn-secondary btn-xs"><i class="bi-file-earmark-pdf"></i></a>
				<a href="index.php?view=reservations&opt=edit&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs"><i class="bi-pencil"></i></a>
				<a href="index.php?action=reservations&opt=del&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs"><i class="bi-trash"></i></a>
				</td>
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
