<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php
$name = $address = $login = $password = '';
if (isset($_SESSION['AnimalMeat'])) {
    $ID = $_SESSION['AnimalMeat']['ID'];
    $MeatPartID = $_SESSION['AnimalMeat']['MeatPartID'];
    $AnimalName = $_SESSION['AnimalMeat']['AnimalName'];
}

echo '<form action="register-output.php" method="post">';
echo '<table>';
echo '<tr><td>お名前</td><td>';
echo '<input type="text" name="ID" value="', $ID, '">';
echo '</td></tr>';
echo '<tr><td>ご住所</td><td>';
echo '<input type="text" name="MeatPartID" value="', $MeatPartID, '">';
echo '</td></tr>';
echo '<tr><td>ログイン名</td><td>';
echo '<input type="text" name="AnimalName" value="', $AnimalName, '">';
echo '</td></tr>';
echo '</table>';
echo '<input type="submit" value="登録">';
echo '</form>';
?>
<?php require 'footer.php'; ?>
<?php error_reporting(E_ALL);
ini_set('display_errors', 1);
?>