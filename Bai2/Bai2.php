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
            <h1>Tìm số nguyên tố ( với định dạng là a-b với a < b )</h1>
            <form method="post" action="">
                <input type="text" name="a" style="width: 80px" value="<?php echo isset($_POST['a']) ? $_POST['a'] : ''  ?>">
                <input type="submit" name="ok" value="OK">
            </form>
            <?php
                if(isset($_POST['ok']))
                {
                    $a=$_POST['a'] ? $_POST['a'] :'';
                    if(empty($a))
                        die("Bạn chưa nhập dữ liệu");
                    $str1=explode(",",$a);
                    $ds=array();
                    foreach ($str1 as $item)
                    {
                        $str2=explode("-",$item);
                        if(count($str2)<2)
                            die("Input sai định dạng");
                        if(!isset($str2[0]) || !is_numeric($str2[0]) || !isset($str2[1]) || !is_numeric($str2[1]))
                            die("Input sai định dạng");
                        echo "Các số nguyên tố có trong dãy trên là : ";
                        for($i=$str2[0] ; $i<$str2[1] ; $i++ )
                        {
                            if(check($i))
                            {
                               $ds[]=$i;
                               echo $i.", ";
                            }
                        }
                    }
                }
                function check($x)
                {
                    if($x<2)
                    {
                        return false;
                    }
                    for($i=2 ; $i<= sqrt($x) ; $i++)
                    {
                        if($x % $i == 0)
                            return false;
                    }
                    return true;
                }
            ?>
        </body>
</html>
