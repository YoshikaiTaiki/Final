<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<?php 
$pdo = new PDO($connect, USER, PASS);
$sql = $pdo->prepare('SELECT * FROM AnimalMeat WHERE id=?');
$sql->execute([$_GET['animal_id']]); // パラメータを取得するために $_POST から $_GET に変更
foreach ($sql as $row){
    echo '<p><img alt="image" src="image/', $row['id'], '.jpg"></p>';
    echo '<form action="cart-insert.php" method="post">';
    echo '<p>ID:', $row['animal_id'], '</p>';
    echo '<p>動物名:', $row['Animal_Meat'], '</p>';
    for($i=1; $i<=10; $i++){
        echo '<option value="', $i, '">', $i, '</option>';
    }
    echo '</select></p>';
    echo '<input type="hidden" name="animal_id" value="', $row['animal_id'], '">';
    echo '<input type="hidden" name="Animal_Meat" value="', $row['Animal_Meat'], '">';
    echo '</form>';
    echo '<p><a href="favorite-insert.php?id=', $row['id'], '">お気に入りに追加</a></p>';
}
?>
<?php require 'footer.php'; ?>
