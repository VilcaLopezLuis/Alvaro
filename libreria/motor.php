<?php
session_start();
function verificarSesion(){
    if(!isset($_SESSION['session'])){
        echo "
            <script> window.location='login.php';</script>
        ";
        exit();
    }
}

function usarioActivo(){
    $rs = false;
    if(isset($_SESSION['session'])){
        $rs = $_SESSION['session'];
    }
    return $rs;
}

function verificarUsuario($datos){
    $m = new MongoClient();
    $usuarios = $m->selectCollection('alvaro','usuarios');
    
    $usrs = $usuarios->find($datos);
    
    $usr= $usrs->getNext();
    
    if($usr){
        $_SESSION['session'] = $usr;
        return true;
    }
    return false;
}
?>