<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>

<form method="post" action="register-output.php">
    <?php
    $ID = $MeatPartID = $AnimalName = '';
    if (isset($_SESSION['AnimalMeat'])) {
        $MeatPartID = $_SESSION['AnimalMeat']['MeatPartID'];
        $AnimalName = $_SESSION['AnimalMeat']['AnimalName'];
    }

    echo '<table>';
    echo '<h1>登録画面</h1>';
    echo '<tr><td>部位IDを入力してください</td><td>';
    echo '<input type="number" name="MeatPartID" value="', $MeatPartID, '">';
    echo '</td></tr>';
    echo '<tr><td>動物名を入力してください</td><td>';
    echo '<input type="text" name="AnimalName" value="', $AnimalName, '">';
    echo '</td></tr>';
    echo '</table>';
    echo '<input type="submit" value="登録">';
    echo '</form>'; // フォームタグを閉じる

    require 'footer.php';
    ?>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require 'footer.php';
    ?>

