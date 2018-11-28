<html>
    <body>
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
                $prep = $db->prepare("DELETE FROM local WHERE moradaLocal = :moradaLocal;");
                $prep->bindParam(':moradaLocal', $_REQUEST['id']);
                $prep->execute();
            }
            if ($type == "eventoEmergencia") {
                $prep = $db->prepare("DELETE FROM eventoEmergencia WHERE numTelefone = :numTelefone AND instanteChamada = :instanteChamada;");
                $prep->bindParam(':numTelefone', $_REQUEST['id']);
                $prep->bindParam(':instanteChamada', $_REQUEST['id2']);
                $prep->execute();
            }
            if ($type == "processoSocorro") {
                $prep = $db->prepare("DELETE FROM processoSocorro WHERE numProcessoSocorro = :numProcessoSocorro");
                $prep->bindParam(':numProcessoSocorro', $_REQUEST['id']);
                $prep->execute();
            }
            if ($type == "meio") {
                $prep = $db->prepare("DELETE FROM meio WHERE numMeio = :numMeio AND nomeEntidade = :nomeEntidade;");
                $prep->bindParam(':numMeio', $_REQUEST['id']);
                $prep->bindParam(':nomeEntidade', $_REQUEST['id2']);
                $prep->execute();
            }
            if ($type == "entidadeMeio") {
                $prep = $db->prepare("DELETE FROM entidadeMeio WHERE nomeEntidade = :nomeEntidade;");
                $prep->bindParam(':nomeEntidade', $_REQUEST['id']);
                $prep->execute();
            }
        }
        if ($mode == "add") {
            if ($type == "local") {
                $prep = $db->prepare("INSERT INTO local VALUES(:moradaLocal);");
                $prep->bindParam(':moradaLocal', $_REQUEST['moradaLocal']);
                $prep->execute();
            }
            if ($type == "eventoEmergencia") {
                $prep = $db->prepare("INSERT INTO alugavel (numTelefone, instanteChamada) VALUES(:numTelefone, :instanteChamada);");
                $prep->bindParam(':numTelefone', $_REQUEST['numTelefone']);
                $prep->bindParam(':instanteChamada', $_REQUEST['instanteChamada']);
                $prep->execute();
                $last_id = $db->lastInsertId();

                $prep = $db->prepare("INSERT INTO espaco (codigo, morada) VALUES(:codigo, :morada);");
                $prep->bindParam(':codigo', $last_id);
                $prep->bindParam(':morada', $_REQUEST['morada']);
                $prep->execute();
            }
            if ($type == "posto") {
                $prep = $db->prepare("INSERT INTO alugavel (morada, foto) VALUES(:morada, :foto);");
                $prep->bindParam(':morada', $_REQUEST['morada']);
                $prep->bindParam(':foto', $_REQUEST['foto']);
                $prep->execute();
                $last_id = $db->lastInsertId();

                $prep = $db->prepare("INSERT INTO posto (morada, codigo, codigo_espaco) VALUES(:morada, :codigo, :codigo_espaco);");
                $prep->bindParam(':codigo', $last_id);
                $prep->bindParam(':codigo_espaco', $_REQUEST['codigo_espaco']);
                $prep->bindParam(':morada', $_REQUEST['morada']);
                $prep->execute();
            }
        }

        $prep = $db->prepare("SELECT moradaLocal FROM local;");
        $prep->execute();
        $result = $prep->fetchAll();

        echo("<h3>local</h3><table border=\"1\">\n");
        echo("<tr><td><b>Morada local</b></td><td></td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['moradaLocal']);
            echo("</td><td><a href=\"a.php?mode=delete&type=local&id={$row['moradaLocal']}\">delete</a></td></tr>\n");
        }
        echo("</table>\n");

        $prep = $db->prepare("SELECT numTelefone, instanteChamada, nomePessoa, moradaLocal, numProcessoSocorro FROM eventoEmergencia;");
        $prep->execute();
        $result = $prep->fetchAll();

        echo("<h3>eventoEmergencia</h3><table border=\"1\">\n");
        echo("<tr><td><b>Número de telefone</b></td><td><b>Instante da chamada</b></td><td><b>Nome</b></td><td><b>Morada local</b></td><td><b>Número do processo</b></td><td></td></tr>\n");
        foreach($result as 99$row)
        {
            echo("<tr><td>");
            echo($row['numTelefone']);
            echo("</td><td>");
            echo($row['instanteChamada']);
            echo("</td><td>");
            echo($row['nomePessoa']);
            echo("</td><td>");
            echo($row['moradaLocal']);
            echo("</td><td>");
            echo($row['numProcessoSocorro']);
            echo("</td><td><a href=\"a.php?mode=delete&type=eventoEmergencia&id={$row['numTelefone']}&id2={$row['instanteChamada']}\">delete</a></td></tr>\n");
        }
        echo("</table>\n");

        $prep = $db->prepare("SELECT numProcessoSocorro FROM processoSocorro;");
        $prep->execute();
        $result = $prep->fetchAll();

        echo("<h3>local</h3><table border=\"1\">\n");
        echo("<tr><td><b>Número do processo</b></td><td></td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['numProcessoSocorro']);
            echo("</td><td><a href=\"a.php?mode=delete&type=processoSocorro&id={$row['numProcessoSocorro']}\">delete</a></td></tr>\n");
        }
        echo("</table>\n");

        $prep = $db->prepare("SELECT numMeio, nomeMeio, nomeEntidade FROM meio;");
        $prep->execute();
        $result = $prep->fetchAll();

        echo("<h3>posto</h3><table border=\"1\">\n");
        echo("<tr><td><b>Número</b></td><td><b>Nome do meio</b></td><td><b>Nome da entidade</b></td><td></td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['numMeio']);
            echo("</td><td>");
            echo($row['nomeMeio']);
            echo("</td><td>");
            echo($row['nomeEntidade']);
            echo("</td><td><a href=\"a.php?mode=delete&type=meio&id={$row['numMeio']}&id2={$row['nomeEntidade']}\">delete</a></td></tr>\n");
        }
        echo("</table>\n");

        $prep = $db->prepare("SELECT nomeEntidade FROM entidadeMeio;");
        $prep->execute();
        $result = $prep->fetchAll();

        echo("<h3>local</h3><table border=\"1\">\n");
        echo("<tr><td><b>Nome da entidade</b></td><td></td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['numProcessoSocorro']);
            echo("</td><td><a href=\"a.php?mode=delete&type=entidadeMeio&id={$row['nomeEntidade']}\">delete</a></td></tr>\n");
        }
        echo("</table>\n");

        $db = null;
        $prep = null;
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
    </body>
</html>
