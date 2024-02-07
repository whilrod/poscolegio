
<?php 

    require '../server/serverConexion.php';
  
    
    $username = ($_POST['username']);
    $password = $_REQUEST['password'];

    $roll = empty($_POST['rol']);
    //echo $username.$password.$rol;
   	$sql = "SELECT * FROM usuarios WHERE username = '$username' AND password='$password'";
	$resultado = $mysqli->query($sql);
	$row = $resultado->fetch_array(MYSQLI_ASSOC);
	$user=$row['username'];
	$rol=$row['rol'];
    if ($rol!="admin"){
	    
	    echo '<script language="javascript">alert("Error de Credenciales.");</script>';
	    
	    echo "<script> window.location='../tablas/administrador.php'; </script>";
	    
	}else{
	    
	    $taste=1;
	    
	}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
    <link rel="stylesheet" href="../../css/admin_estilo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!--<link rel="stylesheet" href="../../css/estilos.css">-->
    <title>Administrador</title>
  </head>
  <body>
     <div class="banner">
      <h1>Consola de Administración</h1>
      <h3>Bienvenido </h3>
      <input type="hidden" id="rol" value="<?php echo $rol ?>">
      <input type="hidden" id="username" value="<?php echo $user ?>">
    <nav>
        <a href="https://uniformescolegio.000webhostapp.com/" class="banner" >Inicio</a>
      </nav>
        
    </div>

    <div class="box2">
        
        <nav><a href="./ingresoMercancia.php" class="banner" >Ingreso de Mercancía</a></nav>
        <nav><a href="./mueveMercancia.php" class="banner" >Movimiento de Mercancía</a></nav>
        <nav><a href="./precios.php" class="banner" >Gestión de precios</a></nav>
        
        <nav><a href="./creaUsuarios.php" class="banner" >Crea Usuarios</a></nav>
        <nav><a href="./backup.php" class="banner" >Copia de seguridad</a></nav>
</div> 
<div class="foot">
        Autor: Whilman Rodriguez
        <a href="mailto:whilrod@gmail.com">whilrod@gmail.com</a>
        
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script>

     $(function() {
        a=document.getElementById("rol").value;
        b=document.getElementById("username").value;
        //console.log(b);
        if (a=="admin"){
            localStorage.rol=a;
            localStorage.username=b;
        }
        if(localStorage.rol!="admin"){
            
            window.location.href = "https://uniformescolegio.000webhostapp.com";
            
        }else{
            //console.log("Si..."+a);
            localStorage.rol="";
        };
        //console.log( "Ha ocurrido document.ready: documento listo"+a );
        //document.getElementById("rol").innerHTML = "Nombre: " + localStorage.rol + a;
    });
             
    </script>
  </body>
</html>
