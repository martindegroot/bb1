<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
?>


<?php

$this->breadcrumbs=array(
	'About',
);


     $mb = new MenuBuilder();
    
    // build the array of menuItems which are to be added to the standard menu, 
    // specific for this page's menu.
    
    echo $mb->buildMenu(null, null);   
?>
<h1>Info</h1>

<p>Deze info pagina is nog niet af, er wordt nog aan gewerkt.</p>
