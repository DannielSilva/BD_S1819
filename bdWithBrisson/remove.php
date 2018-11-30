<html>
<head>
        <meta charset="UTF-8">
        <title>G24 - Locais</title>
        <link rel = "stylesheet" href="styles.css">
    </head>
    <body>
    <ul id="nav">
            <li><a href='index.html'>Ínicio</a></li>
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


        if ($type == local or $type == entidadeMeio or $type == processoSocorro) {
            /*$check = $db->prepare("SELECT 1 FROM $type WHERE $attr1 = :val1;");
            $check->bindParam(':val1', $db_id1);
            $check->execute();

            if (pg_num_rows($check)==0) {
                echo("<p>{$db_id1} não existe em $type</p>");
            }
            else {*/

            $result = $db->prepare("DELETE FROM $type WHERE $attr1 = :val;");
            $result->bindParam(':val', $db_id1);
            $result->execute();
            echo("<p>{$attr1} {$db_id1} removido(a) com sucesso a {$type}</p>");
            //}
        }

        else if ($type == "meio" or $type == "eventoEmergencia" ) {
            /*$check = $db->prepare("SELECT 1 FROM $type WHERE $attr1 = :val1 and $attr3 = :val2;");
            $check->bindParam(':val1', $db_id1);
            $check->bindParam(':val2', $db_id3);
            $check->execute();

            if (pg_num_rows($check)==0) {
                echo("<p>{$db_id3} - {$db_id1} não existe em $type</p>");
            }
            else {*/
                $result = $db->prepare("DELETE FROM $type WHERE $attr1 = :val1 and $attr3 = :val2;");
                $result->bindParam(':val1', $db_id1);
                $result->bindParam(':val2', $db_id3);
                $result->execute();
                echo("<p>{$db_id3} - {$db_id1} removido(a) com sucesso a $type</p>");
            //}
        }




        //$result = pgdelete($db, 'post_log', $type);

        echo("<a href={$back} ><input  type='submit' value='Retornar'></a>");
    }

    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p><br><a href=\"a.php\">Back</a>");
    }
?>

    </body>

</html>
