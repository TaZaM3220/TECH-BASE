<!DOCTYPE html>
<html lang = "ja"></html>
   <head>
       <meta charset = "UTF-8">
       <title>簡易掲示板　衛</title>
   </head> 
    <?php
//if(!iseet(submit))でsubmitが押された場合"submit"に""という長さ０の値が送信されているのでissetで検知できる。

$dsn = 'mysql:dbname=データベース名;host=localhost';
 $user = 'ユーザ名';
 $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
$sql="CREATE TABLE IF NOT EXISTS Mkeiziban"
."("
."id INT AUTO_INCREMENT PRIMARY KEY,"
."name CHAR(32),"
."comment TEXT,"
."day TIMESTAMP,"
."pass CHAR(20)"
.");";
$stmt =$pdo->query($sql);
?>
   <body>
       <form action = "" method = "post">
           掲示板投稿<br>
           <input type = "text" name = "namae" placeholder = "名前" value = "<?php if(isset($_POST["submit3"])){
               $id = $_POST["num2"];
   $sql = 'SELECT*FROM Mkeiziban WHERE id=:id';
   $stmt = $pdo->prepare($sql);
   $stmt->bindParam(':id', $id, PDO::PARAM_INT);
   $stmt->execute();
   $results = $stmt->fetchALL();
   foreach($results as $row){
       $num = $row['id'];
       $name = $row['name'];
       $bun = $row['comment'];
               echo $name;
               };
               };?>"><br>
           <input type = "text" name = "bun" placeHolder = "コメント入力" value = "<?php if(isset($_POST["submit3"])){
    $id = $_POST["num2"];
   $sql = 'SELECT*FROM Mkeiziban WHERE id=:id';
   $stmt = $pdo->prepare($sql);
   $stmt->bindParam(':id', $id, PDO::PARAM_INT);
   $stmt->execute();
   $results = $stmt->fetchALL();
   foreach($results as $row){
       $num = $row['id'];
       $name = $row['name'];
       $bun = $row['comment'];
               echo $bun;
                   };
                   };?>"><br>
        <input type = "text" name = "pass1" placeholder = "パスワード入力"><br>
           <input type = "submit" name = "submit" value = "投稿"><br><br><hr>
           投稿削除<br>
           <input type = "number" name = "num" placeholder = "削除対象番号"><br>
           <input type = "text" name = "pass2" placeholder = "パスワード"><br>
           <input type = "submit" name = "submit2" value = "削除"><br><br><hr>
           投稿編集<br>
           <input type = "number" name = "num2" placeholder = "編集対象番号"><br>
            <input type = "text" name = "pass3" placeholder = "パスワード"><br>
           <input type = "submit" name = "submit3" value = "編集"><br>
           <input type = "hidden" name = "num3" value = "<?php if(isset($_POST["submit3"])){
    $id = $_POST["num2"];
   $sql = 'SELECT*FROM Mkeiziban WHERE id=:id';
   $stmt = $pdo->prepare($sql);
   $stmt->bindParam(':id', $id, PDO::PARAM_INT);
   $stmt->execute();
   $results = $stmt->fetchALL();
   foreach($results as $row){
       $num = $row['id'];
       $name = $row['name'];
       $bun = $row['comment'];
               echo $num;
                   };
                   };?>"><br>
       </form>
           </body>
