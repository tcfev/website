<?php

  $allowedImage = array('jpg', 'jpeg', 'png', 'bmp');
  $allowedDoc = array('doc','xls', 'docx', 'pdf', 'xlsx', 'jpg', 'jpeg', 'png', 'bmp', 'svg');

  function e($str){
    $str = htmlspecialchars($str, ENT_QUOTES, 'UTF-8');

    return $str;
  }

  function r($str) {
    global $con;
    return $con->real_escape_string($str);
  }

  function getToday(){
    $data = getMyDate('dateArray');
    // var_dump($data);
    echo json_encode($data);
  }

  function checkUserLogin(){
    $secret = $_POST['secret'];
    if ($secret == 'karaco') {
      if (isset($_SESSION['u_uid'])) {
        $msg['msg'] = 'success';
        $msg['uid'] = $_SESSION['u_uid'];
      } else {
        $msg['msg'] = 'session is not set';
      }
    } else {
      $msg['msg'] = 'unauthurized access';
    }

    echo json_encode($msg);
  }

  function generateRandomString($length) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }

  function encryptRandomString($length, $letter) {
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $l = $characters[rand(0, $charactersLength - 1)];
        if ($l != $letter) {
          $randomString .= $l;
        }

    }
    return $randomString;
  }

  function logAct($act){
    global $con, $uid;
    $shamsiJDate = getMyDate(1);
    $time = getMyDate(8);
    $sql = $con->query("INSERT INTO logs(mID, Act, Date, Time) VALUES('$uid', '$act' , '$shamsiJDate', '$time')");
  }

  function getShamsiDate($thisDate, $jd){
    include_once 'date.converter.inc.php';
    date_default_timezone_set("Asia/Tehran");
    $date = $thisDate;
    $dateArray = date_parse($date);
    $jDate = date('Y-m-d');

    $shamsiDateArray = gregorian_to_jalali($dateArray['year'], $dateArray['month'], $dateArray['day']);
    $d=mktime($dateArray['hour'], $dateArray['minute'], $dateArray['second'], 8, 12, 2014);
    $shamsiJDate =  $shamsiDateArray[0]."-".$shamsiDateArray[1]."-".$shamsiDateArray[2];
    $time =  date("h:i:s", $d);
    $shamsiDate = $shamsiJDate." ".$time;

    if ($jd) {
      return $shamsiJDate;
    } else {
      return $shamsiDate;
    }
  }

  function encryptMsg($content, $mID2){
    $content64 = base64_encode($content);
    $array = preg_split('//u', $content64, -1, PREG_SPLIT_NO_EMPTY);
    $letter = getEncryptLetter($mID2);
    $rndLenght = rand(1, 5);
    $chatMsg = encryptRandomString($rndLenght, $letter);
    $lVal = letterNumber(mb_substr($chatMsg, 0, 1));
    for ($i=0; $i < count($array); $i++) {
      $array[$i] = $lVal * ord($array[$i]);
    }
    $asciStr = $array[0];
    for ($i=1; $i < count($array); $i++) {
      $asciStr .= $letter.$array[$i];
    }
    $acsiArray = preg_split('//u', $asciStr, -1, PREG_SPLIT_NO_EMPTY);
    for ($i=0; $i < count($acsiArray); $i++) {
      $lNum = $acsiArray[$i];
      $rndLenght = rand(1, 4);
      $rndS = encryptRandomString($rndLenght, $letter);
      $chatMsg .= $lNum.$rndS;
    }

    return $chatMsg;
  }

  function decryptMsg($content, $mID2){
    $lVal = letterNumber(mb_substr($content, 0, 1));
    $letter = getEncryptLetter($mID2);
    $content = preg_replace(".$letter.", "$", $content);
    $content = preg_replace("/[^0-9,$]/", "", $content);
    $array = explode("$", $content);
    for ($i=0; $i < count($array); $i++) {
      $array[$i] = chr($array[$i] / $lVal);
    }
    $msg = base64_decode(implode("", $array));
    return $msg;
  }

  function getEncryptLetter($mID2){
    global $mid;
    $abc = 'abcdefghijklmnopqrstuvwxyz';
    $letter = $abc[($mid + $mID2) % 26];
    return $letter;
  }

  function letterNumber($char){
    $abc = 'abcdefghijklmnopqrstuvwxyz';
    return strpos($abc, $char) + 1;
  }

  function sendNot($txt, $recID, $notType, $dID, $title){
    global $con, $mid;
    $date = getMyDate(0);
    $sql = $con->query("INSERT INTO notification(Type, uID, recID, dID, Date, Text, isDeleted) VALUES('$notType', '$mid', '$recID', '$dID', '$date', '$txt', '0')");
    $to = getToken($recID);
    if (!isset($title)) {
      $title = 'بدون عنوان';
    }
    if (!empty($to) && isset($to)) {
      $lkey = 'AIzaSyBuqZATX2A3dTe2k4cy6oVBc4UDGxtG6OQ';
      $skey = 'AAAAgdXBC7g:APA91bEpD0EUpF72Ay0b1o0qqfI6KJkMQ7Al4u4NP7NTAS7Oeu1YRJf3moZciRkvkQ6_Z3Kch-P8PT1xNLq7CLKnZ2uhSoj1JeGFLvG5iefn4HjW9WRSKEpFrOWWN3ImX69FkMQMaHdt';
      $data = array("title" => $title, "text" => $txt);

      $url = 'https://fcm.googleapis.com/fcm/send';
      $posts = array("to" => $to, "data" => $data);
      $header = array('Authorization:key='.$lkey, 'Content-Type: application/json');

      $curl = curl_init( $url );
      curl_setopt( $curl, CURLOPT_POST, 1);
      curl_setopt( $curl, CURLOPT_POSTFIELDS, json_encode($posts));
      curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt( $curl, CURLOPT_HTTPHEADER, $header);
      curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, 0);

      return curl_exec($curl);
    } else {
      return 0;
    }
  }

  function getToken($mID){
    global $con;
    $row = $con->query("SELECT Token FROM members WHERE ID = '$mID'")->fetch_assoc();
    return $row['Token'];
  }

  function setToken(){
    global $con;
    if (isset($_SESSION['u_uid'])){
      $mid = $_SESSION['u_uid'];
      $token = $con->real_escape_string($_POST['token']);
      $stmt = $con->prepare("UPDATE members SET Token = ? WHERE ID = ?");
      $stmt->bind_param("si", $token, $mid);
      if (!$stmt->execute()) {
        $msg['msg'] = 'خطا در ثبت توکن';
        $msg['res'] = 0;
      } else {
        $msg['msg'] = 'توکن با موفقیت ثبت شد';
        $msg['res'] = 1;
        $msg['token'] = $token;
        $msg['mid'] = $mid;
      }
    } else {
      $msg['msg'] = 'درخواست نامعتبر';
      logAct('درخواست نامعتبر توکن');
      $msg['res'] = 0;
    }

    echo json_encode($msg);
  }

  function rc($row, $array){
    for ($i=0; $i < count($array); $i++) {
      for ($j=0; $j < count($row); $j++) {
        foreach ($row[$j] as $key => $value) {
          if ($key == $array[$i]) {
            unset($row[$j][$key]);
          }
        }
      }
    }
    return $row;
  }

  function getIpAddress(){
    return getenv('HTTP_X_FORWARDED_FOR');
  }

  function combo(){
    global $con;
    $t = $_POST['table'];
    $k = $_POST['keyName'];
    $v = $_POST['value'];
    $a = $_POST['alt'];
    $whereStr = "";

    $kArray = explode('+', $k);
    if (count($kArray) > 1) {
      $k0 = "CONCAT(".$kArray[0];
      for ($i=1; $i < count($kArray); $i++) {
        $k0 .= ", ' ', ".$kArray[$i];
      }
      $k0 .= ")";
    } else {
      $k0 = $kArray[0];
    }
    if (isset($_POST['lang'])) {
      $lang = $_POST['lang'];
      $langStr = "AND Lang = '$lang'";
    } else {
      $langStr = "";
    }

    if (isset($_POST['condCol'])) {
      $cc = $_POST['condCol'];
      $cv = $_POST['condVal'];
      $whereStr = "WHERE $cc = '$cv'";
    }

    $sql = "SELECT $k0 AS Text, $v AS Value, $a AS Alt FROM $t $whereStr $langStr";
    $row = $con->query($sql)->fetch_all(MYSQLI_ASSOC);
    echo json_encode($row);
  }

  function uploadFile($file, $tmp, $path, $type, $size, $allowedSize){
    global $allowedImage, $allowedDoc;
    if ($type == 'img') {
      $allowed = $allowedImage;
    } elseif ($type == 'doc') {
      $allowed = $allowedDoc;
    }
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if (in_array($ext, $allowed)){
      if ($size > $allowedSize) {
        $rtn = 'File size must be smaller than '.($allowedSize/1024).' KB';
      } else {
        $fullPath = $_SERVER['DOCUMENT_ROOT'].root.$path;
        if (!move_uploaded_file($tmp, $fullPath)) {
          $rtn = 'Error: Cannot upload the file';
        } else {
          $rtn = 0;
        }
      }
    } else {
      $rtn = 'Unsupported media file format';
    }
    return $rtn;
  }

  function uploadImageCrop($file, $tmp, $path, $size, $allowedSize, $ratio, $minW){
    global $allowedImage;
    $allowed = $allowedImage;
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if (in_array($ext, $allowed)){
      if ($size > $allowedSize) {
        $rtn = 'File size must be smaller than '.($allowedSize/1000).' KB';
      } else {
        $fullPath = $_SERVER['DOCUMENT_ROOT'].root.$path;

        if ($minW > 0) {
          $tmp = resamplePhoto($tmp, $minW, $ext);
          if ($ratio > 0) {
            $tmp = cropPhoto($ratio, $tmp, $ext, true);
          } else {
            $tmp = $tmp['tmp'];
          }
        } else {
          if ($ratio > 0) {
            $tmp = cropPhoto($ratio, $tmp, $ext, false);
          }
        }


        if ($ext == 'png') {
          if (!imagepng($tmp, $fullPath, 5)){
            $rtn = 'Error: Cannot upload the file';
          } else {
            $rtn = 0;
          }
        } elseif ($ext == 'jpeg' || $ext == 'jpg') {
          if (!imagejpeg($tmp, $fullPath, 80)){
            $rtn = 'Error: Cannot upload the file';
          } else {
            $rtn = 0;
          }
        }
        
      }
    } else {
      $rtn = 'Unsupported media file format';
    }
    return $rtn;
  }

  function cropPhoto($ratio, $photo, $ext, $mode){
    if ($mode) {
      $src = $photo['tmp'];
      $photo_width = $photo['w'];
      $photo_height = $photo['h'];
    } else {
      if ($ext == 'png') {
        $src = imagecreatefrompng($photo);
      } elseif ($ext == 'jpeg' || $ext == 'jpg'){
        $src = imagecreatefromjpeg($photo);
      } elseif ($ext == 'bmp'){
        $src = imagecreatefrombmp($photo);
      }

      list($photo_width, $photo_height) = getimagesize($photo);
    }

    $thisRatio = $photo_width / $photo_height;
    if ($thisRatio > $ratio) {
      $w = $photo_height * $ratio;
      $h = $photo_height;
      $x = ($photo_width - $w) / 2;
      $y = 0;
    } else {
      $w = $photo_width;
      $h = $photo_width / $ratio;
      $y = ($photo_height - $h) / 2;
      $x = 0;
    }
    $img = array();
    $newImg = imagecrop($src, ['x' => $x, 'y' => $y, 'width' => $w, 'height' => $h]);

    return $newImg;
  }

  function resamplePhoto($tmp, $minW, $ext){
    if ($ext == 'png') {
      $src = imagecreatefrompng($tmp);
    } elseif ($ext == 'jpeg' || $ext == 'jpg'){
      $src = imagecreatefromjpeg($tmp);
    } elseif ($ext == 'bmp'){
      $src = imagecreatefrombmp($tmp);
    }

    list($photo_width, $photo_height) = getimagesize($tmp);
    $min_width = $minW;
    $min_height = ($photo_height / $photo_width) * $min_width;

    $tmp_photo_min = imagecreatetruecolor($min_width, $min_height);
    imagealphablending($tmp_photo_min, false);
    imagesavealpha($tmp_photo_min, true);
    $transparent = imagecolorallocatealpha($tmp_photo_min, 255, 255, 255, 0);
    imagefilledrectangle($tmp_photo_min, 0, 0, $min_width, $min_height, $transparent);
    imagecopyresampled($tmp_photo_min, $src, 0,0,0,0, $min_width, $min_height, $photo_width, $photo_height);
    $img['tmp'] = $tmp_photo_min;
    $img['w'] = $min_width;
    $img['h'] = $min_height;
    return $img;
  }

  function loadTags(){
    global $con;
    $row = $con->query("SELECT * FROM tags ORDER BY Text ASC")->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
  }

  function tp($str){
    return $newStr = str_replace( array('0','1','2','3','4','5','6','7','8','9'),  array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'), $str);
  }
?>
