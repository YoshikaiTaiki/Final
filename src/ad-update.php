<?php
    const SERVER = 'mysql218.phy.lolipop.lan';
    const DBNAME = 'LAA1516810-aso2201157';
    const USER = 'LAA1516810';
    const PASS = 'Pass0305';
    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="style.css">
		<title>update</title>
	</head>
	<body>
    <table>
    <tr><th>商品名</th><th>商品説明</th><th>値段</th><th>画像</th><th>スポーツ</th><th>ブランド名</th><th>カテゴリー</th><th>購入</th><th>在庫</th></tr>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('update AnimalMeat set MeatPartID=?,AnimalName=?');
	$sql = $pdo->prepare('select * from AnimalMeat where MeatPartID = ?');
    $sql->execute([$_GET['id']]);
    foreach($sql as $row){

        $Detailsql = $pdo->prepare('select * from Detail where shohin_number = ?');
        $Detailsql->execute([$_GET['id']]);

        foreach($Detailsql as $row2){

            $Stocksql = $pdo->prepare('select * from Stock where shohin_number = ?');
            $Stocksql->execute([$_GET['id']]);

            foreach($Stocksql as $row3){
	
		//var_dump($row);

		        echo '<form action="ad-Update Completed.php" method="post">';
                echo '<input type="hidden" name="shohin_number" value="',$row['shohin_number'],'required">';
                //echo '<div class="td0">',$row['shohin_number'],'</div>';
                echo '<tr>';

	        	//echo '<div class="td1">';
                echo '<td><input type="text" name="shohin_mei" value="',$row['shohin_mei'],'"required></td>';

        		//echo '</div> ';
		        //echo '<div class="td1">';
                echo '<td><input type="text" name="shohin_setu" value="',$row['shohin_setu'],'"required></td>';
        		//echo '</div> ';
        
                //echo '</div> ';
                //echo '<div class="td1">';
                echo '<td><input type="text" name="shohin_price" value="',$row['shohin_price'],'"required></td>';
                //echo '</div> ';

                //echo '</div> ';
	        	//echo '<div class="td1">';
                echo '<td><input type="text" name="shohin_gazo" value="',$row['shohin_gazo'],'"required></td>';
	        	//echo '</div> ';

                //echo '</div> ';
		        //echo '<div class="td1">';
                echo '<td><input type="text" name="shohin_sport" value="',$row2['shohin_sport'],'"required></td>';
		        //echo '</div> ';

                //echo '</div> ';
		        //echo '<div class="td1">';
                echo '<td><input type="text" name="shohin_burnd" value="',$row2['shohin_burnd'],'"rquired></td>';
		        //echo '</div> ';
        
                //echo '</div> ';
	        	//echo '<div class="td1">';
                echo '<td><input type="text" name="shohin_kate" value="',$row2['shohin_kate'],'"rquired></td>';
	        	//echo '</div> ';

                //echo '</div> ';
		        //echo '<div class="td1">';
                echo '<td><input type="text" name="konyu_kazu" value="',$row3['konyu_kazu'],'"rquired></td>';
                //echo '</div> ';

                
                //echo '</div> ';
		        //echo '<div class="td1">';
                echo '<td><input type="text" name="stock_kazu" value="',$row3['stock_kazu'],'"rquired></td>';
                //echo '</div> ';

                echo '<input type="submit" value="更新"></div>';
	        	echo '</form>';
	        	echo "\n";
                echo '<form action="ad-list.php" method="post">';
                echo '<input type="submit" value="戻る"></div>';
	        	echo '</form>';

            }
        }
    }
?>
</table>
    </body>
</html>