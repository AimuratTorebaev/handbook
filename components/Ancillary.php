<?php


class Ancillary {
    private static $m;
    private static $y;

    public static function converter($month){ 
        
        $year = date('Y');      
            
        switch($month){
            case 1: 
                $time = mktime(0,0,0,1,1,$year); 
                return date('Y-m-d H:i:s',$time);
                break;
            case 2: 
                $time = mktime(0,0,0,2,1,$year); 
                return date('Y-m-d H:i:s',$time);
                break;
            case 3: 
                $time = mktime(0,0,0,3,1,$year); 
                return date('Y-m-d H:i:s',$time); 
                break;
            case 4: 
                $time = mktime(0,0,0,4,1,$year); 
                return date('Y-m-d H:i:s',$time); 
                break;
            case 5: 
                $time = mktime(0,0,0,5,1,$year); 
                return date('Y-m-d H:i:s',$time); 
                break;
            case 6: 
                $time = mktime(0,0,0,6,1,$year); 
                return date('Y-m-d H:i:s',$time); 
                break;
            case 7: 
                $time = mktime(0,0,0,7,1,$year); 
                return date('Y-m-d H:i:s',$time); 
                break;
            case 8: 
                $time = mktime(0,0,0,8,1,$year); 
                return date('Y-m-d H:i:s',$time); 
                break;
            case 9: 
                $time = mktime(0,0,0,9,1,$year); 
                return date('Y-m-d H:i:s',$time); 
                break;
            case 10: 
                $time = mktime(0,0,0,10,1,$year); 
                return date('Y-m-d H:i:s',$time); 
                break;
            case 11: 
                $time = mktime(0,0,0,11,1,$year); 
                return date('Y-m-d H:i:s',$time); 
                break;
            case 12: 
                $time = mktime(0,0,0,12,1,$year); 
                return date('Y-m-d H:i:s',$time); 
                break; 
        }
    }
    
    public static function calendar($fill=array(), $m = null, $y = null) {
        
        $month_names=array("январь","февраль","март","апрель","май","июнь",
        "июль","август","сентябрь","октябрь","ноябрь","декабрь"); 
        if (isset($y)){      
             self::$y=$y;           
        }
        if (isset($m)){     
            self::$m=$m;        
        } 
        if (!isset($y) or $y < 1970 or $y > 2037){     
            self::$y=date("Y");
        }
        if (!isset($m) OR $m < 1 OR $m > 12){ 
            self::$m=date("m");
        }

        $month_stamp=mktime(0,0,0, self::$m,1, self::$y);
        $day_count=date("t",$month_stamp);
        $weekday=date("w",$month_stamp);
        if ($weekday==0){ 
            $weekday=7;
        }
        $start=-($weekday-2);
        $last=($day_count+$weekday-1) % 7;
        if ($last==0){
            $end=$day_count;
        }
        else{ 
            $end=$day_count+7-$last;
        }
        $today=date("Y-m-d");
        $prev=date('/m/Y',mktime (0,0,0, self::$m-1,1, self::$y));  
        $next=date('/m/Y',mktime (0,0,0, self::$m+1,1, self::$y));
        $i=0;

        $calendar = "<table border=1 cellspacing=0 cellpadding=2> 
       <tr>
        <td colspan=7> 
         <table width='100%' border=0 cellspacing=0 cellpadding=0> 
          <tr> 
           <td align='left'><a href='".$prev."'>&lt;&lt;&lt;</a></td> 
           <td align='center'>".$month_names[self::$m-1].''.self::$y."</td> 
           <td align='right'><a href='".$next."'>&gt;&gt;&gt;</a></td> 
          </tr> 
         </table> 
        </td> 
       </tr> 
       <tr><td>Пн</td><td>Вт</td><td>Ср</td><td>Чт</td><td>Пт</td><td>Сб</td><td>Вс</td><tr>
      ";
         for($d=$start;$d<=$end;$d++) { 
          if (!($i++ % 7)){ 
              $calendar .= " <tr>\n";
          }
          $calendar .= '  <td align="center">';
          if ($d < 1 OR $d > $day_count) {
            $calendar .= "&nbsp";
          } else {
            $now="$y-$m-".sprintf("%02d",$d);
            if (is_array($fill) AND in_array($now,$fill)) {
              $calendar .= '<b><a href="'.$_SERVER['PHP_SELF'].'?date='.$now.'">'.$d.'</a></b>'; 
            } else {
              $calendar .= $d;
            }
          } 
          $calendar .= "</td>\n";
          if (!($i % 7)){ 
              $calendar .= " </tr>\n";
          }
        } 
      $calendar .= '</table>';
      return $calendar;
    }

