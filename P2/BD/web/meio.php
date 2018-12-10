<html>
    <body>
<?php
    try{
        include 'config.php';


    }   
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p><br><a href=\"a.php\">Back</a>");
    }
?>



    <h1> Sistema de Gest&atildeo de Inc&ecircndios Florestais </h1>
    <div id = "left_col">
        <h2>locais</h2>
        <!-- restantes opcoes -->
    </div>
    <div id = "add">
        <form action="add.php?back=locais.php" method='post'>
            <input type='hidden' name='attr' value='moradalocal'/>  
            <input type='hidden' name='type' value='local'/>    

            Morada Local:<br>
            <input type="text" name="db_id"  >

            <input type="submit" value="Adicionar">   
        </form> 
    </div>

    <div id = "remove">
        <form action="remove.php?back=locais.php" method="post">
        <input type='hidden' name='attr' value='moradalocal'/>  
        <input type='hidden' name='type' value='local'/>    

            <input list="db_ids" name="db_id">
            <datalist id="db_ids">
            <?php
                $result = $db->prepare("SELECT moradaLocal FROM local;");
                $result->execute();

                foreach($result as $row){           
                    echo("<option value='{$row['moradalocal']}'>\n");
                }
            ?>
            </datalist>
            
            <input type="submit" value="Remover">
        </form>
    </div>

    
    <div id = "editar">
    <form action="altera.php?back=locais.php" method="post">
        <input type='hidden' name='attr' value='moradalocal'/>  
        <input type='hidden' name='type' value='local'/>    

            <input list="db_ids" name="db_id">
            <datalist id="db_ids">
            <?php
                $result = $db->prepare("SELECT moradaLocal FROM local;");
                $result->execute();

                foreach($result as $row){           
                    echo("<option value='{$row['moradalocal']}'>\n");
                }
            ?>
            </datalist>
            
            <input type="submit" value="Remover">
        </form>
        <form action="add.php?back=locais.php" method='post'>
            <input type='hidden' name='attr' value='moradalocal'/>  
            <input type='hidden' name='type' value='local'/>    

            Morada Local:<br>
            <input type="text" name="db_id"  >

            <input type="submit" value="Adicionar">   
        </form> 
    </div>

</html>