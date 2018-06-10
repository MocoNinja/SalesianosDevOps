
<div class="container"><br/>
<?php

 $horario=$_POST['horario'];
 $lunes="";
 $martes="";
 $miercoles="";
 $jueves="";
 $viernes="";


        $dias = explode("#", $horario);
        // Genera un array de indices lunes, martes, ..., viernes.
        // Los valores de cada dia son otro vector con las distintas horas
        $lunes = explode("|", $dias [0]) [1];
        $martes = explode("|", $dias [1]) [1];
        $miercoles = explode("|", $dias [2]) [1];
        $jueves = explode("|", $dias [3]) [1];
        $viernes = explode("|", $dias [4]) [1];
?>

 <form id="formulario" action="updateformhandle.php" method="POST">
            <h2> Nuevo Horario</h2>

            <p>Elige el nuevo horario para la actividad</p>
            <label for="lunes">Lunes</label>
            <input name="lunes" class="fechas" type="text" id="lunes" placeholder="HH:mm-HH:mm(;HH:mm-HH:mm;...)" value=<?php echo $lunes; ?>>
            <br /><br/>
            <label for="martes">Martes</label>
            <input name="martes" class="fechas" type="text" id="martes" placeholder="HH:mm-HH:mm(;HH:mm-HH:mm;...)" value=<?php echo $martes; ?>>
            <br /><br/>
            <label for="miercoles">Miércoles</label>
            <input name="miercoles" class="fechas" type="text" id="miercoles" placeholder="HH:mm-HH:mm(;HH:mm-HH:mm;...)" value=<?php echo $miercoles; ?>>
            <br /><br/>
            <label for="jueves">Jueves</label>
            <input name="jueves" class="fechas" type="text" id="jueves" placeholder="HH:mm-HH:mm(;HH:mm-HH:mm;...)" value=<?php echo $jueves; ?>>
            <br /><br/>
            <label for="viernes">Viernes</label>
            <input name="viernes" class="fechas" type="text" id="viernes" placeholder="HH:mm-HH:mm(;HH:mm-HH:mm;...)" value=<?php echo $viernes; ?>>
            <br /><br/>
            <input type="text" hidden="hidden" name="tutor" <?php echo "value=\"$_POST[tutor] \" ;"?> >
            <input type="text" hidden="hidden" name="skill" <?php echo "value=\"$_POST[skill] \" ;"?> >
            <br/>
            <input class="btn btn-warning" id="enviar" type="submit" value="Enviar" />
            <button class="btn btn-danger" type="button" onClick="history.back()"> Volver </button>
        </form>
</div>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
