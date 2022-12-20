<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/votos.css">
</head>
<body>
    <?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
        $conexion = mysqli_connect('localhost','root','12345');
        if(mysqli_connect_errno())
        {
            echo "Error al conectar a MySQL: ".mysqli_connect_error();
        }
            mysqli_select_db($conexion, 'cartelera');
            $id_pelicula = $_POST['id_pelicula'];
            $sanitized_pelicula_id = mysqli_real_escape_string($conexion, $id_pelicula);
            $consulta = "update peliculas set votos = votos + 1 where id='".$sanitized_pelicula_id."';";                $resultado = mysqli_query($conexion, $consulta);
        
        if (!$resultado)
        {
            $mensaje = 'Consulta inválida: ' . mysqli_error($conexion) . "\n";
            $mensaje .= 'Consulta realizada: ' . $consulta;
            die($mensaje);
        }
        else
        {
            echo "<h1>Votación realizada correctamente</h1>";
            echo "<a href='ficha.php?id_pelicula=".$_POST["id_pelicula"]."&id_categoria=".$_POST["id_categoria"]."'><p>Volver a la ficha</p></a>";
            echo "<a href='peliculas.php?id_categoria=".$_POST["id_categoria"]."&orden=alfasc'><p>Volver a la lista de peliculas</p></a>";
            echo "<a href='categorias.php'><p>Volver a la selección de categorías</p></a>";
        }
    ?>
</body>
</html>