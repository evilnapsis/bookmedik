<div class="container">
<div class="row">
<h1 class="text-center">REGISTRO</h1>
<div class="col-md-12">
<br><br><br>
<div class="row">
  <div class="col-md-4"></div>
<div class="col-md-4">
<div class="card">
<div class="card-header text-center">Registrarse</div>
<div class="card-body">

<form method="post" action="./?action=users&opt=register">
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre</label>
    <input type="text" required name="name" class="form-control" id="exampleInputEmail1" placeholder="Nombre">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Apellidos</label>
    <input type="text" required name="lastname" class="form-control" id="exampleInputEmail1" placeholder="Apellidos">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="text" required name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" required name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Confirmar Password</label>
    <input type="password" required name="confirm_password" class="form-control" id="exampleInputPassword1" placeholder="Confirmar Password">
  </div>
  <div class="d-grid gap-2">
  <button type="submit" class="btn btn-primary ">Registrarse</button>
</div>
</form>

</div>
</div>
<br><br><br>

</div>


</div>
<?php
//$user = UserData::getBy("id",2);
//$user->del();
//print_r($user);
?>

</div>
</div>
</div>