    public static function getYear(){
        return self::$y;
    }
    
    public static function getMonth(){
        return self::$m;
    }

    public static function clearStr($data){
        return trim(strip_tags($data));
    }
    
    public static function clearInt($data){
        return abs((int)$data);
    }
    
    public static function addImage($id){
        if (is_uploaded_file($_FILES["image"]["tmp_name"])) {            
            move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/{$id}.jpg");
        }
    }
    
    public static function getImage($id){
        $noImage = 'no-image.jpg';
        $path = '/upload/images/';
        $pathToImage = $path . $id . '.jpg';
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToImage)) {
            self::cropImage($_SERVER['DOCUMENT_ROOT'] . "{$pathToImage}", $_SERVER['DOCUMENT_ROOT'] . "{$pathToImage}", 520, 440);
            return $pathToImage;
        }
        return $path . $noImage;
    }
    
    public static function cropImage($aInitialImageFilePath, $aNewImageFilePath, $aNewImageWidth, $aNewImageHeight) {
        
        if (($aNewImageWidth < 0) || ($aNewImageHeight < 0)) {
            return false;
        }

        $lAllowedExtensions = array(1 => "gif", 2 => "jpeg", 3 => "png"); 

        list($lInitialImageWidth, $lInitialImageHeight, $lImageExtensionId) = getimagesize($aInitialImageFilePath); 

        if (!array_key_exists($lImageExtensionId, $lAllowedExtensions)) {
            return false;
        }
        $lImageExtension = $lAllowedExtensions[$lImageExtensionId];

        $func = 'imagecreatefrom' . $lImageExtension; 
        $lInitialImageDescriptor = $func($aInitialImageFilePath);

        $lCroppedImageWidth = 0;
        $lCroppedImageHeight = 0;
        $lInitialImageCroppingX = 0;
        $lInitialImageCroppingY = 0;
        if ($aNewImageWidth / $aNewImageHeight > $lInitialImageWidth / $lInitialImageHeight) {
            $lCroppedImageWidth = floor($lInitialImageWidth);
            $lCroppedImageHeight = floor($lInitialImageWidth * $aNewImageHeight / $aNewImageWidth);
            $lInitialImageCroppingY = floor(($lInitialImageHeight - $lCroppedImageHeight) / 2);
        } else {
            $lCroppedImageWidth = floor($lInitialImageHeight * $aNewImageWidth / $aNewImageHeight);
            $lCroppedImageHeight = floor($lInitialImageHeight);
            $lInitialImageCroppingX = floor(($lInitialImageWidth - $lCroppedImageWidth) / 2);
        }

        $lNewImageDescriptor = imagecreatetruecolor($aNewImageWidth, $aNewImageHeight);
        imagecopyresampled($lNewImageDescriptor, $lInitialImageDescriptor, 0, 0, $lInitialImageCroppingX, $lInitialImageCroppingY, $aNewImageWidth, $aNewImageHeight, $lCroppedImageWidth, $lCroppedImageHeight);
        $func = 'image' . $lImageExtension;

        return $func($lNewImageDescriptor, $aNewImageFilePath);
    }
    
    public static function cur($cur){
        $curs = array('rub'=>'РУБ', 'usd'=>'USD');
        $sel = '<form action="" method="post" name="form"> '
                . '<select name="currency" onchange="this.form.submit()">';  
        foreach ($curs as $value=>$valuetext) {
        if (trim($cur) == $value) {
        $selected = 'selected="selected"';
        } else { $selected = ''; }
        $sel .='<option '.$selected.' value="'.$value.'">'.$valuetext.'</option>';
        }
        $sel .='</select></form>';
        return $sel;
    }
    
    public static function isCurSet(){
        if(isset($_SESSION['curency'])){
            return $_SESSION['curency'];
        }else {
            return 'rub';
        }
    }

}
