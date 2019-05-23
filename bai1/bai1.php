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
$a = isset($_POST['a']) ? $_POST['a'] : '';
$b = isset($_POST['b']) ? $_POST['b'] : '';
$c = isset($_POST['c']) ? $_POST['c'] : '';
if (isset($_POST['tinh']))
{
    if (!is_numeric($a) && !is_numeric($b) && !is_numeric($c))
    {
        die("Input không đúng định dạng");
    }
    else
    {
        echo ptb2($a,$b,$c);
    }
}
function ptb2($a,$b,$c)
{
    $delta = $b * $b - 4 * $a * $c;
    if ($a == 0 && $b == 0 && $c == 0)
        return "Phương trình có vô số nghiệm";
    if ($a == 0 && $b == 0 && $c != 0)
        return "Phương trình vô nghiệm";
    if ($a == 0 && $b != 0 && $c != 0)
        return "Phương trình có 1 nghiệm là " . (-$c / $b);
    if($delta <0)
        return "Phương trình vô nghiệm";
    if($delta ==0)
        return "Phương trình có nghiệm kép  x1= x2 = ". -$b/($a*2);
    if($delta>0)
        return "Phương trình có 2 nghiệm phân biệt x1 = ".(-$b + sqrt($delta)/(2*$a)) . "x2 = ".(-$b - sqrt($delta)/(2*$a));
}
?>
</body>
</html>
