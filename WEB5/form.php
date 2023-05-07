<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Задание 5</title>
  </head>
  <body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="decor">
      <div class="left-form"></div>
      <div class="right-form"></div>
      <div class="circle"></div>
      <div class="in-form">
        <h3 style="text-align: center;">Форма заполнения данных</h3>
      <div style="color: red; margin-bottom: 23px; text-align: left; font-size: 16px; <?php
      if($error){
        echo "display: none;";
      }
      ?>">
      <ul>
      <?php
        $pr="";
        if (isset($_COOKIE["errorn"])) {
          $pr=$_COOKIE["errorn"];
          echo "<li>$pr</li>";
        }
        if(isset($_COOKIE["errore"])){
          $pr=$_COOKIE["errore"];
          echo "<li>$pr</li>";
        }
        if(isset($_COOKIE["errorp"])){
          $pr=$_COOKIE["errorp"];
          echo "<li>$pr</li>";
        }
        if(isset($_COOKIE["errork"])){
          $pr=$_COOKIE["errork"];
          echo "<li>$pr</li>";
        }
        if(isset($_COOKIE["errors"])){
          $pr=$_COOKIE["errors"];
          echo "<li>$pr</li>";
        }
        if(isset($_COOKIE["errorb"])){
          $pr=$_COOKIE["errorb"];
          echo "<li>$pr</li>";
        }
        if(isset($_COOKIE["ok"])){
            $pr=$_COOKIE["ok"];
            echo "<li>$pr</li>";
        }
      ?></ul></div>
      <div style="color: green; height: 25px; margin-bottom: 18px; text-align: center; font-size: 20px; <?php
      if(!isset($_COOKIE["mark"])){
        echo "display: none;";
      }
      ?>">
      <?php
      if(isset($_COOKIE["mark"])){
        if($_COOKIE["mark"]=="no"){
          echo "Ваши данные успешно отправлены.";
          setcookie("mark","",10000);
        }else{
          echo "Ошибка отправки данных. Попробуйте ещё раз.";
          setcookie("mark","",10000);
        }
      }
      ?>
      </div>
      <div style="color: orange; height: 25px; margin-bottom: 18px;  text-align: center; font-size: 20px; <?php
      if(!isset($_COOKIE["login_new"])){
        echo "display: none;";
      }
      ?>">
        <?php
        if(isset($_COOKIE["new_log"])){
          $log = $_COOKIE["new_log"];
          $pass = $_COOKIE["new_pass"];
          setcookie("new_log","",10000);
          setcookie("new_pass","",10000);
          echo "Логин: $log</br>Пароль: $pass";
        }
        ?>
      </div>
        <input type="text" placeholder="Введите имя" name="name" style="
        <?php
          if (isset($_COOKIE["errorn"])) {
            echo "background: #f6f39e";
          }
        ?>
        "
        value="<?php
          if(isset($_COOKIE["name"])){
            echo $_COOKIE["name"];
          }
          ?>"/>
        <input type="email" placeholder="Email" name="email" style="
        <?php
          if (isset($_COOKIE["errore"])){
            echo "background: #f6f39e";
          }
        ?>
        "
        value="<?php
          if(isset($_COOKIE["email"])){
            echo $_COOKIE["email"];
          }
          ?>"/>
        <a style="padding-left: 5px" style="white-space: nowrap"
          >Укажите год вашего рождения:
          <select
            id="year"
            name="year"
            size="1"
            style="display: inline"
          ></select
        ></a>
        <script>
          var objSel = document.getElementById("year");
          var a = 0;
          for (var i = 2023; i >= 1920; i--) {
            objSel.options[a] = new Option(i, i);
            a++;
          }
          document.getElementById('year').querySelectorAll('option')[2023-Number(<?php
            if(isset($_COOKIE["year"])){
              echo $_COOKIE["year"];}
            ?>)].selected = true;
        </script>
        <span style="<?php
        if(isset($_COOKIE["errorp"])){
          echo "border-radius: 20px; background: #f6f39e;";
        } 
        ?>"><a style="margin-left: 5px">Укажите пол: </a
        ><a style="margin-left: 17px"
          >Мужской<input
            type="radio"
            name="pol"
            class="radio"
            value="Мужской" 
            <?php
              if(isset($_COOKIE["pol"])){
                if($_COOKIE["pol"]=="Мужской"){
                  echo "checked";
                }
              }?>/></a
        ><a style="margin-left: 10px"
          >Женский<input type="radio" name="pol" class="radio" value="Женский"
          <?php
            if(isset($_COOKIE["pol"])){
              if($_COOKIE["pol"]=="Женский"){
                echo "checked";
              }
            }
            ?>/></a></span>
        <br />
        <span style="<?php
        if(isset($_COOKIE["errork"])){
          echo "border-radius: 20px; background: #f6f39e;";
        }
        ?>"><a style="margin-left: 5px">Кол-во конечностей:
          <a style="margin-left: 10px"
            >2 <input type="radio" name="kol" value="2"
            <?php
              if(isset($_COOKIE["kol"])){
                if($_COOKIE["kol"]=="2"){
                  echo "checked";
                }
              }?> /></a>
          <a style="margin-left: 18px"
            >4 <input type="radio" name="kol" value="4"
            <?php
              if(isset($_COOKIE["kol"])){
                if($_COOKIE["kol"]=="4"){
                  echo "checked";
                }
              }?> /></a>
          <a style="margin-left: 18px"
            >6 <input type="radio" name="kol" value="6"
            <?php
              if(isset($_COOKIE["kol"])){
                if($_COOKIE["kol"]=="6"){
                  echo "checked";
                }
              }?>
             style="margin-bottom: 30px"/>
          </a>
        </a>
          </span>
        <a style="margin-left: 6px">
          Укажите сверхспособности:
          <br />
          <select
            name="superpowers[]"
            style="width: 180px; display: inline; height: 60px; margin-top: 10px; margin-bottom: 30px;overflow-y: hidden;
              <?php
              if(isset($_COOKIE["errors"])){
                echo "background: #f6f39e;";
              }
              ?>"
            multiple="multiple" >
            <option value="бессмертие" <?php
              if(isset($_COOKIE["immortality"])){
                echo "selected";
              }
              ?>>бессмертие</option>
            <option value="левитация" <?php
              if(isset($_COOKIE["levitation"])){
                echo "selected";
              }
              ?>>левитация</option>
            <option value="прохождение сквозь стены" <?php
              if(isset($_COOKIE["passing_through_walls"])){
                echo "selected";
              }
              ?>>
              прохождение сквозь стены</option>
          </select>
        </a>
        <textarea placeholder="Биография" rows="3" name="biography" maxlength="511" style="<?php
        if(isset($_COOKIE["errorb"])){
          echo "background: #f6f39e; border-radius: 20px;";
        }
        ?>"><?php
          if(isset($_COOKIE["biography"])){
            echo $_COOKIE["biography"];
          }
          ?></textarea>
        <a style="display: flex; vertical-align: middle"
          ><input
            type="checkbox"
            style="width: 20px; height: 20px; margin-right: 10px"
            value="Согласен"
            name="ok"
          /><span style="margin-top: 3px"
            >C правилами ознакомлен.</span></a
        >
        <div
          style="width: 100%; justify-content: center; height: 50px; display: flex;">
          <input type="submit" value="Отправить" style="margin: 15px"/>
        </div>
        <div style="text-align: center; margin-top: 20px">
        <a href="log.php" style="">Другой пользователь</a>
        </div>
      </div>
    </form>
  </body>
</html>
