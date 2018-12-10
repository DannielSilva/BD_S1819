<html>
    <body>
<?php
    try
    {
        include 'config.php';

        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
        $attr = isset($_REQUEST['attr']) ? $_REQUEST['attr'] : '';
        $db_id = isset($_REQUEST['db_id']) ? $_REQUEST['db_id'] : '';
        $back = isset($_REQUEST['back']) ? $_REQUEST['back'] : '';


        if ($type == "local") {
            $result = $db->prepare("INSERT INTO $type ($attr) VALUES (:morada);");
            $result->bindParam(':morada', $db_id);
            $result->execute();
        }

        echo("<p>{$attr} {$db_id} adicionado(a) com sucesso a {$type}</p>");
        echo("<a href={$back} ><input  type='submit' value='Retornar'></a>");
    }

    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p><br><a href=\"a.php\">Back</a>");
    }
?>

    </body>

</html>
