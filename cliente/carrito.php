 <html>
        <head>
        <title>
            CecyEmprende
        </title>
        <link rel="stylesheet" type="text/css" href="estilo.css">
    </head>
    <body>
        <?php
            include ("barras.php");
            if(!isset($_SESSION['usrcnf'])!=0){
                header("Location: menu_principal.php");
            }
        ?>
        <div class="contenido">

                <h1 class="titulo_carrito">
                    Carrito de compras 
                </h1> 
                <table class="carrito" cellpadding="3">
                <?php
                $sqlCarrito="select detalleventa.Direccion,detalleventa.Subtotaldeproductos,sum(detalleventa.Cantidad), productos.NombreP,productos.Preciounitario, negocios.NNegocio, sum(productos.Preciounitario), detalleventa.idDetalleVenta from detalleventa inner join productos on detalleventa.idproducto=productos.idproducto inner join negocios on productos.idnegocio=negocios.idnegocio where idusuario=".$_SESSION['usrcnf']." group by detalleventa.idproducto;";
                $resCarrito=mysqli_query($mysqli,$sqlCarrito);
                while($fila=mysqli_fetch_array($resCarrito)){
                    echo '<tr><td><img src="img/producto.jpg" width="20%"></td><td>'.$fila[3].'</td><td>'.$fila[4].'</td> <td>'.$fila[6].'</td> <td> cantidad:<input type="number" width="50%" value="'.$fila[2].'" /></td><td><a href="accion_eliminar_carrito.php?detal='.$fila[7].'"><button>Eliminar</button></a></td></tr>';
                }
                echo '</table><table  class="Terminar_compra">';
                $sqlCarritoSuma="select sum(subtotaldeproductos) from detalleventa where idusuario=".$_SESSION['usrcnf'];
                $resCarritoSuma=mysqli_query($mysqli,$sqlCarritoSuma);
                while($fila=mysqli_fetch_array($resCarritoSuma)){
                    echo '<tr><td align="right"> Total de compra:'.$fila[0].'</td></tr><tr><td align="right"><input type="submit" value="Terminar compra"></td></tr>';
                }
                ?>
                </table>

        </div>
     </body>
</html>
