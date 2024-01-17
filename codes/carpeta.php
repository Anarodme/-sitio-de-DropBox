<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="./creadir.php" method="post">
        <fieldset>
            <input type="text" id="nom" name="nomC">Nombre de la carpeta
            <input type="hidden" name="dir" value="<?php echo $_GET['dir'];?>">
        </fieldset>
        
        <input type="submit">
    </form>
        
</body>
</html>