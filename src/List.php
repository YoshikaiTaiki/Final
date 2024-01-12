<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<?php require 'menu.php'; ?>
<form action="List.php" method="post">
商品検索
<input type="text" name="keyword">
<input type="submit" value="検索">
</form>
<hr>
<?php
echo '<table>';
echo '<tr><th>ID</th><th>動物の名前</th><th>部位ID</th></tr>';
$pdo = new PDO($connect, USER, PASS);
if(isset($_POST['keyword'])) {
    $sql = $pdo->prepare('SELECT * FROM AnimalMeat WHERE name LIKE ?');
    $sql->execute(['%' . $_POST['keyword'] . '%']);
} else {
    $sql = $pdo->query('SELECT * FROM AnimalMeat'); // 修正: 'select * form product' を 'SELECT * FROM product' に修正
}
foreach($sql as $row){
    $id = $row['ID'];
    echo '<tr>';
    echo '<td>', $id, '</td>';
    echo '<td>';
    echo '<a href="detail.php?id=', $id, '">', $row['AnimalName'], '</a>';
    echo '</td>';
    echo '<td>', $row['MeatPartID'], '</td>';
    echo '</tr>';
}
echo '</table>';
?>
<?php require 'footer.php'; ?>
