    <?php
    /* @var $this KlantController */
    /* @var $klant  Klant  in the action controller/actions
    which use this view the variable model has been replaced by the variable klant */

    BreadcrumbsBuilder::replacePlaceholder($encodedBreadcrumbsstr, 'klant-admin-encodedBreadcrumbsstr');

    $breadcrumbsArr = BreadcrumbsBuilder::decodeBreadcrumbs($encodedBreadcrumbsstr);

    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => $breadcrumbsArr,
    ));

    ?>
    <?php if(Yii::app()->user->hasFlash('successWachtwoordGewijzigd')) : ?>
        <div class="flash-success">
            <h4><?php echo Yii::app()->user->getFlash('successWachtwoordGewijzigd'); ?></h4>
        </div>
        <?php endif; ?>
    <?php
    $this->menu=array();

    /*
    Deze view gebruik ik voortaan alleen als startpagina voor de budgetbeheerder om acties uit te voeren voor
    de specifieke klant $klant (input parameter vanuit de controller klant/view/id)
    Als de klant details bekeken worden door de user van de klant dan moet de menu-optie / route user/updatePassword/id/NNuser_id 
    actief zijn. De voorwaarde is $klant->user->id  == $loggedInUser->id
    Hiervoor moet $klant als variabele vanuit de klantController beschikbaar zijn, en moet het user-object via
    eager loading geladen zijn bij het laden van $klant
    */

    /* bepaal encodedredirecturl en geef deze mee als get parameter
    We willen terugkeren naar deze pagina klant/view id==
    */
    if ($klant->user->id == User::loggedInUser()->id)
    {
        $label = "Mijn wachtwoord wijzigen";
    }
    /* als loggedInUser role budgetbeheerder heeft (eventueel via role admin , 
    dan ook menu optie maken voor wijzigen wachtwoord van de klant)*/
    elseif (Yii::app()->user->checkAccess('budgetbeheerder') )
    {
        $label = "Wachtwoord wijzigen"  ;
    }

    ?>

    <?php if(Yii::app()->user->hasFlash('success')) : ?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
        <?php endif; ?>


    <h3>Beheer-pagina van klant: <?php echo $klant->klantnr . ' ' . $klant->adresseernaam; ?></h3>

    <?php $this->widget('zii.widgets.CDetailView', array(
        'data'=>$klant,
        'attributes'=>array(
            'klantnr',
            'email',
            'telefoonnr',
            'straathuisnr',
            'postcode',
            'woonplaats',
        ),
    ));
    ?>
    <HR>
    <?php
    /*
        De verticale menu-items moeten een nieuwe $encodedBreadcrumbsstr mee krijgen in de url
        Deze moet bestaan uit de breadcrums van deze view, uitgebreid met de breadcrumb voor de huidige
        route. De $encodedBreadcrumbsstr voor de huidige route is wel gelijk aan de breadcrumbs voor deze
        view. Aanpak: eerst de huidige breadcrumbs in array vorm ophalen
    */ 

    // hier een element aan toevoegen, een string opgebouwd uit $label # $url voor de huidige route
    $label = 'Beheerpagina klant ' . $klant->klantnr;
    $url = Yii::app()->createUrl('klant/view', array(
                                  'id' => $klant->id,
                                  'encodedRedirectLabel' => null,
                                  'encodedRedirectUrl' => null,
                                  'encodedBreadcrumbsstr' => $encodedBreadcrumbsstr,));
    $newEncodedBreadcrumbsstr = BreadcrumbsBuilder::getExpandedBreadcrumbsstr($encodedBreadcrumbsstr,
                                                                              $label,
                                                                              $url);
    
    // De returnurl voor wachtwoord wijzigen view is de beheerpagina klant nr xxx, dit is precies $url
    $encodedReturnUrl = base64_encode($url);
    $menuItems[0]['label'] = 'Wachtwoord wijzigen';
    $menuItems[0]['url']   =   Yii::app()->createUrl(
                                'user/updatePassword',
                                 array( 'id'=>$klant->user->id,
                                 'encodedReturnUrl' => $encodedReturnUrl,
                                 'encodedBreadcrumbsstr' => $newEncodedBreadcrumbsstr,  )); 
                                 
    // menu-item voor budgetkop wijzigen , wel returnurl opgeven
    $menuItems[1]['label'] = 'Budget-kop wijzigen';
    $menuItems[1]['url']   =   Yii::app()->createUrl('budgetKop/update', array( 'klantnr'=>$klant->klantnr,
        'encodedReturnUrl' => $encodedReturnUrl,
         'encodedBreadcrumbsstr' => $newEncodedBreadcrumbsstr,  ));

    // menu-item voor Budgetposten beheren maken
    $menuItems[2]['label'] = 'Budgetposten beheren';
    $menuItems[2]['url'] = Yii::app()->createUrl(
        'budgetPost/admin',
        array('klantnr' => $klant->klantnr,
             'encodedBreadcrumbsstr' => $newEncodedBreadcrumbsstr,
             'userIsKlant' => false,)); 
              
    // verticale menu maken:
    $mbv = new MenuBuilder();
    echo $mbv->buildVerticalMenu($menuItems);

    ?>

