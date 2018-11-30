<html>

<head>
        <meta charset="UTF-8">
        <title>G24 - Locais</title>
        <link rel = "stylesheet" href="styles.css">
    </head>
    <body>
    <ul id="nav">
            <li><a href='index.html'>Inicio</a></li>
            <li><a class="active" href='locais.php'>Locais</a></li>
            <li><a href='proSocorro.php'>Processos de Socorro</a></li>
            <li><a href='eventos.php'>Eventos de Emergência</a></li>
            <li><a href='entidade.php'>Entidades</a></li>
            <li><a href='meio.php'>Meios</a></li>
            <li><a href='e.php'>Accionar Meios</a></li>
        </ul>
        <div style="margin-left:25%;padding:1px 16px;height:1000px;">

<?php
    try{
        include 'config.php';

       
    }   
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p><br><a href=\"a.php\">Back</a>");
    }
?>



    <h1> Sistema de Gest&atildeo de Inc&ecircndios Florestais </h1>
    <div id = "left_col">
        <h2>Locais</h2>
        <!-- restantes opcoes -->
    </div>
  

    <div id = "remove">
        <form action="add.php?back=locais.php" method="post">
        <input type='hidden' name='attr1' value='moradalocal'/>  
        <input type='hidden' name='type' value='local'/>    
            Morada Local:<br>
            <input list="db_ids" name="db_id1">
            <datalist id="db_ids">
            <?php
                $result = $db->prepare("SELECT moradaLocal FROM local;");
                $result->execute();

                foreach($result as $row){           
                    echo("<option value='{$row['moradalocal']}'>\n");
                }
            ?>
            </datalist>
            <p></p>
            <input type="submit" value="Adicionar">

            <input type="submit" formaction="remove.php?back=locais.php" value="Remover">
        </form>
    </div>
    <?php
     $result = $db->prepare("SELECT moradaLocal FROM local;");
     $result->execute();
        echo("<h3>Lista de locais</h3><table border=\"1\">\n");
            echo("<tr><td><b>Morada local</b></td><td></td></tr>\n");
            foreach($result as $row)
            {
                echo("<tr><td>");
                echo($row['moradalocal']);
                echo("</td><td><a href=\"remove.php?back=locais.php&type=local&attr1=moradaLocal&db_id1={$row['moradalocal']}\">delete</a></td></tr>\n");
            }
            echo("</table>\n");
    ?>  

            </div>
</html>