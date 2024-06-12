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
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <?php
        if(isset($_POST["login"])){
            $email = $_POST["email"];
            $pass = $_POST["pass"];

            $errors = array();

            if(empty($email) OR empty($pass)){
                array_push($errors,"Todos los campos son obligatorios");
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors,"El correo no es válido");
            }
            if(strlen($pass)<8){
                array_push($errors,"La longitud de la contraseña debe ser mínimo de 8");
            }

            require_once "database.php";
            $sql = "SELECT * FROM usuario WHERE email = '$email'";
            $result = mysqli_query($conn,$sql);
            $user = mysqli_fetch_array($result,MYSQLI_ASSOC);
            if($user){
                if(password_verify($pass,$user["contrasena"])){
                    $sql = "SELECT idCliente FROM cliente WHERE email = '$email'";
                    $result = mysqli_query($conn,$sql);
                    $rowCount = mysqli_num_rows($result);
                    if($rowCount>0){
                        $row = mysqli_fetch_assoc($result);
                        $idCliente = $row["idCliente"];
                        session_start();
                        $_SESSION["user"] = "yes";
                        $_SESSION["idCliente"] = $idCliente;
                        header("Location: index.php");
                        die();
                    }else{
                        $sql = "SELECT idAdmin FROM admin WHERE email = '$email'";
                        $result = mysqli_query($conn,$sql);
                        $rowCount = mysqli_num_rows($result);
                        if($rowCount>0){
                            $row = mysqli_fetch_assoc($result);
                            $idAdmin = $row["idAdmin"];
                            session_start();
                            $_SESSION["admin"] = "yes";
                            header("Location: admin.php");
                            die();
                        }
                    }


                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: index.php");
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Contraseña incorrecta.</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>El correo electrónico no está registrado.</div>";
            }
        }
        ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Escribe tu correo electrónico." name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Escribe tu contraseña." name="pass" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
        </form>
        <div>
            <p>¿No estás registrado? <a href="register.php">Registrarme</a></p>
        </div>
    </div>
</body>
</html>