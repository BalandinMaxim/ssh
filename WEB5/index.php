<?php
header('Content-Type: text/html; charset=UTF-8');
function namet($data){
  $pattern = '/^[а-яё]+$/iu';
  if (preg_match($pattern, $data)) 
    return true;
 else 
    return false;
}
function emailt($data){
  $pattern = '/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/';
  if (preg_match($pattern, $data)) 
    return true;
   else 
    return false;
}
function biographyt($data){
  $pattern = '/^[a-zA-Zа-яА-Я0-9,. \'"-]*$/u';
  if (preg_match($pattern, $data)) 
    return true;
   else 
    return false;
}

if($_SERVER["REQUEST_METHOD"] == "GET"){
  if(!empty($_COOKIE[session_name()]) && session_start() && !empty($_SESSION['login']) && !isset($_COOKIE['init'])){
    if (isset($_COOKIE["errorn"])) {
      setcookie("errorn", "", 10000);
    }
    if(isset($_COOKIE["errore"])){
      setcookie("errore", "", 10000);
    }
    if(isset($_COOKIE["errorp"])){
      setcookie("errorp", "", 10000);
    }
    if(isset($_COOKIE["errork"])){
      setcookie("errork", "", 10000);
    }
    if(isset($_COOKIE["errors"])){
      setcookie("errors", "", 10000);
    }
    if(isset($_COOKIE["errorb"])){
      setcookie("errorb", "", 10000);
    }
    if(isset($_COOKIE["immortality"])){
      setcookie("immortality", "", 10000);
    }
    if(isset($_COOKIE["levitation"])){
        setcookie("levitation", "", 10000);
      }
    if(isset($_COOKIE["passing_through_walls"])){
      setcookie("passing_through_walls", "", 10000);
    }
    if(isset($_COOKIE["ok"])){
        setcookie("ok", "", 10000);
      }
    $user = 'u52884';
    $pass = '6854641';
    $con = new PDO('mysql:host=localhost;dbname=u52884', $user, $pass, [PDO::ATTR_PERSISTENT => true]);
    $sth = $con->prepare("SELECT name, email, year, pol, limbs, biography FROM FORMS_CHAR where id=:id");
    $id = $_SESSION["id_form"];
    setcookie("id_form", $id);
    $sth->execute(['id'=>"$id"]);
    $result = $sth->fetchAll();
  
    setcookie("name", $result[0]['name']);
    setcookie("email", $result[0]["email"]);
    setcookie("year", $result[0]["year"]);
    setcookie("pol", $result[0]["pol"]);
    setcookie("kol", $result[0]["limbs"]);
    setcookie("biography", $result[0]["biography"]);


    $sth2 = $con->prepare("SELECT id_superpower FROM FORM_SUPER_CHAR where id=:id");
    $sth2->execute(['id'=>"$id"]);
    $result_super = $sth2->fetchAll();

    foreach($result_super as $cout){
      if($cout['id_superpower'] =="1"){
        setcookie("immortality","yes");
      }
      if($cout['id_superpower'] =="2"){
        setcookie("levitation","yes");
      }
      if($cout['id_superpower'] =="3"){
        setcookie("passing_through_walls","yes");
      }
    }

    setcookie("init", "ok");
    header('Location: index.php');
    exit();
  }
  include('form.php');
  exit();
}
else{
  $error=FALSE;
    if (empty($_POST["name"])) {
      setcookie("errorn","Введите имя!");
      setcookie("name",$_POST["name"]);
      $error=TRUE;
    } else {
      if(namet($_POST["name"])){
        setcookie("errorn","",10000);
        setcookie("name",$_POST["name"]);
      }
      else{
        $error=TRUE;
        setcookie("errorn", "Имя должно содержать сиволы русского алфавита");
        setcookie("name",$_POST["name"]);
      }
    }
  
    if(empty($_POST["email"])){
      setcookie("errore","Введите email!");
      setcookie("email", $_POST["email"]);
      $error=TRUE;
    }
    else{
      if(emailt($_POST["email"])){
        setcookie("email",$_POST["email"]);
        setcookie("errore","",10000);
      }
      else{
        $error=TRUE;
        setcookie("errore","E-mail введен не верно");
        setcookie("email",$_POST["email"]);
      }
    }
    setcookie("year",$_POST["year"]);
    if(empty($_POST["pol"])){
      $error=TRUE;
      setcookie("errorp","Укажите пол!");
    }
    else{
      setcookie("errorp","",10000);
      if($_POST["pol"]=="Мужской"){
        setcookie("pol", "Мужской");
      }
      else{
        setcookie("pol", "Женский");
      }
    }
  
    if(empty($_POST["kol"])){
      $error=TRUE;
      setcookie("errork","Укажите кол-во конечностей");
    }
    else{
      setcookie("kol",$_POST["kol"]);
      setcookie("errork","",10000);
    }
  
    if(empty($_POST["superpowers"])){
      $error=TRUE;
      setcookie("errors","Укажите сверхспособность");
      setcookie("superpowers",$_POST["superpowers"]);
    }
    else{
      setcookie("errors","",10000);
      setcookie("immortality","",10000);
      setcookie("levitation","",10000);
      setcookie("passing_through_walls","",10000);
      $superpowers=$_POST["superpowers"];
      foreach($superpowers as $cout){
        if($cout =="бессмертие"){
          setcookie("immortality","yes");
        }
        if($cout =="левитация"){
            setcookie("levitation","yes");
          }
        if($cout =="прохождение сквозь стены"){
          setcookie("passing_through_walls","yes");
        }
      }
    }
  
    if(empty($_POST["biography"])){
      $error=TRUE;
      setcookie("errorb","Введите биографию");
      setcookie("biography",$_POST["biography"]);
    }
    else{
      if(biographyt($_POST["biography"])){
        setcookie("errorb","",10000);
        setcookie("biography",$_POST["biography"]);
      }
      else{
        $error=TRUE;
        setcookie("errorb","Для заполнения доступны символы русского и английского алфавита и цифры");
        setcookie("biography",$_POST["biography"]);
      }
    }

    if(empty($_POST["ok"])){
      $error=TRUE;
      setcookie("ok","Согласие на обработку");
    }
    else{
      setcookie("ok","",10000);
    }


    if($error){
      header("Location: index.php");
      exit();
    }
    else{
      setcookie("name",$_POST["name"], time()+3600);
      setcookie("email", $_POST["email"], time()+3600);
      setcookie("year",$_POST["year"], time()+3600);
      if($_POST["pol"]=="Мужской"){
        setcookie("pol", "Мужской", time()+3600);
      }
      else{
        setcookie("pol", "Женский", time()+3600);
      }
      setcookie("kol",$_POST["kol"], time()+3600);
      $immortality='no';
      $levitation='no';
      $passing_through_walls='no';
      foreach($superpowers as $cout){
        if($cout =="бессмертие"){
          setcookie("immortality","yes", time()+3600);
          $immortality="yes";
        }
        if($cout =="левитация"){
            setcookie("levitation","yes", time()+3600);
            $levitation="yes";
          }
        if($cout =="прохождение сквозь стены"){
          setcookie("passing_through_walls","yes", time()+3600);
          $passing_through_walls="yes";
        }
      }
      setcookie("biography",$_POST["biography"], time()+3600);

      $name = $_POST["name"];
      $email = $_POST["email"];
      $year = $_POST["year"];
      $pol = $_POST["pol"];
      $kol = $_POST["kol"];
      $biography=$_POST["biography"];
      $rez="";
      $user = 'u52884';
      $pass = '6854641';
      $con = new PDO('mysql:host=localhost;dbname=u52884', $user, $pass, [PDO::ATTR_PERSISTENT => true]);

      if(!isset($_COOKIE["init"])){
        $flag = 0;
        $s = $con->prepare("INSERT INTO FORMS_CHAR(name, email, year, pol, limbs, biography) VALUES (:name, :email, :year, :pol, :limbs, :biography)");
        $rez=$s->execute(['name'=>"$name",'email'=>"$email", 'year'=>"$year", 'pol'=>"$pol", 'limbs'=>"$kol", 'biography'=>"$biography"]);
        if($rez != 1){
          $flag+=1;
        }
        $id_f=$con->lastInsertId();

        if($immortality=="yes"){
          $num = 1;
          $s2=$con->prepare("INSERT INTO SUPER_CHAR(id, id_superpower) VALUES (:id, :id_superpower)");
          $rez2=$s2->execute(['id'=>"$id_f", 'id_superpower'=>"$num"]);
          if($rez2 != 1){
            $flag+=1;
          }
        }
        if($levitation=="yes"){
            $num = 2;
            $s3=$con->prepare("INSERT INTO SUPER_CHAR(id, id_superpower) VALUES (:id, :id_superpower)");
            $rez3=$s3->execute(['id'=>"$id_f", 'id_superpower'=>"$num"]);
            if($rez3 != 1){
              $flag+=1;
            }
          }
        if($passing_through_walls=="yes"){
          $num = 3;
          $s4=$con->prepare("INSERT INTO SUPER_CHAR(id, id_superpower) VALUES (:id, :id_superpower)");
          $rez4=$s4->execute(['id'=>"$id_f", 'id_superpower'=>"$num"]);
          if($rez4 != 1){
            $flag+=1;
          }
        }
        $bytes_log = openssl_random_pseudo_bytes(4);
        $bytes_pass = openssl_random_pseudo_bytes(5);
        $log = bin2hex($bytes_log);
        $pass_komb = bin2hex($bytes_pass);
        $pass = md5($pass_komb);
        $s5=$con->prepare("INSERT INTO USER(login, password, id_form) VALUES (:login, :password, :id_form)");
        $rez5=$s5->execute(['login'=>"$log", 'password'=>"$pass", 'id_f'=>"$id_f"]);
        if($rez5 != 1){
          $flag+=1;
        }
        setcookie("login_new",$log);
        setcookie("password_new", $pass_komb);
        if($flag==0){
          setcookie("mark", "ok");
        }
        else{
          setcookie("mark","no");
        }  
      }
      else{
          $flag = 0;
          $s5 = $con->prepare("UPDATE FORMS_CHAR SET name = :name, email = :email, year = :year, pol = :pol, limbs = :limbs, biography = :biography WHERE id = :id");
          $rez5 = 0;
          $s5->bindValue(":id", $_COOKIE['id_form']);
          $s5->bindValue(":name", $name);
          $s5->bindValue(":email", $email);
          $s5->bindValue(":year", $year);
          $s5->bindValue(":pol", $pol);
          $s5->bindValue(":limbs", $kol);
          $s5->bindValue(":biography", $biography);
          $rez5=$s5->execute();
          if($rez5 == 0){
            $flag+=1;
          }
        
          $s6 = $con->prepare("DELETE FROM SUPER_CHAR WHERE id = :id");
          $s6->bindValue("id",$_COOKIE['id_form']);
          $rez6 = $s6->execute();
          if($rez6 == 0){
            $flag+=1;
          }
          $id = $_COOKIE['id_form'];


          if($immortality=="yes"){
            $num = 1;
            $s2=$con->prepare("INSERT INTO SUPER_CHAR(id, id_superpower) VALUES (:id, :id_superpower)");
            $rez2=$s2->execute(['id'=>"$id", 'id_superpower'=>"$num"]);
            if($rez2 != 1){
              $flag+=1;
            }
          }
          if($levitation=="yes"){
            $num = 2;
            $s3=$con->prepare("INSERT INTO SUPER_CHAR(id, id_superpower) VALUES (:id, :id_superpower)");
            $rez3=$s3->execute(['id'=>"$id", 'id_superpower'=>"$num"]);
            if($rez3 != 1){
              $flag+=1;
            }
          }
          if($passing_through_walls=="yes"){
            $num = 2;
            $s4=$con->prepare("INSERT INTO SUPER_CHAR(id, id_superpower) VALUES (:id, :id_superpower)");
            $rez4=$s4->execute(['id'=>"$id", 'id_superpower'=>"$num"]);
            if($rez4 != 1){
              $flag+=1;
            }
          }

        if($flag==0){
          setcookie("mark", "no");
        }
        else{
          setcookie("mark","ok");
        } 
        session_destroy();
      }
    }
    header("Location: index.php");
    exit();
  }
?>
