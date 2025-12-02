<!DOCTYPE html>
<html lang="en">
<head>
    <title>BEE-WEB</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">

    <!-- Load map styles -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />

    <!-- jQuery desde CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container py-5">
        <div class="row py-5" style="background-color: #f2f2f2;" style="position: relative;">
            <div class="row text-center py-3">
                <div style="position: absolute;height: 20px;width: 20px;top: 40px;padding: 20px;">
                    <a href="creaUsuario.php"><img src="assets/img/volver.png" alt="regresar"></a>
                </div>
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Crear usuario</h1>
                </div>
            </div>
            <form class="col-md-9 m-auto" method="post" role="form" action="" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="correo">Correo :</label>
                        <input type="email" class="form-control mt-1" id="correo" name="correo" placeholder="Correo" require style="border: 1px solid black" autocomplete="off">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="clave">Clave: </label>
                        <input type="text" class="form-control mt-1" id="clave" name="clave" placeholder="Clave" require style="border: 1px solid black" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="nombreCliente">Nombre usuario: </label>
                        <input type="text" class="form-control mt-1" id="nombreCliente" name="nombreCliente" placeholder="usuario" require style="border: 1px solid black" autocomplete="off">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="contraCliente">Contraseña: </label>
                        <input type="password" class="form-control mt-1" id="contraCliente" name="contraCliente" placeholder="Contraseña" require style="border: 1px solid black" autocomplete="off">
                    </div>
                </div>
                <div class="row text-center py-3">
                    <div class="col-lg-6 m-auto">
                        <button type="submit" class="btn btn-success btn-lg px-3" name="subir" id="btnCreaCliente">Crear usuario</button>
                    </div>
                </div>
            </form>    
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#nombreCliente').on('input', function() {
                var maxInput = 15;  
                var valor = $(this).val();
                if (valor.length > maxInput) {
                    valor = valor.substring(0, maxInput);
                }
                valor = valor.replace(/[^a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]/g, '');
                $(this).val(valor);
            });

            $('#clave').on('input', function() {
                var maxInput = 4;  
                var valor = $(this).val();
                if (valor.length > maxInput) {
                    valor = valor.substring(0, maxInput);
                }
                valor = valor.replace(/[^a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]/g, '');
                $(this).val(valor);
            });

            $('#contraCliente').on('input', function() {
                var maxInput = 12;  
                var valor = $(this).val();
                if (valor.length > maxInput) {
                    valor = valor.substring(0, maxInput);
                }
                valor = valor.replace(/[^a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]/g, '');
                $(this).val(valor);
            });

            $('#correo').on('input', function() {
                var maxInput = 38;  
                var valor = $(this).val();
                valor = valor.replace(/\s+/g, '');
                if (valor.length > maxInput) {
                    valor = valor.substring(0, maxInput);
                }
                $(this).val(valor);
            });

            $('#btnCreaCliente').click(function(event){
                event.preventDefault();
                const correo=$('#correo').val();
                const clave=$('#clave').val();
                const nombreCliente=$('#nombreCliente').val();
                const contraCliente=$('#contraCliente').val();
                
                $.post('assets/scripts/altaCliente.php',
                {
                    correo:correo,clave:clave,nombreCliente:nombreCliente,
                    contraCliente:contraCliente},function(response){
                        console.log(response);
                        var data=JSON.parse(response);

                        if(data.success){
                            alert('Se ha agregado su nuevo usuario');
                            location.reload();
                        }else{
                            var error=data.error;
                            alert(error);
                        }
                    })
            });
        });
    </script>
</body>
</html>