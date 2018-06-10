
<?php
    if (isset($_GET['deleteForSure'])) {
        include_once('./Database.php');
        $database = new Database();
        $database->deleteTutoring($_GET['user'],$_GET['skill']);    
        echo "<script>location.href='../list.php';</script>";
    } else if (isset($_GET['iRegretThat'])){
        echo "<script>location.href='../list.php';</script>";
    } else {
        include_once('./Database.php');
        $base = new Database();
        $materia=$base->getNameOfSkillById($_POST['skill']);
        echo "<div class='container'><br/><h1>¿Desea borrar la materia " . $materia . "?</h1>";
        echo "<h3><a href=\"?deleteForSure&user=" . $_POST['tutor'] . "&skill=" . $_POST['skill'] . "\" >SÍ</a></h3><br/>";
        echo "<h3><a href=\"?iRegretThat\">NO</a></h3></div>";
    }
        
    echo "<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">";
    echo "<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>";
    echo "<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>";
?>

