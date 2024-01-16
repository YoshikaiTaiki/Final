
<?php
    const SERVER = 'mysql218.phy.lolipop.lan';
    const DBNAME = 'LAA1516810-aso2201157';
    const USER = 'LAA1516810';
    const PASS = 'Pass0305';
    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Document</title>                                 
    <link rel="stylesheet" href="../css/ad(css)/ad-list.css">
    <title>ASOスポーツ用品サイト(管理者側)</title>                                 
</head>
<body>
    <div class="list_field">
    <h1>商品一覧画面</h1>
    <a href="ad-registration.php">
        <button type="button" class="re">商品登録</button>
    </a>
    <table align="center" border="1">
        <tr>
            <th>商品番号</th>
            <th>商品名</th>
            <th>商品説明</th>
            <th>価格</th>
            <th>商品画像</th>
        </tr>
<?php
$pdo = new PDO($connect, USER, PASS);
foreach ($pdo->query('SELECT * FROM Shohin') as $row) {
    echo '<tr>';
    echo '<td>', $row['shohin_number'], '</td>';
    echo '<td>', $row['shohin_mei'], '</td>';
    echo '<td>', $row['shohin_setu'], '</td>';
    echo '<td>', $row['shohin_price'], '</td>';
    echo '<td>', $row['shohin_gazo'], '</td>';
    echo '<td>';
    echo '<div class="delete"><a href="ad-Deletion Completed.php?id=', $row['shohin_number'],'"><button type="button">削除</button></a></div>';
    echo '<div class="update"><a href="ad-update.php?id=', $row['shohin_number'],'"><button type="button">更新</button></a></div>';
    echo '</td>';
    echo '</tr>';
    echo "\n";
}

?>
</table>
</div>
</body>
</html>