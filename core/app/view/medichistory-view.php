<?php
$pacient = MedicData::getById($_GET["id"]);
?>
<div class="row">

<div class="card">
  <div class="card-header" data-background-color="blue">
      <h4 class="title">Historial de Citas del Medico</h4>
<p>Medico: <?php echo $pacient->name." ".$pacient->lastname;?></p>
  </div>
  <div class="card-content table-responsive">
	<div class="col-md-12">
<div class="btn-group pull-right">
<!--<div class="btn-group pull-right">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-download"></i> Descargar <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="report/clients-word.php">Word 2007 (.docx)</a></li>
  </ul>
</div>
-->
</div>
		<?php
		$users = ReservationData::getAllByMedicId($_GET["id"]);
		if(count($users)>0){
			// si hay usuarios
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
				$pacient  = $user->getPacient();
				$medic = $user->getMedic();
				?>
				<tr>
				<td><?php echo $user->title; ?></td>
				<td><?php echo $pacient->name." ".$pacient->lastname; ?></td>
				<td><?php echo $medic->name." ".$pacient->lastname; ?></td>
				<td><?php echo $user->date_at." ".$user->time_at; ?></td>
				</tr>
				<?php

			}
?>
</table>
<?php


		}else{
			echo "<p class='alert alert-danger'>No hay citas</p>";
		}


		?>

</div>
</div>
	</div>
</div>