<html>
    <head>
        <meta charset="UTF-8">
        <title>G24 - Locais</title>
        <link rel = "stylesheet" href="styles.css">
    </head>
    <body>
    <ul id="nav">
            <li><a href='index.html'>Ínicio</a></li>
            <li><a class="active" href='a.php'>Locais</a></li>
            <li><a href='b.php'>Processos de Socorro</a></li>
            <li><a href='d.php'>Eventos de Emergência</a></li>
            <li><a href='e.php'>Entidades</a></li>
            <li><a href='e.php'>Meios</a></li>
            <li><a href='e.php'>Accionar Meios</a></li>
        </ul>
        <div style="margin-left:25%;padding:1px 16px;height:1000px;">
<?php
    try
    {
        include 'config.php';

        $mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        $id2 = isset($_REQUEST['id2']) ? $_REQUEST['id2'] : '';

        if ($mode == "delete") {
            if ($type == "local") {
                $result = $db->prepare("DELETE FROM local WHERE moradaLocal = :moradaLocal;");
                $result->bindParam(':moradaLocal', $_REQUEST['id']);
                $result->execute();
            }
            if ($type == "eventoEmergencia") {
                $result = $db->prepare("DELETE FROM eventoEmergencia WHERE numTelefone = :numTelefone AND instanteChamada = :instanteChamada;");
                $result->bindParam(':numTelefone', $_REQUEST['id']);
                $result->bindParam(':instanteChamada', $_REQUEST['id2']);
                $result->execute();
            }
            if ($type == "processoSocorro") {
                $result = $db->prepare("DELETE FROM processoSocorro WHERE numProcessoSocorro = :numProcessoSocorro");
                $result->bindParam(':numProcessoSocorro', $_REQUEST['id']);
                $result->execute();
            }
            if ($type == "meio") {
                $result = $db->prepare("DELETE FROM meio WHERE numMeio = :numMeio AND nomeEntidade = :nomeEntidade;");
                $result->bindParam(':numMeio', $_REQUEST['id']);
                $result->bindParam(':nomeEntidade', $_REQUEST['id2']);
                $result->execute();
            }
            if ($type == "entidadeMeio") {
                $result = $db->prepare("DELETE FROM entidadeMeio WHERE nomeEntidade = :nomeEntidade;");
                $result->bindParam(':nomeEntidade', $_REQUEST['id']);
                $result->execute();
            }
        }
        if ($mode == "add") {
            if ($type == "local") {
                $result = $db->prepare("INSERT INTO local VALUES(:moradaLocal);");
                $result->bindParam(':moradaLocal', $_REQUEST['moradaLocal']);
                $result->execute();
            }
            if ($type == "eventoEmergencia") {
                $result = $db->prepare("INSERT INTO alugavel (numTelefone, instanteChamada) VALUES(:numTelefone, :instanteChamada);");
                $result->bindParam(':numTelefone', $_REQUEST['numTelefone']);
                $result->bindParam(':instanteChamada', $_REQUEST['instanteChamada']);
                $result->execute();
                $last_id = $db->lastInsertId();

                $result = $db->prepare("INSERT INTO espaco (codigo, morada) VALUES(:codigo, :morada);");
                $result->bindParam(':codigo', $last_id);
                $result->bindParam(':morada', $_REQUEST['morada']);
                $result->execute();
            }
            if ($type == "posto") {
                $result = $db->prepare("INSERT INTO alugavel (morada, foto) VALUES(:morada, :foto);");
                $result->bindParam(':morada', $_REQUEST['morada']);
                $result->bindParam(':foto', $_REQUEST['foto']);
                $result->execute();
                $last_id = $db->lastInsertId();

                $result = $db->prepare("INSERT INTO posto (morada, codigo, codigo_espaco) VALUES(:morada, :codigo, :codigo_espaco);");
                $result->bindParam(':codigo', $last_id);
                $result->bindParam(':codigo_espaco', $_REQUEST['codigo_espaco']);
                $result->bindParam(':morada', $_REQUEST['morada']);
                $result->execute();
            }
        }

        $result = $db->prepare("SELECT moradaLocal FROM local;");
        $result->execute();

        echo("<h3>local</h3><table border=\"1\">\n");
        echo("<tr><td><b>Morada local</b></td><td></td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['moradalocal']);
            echo("</td><td><a href=\"a.php?mode=delete&type=local&id={$row['moradalocal']}\">delete</a></td></tr>\n");
        }
        echo("</table>\n");

        $result = $db->prepare("SELECT numTelefone, instanteChamada, nomePessoa, moradaLocal, numProcessoSocorro FROM eventoEmergencia;");
        $result->execute();
        $result = $result->fetchAll();

        echo("<h3>eventoEmergencia</h3><table border=\"1\">\n");
        echo("<tr><td><b>Número de telefone</b></td><td><b>Instante da chamada</b></td><td><b>Nome</b></td><td><b>Morada local</b></td><td><b>Número do processo</b></td><td></td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['numtelefone']);
            echo("</td><td>");
            echo($row['instantechamada']);
            echo("</td><td>");
            echo($row['nomepessoa']);
            echo("</td><td>");
            echo($row['moradalocal']);
            echo("</td><td>");
            echo($row['numprocessosocorro']);
            echo("</td><td><a href=\"a.php?mode=delete&type=eventoEmergencia&id={$row['numtelefone']}&id2={$row['instantechamada']}\">delete</a></td></tr>\n");
        }
        echo("</table>\n");

        $result = $db->prepare("SELECT numProcessoSocorro FROM processoSocorro;");
        $result->execute();
        $result = $result->fetchAll();

        echo("<h3>local</h3><table border=\"1\">\n");
        echo("<tr><td><b>Número do processo</b></td><td></td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['numprocessosocorro']);
            echo("</td><td><a href=\"a.php?mode=delete&type=processoSocorro&id={$row['numprocessoSocorro']}\">delete</a></td></tr>\n");
        }
        echo("</table>\n");

        $result = $db->prepare("SELECT numMeio, nomeMeio, nomeEntidade FROM meio;");
        $result->execute();
        $result = $result->fetchAll();

        echo("<h3>posto</h3><table border=\"1\">\n");
        echo("<tr><td><b>Número</b></td><td><b>Nome do meio</b></td><td><b>Nome da entidade</b></td><td></td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['nummeio']);
            echo("</td><td>");
            echo($row['nomemeio']);
            echo("</td><td>");
            echo($row['nomeentidade']);
            echo("</td><td><a href=\"a.php?mode=delete&type=meio&id={$row['nummeio']}&id2={$row['nomeentidade']}\">delete</a></td></tr>\n");
        }
        echo("</table>\n");

        $result = $db->prepare("SELECT nomeEntidade FROM entidadeMeio;");
        $result->execute();
        $result = $result->fetchAll();

        echo("<h3>entidades</h3><table border=\"1\">\n");
        echo("<tr><td><b>Nome da entidade</b></td><td></td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['nomeentidade']);
            echo("</td><td><a href=\"a.php?mode=delete&type=entidadeMeio&id={$row['nomeentidade']}\">delete</a></td></tr>\n");
        }
        echo("</table>\n");

        $db = null;
        $result = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p><br><a href=\"a.php\">Back</a>");
    }
