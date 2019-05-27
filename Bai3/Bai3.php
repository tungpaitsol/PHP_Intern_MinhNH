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
$a=$_POST['a'] ? $_POST['a'] : '';
$array=array();
if(isset($_POST['create']))
{
    if (isset($_POST['a']) && is_numeric($a) && $a > 0)
    {
        for ($i = 0; $i < $a; $i++)
        {
            $type=rand(0,1);
            if($type==0)
                $array[$i]=rd_string(round(rand($a/4,(3*$a/4))));
            else
                $array[$i]=rd_int(round(rand($a/4,(3*$a/4))));
        }
        echo '<pre>';
        var_dump($array);
        $_SESSION['array']=$array;
    }
    else
    {
        echo "Input sai định dạng";
    }
}
if(isset($_POST['distribute']))
{
    $array=$_SESSION['array'];
    $array_int=array();
    $array_string=array();
    foreach ($array as $item)
    {
        if (is_int($item))
            $array_int[]=$item;
        else
            $array_string[]=$item;
    }
    echo '<pre>';
    var_dump($array_int);
    echo '<pre>';
    var_dump($array_string);
}
function rd_int($lenght)
{
    $chars = '0123456789';
    $size= strlen($chars);
    $str='';
    for($i=0; $i<$lenght ; $i++)
    {
        $str .=$chars[rand(0,$size -1)];
    }
    return (int)$str;
}
function rd_string($lenght)
{
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $size= strlen($chars);
    $str='';
    for($i=0; $i<$lenght ; $i++)
    {
        $str .=$chars[rand(0,$size -1)];
    }
    return $str;
}
?>
</body>
</html>