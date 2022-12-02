<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
    class pelicula
    {
        function __construct()
        {
            
        } 
        
        function init($titulo,$año,$duracion,$sinopsis,$imagen,$votos,$id_categoria)
        {
            $this->titulo = $titulo;
            $this->año = $año;
            $this->duracion = $duracion;
            $this->sinopsis = $sinopsis;
            $this->imagen = $imagen;
            $this->votos = $votos;
            $this->id_categoria = $id_categoria;
        }

        public function leerDatos()
        {

            $conexion = mysqli_connect('localhost','root','12345');
            if(mysqli_connect_errno())
            {
                echo "Error al conectar a MySQL: ".mysqli_connect_error();
            }
                mysqli_select_db($conexion, 'cartelera');
                $id_categoria = $_GET['id_categoria'];
                $sanitized_categoria_id = mysqli_real_escape_string($conexion, $id_categoria);
                $consulta = "select * from peliculas where id_categoria='".$sanitized_categoria_id."';";
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
                    $listaPeliculas = [];
                    $i = 0;
                    while ($registro = mysqli_fetch_assoc($resultado))
                    {
                        
                        $titulo = $registro['titulo'];
                        $año = $registro['año'];
                        $duracion = $registro['duración'];
                        $sinopsis = $registro['sinopsis'];
                        $imagen = $registro['imagen'];
                        $votos = $registro['votos'];
                        $id_categoria = $registro['id_categoria'];                       
                        
                        $pelicula = new pelicula($titulo, $año, $duracion, $sinopsis, $imagen, $votos, $id_categoria);
    
                        $listaPeliculas[$i] = $pelicula; 
                        var_dump($pelicula);            
                        $i++;                              
                    }  
                    return $listaPeliculas;
                    for($i = 0; $i < count($listaPeliculas); $i++)
                    {
                        var_dump($listaPeliculas[$i]);
                        echo "<br>";
                        echo "<br>";
                    }
                 
                           
                }
                else
                {
                    echo "No hay resultados";
                }
                          
            }

        }

    }

    $pelicula = new pelicula();
    $pelicula->leerDatos();

    ?>
</body>
</html>