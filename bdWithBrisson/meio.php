<html>
<head>
        <meta charset="UTF-8">
        <title>G24 - Meio</title>
        <link rel = "stylesheet" href="styles.css">
    </head>
    <body>
    <ul id="nav">
            <li><a href='index.html'>Inicio</a></li>
            <li><a  href='locais.php'>Locais</a></li>
            <li><a href='proSocorro.php'>Processos de Socorro</a></li>
            <li><a href='eventos.php'>Eventos de Emergência</a></li>
            <li><a href='entidade.php'>Entidades</a></li>
            <li><a class="active" href='meio.php'>Meios</a></li>
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
        <h2>Meios</h2>
        <!-- restantes opcoes -->
    </div>
           
    <div id = "add">
        <form action="add.php?back=meio.php" method='post'>
            <input type='hidden' name='attr1' value='numMeio'/>  
            <input type='hidden' name='attr2' value='nomeMeio'/>
            <input type='hidden' name='attr3' value='nomeEntidade'/>
              
            <input type='hidden' name='type' value='meio'/>    

            Numero Meio:<br>
            <input list="db_id1s" type="number" name="db_id1"  required>
            <datalist id="db_id1s">
            <?php
                $result = $db->prepare("SELECT DISTINCT numMeio FROM meio;");
                $result->execute();
                foreach($result as $row){           
                    echo("<option value='{$row['nummeio']}'>\n");
                }
            ?>
            </datalist>
            <p></p>
            Nome Meio:<br>
            <input list="db_id2s" type="text" name="db_id2"  >
            <datalist id="db_id2s">
            <?php
                $result = $db->prepare("SELECT DISTINCT nomeMeio FROM meio;");
                $result->execute();
                foreach($result as $row){           
                    echo("<option value='{$row['nomemeio']}'>\n");
                }
            ?>
            </datalist>
            <p></p>
            Nome Entidade:<br>
            <input list="db_id3s"type="text" name="db_id3"  required><br>
            <datalist id="db_id3s">
            <?php
                $result = $db->prepare("SELECT DISTINCT nomeentidade FROM meio;");
                $result->execute();
                foreach($result as $row){           
                    echo("<option value='{$row['nomeentidade']}'>\n");
                }
            ?>
            </datalist>
            <p></p>
            <input type="checkbox" value="yes"  name="comb" >Combate
            <input type="checkbox" value="yes" name="sos" >Socorro
            <input type="checkbox" value="yes"  name="apoio" >Apoio
            <p></p>

            <input type="submit" value="Adicionar">   
            <input type="submit" formaction="remove.php?back=meio.php" value="Remover">
            <input type="submit" formaction="edita.php?back=meio.php"  value="Editar">
        </form> 
    </div>
    <?php
     $result = $db->prepare("SELECT * FROM meio;");
     $result->execute();
        echo("<h3>Lista de meios</h3><table border=\"1\">\n");
            echo("<tr><td>Numero</td><td>Nome</td><td>Entidade</td><td>Remover</td><td>Accionar</td></tr>\n");
            foreach($result as $row)
            {
                echo("<tr><td>");
                echo($row['nummeio']);
                echo("</td><td>");
                echo($row['nomemeio']);
                echo("</td><td>");
                echo($row['nomeentidade']);
                echo("</td><td><a href=\"remove.php?back=meio.php&type=meio&attr1=numMeio&attr3=nomeEntidade&db_id1={$row['nummeio']}&db_id3={$row['nomeentidade']}\">delete</a></td>");
                echo("</td><td>

                    <form action='add.php?back=meio.php' method='post'>
                        <input placeholder='Processo' type='text' name='db_id3'  required><br> 
                        <input type='submit' value='Confirmar' formaction='add.php?back=meio.php&type=acciona&db_id1={$row['nummeio']}&db_id2={$row['nomeentidade']}'></a>
                        </td></tr>
                    </form> \n");

                       
            }
            echo("</table>\n");
    ?>  

</html>