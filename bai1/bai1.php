<!DOCTYPE html>
<html>
    <head>
    <title>Giải phương trình bậc hai</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
            if(isset($_POST['tinh']))
            {
                if(isset($_POST['a']))
                {$a=$_POST['a'];}
                if(isset($_POST['b']))
                {$b=$_POST['b'];}
                if(isset($_POST['c']))
                {$c=$_POST['c'];}
                function giaiptbac2($a,$b,$c)
                {

                    if($a == 0)
                    {
                        if($b == 0)
                        { echo ("Phương trình vô nghiệm");}
                        else
                        echo"Phươnq trình có 1 nghiệm là "." x = " .(-$c / $b);
                    }
                    else {
                        $delta = $b * $b - 4 * $a * $c;
                        $x1 = "";
                        $x2 = "";
                        if ($delta > 0) {
                            $x1 = -$b + sqrt($delta) / 2 * $a;
                            $x2 = -$b - sqrt($delta) / 2 * $a;
                            echo "<br>";
                            echo "Phuong trinh co 2 nghiem la " . " x1= " . $x1 . ", x2= " . $x2;
                        }
                        else if($delta==0)
                        {
                            echo "<br>";
                            echo "Phuong trinh co nghiem kep x1 = x2 =".$x1;
                        }
                        else
                        {
                            echo "<br>";
                            echo "Phuong trinh vo nghiem";
                        }
                    }
                }
            }
        ?>
        <h1>Giải pt bậc 2</h1>
        <form method="post" action="#">
            <input type="text" name="a" style="width: 20px" value="<?=$a?>">x <sup>2</sup>
            +<input type="text" name="b" style="width: 20px" value="<?=$b?>">x
            +<input type="text" name="c" style="width: 20px" value="<?=$c?>"> = 0
            <br/><br/>
            <input type="submit" name="tinh" value="Tính">
        </form>
        <?php
            if(is_numeric($GLOBALS ['a'])&& is_numeric($GLOBALS ['b'])&& is_numeric($GLOBALS ['c']))
            {
                giaiptbac2($GLOBALS ['a'],$GLOBALS['b'],$GLOBALS ['c']);
            }
            else
            {
                echo "Input khong hop le";
            }
        ?>
    </body>
</html>