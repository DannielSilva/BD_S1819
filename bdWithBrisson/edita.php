<html>
<head>
        <meta charset="UTF-8">
        <title>G24 - Edita</title>
        <link rel = "stylesheet" href="styles.css">
    </head>
    <body>
    <ul id="nav">
            <li><a href='index.html'>Ínicio</a></li>
            <li><a  href='locais.php'>Locais</a></li>
            <li><a href='b.php'>Processos de Socorro</a></li>
            <li><a href='d.php'>Eventos de Emergência</a></li>
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
        $db_id1 = isset($_REQUEST['db_id1']) ? $_REQUEST['db_id1'] : '';
        $db_id2 = isset($_REQUEST['db_id2']) ? $_REQUEST['db_id2'] : '';
        $db_id3 = isset($_REQUEST['db_id3']) ? $_REQUEST['db_id3'] : '';
        $back = isset($_REQUEST['back']) ? $_REQUEST['back'] : '';




           /* $check = $db->prepare("SELECT * FROM $type WHERE $attr1 = :val1 and $attr3 = :val2;");
            $check->bindParam(':val1', $db_id1);
            $check->bindParam(':val2', $db_id3);
            $check->execute();
            
            if (pg_num_rows($check)==0) {
                echo("<p>{$db_id3} - {$db_id1} não existe em $type</p>");
            }
            else {*/
                echo("<div id = 'add'>
                <form action='update.php?back=meio.php&nm={$db_id1}&ne={$db_id3}' method='post'>
                    <input type='hidden' name='attr1' value='numMeio'/>  
                    <input type='hidden' name='attr2' value='nomeMeio'/>
                    <input type='hidden' name='attr3' value='nomeEntidade'/>
                      
                    <input type='hidden' name='type' value='meio'/>    
        
                    Numero Meio:<br>
                    <input type='text' name='db_id4'  required>
                    <p></p>
                    Nome Meio:<br>
                    <input type='text' name='db_id5'  required>
                    <p></p>
                    Nome Entidade:<br>
                    <input type='text' name='db_id6'  required><br>
                    <p></p>
                    <input type='checkbox' value='yes'  name='comb' >Combate
                    <input type='checkbox' value='yes' name='sos' >Socorro
                    <input type='checkbox' value='yes'  name='apoio' >Apoio
                    <p></p>
        
                    <input type='submit' value='Confirmar'>   

                </form> 
            </div>");
            


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


