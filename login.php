<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/Estilos/style.css">
    <title>Tienda miel</title>

    <!-- jQuery desde CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="contenedor">
        <div class="formus">
            <form method="post" action="">
                <h2 id="titulo">Login</h2>
                <?php
                    include("assets/scripts/login.php");
                ?>
                <label for="usuario">Usuario: </label>
                <input type="text" name="txtUser" id="usuario" maxlenght="15">
                <label for="passwd">Contraseña: </label>
                <input type="password" name="txtPasswd" id="passwd" maxlenght="15">
                <h3 id="nuevoUsuario"><a href="creaUsuario.php">Crear usuario</a></h3>
                <input type="submit" value="Ingresar" name="Ingresa">
            </form>
        </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        $('#usuario').on('input', function() {
            var maxInput = 15;  
            var valor = $(this).val();
            if (valor.length > maxInput) {
                valor = valor.substring(0, maxInput);
            }
            valor = valor.replace(/[^a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]/g, '');
            $(this).val(valor);
        });
        $('#passwd').on('input', function() {
            var maxInput = 15;  
            var valor = $(this).val();
            if (valor.length > maxInput) {
                valor = valor.substring(0, maxInput);
            }
            valor = valor.replace(/[^a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]/g, '');
            $(this).val(valor);
        });
    });
</script>
</html>