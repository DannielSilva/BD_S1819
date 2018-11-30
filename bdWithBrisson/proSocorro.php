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
            <li><a class="active" href='proSocorro.php'>Processos de Socorro</a></li>
            <li><a href='eventos.php'>Eventos de Emergência</a></li>
            <li><a href='entidade.php'>Entidades</a></li>
            <li><a href='meio.php'>Meios</a></li>
            <li><a href='e.php'>Accionar Meios</a></li>
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
        <h2>Processos de Socorro</h2>
        <!-- restantes opcoes -->
    </div>
           
    <div id = "add">
        <form action="add.php?back=proSocorro.php" method='post'>
            <input type='hidden' name='attr1' value='numProcessoSocorro'/>   
            <input type='hidden' name='attr2' value='numTelefone'/>
            <input type='hidden' name='attr4' value='instanteChamada​'/>
            <input type='hidden' name='attr3' value='nomePessoa'/>
            <input type='hidden' name='attr5' value='moradaLocal'/>
            <input type='hidden' name='attr6' value='numProcessoSocorro'/>
              
            <input type='hidden' name='type' value='processoSocorro'/>    

            Numero do processo de socorro:<br>
            <input type="text" name="db_id1"  required><br>
            <p></p>

            <b>Novo evento de emergencia:</b><br>
            <p></p>

            Numero de Telefone:<br>
            <input type="text" name="db_id2"  ><br>
            <p></p> Instante da chamada:<br>
            <input type="text" name="db_id4"  ><br>
            <p></p> Nome da pessoa:<br>
            <input type="text" name="db_id3"  ><br>
            <p></p> Morada do local:<br>
            <input type="text" name="db_id5"  ><br>
 
            <p></p>


            <input type="submit" value="Adicionar">   
            <input type="submit" formaction="remove.php?back=proSocorro.php" value="Remover">
        </form> 
    </div>

    <?php
     $result = $db->prepare("SELECT * FROM processoSocorro;");
     $result->execute();
        echo("<h3>Lista de processos socorro</h3><table border=\"1\">\n");
            echo("<tr><td>Numero</td><td>Remover</td><td>Listar</td></tr>\n");
            foreach($result as $row)
            {
                echo("<tr><td>");
                echo($row['numprocessosocorro']);
                echo("</td><td><a href=\"remove.php?back=proSocorro.php&type=processoSocorro&attr1=numProcessoSocorro&db_id1={$row['numprocessosocorro']}\">delete</a>");
                echo("</td><td><a href=\"list.php?back=proSocorro.php&type=processoSocorro&attr1=numProcessoSocorro&db_id1={$row['numprocessosocorro']}\">meios</a>");
            }
            echo("</table>\n");
    ?>  

   

 

</html>