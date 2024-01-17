<?php
    
    function vaciarDirectorio($carpeta){
        if (is_dir($carpeta)) {
            $scan = @scandir($carpeta);//Escanea los archivos del directorio y los devuelve en array
            if (count($scan) >= 1) {
                $directorio = @opendir($carpeta);//abre el directorio
                while($elem = readdir($directorio)){//empieza a recorrer el contenido
                    if(($elem!='.') and ($elem!='..')){
                        if (is_dir($carpeta.'/'.$elem)) {//Valida que es un directorio
                            vaciarDirectorio($carpeta.'/'.$elem);//Invoca nuevamente a la funcion
                        }elseif(is_file($carpeta.'/'.$elem)){//Valida que es un archivo
                            @unlink($carpeta.'/'.$elem);
                        }
                    }
                }
                rmdir($carpeta);
            }else {
                rmdir($carpeta);
            }
        }
    }

    $archivo = $_GET['archi'];
    session_start();

    $ruta = getenv('HOME_PATH').'/'.$_SESSION["usuario"].'/'.$archivo;
    // Try to delete file
    echo $ruta;
    if (@unlink($ruta)||rmdir($ruta)){
        $Ir_A = $_SERVER["HTTP_REFERER"];
        echo "<script> location.href='".$Ir_A."'</script>";
    }else{
        vaciarDirectorio($ruta);
        $Ir_A = $_SERVER["HTTP_REFERER"];
        echo "<script> location.href='".$Ir_A."'</script>";
    }
?>
