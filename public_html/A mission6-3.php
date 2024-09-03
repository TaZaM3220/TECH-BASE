<!DOCTYPE html>
<html lang = "ja">
   <head>
       <meta charset = "UTF-8">
       <title>新規登録画面</title>
       <link rel="stylesheet"href="A.css"type="text/css">
   </head> 
<html>
    <body>
  <a1>＜新規登録＞</a1><br>
       <a2><form action = "A mission6-3.php" method = "post">
        名前<br>
        <input type = "text" name = 'name1' value = "" class ="A2"><br>
       パスワード<br>
       <input type = "text" name = 'pass' value = "" class = "A2"><br>
       <input type = "submit" value = "新規登録" class ="A3">
       </form>
       </a2>
       </body>
       </html>
<?php
$dsn = 'mysql:dbname=データベース名;host=localhost';
$user = 'ユーザ名';
$password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
$sql="CREATE TABLE IF NOT EXISTS tm6DB"
."("
."id INT AUTO_INCREMENT PRIMARY KEY,"
."name TEXT,"
."pass TEXT"
.");";
$stmt =$pdo->query($sql);
if(empty($_POST['name1'])){
    $name = '';
}else{
    $name = $_POST['name1'];
};
if(empty($_POST['pass'])){
    $str = '';
    }else{
        $pass = $_POST['pass'];
    };
if(!empty($_POST['name1'])&& !empty($_POST['pass'])){
$sql = 'SELECT*FROM tm6DB WHERE name=:name';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':name',$name,PDO::PARAM_STR);
$stmt->execute();
$results = $stmt->fetchAll();
$count = count($results);
}else{
    $count = 2;
}
if(!empty($_POST['name1'])&& !empty($_POST['pass'])){
    if($count > 0){
        echo'<span style ="color:red">この名前は既に登録されています</span><br>';
    }else{
$sql="INSERT INTO tm6DB(name, pass) VALUES (:name, :pass)";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':name',$name,PDO::PARAM_STR);
$stmt->bindParam(':pass',$pass,PDO::PARAM_STR);
$stmt->execute();
    }
}else{
    echo '<span style ="color:red">パスワード又は名前を入力してください</span><br>';
}
session_start();
if(!empty($_POST['name1']) && !empty($_POST['pass'])){
$_SESSION["inputD"] = array($_POST['name1'],$_POST['pass']);
}else{
    $_SESSION["inputD"] = array("","");
}
?>
<!DOCTYPE html>
<html lang = "ja">
   <head>
       <meta charset = "UTF-8">
       <title>入力画面</title>
        <link rel="stylesheet"href="A.css"type="text/css">
   </head> 
   <body>
       <a2><form action = "A mission6-1.php" method = "post" class ="A2">
       名前 <span style ="color:red"><?php echo $_SESSION["inputD"][0];?></span><br>
       パスワード<span style ="color:red"><?php echo $_SESSION["inputD"][1];?></span><br>
       <input type = "submit" name = "submit" value = "戻る" class = "A3"></a2>
   </body>
