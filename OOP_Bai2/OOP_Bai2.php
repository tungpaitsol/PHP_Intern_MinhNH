<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OOP Bài 2</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <title>Bootstrap Simple Registration Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="Css.css">
</head>
<body>
<?php session_start();

class Language
{
    private $_code;

    function getCode()
    {
        return $this->_code;
    }

    static function getLanguage($index, $lang = 'eng')
    {
        $fp = file($lang . '.txt');
        for ($i = 0; $i < count($fp); $i++) {
            $current = explode("=", $fp[$i]);
            $key[$i] = $current[0];
            $value[$i] = str_replace('"', '', $current[1]);
            $language = array_combine($key, $value);
        }
        return $language[$index];
    }
}

if (!isset($_GET['lang'])) {
    $_GET['lang'] = "eng";
}
if (isset($_GET['lang']))
    $_SESSION['lang'] = $_GET['lang'];

$lang = $_SESSION['lang'];
echo Language::getLanguage('name', $lang);
?>
<form method="get">
    <div id="m1">
        Select Language :
        <a href="?lang=eng">Tiếng Anh</a>-----
        <a href="?lang=vi">Tiếng Việt</a>
    </div>
    <!--    <a href="?lang=hi">Tiếng Hi</a>-->
</form>
<div class="signup-form">

    <form action="/examples/actions/confirmation.php" method="post">
        <h2><?php echo Language::getLanguage('register', $lang) ?></h2>
        <p class="hint-text"><?php echo Language::getLanguage('create', $lang); ?></p>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-6"><input type="text" class="form-control" name="first_name"
                                             placeholder="<?php echo Language::getLanguage('firstName', $lang); ?>"
                                             required="required"></div>
                <div class="col-xs-6"><input type="text" class="form-control" name="last_name"
                                             placeholder="<?php echo Language::getLanguage('lastName', $lang); ?>"
                                             required="required"></div>
            </div>
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email"
                   placeholder="<?php echo Language::getLanguage('email', $lang); ?>" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password"
                   placeholder="<?php echo Language::getLanguage('passWord', $lang); ?>" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="confirm_password"
                   placeholder="<?php echo Language::getLanguage('conFirm'); ?>" required="required">
        </div>
        <div class="form-group">
            <label class="checkbox-inline"><input type="checkbox"
                                                  required="required"><?php echo Language::getLanguage('conFirm', $lang); ?>
                <a href="#"><?php echo Language::getLanguage('terms1', $lang); ?></a> &amp;
                <a href="#"><?php echo Language::getLanguage('Privacy', $lang); ?></a></label>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block">Register Now</button>
        </div>
    </form>
    <div class="text-center">Already have an account? <a href="#">Sign in</a></div>
</div>

</body>
</html>


















