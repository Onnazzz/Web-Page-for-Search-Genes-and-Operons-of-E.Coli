<html>
        <head>
                <title> Secuencia Promotores </title>
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
				            $query = "select promoter_name, promoter_sequence from PROMOTER P, TRANSCRIPTION_UNIT TU, OPERON O where O.operon_id=TU.operon_id and TU.promoter_id=P.promoter_id and O.operon_id='". $id . "';";
				            $res = $mysqli->query($query);
                                if ($res->num_rows >= 0){
                                ?>
                                        <table>
                                            <tr>
                                                <td> Nombre </td>
                                                <td> Secuencia del Promotor </td>
                                            </tr>
                                        <?php for ($num_fila = 1;  $num_fila <= $res->num_rows; $num_fila++) {
                                                $campos = $res->fetch_object();
                                                ?>
                                                    <tr>
                                                        <td> <?= $campos-> promoter_name; ?></td>
                                                        <td> <?= $campos-> promoter_sequence; ?></td>
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


