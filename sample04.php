<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sample03</title>
</head>

<body>
    <?php
    $db = new mysqli('localhost:8889', 'root', 'root', 'mydb');
    $message = 'phpから入力した値です。';
    // prepareの場合のみ　valus (?)が使える
    //    ? の部分を後から指定できる
    $stmt = $db->prepare('insert into memos (memo) values (?)');
    if (!$stmt) :
        // die メッセージを出してそのままプログラムを終了させる
        die($db->error);
    endif;
    $stmt->bind_param('s', $message);

    // bind_paramとは　＝ prepareで(?)があるときに何をここにセットするかを書く
    // 文字列：'s' = string  数値：'i' = int
    // もし(?)が2つ以上ある場合　
    // prepare('insert into memos (memo) values (?,?)'); 
    // bind_param('si', $message,$num); 
    //こんな感じでsとiを続けてかける

    $ret = $stmt->execute(); //execute = 実行する
    if ($ret) {
        echo 'データを挿入しました。';
    } else {
        echo $db->error;
    }
    ?>
</body>

</html>