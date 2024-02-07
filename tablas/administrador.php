<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <title>Document</title
        <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
    <link rel="stylesheet" href="../../css/admin_estilo.css">
</head>
<body>
    <div class="banner">
      <h1>Consola de Administración</h1>
    
      <nav>
        <a href="https://uniformescolegio.000webhostapp.com/" class="banner" >Inicio</a>
        
      </nav>
        
    </div>
    
<div class="signUp_user">
    
    <div class="">
        
        <div class="box">

            <form action="../tablas/admin.php" method="post">
                <div><h1>Iniciar sesión</h1></div>
                <input type="text" class="username" name="username" placeholder="Username" autocomplete="off" required>
                <br>
                <input type="password" class="password" name="password"  placeholder="Password" required>
                <br>
                <input type="hidden" name="rol" value="admin" placeholder="rol" >
                <br>
                <button class="" type="submit">Iniciar sesion</button>

            </form>
        </div>
    </div>
   
</div> 
<div class="foot">
        Autor: Whilman Rodriguez
        <a href="mailto:whilrod@gmail.com">whilrod@gmail.com</a>
        
    </div>    
</body>
</html>