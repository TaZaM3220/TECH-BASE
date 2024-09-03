<?php
session_start();
//セッションに保存データがあるか確認
if(isset($_SESSION["inputD"])){
    //セッションから情報を取得
    $name = $_SESSION["inputD"][0];
    $pass = $_SESSION["inputD"][1];
}else{
    $name = "";
    $pass = "";
}
?>
<!DOCTYPE html>
<html lang = "ja">
   <head>
       <meta charset = "UTF-8">
       <title>ログイン画面</title>
        <link rel="stylesheet"href="A.css"type="text/css">
        <style>
           a3{
           font-size:25px;
           font-weight:bold;
           color:#ff4500;
           text-align: center;
           }
       </style>
   </head> 
   <body>
       <a1>＜ログイン＞<br></a1>
       <a2><form action = "" method = "post">
       名前<br>
       <input type = "text" name = 'name' value = "<?php echo $name?>" class ="A2"><br><br>
       パスワード<br>
       <input type = "text" name = "pass" value = "<?php echo $pass;?>" class ="A2"><br><br>
       <input type = "submit" value = "ログイン" class = "A3">
       </form></a2>
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
//パスワード呼び出し
if(!empty($_POST['name'])){
    $name = $_POST['name'];
}else{
    $name = "";
}
$name1 = "";
$sql = 'SELECT*FROM tm6DB WHERE name=:name';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':name',$name,PDO::PARAM_STR);
$stmt->execute();
$results = $stmt->fetchALL();
foreach($results as $row){
    $pass = $row['pass'];
    $name1 = $row['name'];
}
if(!empty($_POST['pass'])){
    $pass1 = $_POST['pass'];
}else{
    $pass1 = "";
}
//条件文に入力パスワード$passと保存パスワード$pass1の一致を入れる
if(!empty($name) && $name == $name1 && $pass == $pass1){
    if(!empty($_POST['name'])&&!empty($_POST['pass'])){
$_SESSION["inputD"] = array($_POST['name'],$_POST['pass']);
}else{
    $_SESSION["inputD"] = array("","");
}
        echo "<a3>".'<a href="A mission6-2.php">'."記録画面へ".'</a>'."<a3>"."<br>";
}elseif(!empty($name)&&$pass != $pass1){
    echo '<span style ="color:red">パスワードが違います</span><br>';;
}elseif(empty($name)){
    echo '<span style ="color:red">名前を入力してください</span><br>';;
}elseif($name != $name1 && $pass == $pass1){
    echo '<span style ="color:red">名前が違います</span><br>';;
}
?>
<html lang = "ja">
    <link rel="stylesheet"href="A.css"type="text/css">
   <body>
       <br>
       <a2>＜新規登録＞</a2><br>
       <form action = "A mission6-3.php" method = "post" class="A2">
       <input type = "submit" value = "新規登録画面へ" class = "A3">
       </form>
   </body>
</html>