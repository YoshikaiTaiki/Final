<?php
session_start();
require 'db-connect.php';  // 適切なデータベース接続のために追加されたと仮定します
require 'header.php';
require 'menu.php';

// フォームからのデータを取得
$MeatPartID = isset($_POST['MeatPartID']) ? $_POST['MeatPartID'] : '';
$AnimalName = isset($_POST['AnimalName']) ? $_POST['AnimalName'] : '';

// セッションにデータを保存
$_SESSION['AnimalMeat'] = [
    'MeatPartID' => $MeatPartID,
    'AnimalName' => $AnimalName
];

// データベースへの接続情報
const SERVER = 'mysql220.phy.lolipop.lan';
const DBNAME = 'LAA1516826-final';
const USER = 'LAA1516826';
const PASS = 'final';

try {
    // データベースに接続
    $dsn = 'mysql:host='.SERVER.';dbname='.DBNAME.';charset=utf8';
    $pdo = new PDO($dsn, USER, PASS);

    // エラーが発生した場合は例外を投げるように設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // データベースにデータを挿入するSQLクエリ
    $query = "INSERT INTO AnimalMeat (MeatPartID, AnimalName) VALUES (:MeatPartID, :AnimalName)";
    
    // プリペアドステートメントを作成
    $stmt = $pdo->prepare($query);

    // プリペアドステートメントに値をバインド
    $stmt->bindParam(':MeatPartID', $MeatPartID);
    $stmt->bindParam(':AnimalName', $AnimalName);

    // プリペアドステートメントを実行
    $stmt->execute();

    // 例: データを表示してみる
    echo '<h1>登録完了</h1>';
    echo '<p>部位ID: ' . htmlspecialchars($MeatPartID) . '</p>';
    echo '<p>動物名: ' . htmlspecialchars($AnimalName) . '</p>';
} catch (PDOException $e) {
    // データベースエラーの場合の処理
    echo 'データベースエラー: ' . $e->getMessage();
}

// データベース接続を閉じる
$pdo = null;
?>
