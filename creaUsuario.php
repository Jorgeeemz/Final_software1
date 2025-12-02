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
    <link rel="stylesheet" href="assets/Estilos/style.css">

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
                    <a href="login.php"><img src="assets/img/volver.png" alt="regresar"></a>
                </div>
            </div>
            <form class="col-md-9 m-auto" method="post" role="form" action="" enctype="multipart/form-data">
            <div class="row">    
                    <div class="mb-3">
                        <label for="inputmessage">Correo</label>
                        <input type="email" class="form-control mt-1" id="correo" name="correo" placeholder="Correo" require style="border: 1px solid black;">
                    </div>
                    <div class="row text-center py-3">
                        <div class="col-lg-6 m-auto">
                        <h4>Solo correos: </h4>
                        <div class="ImgCorreo">
                            <img src="assets/img/gmail.png" alt="Gmail">
                            <img src="assets/img/outlook.png" alt="Outlook">
                        </div>
                            <h3 id="nuevoUsuario"><a href="registroUsuario.php">Ya tengo mi codigo</a></h3>
                        </div>
                    </div>
                    <div class="row text-center py-3">
                        <div class="col-lg-6 m-auto">
                            <button type="submit" class="btn btn-success btn-lg px-3" name="subir" id="btnCreaCorreo">Crear usuario</button>
                        </div>
                    </div>
                </div>
            </form>    
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#correo').on('input', function() {
                var maxInput = 50;  
                var valor = $(this).val();
                valor = valor.replace(/\s+/g, '');
                if (valor.length > maxInput) {
                    valor = valor.substring(0, maxInput);
                }
                $(this).val(valor);
            });
            $('#btnCreaCorreo').click(function(event){
                event.preventDefault();
                var txtEmail=$('#correo').val();
                console.log(txtEmail);
                $.post('assets/scripts/correo.php',{
                    txtEmail:txtEmail},function(response){
                        var data=JSON.parse(response);
                        if(data.success){
                            alert('Correo correcto, verifica la clave que te llego');
                            //window.location.href="registroUsuario.php",
                        }else{
                            var error=data.error;
                            alert(error);
                            $('#correo').val('');
                        }
                    })
            });
        });
    </script>
</body>
</html>