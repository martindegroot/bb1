<?php
    // horizontale menu direct onder de header uit het layout template:
    $mb = new MenuBuilder();
    echo $mb->buildMenu($encodedRedirectLabel, $encodedRedirectUrl);

    // voor nieuwe klantgegevens invoeren menu wil ik terug naar deze pagina klantenlijst
    // daarom moet ik de waarden van 'encodedRedirectLabel'en 'encodedRedirectUrl' zetten op de waarden voor deze pagina
    $thisPageLabel = 'Klantenlijst';
    $encodedThisPageLabel = base64_encode($thisPageLabel);
    $thisPageUrl = Yii::app()->createUrl('klant/index');
    $encodedThisPageUrl = base64_encode($thisPageUrl);
    $this->menu=array(
	    array('label'=>'Nieuwe klantgegevens invoeren', 'url'=>array('create',
                                                                  'encodedRedirectLabel' => $encodedThisPageLabel,
                                                                  'encodedRedirectUrl' => $encodedThisPageUrl)),
	                                                              array('label'=>'Klantgegevens beheren', 'url'=>array('admin')),
);
?>
<h6>&nbsp;</h6>
<h3><?php
             echo $thisPageLabel;
    ?></h3>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
