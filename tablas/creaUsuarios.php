<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <title>Crea Usuarios</title
        <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
    <link rel="stylesheet" href="../../css/admin_estilo.css">
</head>
<body>
    <div class="banner">
      <h1>Consola de Administración</h1>
    
      <nav>
          
        <a href="#" name="volver" onClick="regresa()" class="banner" >Volver</a><br>
        <a href="https://uniformescolegio.000webhostapp.com/" name="inicio" class="banner" >Inicio</a>  
      </nav>

    </div>
    
<div class="signUp_user">
    
    <div class="">
        
        <div class="box">

            <form action="../tablas/users.php" method="post">
                <div><h1>Crea Usuarios</h1></div>
                <input type="text" class="username" name="username" placeholder="Username" autocomplete="off" required>
                <br>
                <input type="password" class="password" name="password"  placeholder="Password" required>
                <br>
                <input type="hidden" name="rol" value="admin" placeholder="rol" >
                <br>
                <button class="" type="submit">Crear Usuario</button>

            </form>
        </div>
    </div>
   
</div> 
<div class="foot">
        Autor: Whilman Rodriguez
        <a href="mailto:whilrod@gmail.com">whilrod@gmail.com</a>
        
    </div>
<form name=form1 action="https://uniformescolegio.000webhostapp.com/tablas/admin.php" method="post">
<input type="hidden" id="username" name="username" value="prueba">
<input type="hidden" id="password" name="password" value="123">
<input type="hidden" id="rol" name="rol" value="admin">
</form>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
//const Url='https://uniformescolegio.000webhostapp.com/tablas/admin.php';
//const data={rol:"admin"}
    function regresa(){
    //localStorage.nombre = document.getElementById("nombre").value;
    localStorage.rol="admin";
    //console.log(document.form1.username.value);
    document.form1.submit();
    };
</script>
</body>
</html>