<?php
  class Utils
  {
    public static function guid() {
        if (function_exists('com_create_guid')){
            return com_create_guid();
        } else{
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = chr(123)// "{"
                    .substr($charid, 0, 8).$hyphen
                    .substr($charid, 8, 4).$hyphen
                    .substr($charid,12, 4).$hyphen
                    .substr($charid,16, 4).$hyphen
                    .substr($charid,20,12)
                    .chr(125);// "}"
            return $uuid;
        }    
    }
      public static function file_get_contents_utf8($filename)
      {
         $content = file_get_contents($filename);
         $content2 = str_replace(chr(128), "!@#$", $content);
         $content3 = mb_convert_encoding($content2, 'UTF-8',
                      mb_detect_encoding($content2, 'UTF-8, ISO-8859-1', true));
         $content4 = str_replace("!@#$", "€", $content3);
         return $content4;       
      }    
  }

?>
