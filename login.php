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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
</head>
<body>
    <div class="container login">
        <div class="px-5 py-5 p-lg-0 bg-surface-secondary">
            <div class="d-flex justify-content-center align-items-center min-vh-100">
                <div class="col-12 col-md-9 col-lg-7 offset-md-4 min-h-lg-screen d-flex flex-column justify-content-center py-lg-16 px-lg-20 position-relative">
                    <div class="row">
                        <div class="col-lg-10 col-md-9 col-xl-6 mx-auto ms-xl-0">
                            <div class="mt-10 mt-lg-5 mb-6 d-flex align-items-center d-lg-block">
                                <span class="d-inline-block d-lg-block h1 mb-lg-6 me-3">👋</span>
                                <h1 class="ls-tight font-bolder h2">
                                ¡Bienvenido!
                                </h1>
                            </div>
                            <form action="login.php" method="post">
                                <div class="mb-5">
                                    <label class="form-label" for="email">Correo</label>
                                    <input type="email" class="form-control form-control-muted" id="email" name="email">
                                </div>
                                <div class="mb-5">
                                    <label class="form-label" for="password">Contraseña</label>
                                    <input type="password" class="form-control form-control-muted" name="pass" id="password" autocomplete="current-password">
                                </div>
                                <div>
                                    <input type="submit" name="login" class="btn btn-primary w-full" value="Iniciar Sesión"> 
                                </div>
                            </form>
                            <div class="my-6">
                                <small>¿No tienes cuenta?</small>
                                <a href="register.php" class="text-warning text-sm font-semibold">Crear cuenta</a>
                            </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>