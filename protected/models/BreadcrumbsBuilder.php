<?php
  class BreadcrumbsBuilder
  {
    public static function decodeBreadcrumbs($encodedBreadcrumbs) 
   {
        $breadcrumbsstr = base64_decode($encodedBreadcrumbs);
        $breadcrumbsArr = explode("!", $breadcrumbsstr) ;
        foreach($breadcrumbsArr as $oneBreadcrumb)
        {
            list($label, $url) = explode("#", $oneBreadcrumb);
            $arrayBreadcrumbs[$label] = $url;
        }
        return $arrayBreadcrumbs;
   }  
   
   private static function getDecodedBreadcrumbsArr($encodedBreadcrumbs) 
   {    
        $breadcrumbsstr = base64_decode($encodedBreadcrumbs);
        $breadcrumbsArr = explode("!", $breadcrumbsstr) ;
        return $breadcrumbsArr;
   }
 
   public static function getExpandedBreadcrumbsstr($oldEncodedBreadcrumbsstr,
                                                   $newLabel,
                                                   $newUrl )
   {  
     $arrayBreadcrumbs = self::getDecodedBreadcrumbsArr($oldEncodedBreadcrumbsstr);
     // hier moet nu een element aan toegevoegd worden gebaseerd op $newLabel en $newUrl
     
     $arrayBreadcrumbs[] =  $newLabel . "#" . $newUrl;
     
     $newBreadcrumbsstr = implode("!",$arrayBreadcrumbs);
     $newEncodedBreadcrumbsstr = base64_encode($newBreadcrumbsstr);
     return $newEncodedBreadcrumbsstr;
   }
   
      public static function  insertEncodedBreadcrumbsStr(
            $sleutel, $waarde)
      {
        self::deleteEncodedBreadcrumbsStr($sleutel);  
        $sql =  "INSERT INTO instellingen (sleutel, tekstwaarde) VALUES('"
                . $sleutel . "' , '" 
                . $waarde . "')";
        $cmd = Yii::app()->db->createCommand($sql);
        $cmd->execute();            
      }
      
      public static function deleteEncodedBreadcrumbsStr($sleutel)
      {
        $sql = "DELETE FROM instellingen WHERE sleutel = '"
                . $sleutel . "'";
        $cmd = Yii::app()->db->createCommand($sql);
        $cmd->execute();                            
      }
      
      /**
      * This function looks up the record in tabel instellingen where the column "sleutel"
      * has the value $placeholder and puts the value of the column "tekstwaarde" in the reference
      * variable $encodedString
      * 
      * @param {mixed|string} $encodedString
      * @param mixed $placeholder
      */
      public static function replacePlaceholder(&$encodedString,
                                               $placeholder) 
      {
        if($encodedString == $placeholder) 
        {
         // haal de record op uit tabel instellingen met waarde $placeholder voor veld sleutel
         $sql = "SELECT tekstwaarde FROM instellingen " .
                " WHERE sleutel = '" . $placeholder ."'";  
         $cmd = Yii::app()->db->createCommand($sql);
         $encodedString = $cmd->queryScalar();                      
        }   
      } 
  }
?>