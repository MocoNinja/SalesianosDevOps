<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco de trabajo</title>
    <link type="text/css" rel="stylesheet" href="./css/style.css">
    <script type="text/javascript" src="./js/main.js"></script>
</head>
<body>
    <?php
        include_once('./php/sessionhandler.php');
        include('./dynamic/userHeader.php');
    ?>

    <h1>Bienvenido al banco de trabajo de Salesianos</h1>
    <hr />

    <form id="formulario" action="./php/handleForm.php" method="POST">
        <h2>Actividades</h2>
        <p>Elige en qué actividad deseas darte de alta</p>
        <label for="actividad">Actividad:</label>
        <select name="actividad" required>
        <?php
            include_once('./php/Database.php');
            $database = new Database();
            $database->selectAllSkills();
         ?>
        </select>
        <br />
        <label for="modalidad">Quiero:</label>
        <select name="modalidad" required>
            <option value="OFERTA">Ofrecer</option>
            <option value="DEMANDA">Solicitar</option>
        </select>
        <h2>Horario</h2>
        <p id="ayudaClick">¿Necesitas ayuda para introducirlo?
            <span id="ayuda">Debes marcar los días en los que deseas realizar la actividad. Además, debes introducir las horas disponibles en formato HH:mm-HH:mm. Si deseas introducir varios intervalos, sepáralos mediante ';'</span>
        </p>
        <p>Elige el horario para la actividad</p>
        <label for="lunes">Lunes</label>
        <input class="dias" type="checkbox" id="lunes" checked="false" />
        <input name="lunes" class="fechas" type="text" id="lunes" placeholder="HH:mm-HH:mm(;HH:mm-HH:mm;...)"/>
        <br />
        <label for="martes">Martes</label>
        <input class="dias" type="checkbox" id="martes" checked="false"  />
        <input name="martes" class="fechas" type="text" id="martes" />
        <br />
        <label for="miercoles">Miércoles</label>
        <input class="dias" type="checkbox" id="miercoles" checked="false" />
        <input name="miercoles" class="fechas" type="text" id="miercoles" placeholder="HH:mm-HH:mm(;HH:mm-HH:mm;...)"/>
        <br />
        <label for="jueves">Jueves</label>
        <input class="dias" type="checkbox" id="jueves" checked="false"  />
        <input name="jueves" class="fechas" type="text" id="jueves" />
        <br />
        <label for="viernes">Viernes</label>
        <input class="dias" type="checkbox" id="viernes" checked="false" />
        <input name="viernes" class="fechas" type="text" id="viernes" placeholder="HH:mm-HH:mm(;HH:mm-HH:mm;...)"/>
        <br />
        <input id="enviar" type="submit" value="Enviar" />
    </form>
</body>
</html>
