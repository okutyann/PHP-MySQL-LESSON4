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
    $id = 12;
    $stme->bind_param('i', $id);
    $stme->execute();
    // bind_result テーブルから持ってくるときにその値に変数をつける
    $stme->bind_result($id, $memos, $created);
    $stme->fetch();
    ?>
    <div><?php echo htmlspecialchars($memos); ?></div>
</body>

</html>