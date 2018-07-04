<?php
    $m = new MongoClient();
    //$produc = $m->selectCollection('alvaro','productos');
    if($_POST){
        $produc->insert($_POST);
    }
    include("U_plantilla.php");
?>