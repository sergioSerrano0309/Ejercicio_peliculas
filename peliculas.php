<!DOCTYPE html>
<head>
    <?php
        ini_set('display_errors', 'On');
        ini_set('html_errors', 0);
        if($_GET['id_categoria']==1)
        {
            echo '<link rel="stylesheet" href="css/terror.css">';
            echo '<title>Cartelera Terrorífica</title>';
        }
        else if ($_GET['id_categoria']==2)
        {
            echo '<link rel="stylesheet" href="css/comedia.css">';
            echo '<title>Cartelera Cómica</title>';
        }

    ?>
</head>
<body>
<?php

ini_set('display_errors', 'On');
ini_set('html_errors', 0);

class peliculas
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
            $id_categoria = $_GET['id_categoria'];
            $sanitized_categoria_id = mysqli_real_escape_string($conexion, $id_categoria);

            if($_GET["orden"]=="alfasc")
            {
                $orden = " order by titulo asc";
            }
            elseif($_GET["orden"]=="alfdesc")
            {
                $orden = " order by titulo desc";
            }
            elseif($_GET["orden"]=="votasc")
            {
                $orden = " order by votos asc";
            }
            elseif($_GET["orden"]=="votdesc")
            {
                $orden = " order by votos desc";
            }
            elseif(!isset($_GET["orden"]))
            {
                $orden = "";
            }
            $sanitized_orden = mysqli_real_escape_string($conexion, $orden);
            $consulta = "select * from peliculas where id_categoria='".$sanitized_categoria_id."' ".$sanitized_orden.";";                
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
                    $id_pelicula = $registro['id'];                    
                    $this->init($titulo,$año,$duracion,$sinopsis,$imagen,$votos,$id_categoria, $id_pelicula);
                    $pelicula = [$titulo,$año,$duracion,$sinopsis,$imagen,$votos,$id_categoria, $id_pelicula];
                    $listaPeliculas[$i] = $pelicula;                      
                    $i++;

                } 

                return $listaPeliculas;
            }
            else
            {
                echo "No hay resultados";
            }
                    
               
            }

        }


    public function pintarPeliculas($listaPeliculas)
    {
        echo "<div class = 'todo'>";
        echo "<div class = 'pagina'>";

    echo "<ul>";   
        echo "<li><a href='peliculas.php?id_categoria=".$_GET['id_categoria']."&orden=alfasc'><p>Ordenar Alfabéticamente(↑)</p></a></li>";
        echo "<li><a href='peliculas.php?id_categoria=".$_GET['id_categoria']."&orden=alfdesc'><p>Ordenar Alfabéticamente(↓)</p></a></li>";
        echo "<li><a href='peliculas.php?id_categoria=".$_GET['id_categoria']."&orden=votasc'><p>Ordenar por votos(↑)</p></a></li>";
        echo "<li><a href='peliculas.php?id_categoria=".$_GET['id_categoria']."&orden=votdesc'><p>Ordenar por votos(↓)</p></a></li>";
    echo "</ul>";
        for ($i = 0; $i < count($listaPeliculas) ; $i++)
        {
            
            echo "<div id = 'cajaTitulo' class = 'f$i'>";
            echo "<div class = 'cajaImagen'><h1>".$listaPeliculas[$i][0]."</h1><br><br><img class='imagen' src='imgs/".$listaPeliculas[$i][4]."'><div class = 'duracion'><p><br><b>Duración: ".$listaPeliculas[$i][2]." min </b></p></div></div>";
            echo "<div class = 'border'>";
            echo "<div class = 'votos'><p><b>Votos: ".$listaPeliculas[$i][5]."</b></div>";
            echo "<div class = 'cajaSinopsis'>
            </p><h1>Sinopsis</h1><br><p>".substr($listaPeliculas[$i][3], 0, -20)." ...</p> 
            <div class = 'verFicha'><a href='ficha.php?id_pelicula=".$listaPeliculas[$i][7]."&id_categoria=".$listaPeliculas[$i][6]."'><p>Ver Ficha</p></a></div></div>";
            echo "</div>";
            echo "</div>";
            
        }

        echo "</div>";
        echo "</div>";
    }
}

$pelicula = new peliculas();
$listaPeliculas = $pelicula->leerDatos();
$pelicula->pintarPeliculas($listaPeliculas);
?>
<body>