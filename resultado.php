<html>
        <head>
                <title> Resultado </title>

			<link rel="icon" href = "cherisombrero.png">
			
       		<?php
			$b =$_GET["bus"];
			$e =$_GET["tipo"];
			$e2 =$_GET["tipo2"];
			?>
			<link href='https://fonts.googleapis.com/css?family=Rock+Salt' rel='stylesheet' type='text/css'>
			<link href="style2.css" rel="stylesheet" type="text/css">
			
			<style> 
	body { 
		background-image: url("https://images.unsplash.com/photo-1462332420958-a05d1e002413?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1207&q=80"); 
		background-color: black;
		background-position: center; 
		background-size: cover;
		background-repeat: no-repeat; 
		color: black;
	} 
</style>	
	</head>
        <body>
		
         	<br>
		<?php
		error_reporting(E_ALL);
		ini_set('display_errors', '1');

			$mysqli = new mysqli("localhost:xxxx", "Insert Username", "Insert Password", "Proyect_name");
			if($mysqli->connect_errno){
				echo "Fallo al conectar a MySQL:(" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
				die();
			}else{
				$bo = 0;
				$bg = 0;
				if ($e == "g"){
				
				$query = "select gene_id, gene_name, gene_strand, gene_posleft, gene_posright from GENE where gene_name like '%". $b . "%';";
				$res = $mysqli->query($query);

				if ($res->num_rows == 0){
					?> 
					<div class="error"> <img src="cherilacolitriste.png" style="width:350px" /> <?php
					echo "Sin resultados de " . $b . ".";
					?>
					</div> <?php
				}else{
					if($res->num_rows == 1){
						$bg = 1;
					}
					?>

					<table>
					<caption> <?php echo "Resultado de genes " . $b . ":";?> </caption>
      				<thead>
						<tr>
					  		<th scope="col">Nombre</th>
					        <th scope="col">Strand</th>
            				<th scope="col">Posicion izquierda</th>
    						<th scope="col">Posicion derecha</th>
                        </tr>
					</thead>	
						<?php for ($num_fila = 1;  $num_fila <= $res->num_rows; $num_fila++) {
						$campos = $res->fetch_object();
						?>
						<tr>
				<th scope="row"> <a <?php echo 'href="gene.php?id=' . $campos-> gene_id .'"'?> > <?= $campos-> gene_name; ?> </a></th>
							<td> <?= $campos-> gene_strand; ?></td>
							<td> <?= $campos-> gene_posleft; ?></td>
							<td> <?= $campos-> gene_posright; ?></td>
						</tr>
					<?php } ?>
						</table>
		  <?php }
		  		$res->close();
				}
				
				if ($e2 == "o"){
				
				echo "<br><br>";
				$query2 = "select operon_id, operon_name, operon_strand, firstgeneposleft, lastgeneposright from OPERON where operon_name like '%". $b . "%';";
				$res2 = $mysqli->query($query2);

				if ($res2->num_rows == 0){
					?> 
					<div class="error"> <img src="cherilacolitriste.png" style="width:350px"/> <?php
					echo "Sin resultados de " . $b . ".";?>
					</div>
				<?php }else{
					if($res2->num_rows == 1){
						$bo = 1;
					}

					?>
					<table>
					<caption> <?php echo "Resultado de operones " . $b . ":";?> </caption>
      				<thead>
						<tr>
					  		<th scope="col">Nombre</th>
					        <th scope="col">Strand</th>
            				<th scope="col">Posicion izquierda</th>
    						<th scope="col">Posicion derecha</th>
                        </tr>
					</thead>
                                     <?php  for ($num_fila = 1;  $num_fila <= $res2->num_rows; $num_fila++) {
                                                $campos = $res2->fetch_object();
                                                ?>
						<tr>
						<th scope="row"> <a <?php echo 'href="operon.php?id=' . $campos-> operon_id .'"'?>> <?= $campos-> operon_name; ?> </a></th>
							<td> <?= $campos-> operon_strand; ?></td>
                                                        <td> <?= $campos-> firstgeneposleft; ?></td>
                                                        <td> <?= $campos-> lastgeneposright; ?></td>
                                                </tr>
                                      <?php } ?>
					</table>
          <?php }
				
		  		$res2->close();
				}
				
				if($bg==1 and $bo==0){
					header ("Location: gene.php?id=" . $campos-> gene_id );
				}

				if($bg==0 and $bo==1){
					header ("Location: operon.php?id=" . $campos-> operon_id );
				}

				$mysqli -> close();	
			

			?> 
			
			<div align="right" > <a <?php echo 'href="index.html"'; ?> > <img src="cherihome.png" style="width:280px" /> </a></div>

	<?php } 
			?>
        </body>
</html>
