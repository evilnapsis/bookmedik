<?php if(isset($_GET["opt"]) && $_GET["opt"]=="all"):?>
<div class="row">
	<div class="col-md-12">
<div class="card">
  <div class="card-header text-white bg-primary">Cambiar Contraseña</div>
  <div class="card-body">
<br>	<form class="form-horizontal" id="changepasswd" method="post" action="./?action=configuration&opt=upd" role="form">
  <div class="form-group row mb-3">
    <label for="inputEmail1" class="col-lg-4 control-label">Contraseña Actual</label>
    <div class="col-lg-8">
      <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña Actual" required>
    </div>
  </div>

  <div class="form-group row mb-3">
    <label for="inputPassword1" class="col-lg-4 control-label">Nueva Contraseña</label>
    <div class="col-lg-8">
      <input type="password" class="form-control"  id="newpassword" name="newpassword" placeholder="Nueva Contraseña" required>
    </div>
  </div>

  <div class="form-group row mb-3">
    <label for="inputPassword1" class="col-lg-4 control-label">Confirmar Nueva Contraseña</label>
    <div class="col-lg-8">
      <input type="password" class="form-control" id="confirmnewpassword" name="confirmnewpassword" placeholder="Confirmar Nueva Contraseña" required>
    </div>
  </div>

  <div class="form-group row mb-3">
    <div class="col-lg-offset-4 col-lg-8">
      <button type="submit" class="btn btn-success ">Cambiar Contraseña</button>
    </div>
  </div>
</form>

<script>
$("#changepasswd").submit(function(e){
	if($("#password").val()=="" || $("#newpassword").val()=="" || $("#confirmnewpassword").val()==""){
		e.preventDefault();
		alert("No debes dejar espacios vacios.");
	}else{
		if($("#newpassword").val() == $("#confirmnewpassword").val()){
//			alert("Correcto");			
		}else{
			e.preventDefault();
			alert("Las nueva contraseña no coincide con la confirmacion.");
		}
	}
});

</script>
</div>
</div>
	</div>
</div>
<?php endif; ?>
