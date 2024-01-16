<?php
session_start();
require 'header.php';
require 'menu.php';

const SERVER = 'mysql220.phy.lolipop.lan';
const DBNAME = 'LAA1516826-final';
const USER = 'LAA1516826';
const PASS = 'final';

$connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';

$MeatPartID = isset($_SESSION['AnimalMeat']['MeatPartID']) ? $_SESSION['AnimalMeat']['MeatPartID'] : '';
$AnimalName = isset($_SESSION['AnimalMeat']['AnimalName']) ? $_SESSION['AnimalMeat']['AnimalName'] : '';

// データベースに接続
$pdo = new PDO($connect, USER, PASS);

// 更新が成功したかどうかの確認
$updateSuccess = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // フォームからのデータ取得
    $MeatPartID = isset($_POST['MeatPartID']) ? $_POST['MeatPartID'] : '';
    $AnimalName = isset($_POST['AnimalName']) ? $_POST['AnimalName'] : '';

    // 入力値のバリデーションなどが必要ならここで行ってください

    // セッションにデータを保存
    $_SESSION['AnimalMeat']['MeatPartID'] = $MeatPartID;
    $_SESSION['AnimalMeat']['AnimalName'] = $AnimalName;

    if (!empty($MeatPartID)) {
        // データベースに更新を反映
        $updateSql = $pdo->prepare('UPDATE AnimalMeat SET AnimalName = ? WHERE MeatPartID = ?');
        $updateSuccess = $updateSql->execute([$AnimalName, $MeatPartID]);
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>更新結果</title>
</head>
<body>

<?php
if ($updateSuccess) {
    echo '更新に成功しました。';
} else {
    echo '更新に失敗しました。';
}
?>

<button onclick="location.href='List.php'">一覧画面へ戻る</button>

<?php require 'footer.php'; ?>

</body>
</html>
