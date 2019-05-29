<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="post" action="">
    <h3>Nhập số lượng sản phẩm</h3>
    <input type="text" name="input" value="<?php echo isset($_POST['input']) ? $_POST['input'] : '' ?>">
    <input type="submit" name="Ok" value="OK">
    <div>Sắp xếp theo :</div>
    <div>Price:</div>
    <input type="submit" name="price_tang" value="Tăng dần"><br>
    <input type="submit" name="price_giam" value="Giảm dần"><br>
    <div>Order:</div>
    <input type="submit" name="order_tang" value="Tăng dần"><br>
    <input type="submit" name="order_giam" value="Giảm dần"><br>
    <div>Total :</div>
    <input type="submit" name="total_tang" value="Tăng dần"><br>
    <input type="submit" name="total_giam" value="Giảm dần">
    <table>
        <tr>
            <td></td>
        </tr>
    </table>
</form>
<?php  session_start();
$input = $_POST['input'] ? $_POST['input'] : '';
$product = array('P_01', 'P_02', 'P_03', 'P_04', 'P_05', 'P_06', 'P_07', 'P_08', 'P_09', 'P_010');
$size = count($product);
$info = array();
$id = 0;
if (isset($_POST['Ok']) && isset($_POST['input']) && is_numeric($input)) {

    for ($i = 0; $i < $input; $i++) {
        $info[$i] = array('id' => $id++, 'name' => $product[rand(0, $size - 1)], 'price' => rand(0, 10000),
            'quantity' => rand(0, 100), 'order' => rand(1, 100));
        $total = $info[$i]['price'] * $info[$i]['quantity'];
        $info[$i]['total'] = $total;
    }
    $_SESSION['info'] = $info;
}
else
{
    echo "Input sai định dạng";
}
$arr = $_SESSION['info'];
if (isset($_POST['price_tang'])) {
    $_SESSION['info'] = sort_up($arr, 'price');
}
if (isset($_POST['price_giam'])) {
    $_SESSION['info'] = sort_dow($arr, 'price');
}
if (isset($_POST['order_tang'])) {
    $_SESSION['info'] = sort_up($arr, 'order');
}
if (isset($_POST['order_giam'])) {
    $_SESSION['info'] = sort_dow($arr, 'order');
}
if (isset($_POST['total_tang'])) {
    $_SESSION['info'] = sort_up($arr, 'total');
}
if (isset($_POST['total_giam'])) {
    $_SESSION['info'] = sort_dow($arr, 'total');
}

?>
<table border="1px">
    <tr align="center">
        <td>ID</td>
        <td width="80px">Name</td>
        <td width="80px">Price</td>
        <td width="80px">Quantity</td>
        <td width="80px">Oder</td>
        <td width="80px">Total</td>
    </tr>
    <?php
    foreach ($arr as $item) {
        echo "<tr>";
        echo "<td>";
        echo $item['id'];
        echo "</td>";
        echo "<td>";
        echo $item['name'];
        echo "</td>";
        echo "<td>";
        echo $item['price'];
        echo "</td>";
        echo "<td>";
        echo $item['quantity'];
        echo "</td>";
        echo "<td>";
        echo $item['order'];
        echo "</td>";
        echo "<td>";
        echo $item['total'];
        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>
<?php
function sort_up($arr, $index): array
{
    $tg = array();
    $count = count($arr);
    for ($i = 0; $i < ($count - 1); $i++) {
        for ($j = ($i + 1); $j < $count; $j++) {
            if ($arr[$i][$index] > $arr[$j][$index]) {
                $tg = $arr[$j];
                $arr[$j] = $arr[$i];
                $arr[$i] = $tg;
            }
        }
    }
    return $arr;
}

function sort_dow($arr, $index)
{
    $tg = array();
    $count = count($arr);
    for ($i = 0; $i < ($count - 1); $i++) {
        for ($j = ($i + 1); $j < $count; $j++) {
            if ($arr[$i][$index] < $arr[$j][$index]) {
                $tg = $arr[$j];
                $arr[$j] = $arr[$i];
                $arr[$i] = $tg;
            }
        }
    }
    return $arr;
}

?>


</body>
</html>