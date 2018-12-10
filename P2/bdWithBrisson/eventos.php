<html>
<head>
        <meta charset="UTF-8">
        <title>G24 - Meio</title>
        <link rel = "stylesheet" href="styles.css">
    </head>
    <body>
    <ul id="nav">
            <li><a href='index.html'>Inicio</a></li>
            <li><a href='locais.php'>Locais</a></li>
            <li><a href='proSocorro.php'>Processos de Socorro</a></li>
            <li><a  class="active" href='eventos.php'>Eventos de Emergência</a></li>
            <li><a href='entidade.php'>Entidades</a></li>
            <li><a href='meio.php'>Meios</a></li>
        </ul>
        <div style="margin-left:25%;padding:1px 16px;height:1000px;">
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
        <h2>Eventos de Emergencia</h2>
        <!-- restantes opcoes -->
    </div>
           
    <div id = "add">
        <form action="add.php?back=eventos.php" method='post'>
            <input type='hidden' name='type' value='eventoemergencia'/>    
            <input type='hidden' name='attr1' value='numtelefone'/>
            <input type='hidden' name='attr3' value='instantechamada​'/>
            <input type='hidden' name='attr2' value='nomepessoa'/>
            <input type='hidden' name='attr4' value='moradalocal'/>
            <input type='hidden' name='attr5' value='numprocessosocorro'/>
              

            Numero de Telefone:<br>
            <input list="db_id1s" type="text" name="db_id1"  required><br>
            <datalist id="db_id1s">
            <?php
                $result = $db->prepare("SELECT DISTINCT numTelefone FROM eventoemergencia;");
                $result->execute();
                foreach($result as $row){           
                    echo("<option value='{$row['numtelefone']}'>\n");
                }
            ?>
            </datalist>
            <p></p> Instante da chamada:<br>
            <input list="db_id3s" type="datetime-local" name="db_id3"  step="1" required><br>
            <p></p> Nome da pessoa:<br>
            <input list="db_id2s" type="text" name="db_id2"  ><br>
            <datalist id="db_id2s">
            <?php
                $result = $db->prepare("SELECT DISTINCT nomepessoa FROM eventoemergencia;");
                $result->execute();
                foreach($result as $row){           
                    echo("<option value='{$row['nomepessoa']}'>\n");
                }
            ?>
            </datalist>
            <p></p> Morada do local:<br>
            <input list="db_id4s" type="text" name="db_id4"  ><br>
            <datalist id="db_id4s">
            <?php
                $result = $db->prepare("SELECT DISTINCT moradalocal FROM eventoemergencia;");
                $result->execute();
                foreach($result as $row){           
                    echo("<option value='{$row['moradalocal']}'>\n");
                }
            ?>
            </datalist>
            <p></p> Numero de processo socorro:<br>
            <input list="db_id5s" type="text" name="db_id5" ><br>
            <datalist id="db_id5s">
            <?php
                $result = $db->prepare("SELECT DISTINCT numprocessosocorro FROM eventoemergencia;");
                $result->execute();
                foreach($result as $row){           
                    echo("<option value='{$row['numprocessosocorro']}'>\n");
                }
            ?>
            </datalist>
            <p></p>
            <input type="submit" value="Adicionar">   
            <input type="submit" formaction="remove.php?back=eventos.php" value="Remover">
        </form> 
    </div>

   
<!-- (​numTelefone, instanteChamada​, nomePessoa, moradaLocal, numProcessoSocorro)  -->
 

</html>