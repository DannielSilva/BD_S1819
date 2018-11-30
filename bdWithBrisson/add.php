<html>
<head>
        <meta charset="UTF-8">
        <title>G24 - Add</title>
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
        $attr4 = isset($_REQUEST['attr4']) ? $_REQUEST['attr4'] : '';
        $attr5 = isset($_REQUEST['attr5']) ? $_REQUEST['attr5'] : '';
        $db_id1 = isset($_REQUEST['db_id1']) ? $_REQUEST['db_id1'] : '';
        $db_id2 = isset($_REQUEST['db_id2']) ? $_REQUEST['db_id2'] : '';
        $db_id3 = isset($_REQUEST['db_id3']) ? $_REQUEST['db_id3'] : '';
        $db_id4 = isset($_REQUEST['db_id4']) ? $_REQUEST['db_id4'] : '';
        $db_id5 = isset($_REQUEST['db_id5']) ? $_REQUEST['db_id5'] : '';
        $back = isset($_REQUEST['back']) ? $_REQUEST['back'] : '';


        if ($type == "local" or $type == "entidadeMeio" or $type == "processoSocorro") {
            $result = $db->prepare("INSERT INTO $type ($attr1) VALUES (:val);");+
            $result->bindParam(':val', $db_id1);
            $result->execute();

            echo("<p>{$attr1} {$db_id1} adicionado(a) com sucesso a {$type}</p>");

            if ($type == "processoSocorro") {

                $result = $db->prepare("INSERT INTO eventoEmergencia VALUES (:numTel,:instChamada,:nomePessoa,:moradaLocal,:numProcessoSocorro);");
                $result->bindParam(':numTel', $db_id2);
                $result->bindParam(':instChamada', str_replace("T"," ",$db_id4));
                $result->bindParam(':nomePessoa', $db_id3);
                $result->bindParam(':moradaLocal', $db_id5);
                $result->bindParam(':numProcessoSocorro', $db_id1);    
                $result->execute();
            }
        }

        

        else if ($type == "meio") {
            
            $result = $db->prepare("INSERT INTO $type ($attr1,$attr2,$attr3) VALUES (:numMeio,:nomeMeio,:nomeEntidade);");
            $result->bindParam(':numMeio', $db_id1);
            $result->bindParam(':nomeMeio', $db_id2);
            $result->bindParam(':nomeEntidade', $db_id3);
            $result->execute();

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
            }

        }

        else if ($type == "eventoemergencia") {
            $result = $db->prepare("INSERT INTO $type  VALUES (:val1,:val2,:val3,:val4,:val5);");
            $result->bindParam(':val1', $db_id1);
            $result->bindParam(':val2', $db_id3);
            $result->bindParam(':val3', $db_id2);
            $result->bindParam(':val4', $db_id4);
            $result->bindParam(':val5', $db_id5);

            $result->execute();
            echo("<p>{$db_id4} reportado por {$db_id3} registado(a) com sucesso para o processo {$db_id3}</p>");

        }

        else if ($type == "acciona") {
            $result = $db->prepare("INSERT INTO acciona (numMeio,nomeEntidade,numProcessoSocorro) VALUES (:val1,:val2,:val3);");

            $result->bindParam(':val1', $db_id1); 
            $result->bindParam(':val2', $db_id2); 
            $result->bindParam(':val3', $db_id3); 
            $result->execute();

            echo("<p>{$db_id2} - {$db_id1} accionado(a) com sucesso para o processo {$db_id3}</p>");

        }

       
        echo("<a href={$back} ><input  type='submit' value='Retornar'></a>");
    }

    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
        echo("<a href={$back} ><input  type='submit' value='Retornar'></a>");

    }
?>

    </body>

</html>
