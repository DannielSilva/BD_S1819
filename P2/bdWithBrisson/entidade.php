<html>
<head>
        <meta charset="UTF-8">
        <title>G24 - Meio</title>
        <link rel = "stylesheet" href="styles.css">
    </head>
    <body>
    <ul id="nav">
            <li><a href='index.html'>Inicio</a></li>
            <li><a href='locais.php'>Locais</a></li>
            <li><a href='proSocorro.php'>Processos de Socorro</a></li>
            <li><a href='eventos.php'>Eventos de Emergência</a></li>
            <li><a class="active" href='entidade.php'>Entidades</a></li>
            <li><a href='meio.php'>Meios</a></li>
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
        <h2>Entidades</h2>
        <!-- restantes opcoes -->
    </div>
           
    <div id = "add">
        <form action="add.php?back=entidade.php" method='post'>
            <input type='hidden' name='attr1' value='nomeEntidade'/>
            <input type='hidden' name='type' value='entidadeMeio'/>    
            Nome Entidade:<br>
            <input list="db_id1s" type="text" name="db_id1"  required><br>
            <datalist id="db_id1s">
            <?php
                $result = $db->prepare("SELECT DISTINCT nomeentidade FROM entidadeMeio;");
                $result->execute();
                foreach($result as $row){           
                    echo("<option value='{$row['nomeentidade']}'>\n");
                }
            ?>
            </datalist>
            <p></p>
            <input type="submit" value="Adicionar">   
            <input type="submit" formaction="remove.php?back=entidade.php" value="Remover">
        </form> 
    </div>
    <?php
     $result = $db->prepare("SELECT * FROM entidadeMeio;");
     $result->execute();
        echo("<h3>Lista de meios</h3><table border=\"1\">\n");
            echo("<tr><td>Entidade</td><td>Remover</td></tr>\n");
            foreach($result as $row)
            {
                echo("<tr><td>");
                echo($row['nomeentidade']);
                echo("</td><td><a href=\"remove.php?back=entidade.php&type=entidadeMeio&attr1=nomeEntidade&db_id1={$row['nomeentidade']}\">delete</a></td></tr>\n");
            }
            echo("</table>\n");
    ?>  

   

 

</html>