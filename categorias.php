<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartelera de Cine</title>
    <link rel="stylesheet" href="css/categorias.css">
</head>
<body>
    <?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
    class categorias{
        public function leerDatos()
        {

            $conexion = mysqli_connect('localhost','root','12345');
            if(mysqli_connect_errno())
            {
                echo "Error al conectar a MySQL: ".mysqli_connect_error();
            }
                mysqli_select_db($conexion, 'cartelera');
                $consulta = "select * from categorias;";
                $resultado = mysqli_query($conexion, $consulta);

            if (!$resultado)
            {
                $mensaje = 'Consulta inválida: ' . mysqli_error($conexion) . "\n";
                $mensaje .= 'Consulta realizada: ' . $consulta;
                die($mensaje);
                
            }
            else
            {
            
                if(($resultado->num_rows) >0)
                {   
                    $listaCategorias = [];
                    $i = 0;
                    while ($registro = mysqli_fetch_assoc($resultado))
                    {
                        $categoria = $registro['id'];    
                        $listaCategorias[$i] = $categoria;
                        $i++;                                                               
                    }  
                        
                }

                else
                {
                    echo "No hay resultados";
                }

                return $listaCategorias;
                
            }

        } 
        
        public function pintarCategorias($listaCategorias)
        {
            echo "<h1>Elige tu catogería</h1>";
            echo "<div class='linea'></div>";
            echo "<div class = 'categorias'>";
            echo "<a href='peliculas.php?id_categoria=".$listaCategorias[0]."'><div class = 'terror'>Terror</div></a>";
            echo "<a href='peliculas.php?id_categoria=".$listaCategorias[1]."'><div class = 'comedia'>Comedia</div></a>";
            echo "</div>";
            echo "<div class='lineaAbajo'></div>";
        }
    }

    $categorias = new categorias();
    $listaCategorias = $categorias->leerDatos();
    $categorias->pintarCategorias($listaCategorias);

   
    ?>
</body>
</html>