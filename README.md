# php-levenshtein
## 调用方法
    require('php-levenshtein.php');
    
    $str1 = 'hello world!';
    $str2 = 'hello php!';
    
    $phpLe = new PHPLevenshtein();
    $res = $phpLe->compute($str1, $str2);
    echo $res;
