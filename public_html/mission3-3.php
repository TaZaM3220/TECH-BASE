<!DOCTYPE html>
<html lang = "ja">
   <head>
       <meta charset = "UTF-8">
       <title>簡易掲示板　衛</title>
   </head> 
   <body>
       <form action = "" method = "post">
           <input type = "text" name = "namae" placeholder = "名前"><br>
           <input type = "text" name = "bun" placeholder = "ここに入力"><br>
           <input type = "submit" name = "submit" value = "投稿"><br>
       </form>
        <?php
$filename = "keiziban.csv";
if(empty($_POST["namae"])){
    $name = "";
}else{
    $name = $_POST["namae"];
};
if(empty($_POST["bun"])){
    $str = "";
    }else{
        $str = $_POST["bun"];
    };
$num = "";
$date = date("Y/m/d H:i:s");
if(!empty($name) && !empty($str)){
    if(file_exists($filename)){
    $num = count(file($filename)) + 1;
}else{
    $num = 1;
}
}
$user = [
        'id' => $num,
        'name' => $name,
        'comment' => $str,
        'date' => $date
        ];
if((!empty($name)) &&(!empty($str))){
    $fp = fopen($filename, "a");
    fputcsv($fp,$user);
    fclose($fp);
}
$fp = fopen($filename,"r");
while($data = fgetcsv($fp)){
    echo '<span style ="color:red">'.$data[0].'</span>'." " ;
    echo '<span style ="color:blue">'.$data[1].'</span>'." " ;
    echo $data[2]." ";
    echo $data[3]." ";
    echo "<br>";
};
fclose($fp);
?>
    </body>
</html>
