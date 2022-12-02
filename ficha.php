<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/ficha.css">
</head>
<body>
    <?php
     class Ficha
     {
        public function pintarFicha()
        {
            echo "<div class=cajaGrande>";
            echo "<div class=cajaIzq>";
            echo "<p class=titulo><b>El Exorcista</b></p>";
            echo "<p class=imagen><img src='imgs/0.jpeg'></p>";
            echo "<p><b>Duración</b></p>";
            echo "</div>";
            echo "<div class=cajaDch>";
            echo "<div class=añoDeSalida>1999</div>";
            echo "<div class=sinopsis>Esto será una sinopsis</div>";
            echo "<div class=drectores>Directores</div>";
            echo "<div class=reparto>Actores que salen</div>";
            echo "<div class=voto>Votos</div>";
            echo "<div class=votar><a href=''>Votar</a></div>";
            echo "</div>";
            echo "</div>";
        }
     }
     
     $ficha1 = new Ficha();
     $ficha1->pintarFicha();
    ?>
</body>
</html>