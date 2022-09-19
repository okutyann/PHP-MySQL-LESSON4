<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メモ詳細</title>
</head>

<body>
    <?php require('dbconnect.php');
    $stme = $db->prepare('select * from memos where id=(?)');
    if (!$stme) {
        die($db->error);
    }
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    // $idが正しくない場合にエラー
    if (!$id) {
        echo '表示するメモを指定してください';
        exit();
    }
    $stme->bind_param('i', $id);
    $stme->execute();
    // bind_result テーブルから持ってくるときにその値に変数をつける
    $stme->bind_result($id, $memos, $created);
    $result = $stme->fetch();
    // 正しく指定はされたもののメモが見つからなかったとき
    if (!$result) {
        echo '指定されたメモは見つかりませんでした';
        exit();
    }
    ?>
    <div><?php echo htmlspecialchars($memos); ?></pre>
    </div>
    <p>
        <a href="update.php?id=<?php echo $id; ?>">編集する</a>
        <a href="/memo">一覧へ</a>
    </p>
</body>

</html>