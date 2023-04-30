<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WEB 4</title>
    <link rel="stylesheet" href="style1.css" />
  </head>

  <body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="decor">
      <div class="form-left-decoration"></div>
      <div class="form-right-decoration"></div>
      <div class="circle"></div>
      <div style="   padding: 50px; padding-bottom: 35px;">
        <h3 style="text-align: center;">Форма для отправки данных</h3>
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
      ?>
      </ul>
      </div>

      <div style="color: green; height: 25px; margin-bottom: 23px; text-align: center; font-size: 16px; <?php
      if(!isset($_COOKIE["mark"])){
        echo "display: none;";
      }
      ?>">
      <?php
      if(isset($_COOKIE["mark"])){
        if($_COOKIE["mark"]=="ok"){
          echo "Ваши данные успешно отправлены.";
          setcookie("mark","",10000);
        }else{
          echo "Ошибка отправки Ваших данных";
          setcookie("mark","",10000);
        }
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
          var c = 0;
          for (var i = 2023; i >= 1920; i--) {
            objSel.options[c] = new Option(i, i);
            c=c+1;
          }
          document.getElementById('year').querySelectorAll('option')[2023-Number(<?php
            if(isset($_COOKIE["year"])){
              echo $_COOKIE["year"];
            }
            ?>)].selected = true;
        </script>
        <span style="<?php
        if(isset($_COOKIE["errorp"])){
          echo "background: #f6f39e; border-radius: 20px;";
        } 
        ?>"><a style="margin-left: 5px">Укажите пол: </a
        ><a style="margin-left: 15px"
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
          echo "background: ##f6f39e; border-radius: 20px;";
        }
        ?>"><a style="margin-left: 5px"
          >Кол-во конечностей:
          <a style="margin-left: 15px"
            >2 <input type="radio" name="kol" value="2"
            <?php
              if(isset($_COOKIE["kol"])){
                if($_COOKIE["kol"]=="2"){
                  echo "checked";
                }
              }
              ?>
          /></a>
          <a style="margin-left: 18px"
            >4 <input type="radio" name="kol" value="4"
            <?php
              if(isset($_COOKIE["kol"])){
                if($_COOKIE["kol"]=="4"){
                  echo "checked";
                }
              }
              ?>
          /></a>
          <a style="margin-left: 18px"
            >6 <input type="radio" name="kol" value="6"
            <?php
              if(isset($_COOKIE["kol"])){
                if($_COOKIE["kol"]=="6"){
                  echo "checked";
                }
              }
              ?>
             style="margin-bottom: 30px"
            />
          </a>
        </a>
          </span>
        <a style="margin-left: 6px">
          Укажите сверхспособности:
          <br />
          <select
            name="superpowers[]"
            style="display: inline; width: 180px; overflow-y: hidden; height: 60px; margin-top: 10px; margin-bottom: 30px;
              <?php
              if(isset($_COOKIE["errors"])){
                echo "background: #f6f39e;";
              }
              ?>
            "
            multiple="multiple"
          >
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
            style="width: 18px; height: 18px; margin-right: 10px"
            name="ok"
            value="Согласен"
          /><span style="margin-top: 3px"
            >C правилами ознакомлен.</span
          ></a
        >
        <div
          style="width: 100%; display: flex; justify-content: center; height: 50px;">
          <input type="submit" value="Отправить" style="margin: 15px"/>
        </div>
      </div>
    </form>
  </body>
</html>
