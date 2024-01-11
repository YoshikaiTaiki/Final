<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<form action="List.php" method="post">
商品検索
<input type="text" name="keyword">
<input type="submit" value="検索">
</form>
<hr>
<?php
echo '<table>';
echo '<tr><th>ID</th><th>動物名</th></tr>';
$pdo = new PDO($connect, USER, PASS);
if(isset($_POST['keyword'])) {
    $sql = $pdo->prepare('SELECT * FROM AnimalMeat WHERE name LIKE ?');
    $sql->execute(['%' . $_POST['keyword'] . '%']);
} else {
    $sql = $pdo->query('SELECT * FROM AnimalMeat'); // 修正: 'select * form product' を 'SELECT * FROM product' に修正
}
foreach($sql as $row){
    $id = $row['animal_id'];
    echo '<tr>';
    echo '<td>', $id, '</td>';
    echo '<td>';
    echo '<a href="detail.php?id=', $id, '">', $row['Meat_name'], '</a>';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';
?>
<?php require 'footer.php'; ?>