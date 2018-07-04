<?php
    $obj = new plantilla();
    class plantilla{
        function __construct(){
    ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">

            <link rel="stylesheet" href="css/estilos_personal.css"/>

            <link rel="stylesheet" href="css/bootstrap.min.css"/>
            <link rel="stylesheet" href="css/bootstrap-theme.css"/>

            <script type="text/javascript" src="js/bootstrap.js"></script>

            <script src="js/bootstrap.min.js"></script>
            <title>Tienda</title>
        </head>

        <body>
            <div id="divPagina">
                
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <a class="navbar-brand" href="./">INICIO</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="U_Producto.php">Poductos<span class="sr-only">(current)</span></a>
                        </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li style="color:white;">  
                            <!--INSERTAR LINE PARA MOSTRAR USUARIO-->
                              </li>
                            <li><a href="salir.php">Salir</a></li>
                        </ul>
                    </div>
                </nav>
                
                <br>
                <br>
    <?php
    }
    function __destruct(){
    ?>
        </div>
            <div class="container"><hr/>Derechos Reservados @2018</div>
        </body>
        </html>

    <?php
    }
}
?>