?>
        <h3>Add new Local</h3>
        <form action='a.php' method='post'>
            <p><input type='hidden' name='mode' value='add'/></p>
            <p><input type='hidden' name='type' value='local'/></p>
            <p>Morada local: <input type='text' name='moradaLocal'/></p>
            <p><input type='submit' value='Submit'/></p>
        </form>
        <h3>Add new Evento de Emergência</h3>
        <form action='a.php' method='post'>
            <p><input type='hidden' name='mode' value='add'/></p>
            <p><input type='hidden' name='type' value='eventoEmergencia'/></p>
            <p>Número de telefone: <input type='text' name='numTelefone'/></p>
            <p>Instante da chamada: <input type='text' name='instanteChamada'/></p>
            <p>Nome: <input type='text' name='nomePessoa'/></p>
            <p>Morada local: <input type='number' name='moradaLocal'/></p>
            <p>Número do processo: <input type='number' name='numProcessoSocorro'/></p>
            <p><input type='submit' value='Submit'/></p>
        </form>
        <h3>Add new Processo de Socorro</h3>
        <form action='a.php' method='post'>
            <p><input type='hidden' name='mode' value='add'/></p>
            <p><input type='hidden' name='type' value='processoSocorro'/></p>
            <p>Número do processo: <input type='number' name='numProcessoSocorro'/></p>
            <p><input type='submit' value='Submit'/></p>
        </form>
        <h3>Add new Meio</h3>
        <form action='a.php' method='post'>
            <p><input type='hidden' name='mode' value='add'/></p>
            <p><input type='hidden' name='type' value='posto'/></p>
            <p>Número: <input type='number' name='numMeio'/></p>
            <p>Nome do meio: <input type='text' name='nomeMeio'/></p>
            <p>Nome da entidade: <input type='text' name='nomeEntidade'/></p>
            <p><input type='submit' value='Submit'/></p>
        </form>
        <h3>Add new Entidade</h3>
        <form action='a.php' method='post'>
            <p><input type='hidden' name='mode' value='add'/></p>
            <p><input type='hidden' name='type' value='entidadeMeio'/></p>
            <p>Nome da entidade: <input type='text' name='nomeEntidade'/></p>
            <p><input type='submit' value='Submit'/></p>
        </form>
    </div>
    </body>
</html>
