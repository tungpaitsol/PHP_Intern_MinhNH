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
    </div>
    <br>
</form>
<?php session_start();
$input = isset($_POST['input']) ? $_POST['input'] : '';
if (isset($_POST['ok'])) {
    $product = array('P_01', 'P_02', 'P_03', 'P_04', 'P_05', 'P_06', 'P_07', 'P_08', 'P_09', 'P_10');
    $id = 0;
    for ($i = 0; $i < $input; $i++) {
        $info[$i] = array('ID' => $id++, 'Name' => $product[rand(0, 9)], 'Price' => rand(1, 10000),
            'Quantity' => rand(0, 100), 'Order' => rand(0, 100));
    }
    output($info);
    $_SESSION['info'] = $info;
}
if (isset($_POST['save'])) {
    $array = $_SESSION['info'];
    $change = $_POST['change'];
    for ($i = 0; $i < count($array); $i++) {
        $replace[$i] = array('Order' => $change[$i]);
        $info[$i] = array_replace($array[$i], $replace[$i]);
    }

    output($info);
    $_SESSION['info']=$info;
}
if (isset($_POST['sort'])) {
    $array = $_SESSION['info'];
    output(sort_up($array, 'Order'));
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
        echo "<form method='post'>";
        echo "<tr>";
        foreach ($arr as $key => $item) {
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
            echo "<input type='text' name='change[]' value='$item[Order]'>";
            echo "</td>";
            echo "<td>";
            echo $item['Price'] * $item['Quantity'];
            echo "</td>";
            echo "</tr>";
        }
        echo "<td colspan='6'>";
        echo "<input style='width:50%' type='submit' name='save' value='Save'>";
        echo "<input style='width: 50%' type='submit' name='sort' value='Sắp xếp'>";
        echo "</td>";
        echo "<form>";
        ?>
    </table>
    <?php
}

function sort_up($arr, $index): array
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

function sort_dow($arr, $index): array
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