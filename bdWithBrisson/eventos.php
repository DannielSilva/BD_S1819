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
        <h2>Eventos de Emergencia</h2>
        <!-- restantes opcoes -->
    </div>
           
    <div id = "add">
        <form action="add.php?back=eventos.php" method='post'>
            <input type='hidden' name='type' value='eventoEmergencia'/>    
            <input type='hidden' name='attr1' value='numTelefone'/>
            <input type='hidden' name='attr3' value='instanteChamada​'/>
            <input type='hidden' name='attr2' value='nomePessoa'/>
            <input type='hidden' name='attr4' value='moradaLocal'/>
            <input type='hidden' name='attr5' value='numProcessoSocorro'/>
              

            Numero de Telefone:<br>
            <input type="text" name="db_id1"  required><br>
            <p></p> Instante da chamada:<br>
            <input type="text" name="db_id3"  required><br>
            <p></p> Nome da pessoa:<br>
            <input type="text" name="db_id2"  ><br>
            <p></p> Morada do local:<br>
            <input type="text" name="db_id4"  ><br>
            <p></p> Numero de processo socorro:<br>
            <input type="text" name="db_id5"  ><br>
            <p></p>
            <input type="submit" value="Adicionar">   
            <input type="submit" formaction="remove.php?back=eventos.php" value="Remover">
        </form> 
    </div>

   
<!-- (​numTelefone, instanteChamada​, nomePessoa, moradaLocal, numProcessoSocorro)  -->
 

</html>