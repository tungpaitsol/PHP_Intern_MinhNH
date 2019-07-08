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

    private $_value;

    function getValue()
    {
        return $this->_value;
    }

    function __construct($code, $value)
    {
        $this->_code = $code;
        $this->_value = $value;
    }
}

class Locale
{
    private static $instance;
    private static $currentLanguage;

    /**
     * @param string $value
     * @param string $lang
     * @return Language
     */
    static function getInstance($value, $lang)
    {
        if (!self::$instance || $lang != self::$currentLanguage) {
            self::$instance = new Language($lang, $value);
            self::$currentLanguage = $lang;
        }
        return self::$instance;
    }


    /**
     * @param string $index
     * @param string $lang
     * @return string
     */
    static function getLanguage($index, $lang = 'eng')
    {
        if ($_SESSION['lang']) {
            $lang = $_SESSION['lang'];
        }
        $fp = file($lang . '.txt');
        for ($i = 0; $i < count($fp); $i++) {
            $current = explode("=", $fp[$i]);
            $key[$i] = $current[0];
            $value[$i] = str_replace('"', '', $current[1]);
            $array = array_combine($key, $value);
        }
        $language = self::getInstance($array, $lang);
        if (isset($language->getValue()[$index])) {

            return $language->getValue()[$index];

        }
        return $index;
    }
}

if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
    $lang = $_SESSION['lang'];
}
$lang = $_SESSION['lang'];
echo Locale::getLanguage('name', $lang);
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

    <form method="post">
        <h2><?php echo Locale::getLanguage('register', $lang) ?></h2>
        <p class="hint-text"><?php echo Locale::getLanguage('create', $lang); ?></p>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-6"><input type="text" class="form-control" name="first_name"
                                             placeholder="<?php echo Locale::getLanguage('firstName', $lang); ?>"
                                             required="required"></div>
                <div class="col-xs-6"><input type="text" class="form-control" name="last_name"
                                             placeholder="<?php echo Locale::getLanguage('lastName', $lang); ?>"
                                             required="required"></div>
            </div>
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email"
                   placeholder="<?php echo Locale::getLanguage('email', $lang); ?>" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password"
                   placeholder="<?php echo Locale::getLanguage('passWord', $lang); ?>" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="confirm_password"
                   placeholder="<?php echo Locale::getLanguage('conFirm'); ?>" required="required">
        </div>
        <div class="form-group">
            <label class="checkbox-inline"><input type="checkbox"
                                                  required="required"><?php echo Locale::getLanguage('conFirm', $lang); ?>
                <a href="#"><?php echo Locale::getLanguage('terms1', $lang); ?></a> &amp;
                <a href="#"><?php echo Locale::getLanguage('Privacy', $lang); ?></a></label>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block">Register Now</button>
        </div>
    </form>
    <div class="text-center">Already have an account? <a href="#">Sign in</a></div>
</div>

</body>
</html>


















