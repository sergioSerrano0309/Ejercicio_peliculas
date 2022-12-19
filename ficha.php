<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        ini_set('display_errors', 'On');
        ini_set('html_errors', 0);
        if($_GET['id_categoria']==1)
        {
            echo '<link rel="stylesheet" href="css/ficha_terror.css">';
            echo '<title>Cartelera Terrorífica</title>';
        }
        else if ($_GET['id_categoria']==2)
        {
            echo '<link rel="stylesheet" href="css/ficha_comedia.css">';
            echo '<title>Cartelera Cómica</title>';
        }

    ?>
</head>
<body>
    <?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
     class Ficha
     {
        function __construct()
        {
                
        } 
        
        function init($titulo,$año,$duracion,$sinopsis,$imagen,$votos,$id_categoria, $id_pelicula)
        {
            $this->titulo = $titulo;
            $this->año = $año;
            $this->duracion = $duracion;
            $this->sinopsis = $sinopsis;
            $this->imagen = $imagen;
            $this->votos = $votos;
            $this->id_categoria = $id_categoria;
            $this->id_pelicula = $id_pelicula;
        }

        public function leerDatos()
        {
    
            $conexion = mysqli_connect('localhost','root','12345');
            if(mysqli_connect_errno())
            {
                echo "Error al conectar a MySQL: ".mysqli_connect_error();
            }
                mysqli_select_db($conexion, 'cartelera');
                $id_pelicula = $_GET['id_pelicula'];
                $sanitized_id = mysqli_real_escape_string($conexion, $id_pelicula);
                $consulta = "select * from peliculas where id='".$sanitized_id."';";                
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
                    while ($registro = mysqli_fetch_assoc($resultado))
                    {
                        
                        $titulo = $registro['titulo'];
                        $año = $registro['año'];
                        $duracion = $registro['duración'];
                        $sinopsis = $registro['sinopsis'];
                        $imagen = $registro['imagen'];
                        $votos = $registro['votos'];
                        $id_categoria = $registro['id_categoria'];  
                        $id_pelicula = $registro['id'];                     
                        $this->init($titulo,$año,$duracion,$sinopsis,$imagen,$votos,$id_categoria, $id_pelicula);
                        $pelicula = [$titulo,$año,$duracion,$sinopsis,$imagen,$votos,$id_categoria, $id_pelicula];                    
                    } 
    
                    return $pelicula;
                }
                else
                {
                    echo "No hay resultados";
                }       
            }
        }

        public function director()
        {
    
            $conexion = mysqli_connect('localhost','root','12345');
            if(mysqli_connect_errno())
            {
                echo "Error al conectar a MySQL: ".mysqli_connect_error();
            }
                mysqli_select_db($conexion, 'cartelera');
                $id_pelicula = $_GET['id_pelicula'];
                $sanitized_id = mysqli_real_escape_string($conexion, $id_pelicula);
                $consulta ="select * from director inner join director_pelicula on director.id = director_pelicula.id_director inner join peliculas on peliculas.id = director_pelicula.id_pelicula where peliculas.id='".$sanitized_id."';";                
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
                    while ($registro = mysqli_fetch_assoc($resultado))
                    {
                        
                        $director = $registro['nombre'];   
                                    
                    } 
    
                    return $director;
                }
                else
                {
                    echo "No hay resultados";
                }
                        
                   
                }
    
            }

        public function actores()
        {
        
                $conexion = mysqli_connect('localhost','root','12345');
                if(mysqli_connect_errno())
                {
                    echo "Error al conectar a MySQL: ".mysqli_connect_error();
                }
                    mysqli_select_db($conexion, 'cartelera');
                    $id_pelicula = $_GET['id_pelicula'];
                    $sanitized_id = mysqli_real_escape_string($conexion, $id_pelicula);
                    $consulta ="select actor.nombre, peliculas.titulo, peliculas.año from actor inner join actor_pelicula on actor.id = actor_pelicula.id_actor inner join peliculas on peliculas.id = actor_pelicula.id_pelicula where peliculas.id='".$sanitized_id."';";                
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
                        $listaActores = [];
                        $i=0;
                        while ($registro = mysqli_fetch_assoc($resultado))
                        {
                            
                            $actor = $registro['nombre'];
                            $listaActores[$i] = $actor; 
                            $i++;
                        } 
        
                        return $listaActores;
                    }
                    else
                    {
                        echo "No hay resultados";
                    }
                            
                       
                }
        
        }      
        
        public function pintarFicha($pelicula, $director, $actores)
        {
            echo "<div class=cajaGrande>";
            echo "<div class=cajaIzq>";
            echo "<p class=titulo><h1><b>".$pelicula[0]."</b></h1></p>";
            echo "<p class=imagen><img src='imgs/".$pelicula[4]."'></p>";
            echo "<p><b>Duración: ".$pelicula[2]." min</b></p>";
            echo "</div>";
            echo "<div class=cajaDch>";
            echo "<div class=añoDeSalida>".$pelicula[1]."</div>";
            echo "<div class=sinopsis>".$pelicula[3]."</div>";
            echo "<div class=drectores>Director: ".$director."</div>";
            echo "<div class=reparto> Actores: ";
            for($i = 0; $i < count($actores); $i++)
            {
                if($i != count($actores) - 1)
                {
                    echo $actores[$i].", ";
                }
                else 
                {
                    echo $actores[$i].". ";
                }

            }
            echo "</div>";
            echo "<div class=voto>Votos: ".$pelicula[5]."</div>";
            
            echo "<form action='votos.php' method='post'>";
            echo "  <input id='id_categoria' name='id_categoria' type='hidden' value='".$pelicula[6]."'>";
            echo "  <input id='id_pelicula' name='id_pelicula' type='hidden' value='".$pelicula[7]."'>";
            echo "  <input class=boton type = 'submit' value='Votar'></p>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
        }
     }
     
    $ficha = new Ficha();
    $listaPelicula = $ficha->leerDatos();
    $director = $ficha->director();
    $actores = $ficha->actores();
    $ficha->pintarFicha($listaPelicula, $director, $actores);
    ?>
</body>
</html>