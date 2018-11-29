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

        //$result = $db->prepare("DELETE FROM $type WHERE $attr = :val;");
        //$result->bindParam(':val', $db_id);
        //$result->execute();

        $result = pgdelete($db, 'post_log', $type);

        echo("<p>{$attr} {$db_id} removido(a) com sucesso de {$type}</p>");
        echo("<a href={$back} ><input  type='submit' value='Retornar'></a>");
    }

    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p><br><a href=\"a.php\">Back</a>");
    }
?>

    </body>

</html>
