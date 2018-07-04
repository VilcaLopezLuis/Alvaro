 <?php
    $m = new MongoClient();
    //$m_m = $m->selectCollection('alvaro','producto');
    $productos = $m->selectCollection('alvaro','productos');

    include("u_plantilla.php");

?>
   <form method="post" action="">
   <div class="row">
    <div class="col col-sm-6">
            <div class="input-group form-group">
                <spam class="input-group-addon">Marca:</spam>
                <select onchange="buscarModelos(this.value);" class="form-control" id="cmbMarca" name="marca">
                </select>
            </div>
            <div class="input-group form-group">
                <spam class="input-group-addon">Modelo:</spam>
                <select class="form-control" id="cmbModelo" name="modelo"></select>
            </div>
            <div>
                <button class="btn btn-primary" type="submit">Filtrar</button>
            </div>
    </div>
</div>

    <table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Marca</th>
            <th>Modelos</th>
            <th>Stock</th>
            <th>Comentario</th>
        </tr>
    </thead>
    <tbody id="tbMarcas">
        <?php 
        if($_POST){
            
            $marc = $_POST['cmbMarca'];
            $mod = $_POST['cmbModelo'];
            
            $obj = array();
            
            $obj['modelo'] = $mod;
            $obj['modelo'] = $mod;
            $datos = $productos->find($obj);
            
            foreach($datos as $prod){
                echo "<tr>
                    <td>{$prod['id']}</td>
                    <td>{$prod['marca']}</td>
                    <td>{$prod['modelo']}</td>
                    <td>{$prod['stock']}</td>
                    <td>{$prod['comentario']}</td>
                    <td>
                        <a class='btn btn-success' href='U_carro.php?id_Compra={$prod['_id']}'>Añadir al carro</button>
                    </td>
                </tr>";
            }
        }
        ?>
    </tbody>
</table>
    <button class="btn btn-success" type="submit">Confirmar Compra</button>
</form>

<!--CARGAR MODELOS SEGUN MARCA-->
<script>
    function buscarModelos(marca){
        cmb = document.getElementById('cmbModelo');
        cmb.innerHTML='';
        mismodelos = modelos[marca].split(',');
        for(x=0;x<mismodelos.length;x++){
            opt=document.createElement('option');
            opt.value=mismodelos[x];
            opt.text=mismodelos[x];
            cmb.appendChild(opt);
        }
        cmb.selectedIndex = -1;
    }
</script>

<!--CARGAR MARCAS DE LOS PRODUCTOS-->
<script>
    var marcas = [];
    var modelos = [];
    
    <?php
        $m_m = $m->selectCollection('alvaro','marcas_modelos');
        $todo = $m_m->find();
        $modelos = array();
        foreach($todo as $fila){
            echo "
            marcas.push('{$fila['marca']}');";
            $modelos[$fila['marca']] = $fila['modelo'];
        }
        $modelos=json_encode($modelos);
        echo "modelos ={$modelos}";
    ?>
    
    cmb = document.getElementById('cmbMarca');
    for(x=0;x<marcas.length;x++){
        opt = document.createElement('option');
        opt.value = marcas[x];
        opt.text=marcas[x];
        cmb.appendChild(opt);
    }
    cmb.selectedIndex=-1;
</script>