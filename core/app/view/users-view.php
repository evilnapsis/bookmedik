<?php 

if(!isset($_SESSION["user_id"])){ Core::redir("./");}
$user= UserData::getById($_SESSION["user_id"]);
// si el id  del usuario no existe.
if($user==null){ Core::redir("./");}

if(isset($_GET["opt"]) && $_GET["opt"]=="all"):?>
<section class="">
<div class="row">
	<div class="col-md-12">
<div class="card">
  <div class="card-header text-white bg-primary">Lista de Usuarios</div>
  <div class="card-body">
	<a href="./?view=users&opt=new" class="btn btn-secondary"><i class='bi-person'></i> Nuevo</a>
<br><br>
		<?php
		$users = UserData::getAll();
		if(count($users)>0){
			?>
			<div class="box box-primary">
			<table class="table datatable table-bordered datatable table-hover">
			<thead>
			<th>Nombre completo</th>
			<th>Email</th>
      <th>Tipo</th>
			<th></th>
			</thead>
			<?php
			foreach($users as $user):
				?>
				<tr>
				<td><?php echo $user->name." ".$user->lastname; ?></td>
				<td><?php echo $user->email; ?></td>
        <td>
          <?php 
          if($user->kind==1){ echo "Administrador"; }
          else if($user->kind==2){ echo "Usuario normal"; }

          ?>
        </td>
				<td style="width:200px;">
				<a href="index.php?view=users&opt=edit&id=<?php echo $user->id;?>" class="btn btn-warning btn-sm"><i class="bi-pencil"></i></a>
				<a href="index.php?action=users&opt=del&id=<?php echo $user->id;?>" class="btn btn-danger btn-sm"><i class="bi-trash"></i></a>
				</td>
				</tr>
				<?php

			endforeach; ?>
</table>
</div>
<?php		}else{
			?>
			<p class="alert alert-warning">No hay usuarios.</p>
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
  <div class="card-header text-white bg-success">Agregar Usuario</div>
  <div class="card-body">
	<br>
<form class="form-horizontal" method="post" id="addproduct" action="index.php?action=users&opt=add" role="form">
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Apellido*</label>
    <div class="col-md-6">
      <input type="text" name="lastname" required class="form-control" id="lastname" placeholder="Apellido">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Email*</label>
    <div class="col-md-6">
      <input type="text" name="email" class="form-control" id="email" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Contrase&ntilde;a</label>
    <div class="col-md-6">
      <input type="password" name="password" class="form-control" id="inputEmail1" placeholder="Contrase&ntilde;a">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Tipo</label>
    <div class="col-md-6">
      <select name="kind" class="form-control" required>
        <option value="2">Usuario normal</option>
        <option value="1">Administrador</option>
      </select>

    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Agregar Usuario</button>
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
<?php $user = UserData::getById($_GET["id"]);?>
<div class="row">
	<div class="col-md-12">
<div class="card">
  <div class="card-header text-white bg-info">Editar Usuario</div>
  <div class="card-body">
	<br>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?action=users&opt=upd" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" value="<?php echo $user->name;?>" class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Apellido*</label>
    <div class="col-md-6">
      <input type="text" name="lastname" value="<?php echo $user->lastname;?>" required class="form-control" id="lastname" placeholder="Apellido">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Email*</label>
    <div class="col-md-6">
      <input type="text" name="email" value="<?php echo $user->email;?>" class="form-control" id="email" placeholder="Email">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Contrase&ntilde;a</label>
    <div class="col-md-6">
      <input type="password" name="password" class="form-control" id="inputEmail1" placeholder="Contrase&ntilde;a">
<p class="help-block">La contrase&ntilde;a solo se modificara si escribes algo, en caso contrario no se modifica.</p>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Tipo</label>
    <div class="col-md-6">
      <select name="kind" class="form-control" required>
        <option value="2" <?php if($user->kind==2){ echo "selected"; } ?>>Usuario normal</option>
        <option value="1" <?php if($user->kind==1){ echo "selected"; } ?>>Administrador</option>
      </select>

    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
      <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
    </div>
  </div>
</form>

</div>
</div>
	</div>
</div>
</div>
<?php endif; ?>