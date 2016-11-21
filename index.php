<?php 
session_start();
if(isset($_SESSION["username"])){
    header("Location:index2.php");
}
$dbUsername = "";

if(isset($_POST["submit"])){
    $db = mysqli_connect("localhost", "root", "", "usuarios");
    $username = $_POST["correo"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM tabla_admin WHERE email='$username'";
    $query = mysqli_query($db, $sql);

    while($row=mysqli_fetch_assoc($query)){
        $dbUsername = $row["email"];
        $dbPassword = $row["password"];

        if($username==$dbUsername && $password==$dbPassword){
            $_SESSION["username"]=$dbUsername;
            $_SESSION["password"]=$dbPassword;
            header("Location:index2.php");
        }
        else{
            $error1=1;
            $error2="Invalid username or password.";
        }
    }
    if($username!=$dbUsername){
        $error1=1;
        $error2="Invalid username or password.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>    
     <!--CDN DEL CODIGO CSS DE BOOTSTRAP-->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<style>
    header{
        background:#eee;
    }
    table thead th{
        vertical-align: middle;
        text-align: center;
    }
</style>
<body>
    <!--HEADER-->
    <header>
        <div class="container">
            <h1>Inicia sesión en tu cuenta para ver o agregar mascotas</h1>
        </div>
    </header>
    <br>
     <!--FORMULARIO PARA LOS DATOS-->
    <div class="container" style="padding:30px 40px 30px;border:thin solid #aaa; width:400px;">
        <form action="index.php" method="post">
            <h3>Inserta tus credenciales</h3>
            <hr>
            <label>Usuario</label>
            <input type="text" class="form-control" name="correo" placeholder="Inserta tu nombre de usuario">
            <br>
            <label>Clave</label>
            <input type="password" class="form-control" name="password" placeholder="Inserta tu clave">
            <hr>
            <button class="btn btn-primary btn-block btn-lg" name="submit" type="submit">Entrar</button>
        </form>
   
    
   <!--CDN DEL CODIGO JS DE BOOTSTRAP Y JQUERY-->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery.min.js"></script>
</body>
</html>