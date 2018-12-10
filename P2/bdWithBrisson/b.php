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
        $id3 = isset($_REQUEST['id3']) ? $_REQUEST['id3'] : '';

        if ($mode == "delete") {
            if ($type == "oferta") {
                $prep = $db->prepare("DELETE FROM oferta WHERE morada = :morada AND codigo = :codigo AND data_inicio = :data_inicio;");
                $prep->bindParam(':morada', $_REQUEST['id']);
                $prep->bindParam(':codigo', $_REQUEST['id2']);
                $prep->bindParam(':data_inicio', $_REQUEST['id3']);
                $prep->execute();
            }
        }
        if ($mode  == "add") {
            if ($type == "oferta") {
                $prep = $db->prepare("INSERT INTO oferta VALUES(:morada, :codigo, :data_inicio, :data_fim, :tarifa);");
                $prep->bindParam(':morada', $_REQUEST['morada']);
                $prep->bindParam(':codigo', $_REQUEST['codigo']);
                $prep->bindParam(':data_inicio', $_REQUEST['data_inicio']);
                $prep->bindParam(':data_fim', $_REQUEST['data_fim']);
                $prep->bindParam(':tarifa', $_REQUEST['tarifa']);
                $prep->execute();
            }
        }

        $prep = $db->prepare("SELECT morada, codigo, foto FROM alugavel;");
        $prep->execute();
        $result = $prep->fetchAll();

        echo("<h3>alugavel</h3><table border=\"1\">\n");
        echo("<tr><td><b>morada</b></td><td><b>codigo</b></td><td><b>foto</b></td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['morada']);
            echo("</td><td>");
            echo($row['codigo']);
            echo("</td><td>");
            echo($row['foto']);
            echo("</td></tr>\n");
        }
        echo("</table>\n");

        $prep = $db->prepare("SELECT morada, codigo, data_inicio, data_fim, tarifa FROM oferta;");
        $prep->execute();
        $result = $prep->fetchAll();

        echo("<h3>oferta</h3><table border=\"1\">\n");
        echo("<tr><td><b>morada</b></td><td><b>codigo</b></td><td><b>data_inicio</b></td><td><b>data_fim</b></td><td><b>tarifa</b></td><td></td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['morada']);
            echo("</td><td>");
            echo($row['codigo']);
            echo("</td><td>");
            echo($row['data_inicio']);
            echo("</td><td>");
            echo($row['data_fim']);
            echo("</td><td>");
            echo($row['tarifa']);
            echo("</td><td><a href=\"b.php?mode=delete&type=oferta&id={$row['morada']}&id2={$row['codigo']}&id3={$row['data_inicio']}\">delete</a></td></tr>\n");
        }
        echo("</table>\n");

        $db = null;
        $prep = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p><br><a href=\"b.php\">Back</a>");
    }
?>
        <h3>Add new oferta</h3>
        <form action='b.php' method='post'>
            <p><input type='hidden' name='mode' value='add'/></p>
            <p><input type='hidden' name='type' value='oferta'/></p>
            <p>morada: <input type='text' name='morada'/></p>
            <p>codigo: <input type='number' name='codigo'/></p>
            <p>data_inicio: <input type='date' name='data_inicio'/></p>
            <p>data_fim: <input type='date' name='data_fim'/></p>
            <p>tarifa: <input type='number' name='tarifa' step="0.01"/></p>
            <p><input type='submit' value='Submit'/></p>
        </form>
    </body>
</html>