</html>
<?php
if(empty($_POST["submit"]) && empty($_POST["submit2"])){
$sql='SELECT*FROM Mkeiziban ORDER BY id';
$stmt=$pdo->query($sql);
$results=$stmt->fetchALL();
foreach($results as $row){
    echo $row['id'].',';
    echo $row['name'].',';
    echo $row['comment'].',';
    echo $row['day'].'<br>';
echo"<hr>";
};
};
if(isset($_POST["submit"])){
    if(empty($_POST["num3"])){
if(empty($_POST["namae"])){
    $name = '';
}else{
    $name = $_POST["namae"];
};
if(empty($_POST["bun"])){
    $str = "";
    }else{
        $str = $_POST["bun"];
    };
if(empty($_POST["pass1"])){
    $pass = "";
}else{
    $pass = $_POST["pass1"];
};
if(!empty($name)&& !empty($str)){
    if(!empty($pass)){
$sql="INSERT INTO Mkeiziban(name, comment, pass, day) VALUES (:name, :comment,:pass,NOW())";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':name',$name,PDO::PARAM_STR);
$stmt->bindParam(':comment',$str,PDO::PARAM_STR);
$stmt->bindParam(':pass',$pass,PDO::PARAM_STR);
$stmt->execute();
 $sql='SELECT*FROM Mkeiziban ORDER BY id';
  $stmt=$pdo->query($sql);
    $results=$stmt->fetchALL();
    foreach($results as $row){
    echo $row['id'].',';
    echo $row['name'].',';
    echo $row['comment'].',';
    echo $row['day'].'<br>';
echo"<hr>";
};
}elseif(empty($pass)){
     echo '<span style ="color:red">パスワードを入力してください</span><br>';
      $sql='SELECT*FROM Mkeiziban ORDER BY id';
  $stmt=$pdo->query($sql);
    $results=$stmt->fetchALL();
    foreach($results as $row){
    echo $row['id'].',';
    echo $row['name'].',';
    echo $row['comment'].',';
    echo $row['day'].'<br>';
echo"<hr>";
};
}
}
}else{
    //編集時
    $id = $_POST["num3"];
    if(empty($_POST["namae"])){
    $name = '';
}else{
    $name = $_POST["namae"];
};
if(empty($_POST["bun"])){
    $str = "";
    }else{
        $str = $_POST["bun"];
    };
if(empty($_POST["pass3"])){
    $pass1 = "";
}else{
    $pass1 = $_POST["pass3"];
};
//パスワード呼び出し
$sql = 'SELECT*FROM Mkeiziban WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id',$id,PDO::PARAM_INT);
$stmt->execute();
$results = $stmt->fetchALL();
foreach($results as $row){
    $pass = $row['pass'];
}
//条件文に入力パスワード$passと保存パスワード$pass1の一致を入れる
    if(!empty($name)&& !empty($str)&& $pass == $pass1){
        $sql = 'UPDATE Mkeiziban SET name=:name,comment=:comment WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name',$name, PDO::PARAM_STR);
        $stmt->bindParam(':comment',$str,PDO::PARAM_STR);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();
    $sql='SELECT*FROM Mkeiziban ORDER BY id';
    $stmt=$pdo->query($sql);
    $results=$stmt->fetchALL();
    foreach($results as $row){
    echo $row['id'].',';
    echo $row['name'].',';
    echo $row['comment'].',';
    echo $row['day'].'<br>';
echo"<hr>";
};
    }elseif(!empty($name)&& !empty($str)&& $pass != $pass1){
    echo '<span style ="color:red">パスワードが間違っています</span><br>';
    $sql='SELECT*FROM Mkeiziban ORDER BY id';
    $stmt=$pdo->query($sql);
    $results=$stmt->fetchALL();
    foreach($results as $row){
    echo $row['id'].',';
    echo $row['name'].',';
    echo $row['comment'].',';
    echo $row['day'].'<br>';
echo"<hr>";
};
    }
}
}
elseif(isset($_POST["submit2"])){
//削除パターン
    $id = $_POST["num"];
    $pass2 = $_POST["pass2"];
    $sql = 'SELECT*FROM Mkeiziban WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id',$id,PDO::PARAM_INT);
$stmt->execute();
$results = $stmt->fetchALL();
foreach($results as $row){
    $pass = $row['pass'];
}
if($pass == $pass2){
    $sql = 'delete from Mkeiziban where id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $sql='SELECT*FROM Mkeiziban ORDER BY id';
    $stmt=$pdo->query($sql);
    $results=$stmt->fetchALL();
    foreach($results as $row){
    echo $row['id'].',';
    echo $row['name'].',';
    echo $row['comment'].',';
    echo $row['day'].'<br>';
echo"<hr>";
}
}elseif($pass != $pass2){
     echo '<span style ="color:red">パスワードが間違っています</span><br>';
    $sql='SELECT*FROM Mkeiziban ORDER BY id';
    $stmt=$pdo->query($sql);
    $results=$stmt->fetchALL();
    foreach($results as $row){
    echo $row['id'].',';
    echo $row['name'].',';
    echo $row['comment'].',';
    echo $row['day'].'<br>';
    echo"<hr>";
    }
}
};

?>
