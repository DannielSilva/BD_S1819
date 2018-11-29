<html>
    <body>
<?php
    try
    {
        include 'config.php';

        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
        $attrs = array($_REQUEST['attr1'],
                      $_REQUEST['attr2'],
                      $_REQUEST['attr3']);
        $db_ids = array($_REQUEST['db_id1'], 
                        $_REQUEST['db_id2'], 
                        $_REQUEST['db_id3']);
        $back = isset($_REQUEST['back']) ? $_REQUEST['back'] : '';

        $columns = array($_REQUEST['attr1']=>$_REQUEST['db_id1']);
        if($_REQUEST['attr2']) $columns[$_REQUEST['attr2']] = $_REQUEST['db_id2'];
        if($_REQUEST['attr3']) $columns[$_REQUEST['attr3']] = $_REQUEST['db_id3'];     
        
        //$result = $db->prepare("DELETE FROM $type WHERE $attr = :val;");
        //$result->bindParam(':val', $db_id);
        //$result->execute();

        $res = pg_delete($db, $type, $columns);
        if ($res) {
            echo "POST data is deleted: $res\n";
        } else {
            echo "User must have sent wrong inputs\n";
        }

        foreach ($columns as $key => $value) {
            echo("<p>Key: $key; Value: $value\n</p>");
        }
        
        echo("<p>{$_REQUEST['attr1']} {$_REQUEST['db_id1']} removido(a) com sucesso de {$type}</p>");
        echo("<a href={$back} ><input  type='submit' value='Retornar'></a>");
        $uu = pg_convert($db, $type, $columns);
    }

    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p><br><a href=\"{$back}\">Back</a>");
    }
?>

    </body>

</html>
