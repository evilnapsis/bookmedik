<div class="container">
<div class="row">
<div class="col-md-6">
<h2>Formulario 1</h2>
<form>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <?php echo Form::input("email","","","Email");?>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <?php echo Form::input("text","","","Password");?>
  </div>
  <div class="form-group">
    <label for="exampleInputFile">File input</label>
        <?php echo Form::input2("file");?>
    <p class="help-block">Example block-level help text here.</p>
  </div>
  <div class="checkbox">
    <label>
        <?php echo Form::input2("checkbox");?>
        Check me out
    </label>
  </div>
    <?php echo Form::submit("Submit","primary");?>
</form>

</div>
<div class="col-md-6">
<h2>Formulario 2</h2>
<form class="form-horizontal">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
    <?php echo Form::input("email","","","Email");?>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
    <?php echo Form::input("text","","","Password");?>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
        <?php echo Form::input2("checkbox");?>
        Recuerdame
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
<?php echo Form::submit("Submit","primary");?>
    </div>
  </div>
</form>

</div>


</div>

<div class="row">
<div class="col-md-12">
<h2>Select</h2>
<?php
//$data = array();
//foreach(UserData::getAll() as $u){ $data[] = array("value"=>$u->id,"name"=>$u->name." ".$u->lastname); }
$data =  array(
	array("value"=>"","name"=>"-- SELECCIONE --"),
	array("value"=>"mxn","name"=>"Peso Mexicano"),
	array("value"=>"usd","name"=>"Dolar estadounidense"),
	array("value"=>"jpy","name"=>"Yen Japones")
	);
echo Form::select("myselect",$data,"","required");

?>
</div>
</div>
</div>