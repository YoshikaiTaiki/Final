<?php
    const SERVER = 'mysql220.phy.lolipop.lan';
    const DBNAME = 'LAA1516826-final';
    const USER = 'LAA1516826';
    const PASS = 'final';
    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<body>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('update Shohin set shoin_mei=?,shohin_setu=?,shohin_price=?,shohin_gazo=? where shohin_number=?');
    $sql=$pdo->prepare('update Detail set shohin_sport=?,shohin_burnd=?,shohin_kate=? where shohin_number=?');
    $sql=$pdo->prepare('update Stock set konyu_kazu=?,stock_kazu=? where shohin_number=?');
    if($sql->execute([htmlspecialchars($_POST['shohin_mei']),($_POST['shohin_setu']),($_POST['shohin_price']),($_POST['shohin_gazo']),($_POST['shohin_sport']),($_POST['shohin_burnd']),($_POST['shohin_kate']),($_POST['konyu_kazu']),($_POST['shohin_number']),$_POST['shohin_number']])){
        // var_dump($sql);
        echo '更新に成功しました。';
    }else{
        echo '更新に失敗しました。';
    }
    
?>
        <button onclick="location.href='ren6-6-input.php'">更新画面へ戻る</button>
    </body>
</html>