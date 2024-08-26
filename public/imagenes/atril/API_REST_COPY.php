<?php


    date_default_timezone_set("America/Bogota");
    
    require "conexion.php";
    
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
      // READ
      if(isset($_GET['email']) & isset($_GET['documento']) & isset($_GET['estado'])) {
        // http://localhost/PruebasCanal/API_REST.php
        $username = $_GET['email'];

        $password = $_GET['documento'];

        $idestado = $_GET['estado'];

        //$key = $_GET['login'];


        $sql_select_user = "SELECT * FROM users WHERE email='$username' AND documento='$password' AND idestado='$idestado'";
        $query_select = $mysqli->query($sql_select_user);
        
        $filas = $query_select->num_rows;
        if($filas == 0) {
          echo "No existe ese registro";
          header("HTTP/1.0 204");
        } else {
          $resultado = $query_select->fetch_assoc();
          echo json_encode($resultado);
          
        }
      } else if(isset($_GET['email']) & isset($_GET['documento'])/* & isset($_GET['login'])*/) {
        // http://localhost/PruebasCanal/API_REST.php
        $username = $_GET['email'];

        $password = $_GET['documento'];

        //$key = $_GET['login'];


        $sql_select_user = "SELECT * FROM users WHERE email='$username' AND documento='$password'";
        $query_select = $mysqli->query($sql_select_user);
        
        $filas = $query_select->num_rows;
        if($filas == 0) {
          echo "No existe ese registro";
          header("HTTP/1.0 204");
        } else {
          $resultado = $query_select->fetch_assoc();
          //$cars = array("EventAPP", "-> Actualizar =>", " Aplicación");
          echo json_encode($resultado);
          //echo json_encode($cars);
          
        }
      } else if(isset($_GET['user_id']) & isset($_GET['estado']) & isset($_GET['apoyo'])) {
        // http://localhost/PruebasCanal/API_REST.php
        $username = $_GET['user_id'];
        $apoyo = $_GET['apoyo'];
        $estado = $_GET['estado'];

        //$password = $_GET['documento'];

        //$key = $_GET['login'];


        $sql_select_user = "SELECT * FROM apoyos WHERE user_id='$username' AND apoyo='$apoyo' AND estado='$estado'";
        $query_select = $mysqli->query($sql_select_user);
        
        $filas = $query_select->num_rows;
        if($filas == 0) {
          echo "No existe ese registro";
          header("HTTP/1.0 204");
        } else {
          $resultado = $query_select->fetch_assoc();
          //echo "Resuelto...";
          echo json_encode($resultado);
          header("HTTP/1.0 200");
        }
      } else if(isset($_GET['user_id']) & isset($_GET['reserva']) & isset($_GET['apoyo'])) {
        // http://localhost/PruebasCanal/API_REST.php
        $username = $_GET['user_id'];
        $apoyo = $_GET['apoyo'];
        $reserva = $_GET['reserva'];

        //$password = $_GET['documento'];

        //$key = $_GET['login'];


        $sql_select_user = "SELECT * FROM apoyos WHERE user_id='$username' AND apoyo='$apoyo' AND estado=1 AND reserva='$reserva'";
        $query_select = $mysqli->query($sql_select_user);
        
        $filas = $query_select->num_rows;
        if($filas == 0) {
          //echo "No existe ese registro";
          //header("HTTP/1.0 204");
          $sql_select_user_sr = "SELECT * FROM apoyos WHERE user_id='$username' AND apoyo='$apoyo' AND estado=1";
          $query_select_sr = $mysqli->query($sql_select_user_sr);
          $filas_sr = $query_select_sr->num_rows;

          if($filas_sr == 0) {
            echo "No existe ese registro";
            header("HTTP/1.0 204");
          } else {
            $resultado = $query_select_sr->fetch_assoc();
            //echo "Resuelto...";
            echo json_encode($resultado);
            header("HTTP/1.0 404");
          }
        } else {
          $resultado = $query_select->fetch_assoc();
          //echo "Resuelto...";
          echo json_encode($resultado);
          header("HTTP/1.0 200");
        }
      } else if(isset($_GET['user_id']) & isset($_GET['fechareserva']) & isset($_GET['apoyo'])) {
        // http://localhost/PruebasCanal/API_REST.php
        $username = $_GET['user_id'];
        $apoyo = $_GET['apoyo'];
        $reserva = $_GET['fechareserva'];

        //$password = $_GET['documento'];

        //$key = $_GET['login'];


        //$sql_select_user = "SELECT * FROM reservations WHERE user_id='$username' AND reserva='$reserva'";
        $sql_select_user = "SELECT reservations.user_id, reservations.reserva, apoyo, lugar, estado, tarifa, corresponsabilidad, servicios, saldo FROM reservations INNER JOIN apoyos on reservations.user_id = apoyos.user_id WHERE reservations.user_id='$username' AND reservations.reserva='$reserva' AND apoyos.estado='1'";
        $query_select = $mysqli->query($sql_select_user);
        
        $filas = $query_select->num_rows;
        if($filas == 0) {
          //echo "No existe ese registro";
          //header("HTTP/1.0 204");
          $sql_select_user_sr = "SELECT * FROM apoyos WHERE user_id='$username' AND apoyo='$apoyo' AND estado=1";
          $query_select_sr = $mysqli->query($sql_select_user_sr);
          $filas_sr = $query_select_sr->num_rows;

          if($filas_sr == 0) {
            echo ("No existe ese registro");
            header("HTTP/1.0 204");
          } else {
            $resultado = $query_select_sr->fetch_assoc();
            //echo "Resuelto...";
            echo json_encode($resultado);
            header("HTTP/1.0 404");
          }
        } else {
          $resultado = $query_select->fetch_assoc();
          //echo "Resuelto...";
          echo json_encode($resultado);
          header("HTTP/1.0 200");
        }
      } else if(isset($_GET['user_id']) & isset($_GET['consulcorresp'])) {
        // http://localhost/PruebasCanal/API_REST.php
        $username = $_GET['user_id'];
        $corresponsabilidad = $_GET['consulcorresp'];


        $sql_select_user = "SELECT * FROM apoyos WHERE user_id='$username' AND apoyo IS NOT NULL";
        $query_select = $mysqli->query($sql_select_user);
        
        $filas = $query_select->num_rows;
        if($filas == 0) {
          echo "No existe ese registro";
          header("HTTP/1.0 204");
          
        } else {
          $resultado = $query_select->fetch_assoc();          
          echo json_encode($resultado);
          header("HTTP/1.0 200");
          //echo "Resuelto...";
          
          
        }

      }  else if(isset($_GET['user_id']) & isset($_GET['estamento'])) {
        // http://localhost/PruebasCanal/API_REST.php
        $username = $_GET['user_id'];
        $estamento = $_GET['estamento'];


        $sql_select_user = "SELECT * FROM persona WHERE user_id='$username' AND estamento IS NOT NULL";
        $query_select = $mysqli->query($sql_select_user);
        
        $filas = $query_select->num_rows;
        if($filas == 0) {
          echo "No existe ese registro";
          header("HTTP/1.0 204");
          
        } else {
          $resultado = $query_select->fetch_assoc();          
          echo json_encode($resultado);
          header("HTTP/1.0 200");
          //echo "Resuelto...";
          
          
        }

      }else if(isset($_GET['user_id']) & isset($_GET['corresponsabilidad']) & isset($_GET['soporte_id']) & isset($_GET['fecha'])) {
        // http://localhost/PruebasCanal/API_REST.php
        $username = $_GET['user_id'];
        $soporte_id = $_GET['soporte_id'];
        $fecha = $_GET['fecha'];
        $descripcion = $_GET['descripcion'];
        $corresponsabilidad = $_GET['corresponsabilidad'];

        //$password = $_GET['documento'];

        //$key = $_GET['login'];


        //$sql_select_user = "SELECT user_id, sum(horas) as horas FROM corresponsabilidads INNER JOIN apoyos on corresponsabilidad.user_id = apoyos.user_id WHERE user_id='$username'

        $sql_select_user = "SELECT corresponsabilidads.user_id, sum(horas) as horas, apoyos.apoyo FROM corresponsabilidads INNER JOIN apoyos on corresponsabilidads.user_id = apoyos.user_id WHERE corresponsabilidads.user_id='$username'";
        
        $query_select = $mysqli->query($sql_select_user);
        
        $filas = $query_select->num_rows;
        if($filas == 0) {
          echo "No existe ese registro";
          header("HTTP/1.0 204");
          
        } else {
          $resultado = $query_select->fetch_assoc();
          //echo "Resuelto...";

          if ($resultado["apoyo"] == 'APOYO ECONOMICO') {
            if ($resultado["horas"]>=32) {
              echo json_encode($resultado);
              header("HTTP/1.0 404");
            } else {

              if ($resultado["horas"]+$corresponsabilidad >=32) {

                $corresponsabilidad = 32-$resultado["horas"];
                $estado = 'CERRADO';
                
              }


              $sql_inser_corr = "INSERT INTO corresponsabilidads (actividad, user_id, soporte_id, horas, fecha, estado) VALUES('$descripcion', '$username', '$soporte_id', '$corresponsabilidad', '$fecha', '$estado')";
              $query_sqlinsert = $mysqli->query($sql_inser_corr);
              $sql_select_usercorrs = "SELECT user_id, sum(horas) as horas FROM corresponsabilidads WHERE user_id='$username'";
              $query_select_corrs = $mysqli->query($sql_select_usercorrs);
              $resultado_corrs = $query_select_corrs->fetch_assoc();

              /*$horas_update = $resultado["corresponsabilidad"]+$corresponsabilidad;
              if ($horas_update > 16) {
                  $sql_update_user = "UPDATE apoyos SET corresponsabilidad=16 WHERE user_id='$username'";
              } else {
                $sql_update_user = "UPDATE apoyos SET corresponsabilidad='$horas_update' WHERE user_id='$username'";
              }
              
              $query_update = $mysqli->query($sql_update_user);
              $query_select_update = $mysqli->query($sql_select_user);
              $resultado_update = $query_select_update->fetch_assoc();*/
              
              //echo $horas_update;
              echo json_encode($resultado_corrs);
              header("HTTP/1.0 200");

            }
          } else {
            if ($resultado["horas"]>=16) {
              echo json_encode($resultado);
              header("HTTP/1.0 404");
            } else {

              if ($resultado["horas"]+$corresponsabilidad >=16) {

                $corresponsabilidad = 16-$resultado["horas"];
                $estado = 'CERRADO';
                
              }


              $sql_inser_corr = "INSERT INTO corresponsabilidads (actividad, user_id, soporte_id, horas, fecha, estado) VALUES('$descripcion', '$username', '$soporte_id', '$corresponsabilidad', '$fecha', '$estado')";
              $query_sqlinsert = $mysqli->query($sql_inser_corr);
              $sql_select_usercorrs = "SELECT user_id, sum(horas) as horas FROM corresponsabilidads WHERE user_id='$username'";
              $query_select_corrs = $mysqli->query($sql_select_usercorrs);
              $resultado_corrs = $query_select_corrs->fetch_assoc();

              /*$horas_update = $resultado["corresponsabilidad"]+$corresponsabilidad;
              if ($horas_update > 16) {
                  $sql_update_user = "UPDATE apoyos SET corresponsabilidad=16 WHERE user_id='$username'";
              } else {
                $sql_update_user = "UPDATE apoyos SET corresponsabilidad='$horas_update' WHERE user_id='$username'";
              }
              
              $query_update = $mysqli->query($sql_update_user);
              $query_select_update = $mysqli->query($sql_select_user);
              $resultado_update = $query_select_update->fetch_assoc();*/
              
              //echo $horas_update;
              echo json_encode($resultado_corrs);
              header("HTTP/1.0 200");

            }
          }
          
        }
      } else if(isset($_GET['email']) & isset($_GET['actividad']) & isset($_GET['fecha'])  & isset($_GET['user_id'])) {
        // http://localhost/PruebasCanal/API_REST.php
        $name = $_GET['email'];

        $eventoSel = $_GET['actividad'];

        $fechaActual = $_GET['fecha'];

        $activity_id = $_GET['activity_id'];

        $user_id = $_GET['user_id'];
        

        $sql_select_id = "SELECT * FROM asistencias WHERE email='$name' AND actividad='$eventoSel' AND activity_id='$activity_id'";
        $query_select_id = $mysqli->query($sql_select_id);
        
        $filas = $query_select_id->num_rows;
        if($filas == 0) {
          echo "No existe ese registro";
          header("HTTP/1.0 204");
        } else {
          $resultado = $query_select_id->fetch_assoc();
          echo json_encode($resultado);
        }
      } else {
        // http://localhost/PruebasCanal/API_REST.php?idUsuario=#
        $sql_select = "SELECT * FROM asistencias";
        $query_select = $mysqli->query($sql_select);

        $datos = array();
        while($resultado = $query_select->fetch_assoc()) {
          $datos[] = $resultado;
        }

        echo json_encode($datos);
      }
    } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
      // CREAD
      $datos = json_decode(file_get_contents("php://input"));
      //echo $datos;
      $name = $datos->email;
      $descripcion = $datos->actividad;
      $date = $datos->fecha;
      $activity_id = $datos->activity_id;
      $created_at = $datos->created_at;
      $metodoreg = $datos->metodoreg;
      $lugar = $datos->lugar;


      $elementopost = $datos->elemento_id;
      $userpost = $datos->user_id;
      $soportepost = $datos->soporte_id;
      $fechapost = $datos->fecha;
      $descripcionpost = $datos->descripcion;
      //$elementopost = $_POST['elemento'];

      if(isset($elementopost)){

        $sql_insert = "INSERT INTO prestamos(elemento_id, descripcion, user_id, soporte_id, fecha) VALUES('$elementopost', '$descripcionpost', '$userpost', '$soportepost', '$fechapost')";
        $query_insert = $mysqli->query($sql_insert);

        echo "Se inserto correctamente";

      } else if(empty($name) || empty($descripcion)) {
        //echo "Faltan campos";
        header("HTTP/1.0 400");

      } else {
        

        $sql_insert = "INSERT INTO asistencias(email, actividad, fecha, activity_id,  user_id, created_at, metodoreg, lugar) VALUES('$name', '$descripcion', '$date', '$activity_id', '$name', '$created_at', '$metodoreg', '$lugar')";
        $query_insert = $mysqli->query($sql_insert);

        echo "Se inserto correctamente";
      }
    } else if($_SERVER['REQUEST_METHOD'] == 'PUT') {
      // UPDATE
      $datos = json_decode(file_get_contents("php://input"));
      $idUsuario = $datos->idUsuario;
      $nombre = $datos->nombre;
      $telefono = $datos->telefono;
      
      if(empty($idUsuario) || empty($nombre) || empty($telefono)) {
        //echo "Faltan campos";
        header("HTTP/1.0 400");
      } else {
        $sql_update = "UPDATE usuarios SET nombre='$nombre', telefono='$telefono' WHERE idUsuario='$idUsuario'";
        $query_update = $mysqli->query($sql_update);

        echo "Se actualizo correctamente";
      }
      
    } else if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
      // DELETE
      if(isset($_GET['idUsuario'])) {
        $idUsuario = $_GET['idUsuario'];

        $sql_delete = "DELETE FROM usuarios WHERE idUsuario='$idUsuario'";
        $query_delete = $mysqli->query($sql_delete);

        echo "Se elimino el registro";
      } else {
        //echo "No hay elemento a borrar";
        header("HTTP/1.0 204");

      }
    } else if($_SERVER['REQUEST_METHOD'] == 'GET') {
      // DELETE
      if(isset($_GET['project_id'])) {
        $project_id = $_GET['project_id'];

        //$sql = "DELETE FROM usuarios WHERE idUsuario='$idUsuario'";
        //$query_delete = $mysqli->query($sql_delete);


        $sql_select_id = "SELECT * FROM levels WHERE project_id = '$project_id' ORDER BY namenivel ASC";
        $query_select_id = $mysqli->query($sql_select_id);

        if ($$query_select_id->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {                
                $html .= '<option value="'.$row['id'].'">'.$row['namenivel'].'</option>';
            }
        }
        echo $html;


        //echo "Se elimino el registro";
      } else {
        //echo "No hay elemento a borrar";
        header("HTTP/1.0 204");

      }
    }

?>