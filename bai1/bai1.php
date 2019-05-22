<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Giải pt bậc 2</h1>
<form method="post" action="">
    <input type="text" name="a" style="width: 20px" value="<?php echo isset($_POST['a']) ? $_POST['a'] : '' ?>">
    x<sup>2</sup>
    + <input type="text" name="b" style="width: 20px" value="<?php echo isset($_POST['b']) ? $_POST['b'] : '' ?>">x
    + <input type="text" name="c" style="width: 20px" value="<?php echo isset($_POST['c']) ? $_POST['c'] : '' ?>"> = 0
    <input type="submit" name="tinh" value="Tính">
</form>
<?php
$kq = '';
$x1 = '';
$x2 = '';
if (isset($_POST['tinh'])) {
    $a = isset($_POST['a']) ? $_POST['a'] : '';
    $b = isset($_POST['b']) ? $_POST['b'] : '';
    $c = isset($_POST['c']) ? $_POST['c'] : '';
    if ($a == '' || $b == '' || $c == '')
        die("Bạn hãy nhập đầy đủ thông tin");
    if (is_numeric($a) && is_numeric($b) && is_numeric($c)) {
        if ($a == 0) {
            if ($b == 0 && $c != 0)
                echo "Phương trình vô nghiệm";
            else {
                die("Phương trình đã cho có 1 nghiệm x= " . (-$c / $b));
            }
        }
        $delta = $b * $b - 4 * $a * $c;
        $x1 = (-$b + sqrt($delta)) / (2 * $a);
        $x2 = (-$b - sqrt($delta)) / (2 * $a);
        if ($delta > 0) {
            $kq = "Phương trình có 2 nghiệm phân biệt x1 =" . $x1 . ", x2 = " . $x2;
        } else if ($delta == 0) {
            $kq = "Phương trình có ngiệm kép x1 = x2 =" . $x1;
        } else {
            $kq = "Phương trình vô nghiệm";
        }
    } else {
        $kq = "Input không đúng định dạng  .";
    }
}
echo $kq;
?>
</body>
</html>
