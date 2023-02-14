<!DOCTYPE html>
<html>

<head>
    <style>
        @import url(estilo.css);
    </style>
</head>

<body>
    <h1>¡Encuentra a tu pokémon preferido!</h1>

    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="get">
        <label for="id">Introduzca el id del pokemon (1 - 898): </label>
        <input id="id" name="id" type="text">
        <input id="button" type="submit" value="Buscar">
    </form>
    <div class="pokemon">
        <?php
        $url = "";
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            if ($id > 0 && $id < 899) {
                $url = "https://pokeapi.co/api/v2/pokemon/" . $id;
                $infoPokemon = file_get_contents($url);
                $infoPokemon = json_decode($infoPokemon, true);

                $imagen = $infoPokemon["sprites"]["other"]["official-artwork"]["front_default"];
                echo "<img src = '" . $imagen . "' /> <br>";

                echo "ID: " . $infoPokemon["id"] . "<br>";
                echo "Nombre: " . ucfirst($infoPokemon["name"]) . "<br>";
                echo "Altura: " . $infoPokemon["height"] / 10 . " m<br>";
                echo "Peso: " . $infoPokemon["weight"] / 10 . " kg<br>";

                $tipos = $infoPokemon["types"];
                if (count($tipos) > 1) {
                    echo "Tipos: ";
                } else {
                    echo "Tipo: ";
                }
                foreach ($tipos as $tipo) {
                    $url = $tipo["type"]["url"];
                    $infoTipo = file_get_contents($url);
                    $infoTipo = json_decode($infoTipo, true);
                    echo $infoTipo["names"]["5"]["name"] . " ";
                }
                echo "<br>";
            } else {
                echo "Lo sentimos. No hay ningún pokémon con ese ID";
            }
        }
        ?>
    </div>
</body>

</html>