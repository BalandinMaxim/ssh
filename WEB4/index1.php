<?php
header('Content-Type: text/html; charset=UTF-8');
function namet($data){
  $pattern = '/^[а-яёЁА-Я]+$/u';
  if(preg_match($pattern, $data))
    return 1;
  else
    return 0;
}
function emailt($data){
  $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
  if(preg_match($pattern, $data))
    return 1;
  else
    return 0;
}
function biographyt($data){
  $pattern = '/^[a-zA-Zа-яА-Я0-9,. \'"-]*$/u';
  if(preg_match($pattern, $data))
    return 1;
  else
    return 0;
}

if($_SERVER["REQUEST_METHOD"] == "GET"){
    include('form1.php');
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
        setcookie("errorn", "В имени должны содержатся символы русского алфавита");
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
        setcookie("errore","Некоректные символы при вводе email");
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
      setcookie("errork","Укажите кол-во конечностей!");
    }
    else{
      setcookie("kol",$_POST["kol"]);
      setcookie("errork","",1000000);
    }
  
    if(empty($_POST["superpowers"])){
      $error=TRUE;
      setcookie("errors","Укажите сверхспособности!");
      setcookie("superpowers",$_POST["superpowers"]);
    }
    else{
      setcookie("errors","",10000);
      setcookie("immortality","",10000);
      setcookie("levitation","",10000);
      setcookie("passing_through_walls","",10000);
      $superpowers=$_POST["superpowers"];
      foreach($superpowers as $output){
        if($output =="бессмертие"){
          setcookie("immortality","yes");
        }
        if($output =="левитация"){
            setcookie("levitation","yes");
          }
        if($output =="прохождение сквозь стены"){
          setcookie("passing_through_walls","yes");
        }
      }
    }
  
    if(empty($_POST["biography"])){
      $error=TRUE;
      setcookie("errorb","Заполните биографию!");
      setcookie("biography",$_POST["biography"]);
    }
    else{
      if(biographyt($_POST["biography"])){
        setcookie("errorb","",10000);
        setcookie("biography",$_POST["biography"]);
      }
      else{
        $error=TRUE;
        setcookie("errorb","Для заполнения биографии необходимо использовать символы русского и латинского алфавита и знаки препинания");
        setcookie("biography",$_POST["biography"]);
      }
    }

    if(empty($_POST["ok"])){
      $error=TRUE;
      setcookie("ok","Примите правила компании!");
    }
    else{
      setcookie("ok","",10000);
    }


    if($error){
      header("Location: index1.php");
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
      foreach($superpowers as $output){
        if($output =="бессмертие"){
          setcookie("immortality","yes", time()+3600);
        }
        if($output =="левитация"){
            setcookie("levitation","yes", time()+3600);
          }
        if($output =="прохождение сквозь стены"){
          setcookie("passing_through_walls","yes", time()+3600);
        }
      }
      setcookie("biography",$_POST["biography"], time()+3600);
      $immortality='no';
      $passing_through_walls='no';
      $levitation='no';
      foreach($superpowers as $output){
        if($output =="бессмертие"){
          $immortality="yes";
        }
        if($output =="левитация"){
            $levitation="yes";
          }
        if($output =="прохождение сквозь стены"){
          $passing_through_walls="yes";
        }
      }

      $name = $_POST["name"];
      $email = $_POST["email"];
      $year = $_POST["year"];
      $pol = $_POST["pol"];
      $kol = $_POST["kol"];
      $biography=$_POST["biography"];
      $cr = 0;
      $otv="";
      $user = 'u52884';
      $pass = '6854641';
      $conn = new PDO('mysql:host=localhost;dbname=u52884', $user, $pass, [PDO::ATTR_PERSISTENT => true]);
      $stmt = $conn->prepare("INSERT INTO FORMS_CHAR(name, email, year, gender, limbs, biography) VALUES (:name, :email, :year, :gender, :limbs, :biography)");
      $otv=$stmt->execute(['name'=>"$name",'email'=>"$email", 'year'=>"$year", 'gender'=>"$pol", 'limbs'=>"$kol", 'biography'=>"$biography"]);
      $id_form=$conn->lastInsertId();
      if($otv != 1){
        $cr+=1;
      }


      if($immortality=="yes"){
        $num = 1;
        $stmt2=$conn->prepare("INSERT INTO SUPER_CHAR(id, id_superpower) VALUES (:id, :id_superpower)");
        $otv2=$stmt2->execute(['id'=>"$id_form", 'id_superpower'=>"$num"]);
        if($otv2 != 1){
          $cr=$cr+1;
        }
      }
      if($levitation=="yes"){
        $num = 2;
        $stmt3=$conn->prepare("INSERT INTO SUPER_CHAR(id, id_superpower) VALUES (:id, :id_superpower)");
        $otv3=$stmt3->execute(['id'=>"$id_form", 'id_superpower'=>"$num"]);
        if($otv3 != 1){
            $cr=$cr+1;
        }
      }
      if($passing_through_walls=="yes"){
        $num = 3;
        $stmt4=$conn->prepare("INSERT INTO SUPER_CHAR(id, id_superpower) VALUES (:id, :id_superpower)");
        $otv4=$stmt4->execute(['id'=>"$id_form", 'id_superpower'=>"$num"]);
        if($otv4 != 1){
            $cr=$cr+1;
        }
      }

      if($cr==0){
        setcookie("mark", "ok");
      }
      else{
        setcookie("mark","not_ok");
      }
    }
    header("Location: index1.php");
    exit();
  }
?>
