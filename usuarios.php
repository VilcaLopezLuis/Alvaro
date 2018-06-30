<?php
    include("libreria/motor.php");
    verificarSesion();
    $m=new MongoClient();
    $usuarios = $m->selectCollection('alvaro','usuarios');
    
    $usuario = array('_id'=>'','email'=>'','nombre'=>'','clave'=>'');

    if ($_POST){
        $id = $_GET['usr'];
        unset($_POST['_id']);
        
        /*------------ACTUALIZAR DATOS---------------*/
        if(strlen($id) > 2){
            $query = array('_id'=>new MongoId($id));
            $usuarios->update($query,$_POST);
        /*------------INSERTAR DATOS---------------*/
        }else{
            $usuarios->insert($_POST);
        }
        
        /*------------CARGAR DATOS---------------*/
    }else if (isset($_GET['usr'])){
        $id = $_GET['usr'];
        $query = array('_id'=>new MongoId($id));
        $usr = $usuarios->find($query);
        $usr = $usr->getNext();
        if($usr){
            $usuario = $usr;
        }
    }
    /*------------ELIMINAR DATOS---------------*/
    if(isset($_GET['del'])){
        $id= new MongoId($_GET['del']);
        $usuarios->remove(array('_id'=>$id));
    }
    include("plantilla.php");
?>

<div class="row">
    <div class="col col-sm-6">
        <form method="post"action="">
            <div class="input-group form-group">
                <input type="hidden" value="<?php echo $usuario['_id']; ?>" name="id" class="form-control"/>
            </div>
            <div class="input-group form-group">
                <spam class="input-group-addon">Email:</spam>
                <input type="text" value="<?php echo $usuario['email']; ?>" name="email" class="form-control"/>
            </div>
            <div class="input-group form-group">
                <spam class="input-group-addon">Nombre:</spam>
                <input type="text" value="<?php echo $usuario['nombre']; ?>"  name="nombre" class="form-control"/>
            </div>
            <div class="input-group form-group">
                <spam class="input-group-addon">Clave:</spam>
                <input type="password" value="<?php echo $usuario['clave']; ?>"  name="clave" class="form-control"/>
            </div>
            <div>
                <button class="btn btn-primary" type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>
<table class="table">
    <thead>
        <tr>
            <th>Email</th>
            <th>Nombre</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $datos = $usuarios->find();
        foreach($datos as $usr){
            echo "<tr>
                <td>{$usr['email']}</td>
                <td>{$usr['nombre']}</td>
                <td>
                    <a class='btn btn-success' href='usuarios.php?usr={$usr['_id']}'>Editar</button>
                    <a onClick='return confirmarBorrar()' class='btn btn-danger' href='usuarios.php?del={$usr['_id']}'>Eliminar</button>
                </td>
            </tr>";
        }
        ?>
    </tbody>
</table>

<script>
    function confirmarBorrar(){
        return confirm("Seguro que desea Borrar este Usuario ? ");
    }
</script>