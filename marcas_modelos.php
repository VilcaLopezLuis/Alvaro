<?php
    include("libreria/motor.php");
    verificarSesion();

    $m = new MongoClient();
    $m_m = $m->selectCollection('alvaro','marcas_modelos');

    if($_POST){
        
        $marcas = $_POST['marca'];
        $modelos = $_POST['modelos'];

        foreach($marcas as $k=>$marca){
            $modelo = $modelos[$k];
            $obj = array();
            $obj['marca'] = $marca;
            $obj['modelo'] = $modelo;
            if(strlen($k)>2){
                $con = array ('_id'=>new MongoId($k));
                $m_m->update($con,$obj);
            }else{
                $m_m->insert($obj);
            }
        }
    }

    include("plantilla.php");
?>
<form method="post" action="">
    <table class="table">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelos</th>
                <td><button type="button" onclick="addMarca('','',''); ">+</button></td>
            </tr>
        </thead>
        <tbody id="tbMarcas">

        </tbody>
    </table>
    <button type="submit">Guardar</button>
</form>
<script>
    function addMarca(_id,marca,modelo){
        destino = document.getElementById('tbMarcas');
        tr=document.createElement('tr');
        
        td=document.createElement('td');
        txt=document.createElement('input');
        txt.setAttribute('name','marca['+_id+']');
        txt.type='text';
        txt.value = marca;
        txt.setAttribute('required','required');
        txt.setAttribute('class','form-control');
        td.appendChild(txt);
        tr.appendChild(td);
        
        td=document.createElement('td');
        txt=document.createElement('input');
        txt.setAttribute('name','modelos['+_id+']');
        txt.value=modelo;
        txt.setAttribute('required','required');
        txt.setAttribute('class','form-control');
        txt.setAttribute('placeholder','Modelos');
        td.appendChild(txt);
        tr.appendChild(td);
        
        destino.appendChild(tr);
    }
</script>
<script>
    <?php
        $datos = $m_m->find();
        foreach($datos as $fila){
            echo "addMarca('{$fila['_id']}','{$fila['marca']}','{$fila['modelo']}'); ";
        }
    ?>
</script>