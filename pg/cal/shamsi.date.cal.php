<?php
  include_once 'date.converter.cal.php';
  date_default_timezone_set("Asia/Tehran");

  function getMyDate($mode){
    $date = date('Y-m-d H:i:s');
    $dateArray = date_parse($date);
    $weekdayArray = array('یکشنبه','دوشنبه', 'سه‌شنبه', 'چهارشنبه', 'پنج‌شنبه', 'جمعه', 'شنبه');
    $weekday = $weekdayArray[date('w', strtotime($date))];
    $shamsiDateArray = gregorian_to_jalali($dateArray['year'], $dateArray['month'], $dateArray['day']);
    $d=mktime($dateArray['hour'], $dateArray['minute'], $dateArray['second'], 8, 12, 2014);
    $shamsiJDate =  $shamsiDateArray[0]."-".$shamsiDateArray[1]."-".$shamsiDateArray[2];
    $time =  date("H:i:s", $d);
    switch ($mode) {
      case 'shamsiDateTime':
        $dd = $shamsiJDate." ".$time;;
        break;

      case 'shamsiDate':
        $dd = $shamsiJDate;
        break;

      case 'date':
        $dd = date('Y-m-d');
        break;

      case 'dateTime':
        $dd = $date;
        break;

      case 'shamsiDateTimeArray':
        $dd = $shamsiDateArray;
        break;

      case 'shamsiDateArray':
        $dd['d'] = $shamsiDateArray[2];
        $dd['m'] = $shamsiDateArray[1];
        $dd['y'] = $shamsiDateArray[0];
        break;

      case 'dateArray':
        $dd['y'] = $dateArray['year'];
        $dd['m'] = $dateArray['month'];
        $dd['d'] = $dateArray['day'];
        break;

      case 'shamsiDateTimeString':
        $dd = $shamsiDateArray[0].$shamsiDateArray[1].$shamsiDateArray[2].$dateArray['hour'].$dateArray['minute'].$dateArray['second'];
        break;

      case 'time':
        $dd = $time;
        break;

      case 'weekday':
        $dd = $weekday;
        break;

      case 'shamsiFormatedDate':
        if ($shamsiDateArray[1] < 10) {
          $m = '0'.$shamsiDateArray[1];
        } else {
          $m = $shamsiDateArray[1];
        }
        if ($shamsiDateArray[2] < 10) {
          $day = '0'.$shamsiDateArray[2];
        } else {
          $day = $shamsiDateArray[2];
        }
        $dd = $shamsiDateArray[0]."-".$m."-".$day;
        break;

      case 'shamsiYear':
        $dd = $shamsiDateArray[0];
        break;

      default:
        $dd = $shamsiJDate;
        break;
    }
    return $dd;
  }

  function getDateNum($isShamsi){
    $date = date('Y-m-d H:i:s');
    $dateArray = date_parse($date);
    $shamsiDateArray = gregorian_to_jalali($dateArray['year'], $dateArray['month'], $dateArray['day']);
    if ($isShamsi) {
      $dateNum = $shamsiDateArray[0].$shamsiDateArray[1].$shamsiDateArray[2].$dateArray['hour'].$dateArray['minute'].$dateArray['second'];
    } else {
      $dateNum = $dateArray['year'].$dateArray['month'].$dateArray['day'].$dateArray['hour'].$dateArray['minute'].$dateArray['second'];
    }
    return $dateNum;
  }
?>
