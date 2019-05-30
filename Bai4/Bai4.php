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
    <div align="center">
        <input type="text" name="input" value="<?php echo isset($_POST['input']) ? $_POST['input'] : '' ?>">
        <input type="submit" name="ok" value="OK"><br>
        <input type="submit" name="price_tang" value="Tăng price">
        <input type="submit" name="price_giam" value="Giảm price"><br>
        <input type="submit" name="order_tang" value="Tăng Oder">
        <input type="submit" name="order_giam" value="Giảm Oder"><br>
        <input type="submit" name="total_tang" value="Tăng Total">
        <input type="submit" name="total_giam" value="Giảm Total"><br>
    </div>
    <br>
</form>
<?php session_start();
$input = isset($_POST['input']) ? $_POST['input'] : '';
if (isset($_POST['ok'])) {
    $product = array('P_01', 'P_02', 'P_03', 'P_04', 'P_05', 'P_06', 'P_07', 'P_08', 'P_09', 'P_10');
    $id = 0;
    for ($i = 0; $i < $input; $i++) {
        $info[$i] = array('ID' => $id++, 'Name' => $product[rand(0, 9)], 'Price' => rand(0, 10000), 'Quantity' => rand(0, 100), 'Order' => rand(0, 100));
        $total = $info[$i]['Price'] * $info[$i]['Quantity'];
        $info[$i]['Total'] = $total;
    }
    echo output($info);
    $_SESSION['info'] = $info;
}
if (isset($_POST['price_tang'])) {
    $array = $_SESSION['info'];
    $info=sort_up($array,'Price');
    echo output($info);
}
if (isset($_POST['price_giam'])) {
    $array = $_SESSION['info'];
    $info=sort_dow($array,'Price');
    echo output($info);
}
if (isset($_POST['order_tang'])) {
    $array = $_SESSION['info'];
    $info=sort_up($array,'Order');
    echo output($info);
}
if (isset($_POST['order_giam'])) {
    $array = $_SESSION['info'];
    $info=sort_dow($array,'Order');
    echo output($info);
}
if (isset($_POST['total_tang'])) {
    $array = $_SESSION['info'];
    $info=sort_up($array,'Total');
    echo output($info);
}
if (isset($_POST['total_giam'])) {
    $array = $_SESSION['info'];
    $info=sort_dow($array,'Total');
    echo output($info);
}
function output($arr)
{
    ?>
    <table border="1px" align="center">
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Price</td>
            <td>Quantity</td>
            <td>Order</td>
            <td>Total</td>
        </tr>
        <?php
        echo "<tr>";
        foreach ($arr as $item) {
            echo "<td>";
            echo $item['ID'];
            echo "</td>";
            echo "<td>";
            echo $item['Name'];
            echo "</td>";
            echo "<td>";
            echo $item['Price'];
            echo "</td>";
            echo "<td>";
            echo $item['Quantity'];
            echo "</td>";
            echo "<td>";
            echo $item['Order'];
            echo "</td>";
            echo "<td>";
            echo $item['Total'];
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <?php
}

function sort_up($arr, $index) :array
{
    $spt = count($arr);
    for ($i = 0; $i < $spt - 1; $i++) {
        for ($j = $i + 1; $j < $spt; $j++) {
            if ($arr[$i][$index] > $arr[$j][$index]) {
                $tg = $arr[$j];
                $arr[$j] = $arr[$i];
                $arr[$i] = $tg;
            }
        }
    }
    return $arr;
}
function sort_dow($arr, $index) :array
{
    $spt = count($arr);
    for ($i = 0; $i < $spt - 1; $i++) {
        for ($j = $i + 1; $j < $spt; $j++) {
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