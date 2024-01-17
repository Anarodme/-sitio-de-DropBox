                        $conta = 0;
                        $directorio = opendir($ruta);
                        echo '<a href=./agrearchi.php>'.'Agregar archivo</a>';
                        echo '<br><br>';
                        echo '<a href=./codes/carpeta.php>'.'Agregar Carpetas</a>';
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
                                    echo '<th><a href=abrarchi.php?arch='.$elem.'>'.$elem.'</a> <img src="./icon/pdf.png" alt=""></th>';
                                }elseif($extension == 'docx'){
                                    echo '<th><a href=abrarchi.php?arch='.$elem.'>'.$elem.'</a> <img src="./icon/docx.png" alt=""></th>';
                                }else {
                                    echo '<th><a href=carpetas.php?arch='.$elem.'>'.$elem.'</a></th>';
                                }
                            
                                echo '<th>'.filesize($ruta.'/'.$elem).' bytes</th>';
                                echo '<th>'.date("d/m/y h:i:s",fileatime($ruta.'/'.$elem)).'</th>';
                                echo '<th>'.is_file($ruta.'/'.$elem).'</th>';
                                echo '<th>'.is_dir($ruta.'/'.$elem).'</th>';
                                echo '<th>'.is_readable($ruta.'/'.$elem).'</th>';
                                echo '<th>'.is_writeable($ruta.'/'.$elem).'</th>';
                                echo '<th>'.is_executable($ruta.'/'.$elem).'</th>';
                                echo '<th><a href=./codes/borrarchi.php?archi='.$elem.'>Borrar</a></th>';
                                echo '</tr>';
                                $conta++;
                            } // fin del if
                        } // fin del while
                        echo '</table>';
                        echo '<br><br>';
                        closedir($directorio);
                        if($conta == 0)
                            echo 'La carpeta del usuario se encuetra vacia!';