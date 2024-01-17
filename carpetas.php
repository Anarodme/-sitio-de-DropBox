<?php
    session_start();
    if($_SESSION["autenticado"] != "SI") {
        header("Location: index.php");
        exit(); //fin del scrip
    }

    $archivo=$_GET['arch'];

    $ruta  = getenv('HOME_PATH').'/'.$_SESSION["usuario"];
?>
<!doctype html>
<html lang="en">
<head>
    <?php
        include_once('sections/head.inc');
    ?>
    <title>Ingreso al Sitio</title>

    <script>
        function confirmar(){
            var confirma = confirm("¿desea borrar lo que digito?");
            if(confirma==true){
                return true;
            }else{
                return false;
            }
        }
    </script>
</head>
<body class="container-fluid">
    <header class="row">
        <div class="row">
            <?php include_once('sections/header.inc'); ?>
        </div>
    </header>
    
    <main class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <strong>Mi Cajón de Archivos</strong>
            </div>
            <div class="panel-body">
                <?php
                    if (isset($archivo)){
                        $ruta.='/'.$archivo;
                        //include_once('sections/contDirectorios.inc');
                        $conta = 0;
                        $directorio = opendir($ruta);
                        
                        echo '<div class="btnAgregar"><a href=agrearchi.php?directorio='.$ruta.'>'.'Agregar archivo</a></div>';
                        echo '<br><br>';
                        echo '<div class="btnAgregar"><a href=codes/carpeta.php?dir='.$ruta.'>'.'Agregar Carpetas</a></div>';
                        echo '<br><br>';
                        echo '<table class="table table-striped">';
                        echo '<tr>';
                        echo '<th>Nombre</th>';
                        echo '<th>Tamaño</th>';
                        echo '<th>Ultimo acceso</th>';
                        echo '<th>Archivo</th>';
                        echo '<th>Directorio</th>';
                        echo '<th>Lectura</th>';
                        echo '<th>Escritura</th>';
                        echo '<th>Ejecutable</th>';
                        echo '<th>Acción</th>';
                        echo '</tr>';
                        while($elem = readdir($directorio)){
                            if(($elem!='.') and ($elem!='..')){
                                $file = new SplFileInfo($elem);
                                $extension = $file->getExtension();
                                echo '<tr>';
                                if($extension =='pdf'){
                                    echo '<th><div class="iconos"><img class="tamanioIco" src="./icon/PDF.png" alt=""></div><a class="nombres" href=abrarchi.php?arch='.$elem.'>'.$elem.'</a></th>';
                                }elseif($extension == 'docx'){
                                    echo '<th><div class="iconos"><img class="tamanioIco" src="./icon/WORD.png" alt=""></div><a class="nombres" href=abrarchi.php?arch='.$elem.'>'.$elem.'</a></th>';
                                }elseif($extension == 'jpg'){
                                    echo '<th><div class="iconos"><img class="tamanioIco" src="./icon/JPG.png" alt=""></div><a class="nombres" href=abrarchi.php?arch='.$elem.'>'.$elem.'</a></th>';
                                }elseif($extension == 'png'){
                                    echo '<th><div class="iconos"><img class="tamanioIco" src="./icon/PNG.png" alt=""></div><a class="nombres" href=abrarchi.php?arch='.$elem.'>'.$elem.'</a></th>';
                                }elseif($extension == 'txt'){
                                    echo '<th><div class="iconos"><img class="tamanioIco" src="./icon/TXT.png" alt=""></div><a class="nombres" href=abrarchi.php?arch='.$elem.'>'.$elem.'</a></th>';
                                }else {
                                    $next=$archivo.'/'.$elem;
                                    echo '<th><div class="iconos"><img class="tamanioIco" src="./icon/Directorio.png" alt=""></div><a class="nombres" href=carpetas.php?arch='.$next.'>'.$elem.'</a></th>';
                                }
                                $file= filesize($ruta.'/'.$elem);
                                echo '<th>'.round($file/ 1024 / 1024, 2).' Mbytes</th>';
                                echo '<th>'.date("d/m/y h:i:s",fileatime($ruta.'/'.$elem)).'</th>';
                                echo '<th>'.is_file($ruta.'/'.$elem).'</th>';
                                echo '<th>'.is_dir($ruta.'/'.$elem).'</th>';
                                echo '<th>'.is_readable($ruta.'/'.$elem).'</th>';
                                echo '<th>'.is_writeable($ruta.'/'.$elem).'</th>';
                                echo '<th>'.is_executable($ruta.'/'.$elem).'</th>';
                                $file=$archivo.'/'.$elem;
                                echo '<th><a href=codes/borrarchi.php?archi='.$file.'>Borrar</a></th>';
                                echo '</tr>';
                                $conta++;
                            }// fin del if
                        } // fin del while
                        echo '</table>';
                        echo '<br><br>';
                        closedir($directorio);
                        if($conta == 0)
                            echo 'La carpeta del usuario se encuetra vacia!';
                    }else{
                        $conta = 0;
                        $directorio = opendir($ruta);
                        echo '<div class="btnAgregar"><a href=agrearchi.php?directorio='.$ruta.'>'.'Agregar archivo</a></div>';
                        echo '<br><br>';
                        echo '<div class="btnAgregar"><a href=codes/carpeta.php?dir='.$ruta.'>'.'Agregar Carpetas</a></div>';
                        echo '<br><br>';
                        echo '<table class="table table-striped">';
                        echo '<tr>';
                        echo '<th>Nombre</th>';
                        echo '<th>Tamaño</th>';
                        echo '<th>Ultimo acceso</th>';
                        echo '<th>Archivo</th>';
                        echo '<th>Directorio</th>';
                        echo '<th>Lectura</th>';
                        echo '<th>Escritura</th>';
                        echo '<th>Ejecutable</th>';
                        echo '<th>Acción</th>';
                        echo '</tr>';
                        while($elem = readdir($directorio)){
                            if(($elem!='.') and ($elem!='..')){
                                $file = new SplFileInfo($elem);
                                $extension = $file->getExtension();
                                echo '<tr>';
                                if($extension =='pdf'){
                                    echo '<th><div class="iconos"><img class="tamanioIco" src="./icon/PDF.png" alt=""></div><a class="nombres" href=abrarchi.php?arch='.$elem.'>'.$elem.'</a></th>';
                                }elseif($extension == 'docx'){
                                    echo '<th><div class="iconos"><img class="tamanioIco" src="./icon/WORD.png" alt=""></div><a class="nombres" href=abrarchi.php?arch='.$elem.'>'.$elem.'</a></th>';
                                }elseif($extension == 'jpg'){
                                    echo '<th><div class="iconos"><img class="tamanioIco" src="./icon/JPG.png" alt=""></div><a class="nombres" href=abrarchi.php?arch='.$elem.'>'.$elem.'</a></th>';
                                }elseif($extension == 'png'){
                                    echo '<th><div class="iconos"><img class="tamanioIco" src="./icon/PNG.png" alt=""></div><a class="nombres" href=abrarchi.php?arch='.$elem.'>'.$elem.'</a></th>';
                                }elseif($extension == 'txt'){
                                    echo '<th><div class="iconos"><img class="tamanioIco" src="./icon/TXT.png" alt=""></div><a class="nombres" href=abrarchi.php?arch='.$elem.'>'.$elem.'</a></th>';
                                }else {
                                    echo '<th><div class="iconos"><img class="tamanioIco" src="./icon/Directorio.png" alt=""></div><a class="nombres" href=carpetas.php?arch='.$elem.'>'.$elem.'</a></th>';
                                }
                                $file= filesize($ruta.'/'.$elem);
                                echo '<th>'.round($file/ 1024 / 1024, 2).' Mbytes</th>';
                                echo '<th>'.date("d/m/y h:i:s",fileatime($ruta.'/'.$elem)).'</th>';
                                echo '<th>'.is_file($ruta.'/'.$elem).'</th>';
                                echo '<th>'.is_dir($ruta.'/'.$elem).'</th>';
                                echo '<th>'.is_readable($ruta.'/'.$elem).'</th>';
                                echo '<th>'.is_writeable($ruta.'/'.$elem).'</th>';
                                echo '<th>'.is_executable($ruta.'/'.$elem).'</th>';
                                echo '<th><a href=codes/borrarchi.php?archi='.$elem.' onclick="return confirmar()">Borrar</a></th>';
                                echo '</tr>';
                                $conta++;
                            } // fin del if
                        } // fin del while
                        echo '</table>';
                        echo '<br><br>';
                        closedir($directorio);
                        if($conta == 0)
                            echo 'La carpeta del usuario se encuetra vacia!';
                    }
                ?>
            </div>
        </div>
    </main>
    <footer class="row">
        <?php include_once('sections/foot.inc'); ?>
    </footer>
</body>
</html>
