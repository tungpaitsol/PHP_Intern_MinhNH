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
    <input type="text" name="a" value="<?php echo isset($_POST['a']) ? $_POST['a'] : '' ?>">
    <input type="submit" name="create" value="Tạo mảng">
    <input type="submit" name="distribute" value="Tách mảng">
</form>
<?php session_start() ?>
<?php

$a = $_POST['a'] ? $_POST['a'] : '';
$arr_number = array();
$arr_string = array();
if (isset($_POST['create'])) {
    if (isset($_POST['a']) && is_numeric($a)) {
        $dem = rand(1, $a);
        for ($i = 0; $i < $dem; $i++) {
            $arr_number[$i] = (int)rd_number(round(rand($a / 4, 3 * $a / 4)));
        }
        for ($i = 0; $i < ($a - $dem); $i++) {
            $arr_string[$i] = (string)rd_string(round(rand($a / 4, 3 * $a / 4)));
        }
        $array = array_merge($arr_string, $arr_number);
        echo '<pre>';
        var_dump($array);
        $_SESSION['arr_number'] = $arr_number;
        $_SESSION['arr_string'] = $arr_string;
    } else {
        echo "Input sai định dạng";
    }
}
if (isset($_POST['distribute'])) {

    $arr_number = $_SESSION['arr_number'];
    $arr_string = $_SESSION['arr_string'];
    echo '<pre>';
    var_dump($arr_number);
    echo '<pre>';
    var_dump($arr_string);
}
function rd_number($lenght)
{
    $chars = '0123456789';
    $size = strlen($chars);
    $str = rand(1, $size - 1);;
    for ($i = 0; $i < $lenght; $i++) {
        $str .= $chars[rand(0, $size - 1)];
    }
    return $str;
}

function rd_string($lenght)
{
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $size = strlen($chars);
    $str = '';
    for ($i = 0; $i < $lenght; $i++) {
        $str .= $chars[rand(0, $size - 1)];
    }
    return $str;
}

?>
</body>
</html>