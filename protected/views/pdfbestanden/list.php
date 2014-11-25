<?php
/* @var $this PdfbestandenController */

$this->breadcrumbs=array(
	'Pdfbestanden'=>array('/pdfbestanden'),
	'List',
);
?>
<h3><?php echo $this->id . '/' . $this->action->id; ?></h3>
<p>
  Dit wordt een testje
</p>
<?php 
    if($message != '') {
        echo $message;
    }
    
    if(is_array($files))  {
        echo '<ul>';
        foreach ($files as $file) {
//            echo '<li>'.$file.
//                ' <a href="'.Yii::app()->createUrl('pdfbestanden/viewmeta',
//                                                array(
//                                                    'encodedFile' => base64_encode($file),
//                                            )) .
//                  '" title="View PDF Meta">View Meta</a>' .
//                '</li>';
            // extract the filename
            $filename  = basename($file, ".htm") . "_Page1.htm";
            $file_Dir = basename($file, ".htm") . "_Dir";
            echo '<li>'.
                ' <a target="_blank" href="../../../../scans/' . $file_Dir . "/"  . $filename . '"' .
                           ' title="Bekijk deze file">' . $filename . '</a>' .
                '</li>';  }
        echo '</ul>';        
    }
?>
