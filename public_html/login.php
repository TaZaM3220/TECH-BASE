<!DOCTYPE html>
<html lang = "ja">
   <head>
       <meta charset = "UTF-8">
       <title>ログイン画面</title>
       <style>
           *{
text-align:center;
background-color:#fffaf0;
}

a1{
font-weight:bold;
font-size: 32px;
color:#008b8b;
}
a2{
font-weight:bold;
font-size: 20px;
color:#4169e1;
}
.A1{
background-color:#a9a9a9;
}
.A2{
color:#4682b4;
background-color:#dcdcdc;
}
.A3{
color:#ffffff;
background-color:#008080;
}
       </style>
   </head> 
   <body>
       <a1>＜ログイン＞<br></a1><br>
      <a2><form action = "" method = "post" class="A1">
       メールアドレス<br>
       <input type = "text" name = 'email' placeholder = "メールアドレスを入力" class = "A2"><br><br>
       パスワード<br>
       <input type = "text" name = "pass" value = "パスワードを入力" class = "A2"><br><br>
       <input type = "submit" value = "ログイン" class = "A3"><br>
       </form></a2>
   </body>
</html>
<?php
session_start();
$_SESSION['email']= "";
//DB_USER: 
//user_id ←primary key
//name CHAR(32)
//email CHAR(32)←typeはemailとしなくてもいい
 //password CHAR(32)
 $dsn = 'mysql:dbname=データベース名;host=localhost';
 $user = 'ユーザ名';
 $password = 'パスワード';

try {
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
} catch (PDOException $e) {
    echo json_encode(['error' => 'データベース接続に失敗しました。']);
    exit;
}
if(empty($_POST['email'])){
    $email1 = "";
}else{
    $email1 = $_POST['email'];
}
if(empty($_POST["pass"])){
    $pass1 = "";
}else{
    $pass1 = $_POST["pass"];
}
if(!empty($email1)&& !empty($pass1)){
    $sql = 'SELECT*FROM DB_USER WHERE email=:email';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email',$email1,PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchALL();
    foreach($results as $row){
    $email2 = $row['email'];
    $password = $row['password'];
    }
      if($email1 == $email2 && $pass1 == $password){
          $_SESSION['email'] = $email1;
        echo '<a href="home.php">'."ホームへ".'</a>'."<br>";
    }elseif($email1 != $email2){
        echo "メールアドレスが違います<br>";
    }elseif($pass1 != $password){
        echo "パスワードが違います<br>";
    }
}elseif(empty($email1)){
    echo "メールアドレスを入力してください<br>";
}elseif(empty($pass1)){
    echo "パスワードを入力してください<br>";
}else{
    echo "エラー2";
}

?>