<?php require 'db-connect.php'; ?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
        <link rel="stylesheet" href="../css/ad(css)/ad-Update Completed.css">
		<title>ASOスポーツ用品サイト(管理者側)</title>
	</head>
	<body>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('update Shohin set shohin_mei=?,shohin_setu=?,shohin_price=?,shohin_gazo=? where shohin_number=?');
    $Detailsql=$pdo->prepare('update Detail set shohin_sport=?,shohin_burnd=?,shohin_kate=? where shohin_number=?');
    $Stocksql=$pdo->prepare('update Stock set konyu_kazu=?,stock_kazu=? where shohin_number=?');
    if($Detailsql->execute([htmlspecialchars($_POST['shohin_sport']),$_POST['shohin_burnd'],$_POST['shohin_kate'],$_GET['id']])){
        if($Stocksql->execute([htmlspecialchars($_POST['konyu_kazu']),$_POST['stock_kazu'],$_GET['id']])){
            if($sql->execute([htmlspecialchars($_POST['shohin_mei']),$_POST['shohin_setu'],$_POST['shohin_price'],$_POST['shohin_gazo'],$_GET['id']])){
        // var_dump($sql);
                echo '<h1>更新に成功しました。</h1>';
            }else{
                echo '<h1>更新に失敗しました。</h1>';
            }
        }
    }
    echo '<form action="ad-update.php?id=', $_GET['id'],'" method="post">';
    echo '<input type="submit" value="更新画面へ" class="ko"></div>';
    echo '</form>';
    echo "\n";
?>
        <button onclick="location.href='ad-list.php'" class="i">商品一覧へ</button>
    </body>
</html>