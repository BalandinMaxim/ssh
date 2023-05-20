<?php
header('Content-Type: text/html; charset=UTF-8');
function namet($data){
  $pattern = '/<?php
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
         $messages = array();


  // В суперглобальном массиве $_GET PHP хранит все параметры, переданные в текущем запросе через URL.
   if (!empty($_COOKIE['save'])) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('save', '', 100000);
    // Если есть параметр save, то выводим сообщение пользователю.
    $messages[] = 'Спасибо, результаты сохранены.';
  }
  
  $errors = array();
  $errors['fio'] = !empty($_COOKIE['fio_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['date'] = !empty($_COOKIE['date_error']);
  $errors['sex'] = !empty($_COOKIE['sex_error']);
  $errors['limbs'] = !empty($_COOKIE['limbs_error']);
  $errors['abilities'] = !empty($_COOKIE['abilities_error']);
  $errors['bio'] = !empty($_COOKIE['bio_error']);
  $errors['checkbox'] = !empty($_COOKIE['checkbox_error']);
  
  if ($errors['fio']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('fio_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Заполните имя. <br> Используйте символы: А-Я, а-я, A-Z,a-z</div>';
  }
  if ($errors['email']) {
    setcookie('email_error', '', 100000);
    $messages[] = '<div class="error">Заполните email.</div>';
  }
  if ($errors['date']) {
    setcookie('date_error', '', 100000);
    $messages[] = '<div class="error">Заполните дату рождения. <br> Должен содержать @</div>';
  }
  if ($errors['sex']) {
    setcookie('sex_error', '', 100000);
    $messages[] = '<div class="error">Укажите пол. <br> день/месяц/год </div>';
  }
  if ($errors['limbs']) {
    setcookie('limbs_error', '', 100000);
    $messages[] = '<div class="error">УУкажите количество конечностей.</div>';
  }
  if ($errors['abilities']) {
    setcookie('abilities_error', '', 100000);
    $messages[] = '<div class="error">Укажите сверхспособность.</div>';
  }
  if ($errors['bio']) {
    setcookie('bio_error', '', 100000);
    $messages[] = '<div class="error">Заполните биографию. <br> Используйте символы: А-Я, а-я, A-Z,a-z</div>';
  }
  if ($errors['checkbox']) {
    setcookie('checkbox_error', '', 100000);
    $messages[] = '<div class="error">Примите условия соглашения.</div>';
  }
  
  $values = array();
  $values['fio'] = empty($_COOKIE['fio_value']) ? '' : $_COOKIE['fio_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['date'] = empty($_COOKIE['date_value']) ? '' : $_COOKIE['date_value'];
  $values['sex'] = empty($_COOKIE['sex_value']) ? '' : $_COOKIE['sex_value'];
  $values['limbs'] = empty($_COOKIE['limbs_value']) ? '' : $_COOKIE['limbs_value'];
  $values['abilities'] = empty($_COOKIE['abilities_value']) ? '' : $_COOKIE['abilities_value'];
  $values['bio'] = empty($_COOKIE['bio_value']) ? '' : $_COOKIE['bio_value'];
  $values['checkbox'] = empty($_COOKIE['checkbox_value']) ? '' : $_COOKIE['checkbox_value'];
  
  // Включаем содержимое файла form.php.
  include('form.php');
  
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.
else{
// Проверяем ошибки.
$errors = FALSE;
if (empty($_POST['fio'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('fio_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на год.
    setcookie('fio_value', $_POST['fio'], time() + 30 * 24 * 60 * 60 * 12);
  }

  if (empty($_POST['email'])) {
    setcookie('email_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60 * 12);
  }

  if (empty($_POST['date'])) {
    setcookie('date_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('date_value', $_POST['date'], time() + 30 * 24 * 60 * 60 * 12);
  }

  if (empty($_POST['sex'])) {
    setcookie('sex_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('sex_value', $_POST['sex'], time() + 30 * 24 * 60 * 60 * 12);
  }

  if (empty($_POST['limbs'])) {
    setcookie('limbs_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('limbs_value', $_POST['limbs'], time() + 30 * 24 * 60 * 60 * 12);
  }

  if (empty($_POST['abilities'])) {
    setcookie('abilities_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('abilities_value', $_POST['abilities'], time() + 30 * 24 * 60 * 60 * 12);
  }

  if (empty($_POST['bio'])) {
    setcookie('bio_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('bio_value', $_POST['bio'], time() + 30 * 24 * 60 * 60 * 12);
  }

  if (empty($_POST['checkbox'])) {
    setcookie('checkbox_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('checkbox_value', $_POST['checkbox'], time() + 30 * 24 * 60 * 60 * 12);
  }


if ($errors) {
  // При наличии ошибок завершаем работу скрипта.
  header('Location: index1.php');
  exit();
}
  else {
    // Удаляем Cookies с признаками ошибок.
    setcookie('fio_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('date_error', '', 100000);
    setcookie('sex_error', '', 100000);
    setcookie('limbs_error', '', 100000);
    setcookie('abilities_error', '', 100000);
    setcookie('bio_error', '', 100000);
    setcookie('checkbox_error', '', 100000);
  }


// Сохранение в базу данных.

$user = 'u52884';
$pass = '6854641';
$db = new PDO('mysql:host=localhost;dbname=u52884', $user, $pass,
[PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); // Заменить test на имя БД, совпадает с логином uXXXXX

// Подготовленный запрос. Не именованные метки.
try {

  $stmt = $db->prepare("INSERT INTO FORMS_CHAR (name,email,year,gender,limbs,biography) VALUES 
  (?,?,?,?,?,?,?)");
  $stmt -> execute([$_POST['fio'], $_POST['email'], $_POST['date'], $_POST['sex'], $_POST['limbs'], $_POST['bio']]);
  $id = $db->lastInsertId();
  $stmt = $db->prepare("INSERT INTO FORM_SUPER_CHAR (id_DATA_FORM, id_DATA_superpower) VALUES (?,?)");
    foreach ($_POST['abilities'] as $ability) {
          $stmt->execute([$id, $ability]);
        }



 
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}

 // Сохраняем куку с признаком успешного сохранения.
  setcookie('save', '1');

  // Делаем перенаправление.
  header('Location: index1.php');
}^[а-яёЁА-Я]+$/u';
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
