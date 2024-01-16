<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
        <link rel="stylesheet" href="../css/ad(css)/ad-Deletion Completed.css">
		<title>ASOスポーツ用品サイト(管理者側)</title>
	</head>
	<body>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $shohinNumber = $_GET['id'];
    //子を先に削除
    $Detailsql=$pdo->prepare('delete from AnimalMeat where MeatPartId=?');
    $Detailsql->execute([$shohinNumber]);
    //子を先に削除
    $Stocksql=$pdo->prepare('delete from AnimalMeat where AnimalName=?');
    $Stocksql->execute([$shohinNumber]);
    //親を削除
    $sql=$pdo->prepare('delete from AnimalMeat where ID=?');
    $sql->execute([$shohinNumber]);

    echo '<h1>削除が完了しました。</h1>'; 
?>
<button onclick="location.href='List.php'" class="de">商品一覧へ</button>
</html>
