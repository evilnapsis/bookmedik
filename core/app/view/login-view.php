<div class="container">
<div class="row">
<h1 class="text-center">LOGIN</h1>
<div class="col-md-12">
<br><br><br>
<div class="row">
  <div class="col-md-4"></div>
<div class="col-md-4">
<div class="card">
<div class="card-header text-center">Iniciar sesion</div>
<div class="card-body">

<form method="post" action="./?action=access&opt=login">
  <div class="form-group">
    <label for="exampleInputEmail1">Correo Electronico</label>
    <input type="text" required name="email" class="form-control" id="exampleInputEmail1" placeholder="Correo Electronico">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" required name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="d-grid gap-2">
  <button type="submit" class="btn btn-secondary ">Acceder</button>
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