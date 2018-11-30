<html>
<head>
        <meta charset="UTF-8">
        <title>G24 - List</title>
        <link rel = "stylesheet" href="styles.css">
    </head>
    <body>
    <ul id="nav">
            <li><a href='index.html'>Inicio</a></li>
            <li><a  href='locais.php'>Locais</a></li>
            <li><a href='proSocorro.php'>Processos de Socorro</a></li>
            <li><a href='eventos.php'>Eventos de Emergência</a></li>
            <li><a href='entidade.php'>Entidades</a></li>
            <li><a  href='meio.php'>Meios</a></li>
            <li><a href='e.php'>Accionar Meios</a></li>
        </ul>
        <div style="margin-left:25%;padding:1px 16px;height:1000px;">
<?php
    try
    {
        include 'config.php';

        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
        $attr1 = isset($_REQUEST['attr1']) ? $_REQUEST['attr1'] : '';
        $attr2 = isset($_REQUEST['attr2']) ? $_REQUEST['attr2'] : '';
        $attr3 = isset($_REQUEST['attr3']) ? $_REQUEST['attr3'] : '';
        $db_id1 = isset($_REQUEST['db_id1']) ? $_REQUEST['db_id1'] : '';
        $db_id2 = isset($_REQUEST['db_id2']) ? $_REQUEST['db_id2'] : '';
        $db_id3 = isset($_REQUEST['db_id3']) ? $_REQUEST['db_id3'] : '';
        $back = isset($_REQUEST['back']) ? $_REQUEST['back'] : '';


        if ($type == processoSocorro) {
           
         
            $result = $db->prepare("SELECT * FROM acciona WHERE $attr1=:val ;");
            $result->bindParam(':val', $db_id1);
            $result->execute();
               echo("<h3>Lista de meios</h3><table border=\"1\">\n");
                   echo("<tr><td>Numero</td><td>Entidade</td><td>Remover</td></tr>\n");
                   foreach($result as $row)
                   {
                       echo("<tr><td>");
                       echo($row['nummeio']);

                       echo("</td><td>");
                       echo($row['nomeentidade']);
                       echo("</td><td><a href=\"remove.php?back=meio.php&type=meio&attr1=numMeio&attr3=nomeEntidade&db_id1={$row['nummeio']}&db_id3={$row['nomeentidade']}\">delete</a></td></tr>\n");
                   }
                   echo("</table>\n<p></p>");
            

           

        }

        else if ($type == "local") {
            $result = $db->prepare("SELECT nummeio,nomemeio FROM acciona natural join eventoemergencia natural join meiosocorro WHERE $attr1=:val ;");
            $result->bindParam(':val', $db_id1);
            $result->execute();
               echo("<h3>Lista de meios</h3><table border=\"1\">\n");
                   echo("<tr><td>Numero</td><td>Entidade</td><td>Remover</td></tr>\n");
                   foreach($result as $row)
                   {
                       echo("<tr><td>");
                       echo($row['nummeio']);

                       echo("</td><td>");
                       echo($row['nomeentidade']);
                       echo("</td><td><a href=\"remove.php?back=meio.php&type=meio&attr1=numMeio&attr3=nomeEntidade&db_id1={$row['nummeio']}&db_id3={$row['nomeentidade']}\">delete</a></td></tr>\n");
                   }
                   echo("</table>\n<p></p>");
        }




        //$result = pgdelete($db, 'post_log', $type);

        echo("<a href={$back} ><input  type='submit' value='Retornar'></a>");
    }

    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p><br>");
        echo("<a href={$back} ><input  type='submit' value='Retornar'></a>");
    }
?>

    </body>

</html>
