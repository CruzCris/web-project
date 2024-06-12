<?php
session_start();
if(isset($_SESSION["user"])){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <?php
        if(isset($_POST["submit"])){
            $nom = $_POST["nombre"];
            $pat = $_POST["paterno"];
            $mat = $_POST["materno"];
            $cel = $_POST["celular"];
            $email = $_POST["email"];
            $pass = $_POST["pass"];
            $pass1 = $_POST["pass1"];

            $passwordHash = password_hash($pass,PASSWORD_DEFAULT);

            $errors = array();

            if(empty($nom) OR empty($pat) OR empty($mat) OR empty($cel) OR empty($email) OR empty($pass) OR empty($pass1)){
                array_push($errors,"Todos los campos son obligatorios");
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors,"El correo no es válido");
            }
            if(strlen($pass)<8){
                array_push($errors,"La longitud de la contraseña debe ser mínimo de 8");
            }
            if($pass!==$pass1){
                array_push($errors,"Las contraseñas deben de coincidir");
            }

            require_once "database.php";
            $sql = "SELECT * FROM usuario WHERE email = '$email'";
            $result = mysqli_query($conn,$sql);
            $rowCount = mysqli_num_rows($result);
            if($rowCount>0){
                array_push($errors,"El email ingresado ya está registrado en una cuenta existente.");
            }

            if(count($errors)>0){
                foreach($errors as $error){
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }else{
                require_once "database.php";
                $sql = "INSERT INTO usuario (email,contrasena,nombre,paterno,materno,celular,idRol) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                if($prepareStmt){
                    $rol = "2";
                    mysqli_stmt_bind_param($stmt,"ssssssi",$email,$passwordHash,$nom,$pat,$mat,$cel,$rol);
                    mysqli_stmt_execute($stmt);
                    $sql = "INSERT INTO cliente (email,monedero) VALUES (?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                    if($prepareStmt){
                        $monedero = 10000;
                        mysqli_stmt_bind_param($stmt,"si",$email,$monedero);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>Se ha registrado correctamente.</div>";
                    }else{
                        die("Ocurrió un error.");
                    }
                }else{
                    die("Ocurrión un error.");
                }
            }
        }
        ?>
        <form action="register.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="nombre" placeholder="Nombre(s):">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="paterno" placeholder="Apellido paterno:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="materno" placeholder="Apellido materno:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="celular" placeholder="Celular:">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Correo electrónico:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="pass" placeholder="Contraseña:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="pass1" placeholder="Repetir contraseña:">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Registrarme" name="submit">
            </div>
        </form>
        <div>
            <p>¿Ya estás registrado? <a href="login.php">Iniciar sesión</a></p>
        </div>
    </div>
</body>
</html>