<html>
        <head>
                <title> Operon </title>

                <link rel="icon" href = "cherisombrero.png">
                <link rel="stylesheet" type="text/css" href="styletab.css" />

                <?php 
                        $id =$_GET["id"];
                ?>

        <style> 
	        body { 
		background-image: url("https://images8.alphacoders.com/768/thumb-1920-768202.jpg"); 
		background-color: black;
		background-position: center; 
		background-size: cover;
		background-repeat: no-repeat; 
		color: black;
	        } 
        </style>

        </head>
        <body>
		<?php
		error_reporting(E_ALL);
                ini_set('display_errors', '1');

                        $mysqli = new mysqli("localhost:xxxx", "Insert Username", "Insert Password", "Proyect_name");
                        if($mysqli->connect_errno){
                                echo "Fallo al conectar a MySQL:(" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                                die();
                        }else{
                                $query = "select operon_name from OPERON where operon_id ='". $id . "';";
                                $res = $mysqli->query($query);

                                if ($res->num_rows >= 0){
                                	$fila = $res->fetch_assoc();
				}

				$query = "select O.operon_id, promoter_name, promoter_sequence, pos_1 from PROMOTER P, TRANSCRIPTION_UNIT TU, OPERON O where O.operon_id=TU.operon_id and TU.promoter_id=P.promoter_id and O.operon_id='". $id . "';";
				$res = $mysqli->query($query);
                                if ($res->num_rows >= 0){
                                ?>
                                        <table>
                                        <caption>Informacion del Operon <?php echo $fila['operon_name']?></caption>
                                   <thead>
					<tr>
                                        <th scope="col"> Nombre </th>
                                        <th scope="col">Posicion del primer gene </th>
                                        </tr>
                                   </thead>        
                                        <?php for ($num_fila = 1;  $num_fila <= $res->num_rows;  $num_fila++) {
                                                $campos = $res->fetch_object();
                                                ?>
                                                
                                                <tr>
                                                        <td> <?= $campos-> promoter_name; ?></td>
							<td> <?= $campos-> pos_1; ?></td>
                                                        
                                                </tr>
                                                
                                                
                                        <?php } ?>
                                                </table>
                          <?php }
                                echo "<br>";
                                ?>
                                
                                <div align="center">
                                <button class="button" onclick ="window.open('seqpromo.php?id=<?=$campos->operon_id;?>', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=0,width=400,height=400')";
                                >Secuencia del Promotor</button>
                                </div>
                                <?php 
                                echo "<br>";
                                $query = "select G.gene_id, gene_name from GENE G, TU_GENE_LINK TGL, TRANSCRIPTION_UNIT TU, OPERON O where O.operon_id=TU.operon_id and TU.transcription_unit_id=TGL.transcription_unit_id and TGL.gene_id=G.gene_id and O.operon_id= '". $id . "'";
                                $res = $mysqli->query($query);
                                if ($res->num_rows >= 0){
                                ?>
                                        <table>
                                        <caption>Genes relacionados </caption>       
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
				<td> <a <?php echo 'href="gene.php?id=' . $campos-> gene_id .'"'?> > <?= $campos-> gene_id; ?> </a></td>
				<td> <a <?php echo 'href="gene.php?id=' . $campos-> gene_id .'"'?> > <?= $campos-> gene_name; ?> </a></td>
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

