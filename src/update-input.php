<?php
session_start();
require 'header.php';
require 'menu.php';

const SERVER = 'mysql220.phy.lolipop.lan';
const DBNAME = 'LAA1516826-final';
const USER = 'LAA1516826';
const PASS = 'final';

$connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';

$MeatPartID = isset($_SESSION['AnimalMeat']['MeatPartID']) ? $_SESSION['AnimalMeat']['MeatPartID'] : '';
$AnimalName = isset($_SESSION['AnimalMeat']['AnimalName']) ? $_SESSION['AnimalMeat']['AnimalName'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // フォームからのデータ取得
    $MeatPartID = isset($_POST['MeatPartID']) ? $_POST['MeatPartID'] : '';
    $AnimalName = isset($_POST['AnimalName']) ? $_POST['AnimalName'] : '';

    // 入力値のバリデーションなどが必要ならここで行ってください

    // セッションにデータを保存
    $_SESSION['AnimalMeat']['MeatPartID'] = $MeatPartID;
    $_SESSION['AnimalMeat']['AnimalName'] = $AnimalName;

    if (!empty($MeatPartID)) {
        // データベースに更新を反映
        $pdo = new PDO($connect, USER, PASS);
        $updateSql = $pdo->prepare('UPDATE AnimalMeat SET AnimalName = ? WHERE MeatPartID = ?');
        $updateSql->execute([$AnimalName, $MeatPartID]);

        // 更新が完了したらリダイレクト
        header('Location: List.php');
        exit();
    }
}
?>

<form method="post" action="">
    <table>
        <h1>更新画面</h1>
        <tr><td>部位IDを入力してください</td><td><input type="number" name="MeatPartID" value="<?php echo htmlspecialchars($MeatPartID); ?>"></td></tr>
        <tr><td>動物名を入力してください</td><td><input type="text" name="AnimalName" value="<?php echo htmlspecialchars($AnimalName); ?>"></td></tr>
    </table>
    <button onclick="location.href='List.php'" class="de">更新</button>
</form>

<?php require 'footer.php'; ?>
