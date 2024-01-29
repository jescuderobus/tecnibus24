<?php if (empty($_SESSION["usuario"])||($_SESSION['tipo_usu'])!= 0) {
?>
<!DOCTYPE>
<head>
    <link rel="stylesheet" href="css/login.css" type="text/css">
<head>
<form method="post" action="" name="signin-form">
    <div class="form-element">
        <label>Username</label>
        <input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
    </div>
    <div class="form-element">
        <label>Password</label>
        <input type="password" name="password" required />
    </div>
    <button type="submit" name="login" value="login">Log In</button>
</form>
<?php
define('USER', 'tecnibus9');
define('PASSWORD', 'TecniBus_123');
define('HOST','localhost');
define('DATABASE', 'tecnibus9');
try {
    $connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}

session_start();
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = $connection->prepare("SELECT * FROM users WHERE USERNAME=:username");
    $query->bindParam("username", $username, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        echo '<p class="error">Username password combination is wrong!</p>';
    } else {
        $hash = password_hash($result['password'], PASSWORD_DEFAULT);
        if (password_verify($password, $hash)) {
            $_SESSION['user_id'] = $result['id'];
            $_SESSION["usuario"] = $username;
            $_SESSION["tipo_usu"] = $result['tipo_usu'];
            echo '<p class="success">Congratulations, you are logged in!</p>';
            switch($result['tipo_usu']){
                case 0: header("Location: http://172.31.0.190/tecnibus9/CitasUs/administrador.php");
                    break;
                default: header("Location: http://172.31.0.190/tecnibus9/CitasUs/usuario.php");
            }
        } else {
            echo '<p class="error">Username password combination is wrong!</p>';
        }
    }
}
}else{
    if($_SESSION['tipo_usu'] == 0){
    header("Location: http://172.31.0.190/tecnibus9/CitasUs/administrador.php");
}else {
    header("Location: http://172.31.0.190/tecnibus9/CitasUs/usuario.php");

}
}?>