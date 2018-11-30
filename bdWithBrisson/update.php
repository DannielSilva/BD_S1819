<html>
<head>
        <meta charset="UTF-8">
        <title>G24 - Update</title>
        <link rel = "stylesheet" href="styles.css">
    </head>
    <body>
    <ul id="nav">
            <li><a href='index.html'>Ínicio</a></li>
            <li><a  href='locais.php'>Locais</a></li>
            <li><a href='proSocorro.php'>Processos de Socorro</a></li>
            <li><a href='eventos.php'>Eventos de Emergência</a></li>
            <li><a href='entidade.php'>Entidades</a></li>
            <li><a class="active"  href='meio.php'>Meios</a></li>
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
        $db_id1 = isset($_REQUEST['nm']) ? $_REQUEST['nm'] : '';
        $db_id3 = isset($_REQUEST['ne']) ? $_REQUEST['ne'] : '';
        $db_id4 = isset($_REQUEST['db_id4']) ? $_REQUEST['db_id4'] : '';
        $db_id5 = isset($_REQUEST['db_id5']) ? $_REQUEST['db_id5'] : '';
        $db_id6 = isset($_REQUEST['db_id6']) ? $_REQUEST['db_id6'] : '';
        $back = isset($_REQUEST['back']) ? $_REQUEST['back'] : '';


        
            $result = $db->prepare("UPDATE $type SET $attr1 = :numMeio, $attr2 = nomeMeio ,$attr3 = nomeEntidade WHERE $attr1 = :oldNum and $attr3=:oldEnt ;");
            $result->bindParam(':oldNum', $db_id1);
            $result->bindParam(':oldEnt', $db_id3);
            $result->bindParam(':numMeio', $db_id4);
            $result->bindParam(':nomeMeio', $db_id5);
            $result->bindParam(':nomeEntidade', $db_id6);
            $result->execute();
/*
            $combate = isset($_REQUEST['comb']) ? $_REQUEST['comb'] : '';
            $socorro = isset($_REQUEST['sos']) ? $_REQUEST['sos'] : '';
            $apoio = isset($_REQUEST['apoio']) ? $_REQUEST['apoio'] : '';
            echo("<p>{$db_id3} - {$db_id1} adicionado(a) com sucesso a $type</p>");

            if ($combate=="yes") {
                $result = $db->prepare("INSERT INTO meioCombate ($attr1,$attr3) VALUES (:numMeio,:nomeEntidade);");
                $result->bindParam(':numMeio', $db_id1);
                $result->bindParam(':nomeEntidade', $db_id3);
                $result->execute();
                echo("<p>{$db_id3} - {$db_id1} adicionado(a) com sucesso a meioCombate</p>");
            }
            if ($socorro=="yes") {
                $result = $db->prepare("INSERT INTO meioSocorro ($attr1,$attr3) VALUES (:numMeio,:nomeEntidade);");
                $result->bindParam(':numMeio', $db_id1);
                $result->bindParam(':nomeEntidade', $db_id3);
                $result->execute();
                echo("<p>{$db_id3} - {$db_id1} adicionado(a) com sucesso a meioSocorro</p>");
            }
            if ($apoio=="yes") {
                $result = $db->prepare("INSERT INTO meioApoio($attr1,$attr3) VALUES (:numMeio,:nomeEntidade);");
                $result->bindParam(':numMeio', $db_id1);
                $result->bindParam(':nomeEntidade', $db_id3);
                $result->execute();
                echo("<p>{$db_id3} - {$db_id1} adicionado(a) com sucesso a meioApoio</p>");
            }*/
        

       
        echo("<a href={$back} ><input  type='submit' value='Retornar'></a>");
    }

    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p><br><a href=\"a.php\">Back</a>");
    }
?>

    </body>

</html>
