<html>
        <head>
                <title> Gen </title>
                <link rel="stylesheet" type="text/css" href="styletab.css" />

                <link rel="icon" href = "cherisombrero.png">

                <?php
                        $id =$_GET["id"];
                ?>

        <style> 
	        body { 
		background-image: url("https://www.10wallpaper.com/wallpaper/1366x768/1402/ghost_nebula-Space_Photo_Wallpaper_1366x768.jpg"); 
		background-color: black;
		background-position: center; 
		background-size: cover;
		background-repeat: no-repeat; 
		color: black;
	        } 
        </style>

        </head>
        <body>
                <script>
                function myFunction() {
                        var myWindow = window.open("", "", "width=200,height=100");
                }           
                </script>
                <?php
                error_reporting(E_ALL);
                ini_set('display_errors', '1');

                        $mysqli = new mysqli("localhost:xxxx", "Insert Username", "Insert Password", "Proyect_name");
                        if($mysqli->connect_errno){
                                echo "Fallo al conectar a MySQL:(" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                                die();
                        }else{
                                
                                $cadena = "";
				echo "<br>";
				$query = "select OBJECT_SYNONYM_NAME from OBJECT_SYNONYM OS, GENE G where G.gene_ID=OS.object_id and G.gene_id='" . $id . "';";
                                $res = $mysqli->query($query);
				if ($res->num_rows >= 0){
                                	for ($num_fila = 1;  $num_fila <= $res->num_rows; $num_fila++) {
                                            $campos1 = $res->fetch_assoc();
                                                $cadena = $cadena . $campos1['OBJECT_SYNONYM_NAME'] . ", ";
					}
				}

                                $query = "select gene_id, gene_name, gene_posleft, gene_posright, gene_strand, gene_sequence from GENE where gene_id ='". $id . "';";
                                $res = $mysqli->query($query);
                                if ($res->num_rows >= 0){
                                ?>
                                   <table>
                                   <caption>Informacion del Gen</caption>
                                   <thead>
					<tr>
                                        <th scope="col"> Nombre </th>
                                        <th scope="col">Posición a la izquierda </th>
                                        <th scope="col">Posición a la derecha </th>
                                        <th scope="col">Strand </th>
                        
                                        </tr>
                                   </thead>
                                        <?php for ($num_fila = 1;  $num_fila <= $res->num_rows; $num_fila++) {
                                                $campos = $res->fetch_object();
                                                ?>
                                                <tbody>
                                                <tr>
                                                        <td> <?= $campos-> gene_name; ?></td>
                                                        <td> <?= $campos-> gene_posleft; ?></td>
							<td> <?= $campos-> gene_posright; ?></td>
							<td> <?= $campos-> gene_strand; ?></td>
                                                        
                                                        <tfoot>
                                                        <tr>
                                                          <th scope="row" colspan="2">Sinonimos</th>                                                      
                                                          <td colspan="2"> <?php echo $cadena; ?></td>
                                                        </tr>                                                
                                                        </tfoot>
                                                </tr>
                                                </tbody>
                                                    
                                        <?php } ?>
                                        
                                        </table>
                                <br>

                                <div align="center">
                                <button class="button" onclick ="window.open('seqg.php?id=<?=$campos->gene_id;?>', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=0,width=400,height=400')";
                                                        >Secuencia del Gen</button>
                                </div>
                          <?php }
                                
                                $cadena2 = "";
                                $query = "select OS.OBJECT_SYNONYM_NAME from OBJECT_SYNONYM OS, PRODUCT P, GENE G, GENE_PRODUCT_LINK GPL where G.gene_ID=GPL.gene_id and GPL.product_id=P.product_id and P.product_id=OS.object_id and G.gene_id ='" . $id ."';";
                                $res = $mysqli->query($query);
                                if ($res->num_rows >= 0){
                                        for ($num_fila = 1;  $num_fila <= $res->num_rows; $num_fila++) {
                                            $campos = $res->fetch_assoc();
                                                $cadena2 = $cadena2 . $campos['OBJECT_SYNONYM_NAME'] . ", ";
                                        }
                                }

                                $query = "select G.gene_id, product_name, product_sequence, location, molecular_weigth, isoelectric_point from PRODUCT P, GENE_PRODUCT_LINK GPL, GENE G where G.gene_id=GPL.gene_id and GPL.product_id=P.product_id and G.gene_id ='". $id . "';";
                                $res = $mysqli->query($query);
                                if ($res->num_rows >= 0){
                                ?>
                                   <table>
                                        <caption> <?php echo "Producto del Gen "?> </caption>
      				        <thead>
						<tr>
					  		<th scope="col">Nombre</th>
					                <th scope="col">Locación celular</th>
            				                <th scope="col">Peso molecular</th>
    						        <th scope="col">Punto isoeléctrico</th>

                                                </tr>
					</thead>
                                        <?php for ($num_fila = 1;  $num_fila <= $res->num_rows; $num_fila++) {
                                                $campos = $res->fetch_object();
                                                ?>
                                                <tr>
                                                        <td> <?= $campos-> product_name; ?></td>
                                                        <td> <?= $campos-> location; ?></td>
                                                        <td> <?= $campos-> molecular_weigth; ?></td>
                                                        <td> <?= $campos-> isoelectric_point; ?></td>
                                                        <tfoot>
                                                        <tr>
                                                          <th scope="row" colspan="2">Sinonimos</th>                                                      
                                                          <td colspan="2"> <?php echo $cadena2; ?></td>
                                                        </tr>                                                
                                                        </tfoot>

                                                </tr>
                                        <?php } ?>
                                              </table>
                                <?php }
                                echo "<br>";
                                ?>

                                <div align="center">
                                <button class="button" onclick ="window.open('seqo.php?id=<?=$campos->gene_id;?>', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=0,width=400,height=400')";
                                >Secuencia del Producto</button>
                                </div>
                                <?php 
                                
				

                                $query = "select O.operon_id, operon_name from GENE G, TU_GENE_LINK TGL, TRANSCRIPTION_UNIT TU, OPERON O where O.operon_id=TU.operon_id and TU.transcription_unit_id=TGL.transcription_unit_id and TGL.gene_id=G.gene_id and G.gene_id= '". $id . "'";
                                $res = $mysqli->query($query);
                                if ($res->num_rows >= 0){
                                ?>
                                        <table>
                                        <caption> <?php echo "Operones relacionados "?> </caption>
      				        <thead>        
                                        <tr>
                                        <th scope="col"> ID </th>
                                        <th scope="col"> Nombre </th>
                                        </tr>
                                        </thead>
                                        <?php for ($num_fila = 1;  $num_fila <= $res->num_rows; $num_fila++) {
                                                $campos = $res->fetch_object();
                                                ?>
                                                <tr>
                                <td> <a <?php echo 'href="operon.php?id=' . $campos-> operon_id .'"'?> > <?= $campos-> operon_id; ?> </a></td>
                                <td> <a <?php echo 'href="operon.php?id=' . $campos-> operon_id .'"'?> > <?= $campos-> operon_name; ?> </a></td>
                                                </tr>
                                        <?php } ?>
                                                </table>
                          <?php }

                        ?> 
			<div align="right" > <a <?php echo 'href="index.html"'; ?> > <img src="cherihome.png" style="width:280px" /> </a></div>
	          <?php }
                ?>
        </body>

</html>

