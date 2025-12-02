<!DOCTYPE html>
<?php
    $nivelUsuario="";
    $nombreUsuario="";
    $bandCookie=0;
    $numCookie=2;
    if(isset($_COOKIE['UserName'])){
        $nombreUsuario=$_COOKIE['UserName'];
        $bandCookie+=1;
    }
    if(isset($_COOKIE['UserType'])){
        $nivelUsuario=$_COOKIE['UserType'];
        $bandCookie+=1;
    }
    if($bandCookie!=$numCookie){
        header("Location: ../login.php");
    }
    include_once "../assets/scripts/cantidadCarrito.php";
    include_once "../assets/scripts/database.php";
    $miDinero=number_format($datosCliente['saldoCliente'],2,'.','');
?>
<html lang="en">
<head>
    <title>BEE-WEB</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="apple-touch-icon" href="../assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/templatemo.css">
    <link rel="stylesheet" href="../assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="../assets/css/fontawesome.min.css">

    <!-- Load map styles -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />

    <!-- jQuery desde CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:<?php echo "$correoLocal" ?>"><?php echo "$correoLocal" ?></a>
                    <i class="fa fa-phone mx-2"></i>                           
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:<?php echo "$numLocal" ?>"><?php echo "$numLocal"?></a>
                </div>
                <div>
                    <a class="text-light" href="https://fb.com/templatemo" target="_blank" rel="sponsored"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://twitter.com/" target="_blank"><i class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin fa-sm fa-fw"></i></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->
    <?php
        echo "$nombreUsuario";
    ?>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="EmpleadoAlta.php">
                BEE-WEB
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                    <li class="nav-item">
                            <a class="nav-link" href="cliente.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="clienteConocenos.php">Conocenos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="clienteTienda.php">Tienda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="clienteContacto.php">Contacto</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <a class="nav-icon position-relative text-decoration-none" href="carrito.php">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"><?php if($prodCarrito > 0) echo "$prodCarrito"; ?></span>
                    </a>
                    
                    <a class="nav-icon position-relative text-decoration-none" href="usuario.php">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                    </a>

                    <a class="nav-icon position-relative text-decoration-none" href="../assets/scripts/logOut.php">
                        <i class="fa fa-sign-out-alt"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                    </a>

                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->
     <?php if($prodCarrito > 0){ ?>  
        <section class="bg-light">
            <div style="display: flex; justify-content: center; align-items: center">
                <h4 style="display: flex; justify-content: center; width: 40%; margin-top: 10px"><?php echo  "Mi saldo: $miDinero" ?></h4>
            </div>
            <?php 
                $link=null;  
                conectar_db($link);
                if($link){
                    $query=null;
                    sql_ConsultaCarrito($link,$query,$nombreUsuario);
                    if(mysqli_num_rows($query) > 0){
                        while($row = mysqli_fetch_array($query)){
                            $id=$row['idCarrito'];
                            $strProd=$row['nombreProducto'];
                            $floatCosto=$row['costoProducto'];
                            $intCantidad=$row['cantidad'];
                            $tope=$row['cantidadProducto'];
                            $imgCarr=$row['imagenProducto'];

                            $imagen="../assets/imgProductos/".$imgCarr;

                            //Comprueba que exista una imagen
                            if(!file_exists($imagen)){
                                $imagen="../assets/imgProductos/temporal.jpg";
                            }
            ?>
            <div class="container pb-5" id="cont<?php echo "$id"?>">
                <div class="row justify-content-center">
                    <div class="col-lg-7 mt-5">
                        <div class="card d-flex justify-content-center">
                            <div class="card-body position-relative"> 
                                <div class="text-end" style="position: absolute; top: 10px; right: 10px;"> <!-- Cambiado para posicionar la imagen -->
                                    <img src="<?php echo "$imagen"; ?>" alt="Descripción de la imagen" class="img-fluid" style="max-width: 100px; height: 100px;">
                                </div>
                                <h1 class="h2"><?php echo "$strProd"; ?></h1>
                                <p class="h3 py-2">$ <?php  echo "$floatCosto"; ?></p>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <h6>Cantidad :</h6>
                                    </li>
                                    <li class="list-inline-item">
                                        <p class="text-muted" id="tope<?php echo $id ?>"><strong><?php echo "$tope" ?></strong></p>
                                    </li>
                                </ul> 
                                <form action="" method="post">
                                    <input type="hidden" name="product-title" value="Activewear">
                                    <input type="hidden" name="productoId" value="<?php echo $tope; ?>" id="top<?php echo $id ?>">
                                    <input type="hidden" name="img" value="<?php echo "$imgCarr"; ?>">                                    
                                    <div class="row">
                                        <div class="col-auto">
                                            <ul class="list-inline pb-3">
                                                <li class="list-inline-item text-right">
                                                    Cantidad a comprar:
                                                    <input type="hidden" name="product-quantity<?php echo "$id"?>" id="product-quantity<?php echo "$id"?>" value="1">
                                                </li>
                                                <li class="list-inline-item"><span class="btn btn-success" id="btn-minus<?php echo "$id"?>">-</span></li>
                                                <li class="list-inline-item"><span class="badge bg-secondary" id="var-value<?php echo "$id"?>"><?php echo "$intCantidad"; ?></span></li>
                                                <li class="list-inline-item"><span class="btn btn-success" id="btn-plus<?php echo "$id"?>">+</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <h6>Costo total :</h6>
                                    </li>
                                    <li class="list-inline-item">
                                        <input type="text" name="product-actu<?php echo "$id"?>" id="product-actu<?php echo "$id" ?>" value="<?php $nuevo=number_format(($floatCosto*$intCantidad),2,'.',''); echo "$nuevo"?>" disabled >
                                    </li>
                                    <li class="list-inline-item" style="margin-left: 20px">
                                        <input type="submit" style="display: none">
                                        <img src="../assets/img/elimina.png" alt="elimina" class="img-fluid" style="max-width: 50px; height: 50px; cursor: pointer" id="elimina<?php echo "$id"?>">
                                    </li>
                                    </ul> 
                                    <div class="row pb-3">
                                        <div class="col d-grid">
                                            <button type="submit" class="btn btn-success btn-lg" name="btnCompra<?php echo "$id"?>" value="Comprar producto" id="btnCompra<?php echo "$id"?>">Comprar producto</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $('#btn-plus<?php echo "$id"?>').click(function() {
                        var val = parseInt($("#var-value<?php echo "$id"?>").html()); // Convertir a número
                        var maxProducto = <?php echo $tope ?>; // Límite superior
                        
                        // Comprobar si el valor es menor que el máximo
                        if (val < maxProducto) {
                            val++; // Incrementar el valor
                            $("#var-value<?php echo "$id"?>").html(val); // Actualizar el contenido
                            $("#product-quantity<?php echo "$id"?>").val(val); // Actualizar el valor del campo
                            var costoT = val * <?php echo $floatCosto; ?>; // Calcular el costo total
                            $("#product-actu<?php echo "$id"?>").val(costoT.toFixed(2));
                        } else {
                            alert("Se han agregado el máximo del producto"); // Mensaje al usuario
                        }
                        return false; // Prevenir el comportamiento predeterminado
                    });

                    $('#btn-minus<?php echo "$id"?>').click(function() {
                        var val = parseInt($("#var-value<?php echo "$id"?>").html()); // Convertir a número
                        val = (val == '1') ? 1 : val - 1; // Asegurar que no baje de 1
                        $("#var-value<?php echo "$id"?>").html(val); // Actualizar el contenido
                        $("#product-quantity<?php echo "$id"?>").val(val); // Actualizar el valor del campo
                        var costoT = val * <?php echo $floatCosto; ?>; // Calcular el costo total
                        $("#product-actu<?php echo "$id"?>").val(costoT.toFixed(2));
                        $("#product-actu<?php echo "$id"?>").val(costoT);
                        return false; // Prevenir el comportamiento predeterminado
                    });

                    $('#btnCompra<?php echo "$id"?>').click(function(event) {
                        event.preventDefault();
                        const carritoId = <?php echo $id; ?>;
                        const cantidad=parseInt($("#var-value<?php echo "$id"?>").html());
                        var nombreProducto="<?php echo "$strProd"; ?>"; 
                        var saldo = parseFloat($("#product-actu<?php echo "$id"?>").val());
                        var imagen="<?php echo "$imgCarr"?>";
                        var tope=parseInt($("#top<?php echo $id ?>").val());
                        var dif=tope-cantidad;
                        console.log(dif);
                        console.log(saldo);
                        //console.log(saldo);
                        var miCantidad = parseFloat(<?php echo $miDinero ?>);
                        //console.log(miCantidad);
                        var compara=miCantidad-saldo;
                        console.log(compara);
                        if(compara < 0 ){
                            alert('No se ajusta este producto');
                        }else{
                            var opcion=confirm('¿Deseas comprar <?php echo "$strProd"; ?>');
                            if(opcion){
                                $.post('../assets/scripts/compraProducto.php',
                                {carritoId: carritoId, compara: compara, 
                                    cantidad:cantidad, nombreProducto: nombreProducto, 
                                    saldo:saldo,imagen:imagen,dif:dif},function(response){
                                    console.log('Respuesta del servidor:', response);
                                    var data=JSON.parse(response);
                                    if(data.success){
                                        alert('Producto comprado correctamente');
                                        $('#cont<?php echo "$id"?>').remove();
                                        location.reload();
                                    }else{
                                        var error=data.error;
                                        alert(error);
                                    }
                                })
                            } 
                        }
                    });

                    $('#elimina<?php echo "$id"?>').click(function(event){
                        event.preventDefault(); // Evitar el comportamiento predeterminado del evento

                        const form = $(this).closest('form');
                        const productoId = <?php echo "$id"; ?>;

                        var decision = confirm('¿Deseas eliminar <?php echo "$strProd"; ?> del carrito?');
                        if (decision) {
                            $.post('../assets/scripts/eliminaCarrito.php', { productoId: productoId }, function() {
                                alert('Se ha eliminado este producto del carrito');
                                location.reload(); 
                            })
                            .fail(function() {  
                                alert('Ups, hubo un error');
                            });
                        } else {
                            alert('No se ha eliminado');
                        }
                    })
                });
            </script>
            <?php
                        }
                    }
                }
            ?> 
        </section>
    <?php }else{
        echo "<section class='bg-light'>
                <div class='container pb-5' style='height: 500px; display: flex;
                    justify-content: center;align-items: center;'>
                    <h2 style='display: flex; justify-content: center; width: 90%;'>
                        No se han agregado productos al carrito
                    </h2>
                </div>
            </section>";
    } ?>

<footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">BEE-WEB</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            <?php echo "$ubicacion"?>
                        </li>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:<?php echo "$numLocal" ?>"><?php echo "$numLocal"?></a>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none" href="mailto:<?php echo "$correoLocal" ?>"><?php echo "$correoLocal" ?></a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Productos</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <?php   
                            $link=null;
                            conectar_db($link);
                            if($link){
                                $query=null;
                                sql_ConsultaCategorias($link,$query);
                                if(mysqli_num_rows($query) > 0){
                                    while($row=mysqli_fetch_array($query)){
                                        $idCat=$row['idCategoria'];
                                        $nombreCat=$row['nombreCategoria'];       
                        ?>
                                        <li><a class="text-decoration-none" href="clienteTienda.php"><?php echo "$nombreCat" ?></a></li> 
                        <?php
                                    }
                                } 
                            }
                        ?> 
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Mas Info</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                    <li><a class="text-decoration-none" href="cliente.php">Home</a></li>
                        <li><a class="text-decoration-none" href="clienteConocenos.php">Conocenos</a></li>
                        <li><a class="text-decoration-none" href="clienteTienda.php">Tienda</a></li>
                        <li><a class="text-decoration-none" href="carrito.php">Mi carrito</a></li>
                        <li><a class="text-decoration-none" href="clienteContacto.php">Contacto</a></li>
                    </ul>
                </div>

            </div>

            <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                <div class="col-auto me-auto">
                    <ul class="list-inline text-left footer-icons">
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-auto">
                    <label class="sr-only" for="subscribeEmail">Email address</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control bg-dark border-light" id="subscribeEmail" placeholder="Email address">
                        <div class="input-group-text btn-success text-light">Subscribe</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                        Copyright &copy; 2024 - <?php echo "$anioAct" ?> BEE-WEB 
                        | Designed by <a rel="sponsored" href="https://templatemo.com/page/1" target="_blank">TemplateMo</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->




    <!-- Start Script -->
    <script src="../assets/js/jquery-1.11.0.min.js"></script>
    <script src="../assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/templatemo.js"></script>
    <script src="../assets/js/custom.js"></script>
    

    <!-- End Script -->
</body>
</html>