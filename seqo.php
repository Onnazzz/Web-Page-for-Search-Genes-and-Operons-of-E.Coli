<html>
        <head>
                <title> Secuencia Producto </title>
                <link rel="stylesheet" type="text/css" href="stylepop.css" />
                <link rel="icon" href = "cherisombrero.png">

                <?php
                        $id =$_GET["id"];
                ?>

        <style> 
	        body { 
		background-image: url("noise.png"); 
		background-color: rgb(113, 160, 248);
		background-position: center; 
		background-size:contain;
		background-repeat:repeat; 
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
                                $query = "select product_name, product_sequence from PRODUCT P, GENE_PRODUCT_LINK GPL, GENE G where G.gene_id=GPL.gene_id and GPL.product_id=P.product_id and G.gene_id ='". $id . "';";
                                $res = $mysqli->query($query);
                                if ($res->num_rows >= 0){
                                ?>
                                   <table>
      				                   
				        		            <tr>
        					  		            <td> Nombre</td>
                                                <td>Secuencia del Producto</td>
                                            </tr>
                                            <?php for ($num_fila = 1;  $num_fila <= $res->num_rows; $num_fila++) {
                                                $campos = $res->fetch_object();
                                                ?>
                                                <tr>
                                                        <td> <?= $campos-> product_name; ?></td>
                                                        <td> <?= $campos-> product_sequence; ?></td>
                                                </tr>
                                        <?php } ?>
                                              </table>
                         <?php }
                        }
                        ?>
                        <div align="center">
                            <img src="cherisombrero.png" style="width:280px" />
                            </div>
    </body>

</html>
