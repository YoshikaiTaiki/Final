<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
if(isset($_SESSION['AnimalMeat'])) {
    $id=$_SESSION['AnimalMeat']['ID'];
    $sql=$pdo->prepare('select * from AnimalMeat where ID!=? and MeatPartID=?');
    $sql->execute([$id, $_POST['MeatPartID']]);
}else {
    $sql=$pdo->prepare('select * from AnimalMeat where MeatPartID=?');
    $sql->execute([$_POST['MeatPartID']]);
}
if (empty($sql->fetchAll())) {
    if(isset($_SESSION['AnimalMeat'])) {
        $sql=$pdo->prepare('update AnimalMeat set AnimalName=?, '.' MeatPartID=?,where ID=?');
        $sql->execute([
            $_POST['AnimalName'],
            $_POST['MeatPartID'], $id]);
            $_SESSION['AnimalMeat']=[
                'ID'=>$id, 'AnimalName'=>$_POST['AnimalName'],'MeatPartID'=>$_POST['MeatPartID']];
                echo 'お客様情報を更新しました。';
        } else {
            $sql=$pdo->prepare('insert into AnimalMeat values(null,?,?,?,?)');
            $sql->execute([
                $_POST['AnimalName'],
                $_POST['MeatPartID'],]);
            echo 'お客様情報を登録しました。';
     }
}else{
        echo 'ログイン名がすでに使用されていますので、変更してください。';
}

    ?>
    <?php require 'footer.php'; ?>