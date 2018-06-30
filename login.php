<?php
    include("libreria/motor.php");
    $mensaje="";
    if($_POST){
        if(verificarUsuario($_POST)){
            header("Location:index.php");
            exit();
        }else{
            $mensaje="Usuario o Clave no Valida";
        }
    }
    include("plantilla.php");
?>
<form method="post" action="">
    <div id="divLogin">
        <div class="form-group input-group">
            <span class="input-group-addon">Email:</span>
            <input type="text" name="email" class="form-control"/>
        </div>
        <div class="form-grup input-group">
            <span class="input-group-addon">Clave:</span>
            <input type="password" name="clave" class="form-control"/>
        </div>
        <div class="erro">
            <?php echo $mensaje; ?>
        </div>
        <br>
        <br>
        <div class="form-grup input-group">
            <button class="btn btn-success" type="submit">Entrar</button>
        </div>
    </div>
</form>