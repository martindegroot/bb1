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
            echo '<li>'.$file.
                ' <a target="_blank" href="'.Yii::app()->createUrl('pdfbestanden/test02',
                                                array(
                                                    'pdfbestand' => base64_encode($file),
                                            )) .
                  '" title="View PDF Meta">View Meta</a>' .
                '</li>';
  
        }    
        echo '</ul>';      
    }
?>
