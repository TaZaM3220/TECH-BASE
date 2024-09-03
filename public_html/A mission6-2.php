<?php
session_start();
    ?>
<!DOCTYPE html>
<html lang = "ja">
   <head>
       <meta charset = "UTF-8">
       <title>記録画面</title>
       <link rel="stylesheet"href="A.css"type="text/css">
       <style>
           a3{
           font-size:15px;
           display:block;
           font-weight:normal;
           color:#ff4500;
           text-align: right;
           }
           a4{
               font-size:20px;
               font-weight:bold;
               color:black;
           }
       </style>
   </head> 
<html>
    <body>
<a3><?php echo $_SESSION["inputD"][0];?>さん</a3><br>
<a1>＜入力＞</a1><br>
       <a2><form action = "" method = "post">
        企業名<br>
       <input type = "text" name = 'Kname' placeholder = "入力"><br>
       ID<br>
       <input type = "text" name = 'Kid' placeholder = "入力"><br>
       パスワード<br>
       <input type = "text" name = 'Kpass' placeholder = "入力"><br>
       <input type = "submit" value = "投稿" class = "A3"><hr>
  ＜記録画面＞<br>
  </a2>
  </body>
</html>
<?php
 $dsn = 'mysql:dbname=データベース名;host=localhost';
 $user = 'ユーザ名';
 $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
$sql="CREATE TABLE IF NOT EXISTS Klist2"
."("
."id INT AUTO_INCREMENT PRIMARY KEY,"
."un TEXT,"
."name CHAR(32),"
."kd TEXT,"
."pass TEXT"
.");";
$stmt =$pdo->query($sql);
if(empty($_SESSION["inputD"][0])){
    $Uname = "";
    }else{
        $Uname = $_SESSION["inputD"][0];
    };
if(empty($_POST["Kname"])){
    $name = '';
}else{
    $name = $_POST["Kname"];
};
if(empty($_POST["Kid"])){
    $id = '';
    }else{
        $id = $_POST["Kid"];
    };
if(empty($_POST["Kpass"])){
    $pass = '';
}else{
    $pass = $_POST["Kpass"];
};
if(!empty($name)&& !empty($id)&& !empty($pass)){
$sql="INSERT INTO Klist2(un, name, kd, pass) VALUES (:un, :name, :kd, :pass)";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':un',$Uname,PDO::PARAM_STR);
$stmt->bindParam(':name',$name,PDO::PARAM_STR);
$stmt->bindParam(':kd',$id,PDO::PARAM_STR);
$stmt->bindParam(':pass',$pass,PDO::PARAM_STR);
$stmt->execute();
}elseif(empty($name)){
    echo '<span style ="color:red">企業の名前を入力してください</span><br>';;
}elseif(empty($id)){
    echo '<span style ="color:red">企業IDを入力してください</span><br>';;
}elseif(empty($pass)){
    echo '<span style ="color:red">企業パスワードを入力してください</span><br>';;
}else{
    echo "エラー";
}
$sql='SELECT*FROM Klist2 WHERE un=:un';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':un',$Uname,PDO::PARAM_STR);
$stmt->execute();
$results=$stmt->fetchALL();
echo "<table border=1; style='width: 100%'>";
                echo "<tr>";
                echo "<th>企業名</th>";
                echo "<th>企業ID</th>";
                echo "<th>パスワード</th>";
                echo "</tr>";
foreach($results as $row){
    echo "<tr>";
    echo "<td>"."<a4>".$row['name']."<a4>"."</td>";
    echo "<td>"."<a4>".$row['kd']."<a4>"."</td>";
    echo "<td>"."<a4>".$row['pass']."<a4>"."</td>";
    echo "</tr>";
}
echo '<a href="A mission6-1.php">'.'<a3>'."ログイン画面へ".'</a3>'.'</a>'."<br>";
?>