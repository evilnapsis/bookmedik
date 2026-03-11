<?php 
/***** VALIDATIONS AREA ******/
if(!isset($_SESSION["user_id"])){ Core::redir("./");}
$user= UserData::getById($_SESSION["user_id"]);
// si el id  del usuario no existe.
if($user==null){ Core::redir("./");}
/**** GLOBAL VARIABLES AREA *****/
$main_title = "Personas";
$new_btn_text = "Nueva Persona";
?>
<?php if(isset($_GET["opt"]) && $_GET['opt']=="all"):
$contacts = PersonData::getAll();

TableTool::$table_header = array("Id", "Nombre", "Direccion", "Telefono", "");

  ?>
<div class="container">
<div class="row">
<div class="col-md-12">
<h2><?php echo $main_title; ?> (Version 2)</h2>

<a href="./?view=personsmod&opt=new" class="btn btn-secondary"><?php echo $new_btn_text; ?></a>
<br><br>
<?php if(count($contacts)>0):?>
  <table class="table table-bordered">
    <?php TableTool::getHeader(); ?>

    <?php foreach($contacts as $con):?>
      <tr>
        <td><a href="./?view=personsmod&opt=open&id=<?php echo $con->id; ?>" class="btn btn-link btn-sm">#<?php echo $con->id; ?></a></td>
        <td><?php echo $con->name." ".$con->lastname; ?></td>
        <td><?php echo $con->{'address'}; ?></td>
        <td><?php echo $con->phone; ?></td>
        <td>
          <a href="./?view=personsmod&opt=edit&id=<?php echo $con->id; ?>" class="btn btn-warning btn-sm"><i class="bi-pencil"></i></a>
          <a href="./?action=personsmod&opt=del&id=<?php echo $con->id; ?>" class="btn btn-danger btn-sm"><i class="bi-trash"></i></a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
<?php else:?>
  <p class="alert alert-warning">No hay contactos</p>
<?php endif; ?>

</div>
</div>
</div>
<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="new"):?>
<div class="container">
<div class="row">
<div class="col-md-12">
<h2>Nuevo Contacto</h2>


<form method="post" action="./?action=personsmod&opt=add">
<?php
FormTool::addInput("text","name","Nombre","required");
FormTool::addInput("text","lastname","Apellidos","required");
FormTool::addInput("text","email","Email","required");
FormTool::addInput("text","phone","Telefono","required");
FormTool::addInput("text","address","Direccion","required");
?>

  <div class="d-grid gap-2">
  <button type="submit" class="btn btn-primary ">Guardar</button>
</div>
</form>

</div>
</div>
</div>
<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="edit"):
$contact = PersonData::getById($_GET["id"]);
  ?>
  <div class="container">
<div class="row">
<div class="col-md-12">
<h2>Editar Contacto</h2>


<form method="post" action="./?action=personsmod&opt=update">
  <input type="hidden" name="_id" value="<?php echo $contact->id; ?>">

<?php
FormTool::addInputVal("text","name",$contact->name,"Nombre","required");
FormTool::addInputVal("text","lastname",$contact->lastname,"Apellidos","required");
FormTool::addInputVal("text","email",$contact->email, "Email","required");
FormTool::addInputVal("text","phone",$contact->phone,"Telefono","required");
FormTool::addInputVal("text","address",$contact->address,"Direccion","required");
?>

<div class="d-grid gap-2">
<button type="submit" class="btn btn-success ">Actualizar</button>
</div>
</form>

</div>
</div>
</div>
<?php endif; ?>
