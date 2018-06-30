<?php
    include("libreria/motor.php");
    verificarSesion();
    $m = new MongoClient();
    $produc = $m->selectCollection('alvaro','productos');
    if($_POST){
        $produc->insert($_POST);
    }
    include("plantilla.php");
?>
<div class="row">
    <div class="col col-sm-6">
        <form method="post" action="">
            <div class="input-group form-group">
                <spam class="input-group-addon">ID:</spam>
                <input type="text" name="id" class="form-control"/>
            </div>
            <div class="input-group form-group">
                <spam class="input-group-addon">Marca:</spam>
                <select onchange="buscarModelos(this.value);" class="form-control" id="cmbMarca" name="marca">
                </select>
            </div>
            <div class="input-group form-group">
                <spam class="input-group-addon">Modelo:</spam>
                <select class="form-control" id="cmbModelo" name="modelo"></select>
            </div>
            
            <div class="input-group form-group">
                <spam class="input-group-addon">Stock: </spam>
                <div class="form-control">
                    <label><input type="radio" name="stock" value="si"/>SI</label>
                    <label><input type="radio" name="stock" value="no"/>NO</label>
                </div>
            </div>
            <div class="input-group form-group">
                <spam class="input-group-addon">Comentario</spam>
                <textarea name="comentario" class="form-control"></textarea>
            </div>
            <div>
                <button class="btn btn-primary" type="submit">Enviar</button>
            </div>
        </form>
    </div>
</div>
<fielset>
    <legend>Vehiculos Agregados</legend>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelos</th>
                <th>Stock</th>
                <th>Comentario</th>
                <td></td>
            </tr>
        </thead>
        <tbody>
           <!--MOSTRAR DATOS-->
            <?php 
                $datos = $produc->find();
                foreach($datos as $fila){
                    echo "<tr>
                        <td>{$fila['id']}</td>
                        <td>{$fila['marca']}</td>
                        <td>{$fila['modelo']}</td>
                        <td>{$fila['stock']}</td>
                        <td>{$fila['comentario']}</td>
                    </tr>";
                }
            ?>
        </tbody>
    </table>
</fielset>

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
    /*REVISAR LINEA SIGUIENTE*/
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