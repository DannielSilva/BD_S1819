<html>
<head>
        <meta charset="UTF-8">
        <title>G24 - Meio</title>
        <link rel = "stylesheet" href="styles.css">
    </head>
    <body>
    <ul id="nav">
            <li><a href='index.html'>Ínicio</a></li>
            <li><a  href='locais.php'>Locais</a></li>
            <li><a href='b.php'>Processos de Socorro</a></li>
            <li><a href='d.php'>Eventos de Emergência</a></li>
            <li><a href='e.php'>Entidades</a></li>
            <li><a class="active" href='meio.php'>Meios</a></li>
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
            <input type="text" name="db_id1"  required>
            <p></p>
            Nome Meio:<br>
            <input type="text" name="db_id2"  >
            <p></p>
            Nome Entidade:<br>
            <input type="text" name="db_id3"  required><br>
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

   

 

</html>