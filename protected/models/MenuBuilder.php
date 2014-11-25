<?php
  class MenuBuilder
  {
      private $theMenu='';
      
      public function buildMenu($encodedReturnLabel, $encodedReturnUrl, $menuItems=null)
      {
        $loggedInUser = User::loggedInUser();
        if (is_null($loggedInUser)) {
            $roleLoggedInUser = 'bezoeker';
        }
        else {
           $roleLoggedInUser = $loggedInUser->role;  
        }
       
        
        switch ($roleLoggedInUser)
        {
            case 'klant':
                $klantnr = User::loggedInUser()->klantnr;
                $urlStartPagina = Yii::app()->createUrl('siteauthenticated/startKlant', array('klantnr' => $klantnr));
                break;
            case 'budgetbeheerder':           
                $urlStartPagina = Yii::app()->createUrl('siteauthenticated/startbeheerder');
                break;
            case 'applicatiebeheerder':
                $urlStartPagina = Yii::app()->createUrl('siteauthenticated/startbeheerder');
                break;            
        }
        $menu = '';
        $menu .= '<div id="xmainmenu" style="position: relative; z-index: 200;">'                       . "\r\n";
        $menu .= '<!-- Start css3menu.com BODY section --> ' . "\r\n";
        $menu .= '<ul id="css3menu1" class="topmenu">'       . "\r\n";
        
        $urlSiteContact = Yii::app()->createUrl('/site/contact');
        $urlSiteLogin =   Yii::app()->createUrl('site/login');
        $urlSiteIndex =   Yii::app()->createUrl('site/index');
        $urlSiteAbout = Yii::app()->createUrl('site/page', array('view' => 'about'));
        $urlSiteLogout = Yii::app()->createUrl('site/logout');
        
  if(Yii::app()->user->isGuest  )
   {
        
        $menu .= '  <li class="toproot"><a href="' . $urlSiteIndex  . '" ><span>Startpagina</span></a></li>'      . "\r\n";
        $menu .= '  <li class="toproot"><a href="' . $urlSiteAbout .'"  ><span>Info</span></a></li>'  . "\r\n";
        $menu .= '  <li class="toproot"><a href="' . $urlSiteContact .'" ><span>Contact</span></a></li>'       . "\r\n";
        $menu .= '  <li class="toproot"><a href="' . $urlSiteLogin . '"><span>Inloggen</span></a></li>'                             . "\r\n";         
   }
   else
   {
        $menu .= '  <li class="toproot"><a href="' . $urlSiteIndex  . '" style="width:85px;"><span>Bezoekers</span></a>' . "\r\n";
        $menu .= '    <ul>' . "\r\n";
        $menu .= '      <li><a href="' . $urlSiteIndex  . '" style="width:75px;"><span>Startpagina</span></a></li>'                             . "\r\n";
        $menu .= '      <li><a href="' . $urlSiteAbout .'"  style="width:20px;"><span>Info</span></a></li>'                        . "\r\n";
        $menu .= '      <li><a href="' . $urlSiteContact .'"  style="width:55px;"><span>Contact</span></a></li>'                            . "\r\n";
        $menu .= '    </ul>' . "\r\n";
        $menu .= '  </li>  ' . "\r\n";
        // acties hoofdmenu-item,
        
        if (!is_null($menuItems)) 
        { 
            $menu .= '  <li class="toproot"><a href="#"><span>Acties</span></a>'   . "\r\n";
            $menu .= '    <ul>'                                                    . "\r\n";
            foreach($menuItems as $mi)
            {
              $menu .= '      <li><a href="' . $mi['url'] .'" ><span>' . $mi['label'] . '</span></a></li>'  . "\r\n";
            }
            $menu .= '    </ul>' . "\r\n";
            $menu .= '  </li>'   . "\r\n";
       
        }
    
        $menu .= ' <li><a href="' . $urlSiteLogout . '"><span>Uitloggen (' . Yii::app()->user->name . ')</span></a></li>'                . "\r\n";
        // voorlopig een top-menu item "Externe webpagina's"
        $menu .= '  <li><a href="#" style="width:150px;"><span>Externe&nbsp;webpagina\'s</span></a>' . "\r\n";
        $menu .= '    <ul>' . "\r\n";
        $menu .= '      <li><a href="http://www.belastingdienst.nl" target = "_blank" ><span>Belastingdienst</span></a></li>' . "\r\n";
        $menu .= '      <li><a href="http://www.nibud.nl" target = "_blank" ><span>Nibud</span></a></li>' . "\r\n";
        $menu .= '      <li><a href="http://www.schuldinfo.nl" target = "_blank" ><span>SchuldInfo</span></a></li>' . "\r\n";
        $menu .= '      <li><a href="http://www.schuldhulpmaatje.nl" target = "_blank" ><span>SchuldHulpMaatje</span></a></li>' . "\r\n";
        $menu .= '      <li><a href="http://www.uitdeschulden.nl" target = "_blank" ><span>Uit de schulden</span></a></li>' . "\r\n";
        $menu .= '      <li><a href="http://www.zelfjeschuldenregelen.nl" target = "_blank" ><span>Zelf je schulden regelen</span></a></li>' . "\r\n";
        $menu .= '      <li><a href="http://www.kbvg.nl" target = "_blank" ><span>Bereken beslagvrije voet</span></a></li>' . "\r\n";
        $menu .= '      <li><a href="http://www.schulden.startpagina.nl" target = "_blank" ><span>Schulden startpagina</span></a></li>' . "\r\n";
        $menu .= '      <li><a href="http://www.nvvk.eu" target = "_blank" ><span>NVVK</span></a></li>' . "\r\n";
        
       
        
        $menu .= '    </ul>' . "\r\n";
        $menu .= '  </li>  ' . "\r\n";
        
   } 
        $menu .= '</ul>'                                                                                                                                      . "\r\n";
        $menu .= '</div><!-- xmainmenu -->'                                                                                                                    . "\r\n";
        
        return $menu;
   }
   public function buildVerticalMenu($menuItems = null) 
   {
       // dit hieronder is wat tot nu toe het verticale menu is voor de klant startpagina.
       // Dit ombouwen tot een functie die als input $menuItems heeft.
       // voorlopig: dit is een array van menuItems, elk element is een array met keys 'url' en 'label'
       // het aantal elementen is te vinden als count($menuItems)
       // het eerste menu-item moet class = "topfirst" hebben, de middelse class = "topmenu"
       // en de laatste moet class = "toplast" hebben.
       if (is_array($menuItems))
           $numItems = count($menuItems);
       else 
           $numItems = 0;
       $menu = '';
       $menu .= '<div id="xmainmenu" style="position: relative; z-index: 199;">' . "\r\n";
       $menu .= '<!-- Start css3menu.com BODY section --> ' . "\r\n";
       $menu .= '<ul id="css3menu2" class="topmenu">'  . "\r\n";
     for ($i = 0; $i < $numItems; $i++) {
       if ($i == 0)
           $topDescr = 'topfirst';
       elseif ($i == $numItems - 1)
           $topDescr = 'toplast';
       else
           $topDescr = 'topmenu';
       $menu .= '  <li class="' . $topDescr .'"><a href="' . $menuItems[$i]['url'] . '"><span>' . $menuItems[$i]['label'] .'</span></a></li>' . "\r\n";
     }
       $menu .= '</ul>' . "\r\n";
       $menu .= '<!-- End css3menu.com BODY section -->' . "\r\n";
       $menu .= '</div><!-- mainmenu --> ' . "\r\n";

       return $menu;

   } 
   

}
?>