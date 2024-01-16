<?php
require 'header.php';
require 'db-connect.php';
require 'menu.php';

$pdo = new PDO($connect, USER, PASS);

// 商品の削除処理
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $deleteId = $_POST['delete_id'];
    
    // バリデーション: 数値であることを確認
    if (!is_numeric($deleteId)) {
        echo '不正なリクエストです。';
        exit();
    }

    $deleteSql = $pdo->prepare('DELETE FROM AnimalMeat WHERE ID = ?');
    
    if ($deleteSql->execute([$deleteId])) {
        // 削除が成功した場合の処理
        header('Location: delete.php');
        exit();
    } else {
        // 削除が失敗した場合の処理
        echo '削除に失敗しました。';
    }
}

// 商品一覧取得
echo '<form action="List.php" method="post">';
echo '</form>';
echo '<hr>';
echo '<table>';
echo '<tr><th>ID</th><th>動物の名前</th><th>部位ID</th><th>操作</th></tr>';

if (isset($_POST['keyword'])) {
    $sql = $pdo->prepare('SELECT * FROM AnimalMeat WHERE AnimalName LIKE ?');
    $sql->execute(['%' . $_POST['keyword'] . '%']);
} else {
    $sql = $pdo->query('SELECT * FROM AnimalMeat');
}

foreach ($sql as $row) {
    $id = $row['ID'];
    echo '<tr>';
    echo '<td>', $id, '</td>';
    echo '<td>';
    echo '<a href="detail.php?id=', $id, '">', $row['AnimalName'], '</a>';
    echo '</td>';
    echo '<td>', $row['MeatPartID'], '</td>';
    echo '<td>';
    echo '<form method="post" action="">';
    echo '<input type="hidden" name="delete_id" value="' . $id . '">';
    echo '<input type="submit" value="削除">';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
}

echo '</table>';
require 'footer.php';
?>
