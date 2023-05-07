<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
if(isset($_COOKIE["init"])){
  setcookie("init", "", 10000);
  $_SESSION['login']="";
}
if(!empty($_SESSION['login'])){
  header('Location: index.php'); 
  exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="log_style.css" />
    <title>Задание 5</title>
  </head>
  <body>
    <form method="POST" action="log.php">
    <div class="container">
      <div style="margin-bottom: 20px; color:white; <?php
      if(!isset($_COOKIE["info"])){
        echo "display: none;";
      }
      ?>">Ввелен не верный логин или пароль</div>
    <div class="inputs">
        <label style="margin-left:15px; font-size: 20px; ">Логин</label>
        <input type="text" name="login" placeholder="Введите логин" value="<?php
        if(isset($_COOKIE["login"])){
          echo $_COOKIE["login"];
        }
        ?>" required/>
        <label style="margin-left:15px; font-size: 20px; ">Пароль</label>
        <input type="password" name="password" placeholder="Введите пароль" value="<?php
        if(isset($_COOKIE["password"])){
          echo $_COOKIE["password"];
        }
        ?>" required/>
        <button type="submit">Вход</button>
    </div>
    <a href="index.php">Вход без авторизации</a>
    </div>
  </form>
  </body>
</html>

<?php
}
else {
  $user = 'u52884'; $pass = '6854641';
  $con = new PDO('mysql:host=localhost;dbname=u52879', $user, $pass, [PDO::ATTR_PERSISTENT => true]);
  $login=$_POST["login"];
  $password=$_POST["password"];
  $password_time=md5($password);
  $sth = $con->prepare("SELECT id, login, password, id_f FROM USER where login=:login and password=:password");
  $sth->execute(['login'=>"$login", 'password'=>"$password_time"]);
  $result = $sth->fetchAll();
  setcookie("login", $login);
  setcookie("password", $password);
  setcookie("info", "error");

  if(!empty($result)){
    $_SESSION['login'] = $login;
    $_SESSION['id'] = $result[0]['id'];
    $_SESSION['id_f']=$result[0]['id_f'];
    $_SESSION['password']=$password;
    setcookie("info", "", 10000);
  }
  header('Location: login.php');
  exit();
}
?>
