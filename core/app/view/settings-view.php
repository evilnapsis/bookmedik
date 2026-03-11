<?php if(isset($_GET["opt"]) && $_GET["opt"]=="all"):?>
<?php
$settings = SettingData::getAll();
//$coins = CoinData::getAll();

?>
<div class="">
        <!-- Main Content -->
          <div class="row">
            <div class="col-md-12">

            </div>
            </div>

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header text-white bg-primary">Ajustes Generales</div>
                <div class="card-body">
            <a href="./?view=settings&opt=new" class="btn btn-secondary">Nueva Variable</a>
<br><br>
<form method="post" action="./?action=settings&opt=update">
                    <table class="table table-bordered">
                      <tbody>
<?php
 if(count($settings)>0):?>
<?php foreach($settings as $cat):?>
                        <tr>
                        <td><?php echo $cat->label; ?>
                        </td>
                        <td>

                        <input type="text" name="<?php echo $cat->name; ?>" class="form-control" value="<?php echo $cat->val;?>">
                        </td>
                        </tr>
<?php endforeach; ?>
 <?php endif; ?>

                        <tr>
                        <td>
                        </td>
                        <td>
                        <input type="submit"  class="btn btn-success" value="Actualizar Ajustes">
                        </td>
                        </tr>
                      </tbody>
                    </table>
                    </form>
                  </div>
              </div>
            </div>

          </div>
</div>
<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="new"):?>
  <div class="container">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header text-white bg-success">Nueva Variable en Ajustes</div>
<div class="card-body">


<form method="post" action="./?action=settings&opt=add">
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre corto / slug</label>
    <input type="text" required name="name" class="form-control" id="exampleInputEmail1" placeholder="Nombre corto /slug">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre / Etiqueta</label>
    <input type="text" required name="label" class="form-control" id="exampleInputEmail1" placeholder="Nombre / Etiqueta">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Valor</label>
    <input type="text" required name="val" class="form-control" id="exampleInputEmail1" placeholder="Valor">
  </div>

  <div class="d-grid gap-2">
  <button type="submit" class="btn btn-primary ">Guardar</button>
</div>
</form>

</div>
</div>
</div>
</div>
</div>
<?php endif; ?>