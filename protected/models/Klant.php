<?php

/**
 * This is the model class for table "klant".
 *
 * The followings are the available columns in table 'klant':
 * @property integer $id
 * @property integer $klantnr
 * @property string $intake_datum
 * @property string $begin_datum
 * @property string $einddatum
 * @property string $beheer_rek_nr
 * @property string $prive_rek_nr
 * @property string $achternaam
 * @property string $voorvoegsel
 * @property string $voorletters
 * @property string $titel
 * @property string $naamgebruik
 * @property string $geboortedatum
 * @property string $bsn
 * @property string $achternaam_partner
 * @property string $voorvoegsel_partner
 * @property string $voorletters_partner
 * @property string $titel_partner
 * @property string $naamgebruik_partner
 * @property string $geboortedatum_partner
 * @property string $bsn_partner
 * @property string $email
 * @property string $telefoonnr
 * @property integer $iddoc_soort
 * @property string $iddoc_nummer
 * @property string $iddoc_geldigtotdatum
 * @property integer $iddoc_partner_soort
 * @property string $iddoc_partner_nummer
 * @property string $iddoc_partner_geldigtotdatum
 * @property string $straathuisnr
 * @property string $postcode
 * @property string $woonplaats
 * @property string $create_time
 * @property integer $create_user_id
 * @property integer $update_user_id
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property User[] $users
 */
class Klant extends Bb1ActiveRecord
{
    
    const SOORT_IDDOC_IDENTITEITSKAART       = 0;
    const SOORT_IDDOC_PASPOORT               = 1;
    const SOORT_ID_DOC_VREEMDELINGENDOCUMENT = 2;
    
    const NAAMGEBRUIK_EIGEN         = 'E';
    const NAAMGEBRUIK_EIGEN_PARTNER = 'EP';
    const NAAMGEBRUIK_PARTNER       = 'P';
    const NAAMGEBRUIK_PARTNER_EIGEN = 'PE';
    
    const TITEL_DHR  = 'Dhr.';
    const TITEL_MEVR = 'Mevr.';
        
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Klant the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
    * Returns the property klantnr based on the value of theinput parameter $id
    */
    public static function getKlantnrFromId($id)
    {
        $klantobj = Klant::model()->findByPk($id);
        return $klantobj->klantnr;
    }
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'klant';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('achternaam', 'required'),
            array('klantnr', 'required', 'on'=> 'page5' ),
			array('klantnr', 'numerical', 'integerOnly'=>true),
            array('email', 'unique'),
            array('email', 'email'),
            array('iddoc_soort, iddoc_partner_soort', 'verifyNullOrInteger' ) ,
            array('bsn, bsn_partner', 'verifyBSN9Cijfers'),
            array('bsn', 'verifyBSNNotExists', 'on' => 'page2'),
            array('bsn_partner', 'verifyBSNNotExists', 'on' => 'page4'),
			array('beheer_rek_nr, prive_rek_nr', 'length', 'max'=>18),
            array('beheer_rek_nr', 'verifyBeheerRekNotExists'),
            array('prive_rek_nr', 'verifyPriveRekNotExists'),
			array('achternaam, voorvoegsel, voorletters, achternaam_partner, voorletters_partner, email, straathuisnr, woonplaats', 'length', 'max'=>45),
			array('titel, voorvoegsel_partner, titel_partner, iddoc_nummer, iddoc_partner_nummer', 'length', 'max'=>30),
			array('naamgebruik, naamgebruik_partner', 'length', 'max'=>2),
			array('telefoonnr', 'length', 'max'=>15),
			array('postcode', 'length', 'max'=>7),
            array('beheer_rek_nr, prive_rek_nr', 'verifyBankRek18Tekens'),
			array('intake_datum, begin_datum, einddatum, geboortedatum, geboortedatum_partner,
                   iddoc_geldigtotdatum, iddoc_partner_geldigtotdatum', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, klantnr, intake_datum, begin_datum, einddatum, beheer_rek_nr, prive_rek_nr, achternaam, voorvoegsel, voorletters, titel, naamgebruik, geboortedatum, bsn, achternaam_partner, voorvoegsel_partner, voorletters_partner, titel_partner, naamgebruik_partner, geboortedatum_partner, bsn_partner, email, telefoonnr, iddoc_soort, iddoc_nummer, iddoc_geldigtotdatum, iddoc_partner_soort, iddoc_partner_nummer, iddoc_partner_geldigtotdatum, straathuisnr, postcode, woonplaats, create_time, create_user_id, update_user_id, update_time', 'safe', 'on'=>'search'),
		);
	}
      public function verifyNullOrInteger($attribute, $params)
      {

         if(!is_null($this->getAttribute($attribute) ) && $this->getAttribute($attribute) != '')
         {       
                if(!ctype_digit($this->getAttribute($attribute)))
                {
                    $attributeLabels = $this->attributeLabels();
                    $labelOfAttribute = $attributeLabels[$attribute] ;
                    $this->addError($attribute,'"' . $labelOfAttribute . '" moet geheel uit cijfers bestaan!'); 
                }
        }      
      }
      
      /**
      *     
      */
      public function verifyBSN9Cijfers($attribute, $params)
      {
         $attributeValue = $this->getAttribute($attribute); 
        if(!is_null($attributeValue ) && $attributeValue != '')
            {   $nrPersoon = $attribute == 'bsn' ? '1' : '2' ;
                if(!ctype_digit($attributeValue))
                {
                    $this->addError($attribute,'BSN persoon ' . $nrPersoon . ': Een BurgerServiceNummer moet geheel uit cijfers bestaan!'); 
                }
                elseif(strlen($attributeValue) != 9)
                {
                    $this->addError($attribute, 'BSN persoon ' . $nrPersoon . ': Een BurgerServiceNummer moet uit 9 cijfers bestaan!');
                }
            }         
      }      
 
       public function verifyBankRek18Tekens($attribute, $params)
      {
         $attributeValue = $this->getAttribute($attribute);
        if(!is_null($attributeValue ) && $attributeValue != '')
            {   
                if(strlen($attributeValue) != 18)
                {
                    $attributeLabels = $this->attributeLabels();
                    $labelOfAttribute = $attributeLabels[$attribute] ;
                    $this->addError($attribute,'"' . $labelOfAttribute . '" moet geheel uit cijfers bestaan!'); 
                    
                  //  $this->addError($attribute, $this->attributeLabels()[$attribute] . ': Een bankrekeningnummer moet uit 18 tekens bestaan!');
                }
            }         
      }      

 
     
         /**
     * On insert this function checks that the value for attribute 'attribute' does
     * not yet exists in the database table. If it does an error is added.
     * 
     */
    public function verifyBSNNotExists($attribute,$params)
    {   
        // Deze functie moet controleren in tabel klant dat er nog geen klant records zijn waarvoor
        // kolom bsn of kolom bsn_partner een waarde heeft gelijk aan de waarde van $attribute in het huidige klant model
        // zowel bsn als bsn_partner moeten gecontroleerd worden 
        $attributeValue =  $this->getAttribute($attribute);
        if (!is_null($attributeValue) && ($attributeValue != '') ) 
        { 
            $klantWithBSN = Klant::model()->findByAttributes(array('bsn'=>$attributeValue));
            if(!is_null($klantWithBSN))
            {
                $this->addError($attribute,'Er is al een klant met  BSN gelijk aan "' . $attributeValue .  '"!'); 
            }
            $klantPartnerWithBSN =  Klant::model()->findByAttributes(array('bsn_partner'=>$attributeValue));
            if(!is_null($klantPartnerWithBSN))
            {
                $this->addError($attribute,'Er is al een klant met partner\'s BSN gelijk aan "' . $attributeValue .  '"!'); 
            }
            // Hier ook controleren dat het bsn en het bsn_partner van huidige klant niet gelijk zijn
            // fout melding geven als het wel zo is
            if (!is_null($this->bsn) && !is_null($this->bsn_partner))
                if ($this->bsn == $this->bsn_partner)
                {
                    if ($attribute=='bsn')
                    {
                         $this->addError($attribute,'"' . $attributeValue .  '" is ook al opgegeven als BSN van de partner!');     
                    }
                    else
                    {
                        $this->addError($attribute,'"' . $attributeValue .  '" is ook al opgegeven als BSN van de klant!');                             
                    }
                }
        }
    }    

      
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::HAS_ONE, 'User', 'klant_id'),
            'budgetkop'  => array(self::HAS_ONE, 'BudgetKop', 'klant_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'klantnr' => 'Klantnr',
			'intake_datum' => 'Intakedatum',
			'begin_datum' => 'Begindatum',
			'einddatum' => 'Einddatum',
			'beheer_rek_nr' => 'Beheer Rekening Nr',
			'prive_rek_nr' => 'Privé Rekening Nr',
			'achternaam' => 'Achternaam&nbsp;persoon&nbsp;1',
			'voorvoegsel' => 'Voorvoegsel&nbsp;persoon&nbsp;1',
			'voorletters' => 'Voorletters persoon 1',
			'titel' => 'Titel persoon 1',
			'naamgebruik' => 'Naamgebruik persoon 1',
            'naamgebruikOmschrijving' => 'Naamgebruik&nbsp;persoon&nbsp;1' ,
			'geboortedatum' => 'Geboortedatum persoon 1',
			'bsn' => 'BSN persoon 1',
			'achternaam_partner' => 'Achternaam&nbsp;persoon&nbsp;2',
			'voorvoegsel_partner' => 'Voorvoegsel&nbsp;persoon&nbsp;2',
			'voorletters_partner' => 'Voorletters&nbsp;persoon&nbsp;2',
			'titel_partner' => 'Titel&nbsp;persoon&nbsp;2',
            'naamgebruik_partner' => 'Naamgebruik&nbsp;persoon&nbsp;2',
            'naamgebruik_partnerOmschrijving' => 'Naamgebruik&nbsp;persoon&nbsp;2',            
			'geboortedatum_partner' => 'Geboortedatum&nbsp;persoon&nbsp;2',
			'bsn_partner' => 'BSN&nbsp;persoon&nbsp;2',
			'email' => 'E-mail adres',
			'telefoonnr' => 'Telefoonnummer',
			'iddoc_soort' => 'Soort&nbsp;identiteitsdocument&nbsp;persoon&nbsp;1',
            'iddocsoortOmschrijving' => 'Soort&nbsp;identiteitsdocument&nbsp;persoon&nbsp;1',
			'iddoc_nummer' => 'Nummer&nbsp;identiteitsdocument&nbsp;persoon&nbsp;1',
			'iddoc_geldigtotdatum' => 'Identiteitsdocument&nbsp;persoon&nbsp;1&nbsp;geldig&nbsp;tot',
			'iddoc_partner_soort' => 'Soort&nbsp;identiteitsdocument&nbsp;persoon&nbsp;2',
            'iddocpartnersoortOmschrijving'  => 'Soort&nbsp;identiteitsdocument&nbsp;persoon&nbsp;2',
			'iddoc_partner_nummer' => 'Nummer&nbsp;identiteitsdocument&nbsp;persoon 2',
			'iddoc_partner_geldigtotdatum' => 'Identiteitsdocument&nbsp;persoon&nbsp;2&nbsp;geldig&nbsp;tot',
			'straathuisnr' => 'Straat&nbsp;en&nbsp;huisnummer',
			'postcode' => 'Postcode',
			'woonplaats' => 'Woonplaats',
			'create_time' => 'Create Time',
			'create_user_id' => 'Create User',
			'update_user_id' => 'Update User',
			'update_time' => 'Update Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('klantnr',$this->klantnr);
		$criteria->compare('intake_datum',$this->intake_datum,true);
		$criteria->compare('begin_datum',$this->begin_datum,true);
		$criteria->compare('einddatum',$this->einddatum,true);
		$criteria->compare('beheer_rek_nr',$this->beheer_rek_nr,true);
		$criteria->compare('prive_rek_nr',$this->prive_rek_nr,true);
		$criteria->compare('achternaam',$this->achternaam,true);
		$criteria->compare('voorvoegsel',$this->voorvoegsel,true);
		$criteria->compare('voorletters',$this->voorletters,true);
		$criteria->compare('titel',$this->titel,true);
		$criteria->compare('naamgebruik',$this->naamgebruik,true);
		$criteria->compare('geboortedatum',$this->geboortedatum,true);
		$criteria->compare('bsn',$this->bsn);
		$criteria->compare('achternaam_partner',$this->achternaam_partner,true);
		$criteria->compare('voorvoegsel_partner',$this->voorvoegsel_partner,true);
		$criteria->compare('voorletters_partner',$this->voorletters_partner,true);
		$criteria->compare('titel_partner',$this->titel_partner,true);
		$criteria->compare('naamgebruik_partner',$this->naamgebruik_partner,true);
		$criteria->compare('geboortedatum_partner',$this->geboortedatum_partner,true);
		$criteria->compare('bsn_partner',$this->bsn_partner);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('telefoonnr',$this->telefoonnr,true);
		$criteria->compare('iddoc_soort',$this->iddoc_soort);
		$criteria->compare('iddoc_nummer',$this->iddoc_nummer,true);
		$criteria->compare('iddoc_geldigtotdatum',$this->iddoc_geldigtotdatum,true);
		$criteria->compare('iddoc_partner_soort',$this->iddoc_partner_soort);
		$criteria->compare('iddoc_partner_nummer',$this->iddoc_partner_nummer,true);
		$criteria->compare('iddoc_partner_geldigtotdatum',$this->iddoc_partner_geldigtotdatum,true);
		$criteria->compare('straathuisnr',$this->straathuisnr,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('woonplaats',$this->woonplaats,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_user_id',$this->update_user_id);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getSoortIDDocOptions()
    {
        return array(
                      self::SOORT_IDDOC_IDENTITEITSKAART       => 'Identiteitskaart',
                      self::SOORT_IDDOC_PASPOORT               => 'Paspoort',
                      self::SOORT_ID_DOC_VREEMDELINGENDOCUMENT => 'Vreemdelingendocument'
                    );
    }
    
    public function getNaamgebruikOptions()
    {
        return array(
                     self::NAAMGEBRUIK_EIGEN          => 'Eigen',
                     self::NAAMGEBRUIK_EIGEN_PARTNER  => 'Eigen-Partner',
                     self::NAAMGEBRUIK_PARTNER        => 'Partner',
                     self::NAAMGEBRUIK_PARTNER_EIGEN  => 'Partner-Eigen',
                    );
    }
    
    public function getTitelOptions()
    {
        return array(
                        self::TITEL_DHR  => 'Dhr.',
                        self::TITEL_MEVR => 'Mevr.',
                    );
    }
    
    public function getNextAvailableKlantnr()
    {
         // find maximum klantnr
        $sql = 'SELECT MAX(klantnr) AS maxKlantnr FROM klant';
        $command = Yii::app()->db->createCommand($sql);
        $maxKlantnr = $command->queryScalar();
        if (is_null($maxKlantnr))
            $maxKlantnr = 1000;
        return $maxKlantnr + 1;     
    }    
    
    public function setKlantnrToNextAvailableNr()
    {
       $this->klantnr = $this->getNextAvailableKlantnr(); 
    }   
    
    /**
     * On insert this function checks that the value for 'beheer_rek_nr' does
     * not yet exists in the database table. If it does an error is added.
     * 
     */
    public function verifyBeheerRekNotExists($attribute,$params)
    {  
        if ($this->beheer_rek_nr =='')
            $this->beheer_rek_nr = null;
        if (!is_null($this->beheer_rek_nr) )
        {
            $klantWithThisBeheerreknr = Klant::model()->findByAttributes(array('beheer_rek_nr'=>$this->beheer_rek_nr));
            if(!is_null($klantWithThisBeheerreknr) && ($klantWithThisBeheerreknr->klantnr != $this->klantnr))
            {
                $this->addError('beheer_rek_nr','Er is al een klant  (klant met klantnr=' .
                                                                        $klantWithThisBeheerreknr->klantnr .
                                                                   ')met dit rekeningnr voor de beheer-rekening!'); 
            }
        }
    }    

   /**
     * On insert this function checks that the value for 'prive_rek_nr' does
     * not yet exists in the database table. If it does an error is added.
     * 
     */
    public function verifyPriveRekNotExists($attribute,$params)
    {
        if ($this->prive_rek_nr =='')
            $this->prive_rek_nr = null;
        if (!is_null($this->prive_rek_nr) )
        {
            $klantWithThisPrivereknr = Klant::model()->findByAttributes(array('prive_rek_nr'=>$this->prive_rek_nr));
            if(!is_null($klantWithThisPrivereknr)  && ($klantWithThisPrivereknr->klantnr != $this->klantnr) )
            {
                $this->addError('prive_rek_nr','Er is al een klant (klant met klantnr=' .
                                                                    $klantWithThisPrivereknr->klantnr .
                                                               ') met dit rekeningnr voor de privé-rekening!'); 
            }
        }
    }          
    /**
    * This function checks whether or not the loggedinuser has either klantnr == null or klantnr == $this.klantnr
    * If this is true, the logged in user "belongs" to this klant and the function returns true; 
    * otherwise the loggedinuser belongs to a different klant and does not belong to this klant, returnvalue is then false
    * 
    */
    public function userBelongsToMe()
    {
        $user = User::loggedInUser();
        return (is_null($user->klantnr) || ($this->klantnr == $user->klantnr) );
    }

    public function getNaamgebruikOmschrijving()
    {
        /* translate $this->naamgebruik (E, EP, P, PE) to longer descriptions:  */
        if (is_null($this->naamgebruik) || trim($this->naamgebruik) == '')
        {
            $naamgebruikOmschr = null;
        }
        else
        {
              $naamgebruikOptions = $this->getNaamgebruikOptions();
              $naamgebruikOmschr = $naamgebruikOptions[$this->naamgebruik];
 
        }
        return $naamgebruikOmschr;
    }
    
    public function getIddocsoortOmschrijving()
    {
        /* translate $this->iddoc_soort (0,1,2) to longer descriptions:  */
        if (is_null($this->iddoc_soort) || trim($this->iddoc_soort) == '')
        {
            $iddoc_soortOmschr = null;
        }
        else
        {
              $iddocsoortOptions = $this->getSoortIDDocOptions();
              $iddoc_soortOmschr = $iddocsoortOptions[$this->iddoc_soort];
 
        }
        return $iddoc_soortOmschr;        
    }

    public function getIddocpartnersoortOmschrijving()
    {
        /* translate $this->iddoc_soort (0,1,2) to longer descriptions:  */
        if (is_null($this->iddoc_partner_soort) || trim($this->iddoc_partner_soort) == '')
        {
            $iddoc_partner_soortOmschr = null;
        }
        else
        {
              $iddocsoortOptions = $this->getSoortIDDocOptions();
              $iddoc_partner_soortOmschr = $iddocsoortOptions[$this->iddoc_partner_soort];
 
        }
        return $iddoc_partner_soortOmschr;        
    }

    
//        const SOORT_IDDOC_IDENTITEITSKAART       = 0;
//    const SOORT_IDDOC_PASPOORT               = 1;
//    const SOORT_ID_DOC_VREEMDELINGENDOCUMENT = 2;


    public function getNaamgebruik_partnerOmschrijving()
    {
        /* translate $this->naamgebruik_partner (E, EP, P, PE) to longer descriptions:  */
        if (is_null($this->naamgebruik_partner) || trim($this->naamgebruik_partner) == '')
        {
            $naamgebruik_partnerOmschr = null;
        }
        else
        {
              $naamgebruikOptions = $this->getNaamgebruikOptions();
              $naamgebruik_partnerOmschr = $naamgebruikOptions[$this->naamgebruik_partner];
 
        }
        return $naamgebruik_partnerOmschr;
    }

    /**
    * getNaamVoluitTitel retourneert de volledige naam, inclusief titel voorletters voorvoegsel achternaam
    * 
    */
    public function getPersoon1NaamVoluitTitel() 
    {
        // naamVoluitTitel bestaat uit titel voorletters voorvoegsel achternaam
        // waarvan alleen achternaam gegarandeerd bestaat
        
        $naamVoluit = '';
        if (!is_null($this->titel))
            $naamVoluit .= $this->titel;
            
        if (!is_null($this->voorletters))
        {
           $spatie = ($naamVoluit != '' ? ' ' : ''); // als naamVoluit niet meer leeg is 
                                                     // eerst een spatie toevoegen
           $naamVoluit .= $spatie . $this->voorletters;
        }

        
         $spatie = ($naamVoluit != '' ? ' ' : ''); // als naamVoluit niet meer leeg is 
                                                  // eerst een spatie toevoegen
        $naamVoluit .= $spatie . $this->getPersoon1GebruikteAchternaam();
        
        return $naamVoluit;       
    } 

    /**
    * getNaamVoluitTitel retourneert de volledige naam, inclusief titel voorletters voorvoegsel achternaam
    * 
    */
    public function getPersoon2NaamVoluitTitel() 
    {
        // naamVoluitTitel bestaat uit titel voorletters voorvoegsel achternaam
        // waarvan alleen achternaam gegarandeerd bestaat
        $persoon2GebruikteAchternaam =  $this->getPersoon2GebruikteAchternaam();
        if($persoon2GebruikteAchternaam == '') {
            return '';
        }
        $naamVoluit = '';
        if (!is_null($this->titel_partner))
            $naamVoluit .= $this->titel_partner;
            
        if (!is_null($this->voorletters_partner))
        {
           $spatie = ($naamVoluit != '' ? ' ' : ''); // als naamVoluit niet meer leeg is 
                                                     // eerst een spatie toevoegen
           $naamVoluit .= $spatie . $this->voorletters_partner;
        }

        
         $spatie = ($naamVoluit != '' ? ' ' : ''); // als naamVoluit niet meer leeg is 
                                                  // eerst een spatie toevoegen
        $naamVoluit .= $spatie . $persoon2GebruikteAchternaam;
        
        return $naamVoluit;       
    } 
    
    
    
    public function getPersoon1NaamVoluitAchter()
    {
        // naamVoluitAchter bestaat uit achternaam, titel voorletters voorvoegsel 
        // waarvan alleen achternaam gegarandeerd bestaat
        //Voorbeelden: Groot, dhr. M. de               E    achternaam, titel voorletters voorvoegsel
        //             Groot-Wijtzes, mevr. A.A. de    PE   achternaam_partner - voorvoegsel achternaam,  titel voorletters voorvoegsel_partner
        //             Boer, dhr. A. de                E
        //             Boer-van der Graaf, mevr. B. de PE   achternaam_partner - voorvoegsel achternaam, titel voorletters voorvoegsel_partner
        //             Boer, mevr. B. de                P   achternaam_partner, titel voorletters voorvoegsel_partner
         $naam = '';
         $naamgebruik = $this->naamgebruik;
        switch ($naamgebruik)  {
            case "E":
                $naam = $this->achternaam;
                if (!is_null($this->titel) || !is_null($this->voorletters) || !is_null($this->voorvoegsel) ) {
                    $naam .= ',';
                }
                if (!is_null($this->titel)) {
                    $naam .= ' ' . $this->titel;
                }
                if(!is_null($this->voorletters)) {
                    $naam .= ' ' . $this->voorletters;
                }
                if (!is_null($this->voorvoegsel)) {
                    $naam .= ' ' . $this->voorvoegsel;
                }
                break;
            case "P":
                $naam = $this->achternaam_partner;
                if (!is_null($this->titel) || !is_null($this->voorletters) || !is_null($this->voorvoegsel_partner) ) {
                    $naam .= ',';
                }
                if (!is_null($this->titel)) {
                    $naam .= ' ' . $this->titel;
                }
                if(!is_null($this->voorletters)) {
                    $naam .= ' ' . $this->voorletters;
                }
               if (!is_null($this->voorvoegsel_partner)) {
                    $naam .= ' ' . $this->voorvoegsel_partner;
                }               
                break;
            case "EP":
             //             Graaf-de Boer, mevr. B. van der EP   achternaam - voorvoegsel_partner Achternaam_partner, titel voorletters, voorvoegsel
                $naam = $this->achternaam;
                if (!is_null($this->achternaam_partner) && trim($this->achternaam_partner) != '' )  {
                     $naam .= '-';
                }
               
                if(!is_null($this->voorvoegsel_partner))  {
                    $naam .= $this->voorvoegsel_partner . ' ';
                }
                $naam .= $this->achternaam_partner;
                if (!is_null($this->titel) || !is_null($this->voorletters) || !is_null($this->voorvoegsel) ) {
                    $naam .= ',';
                }
                if (!is_null($this->titel)) {
                    $naam .= ' ' . $this->titel;
                }
                if(!is_null($this->voorletters)) {
                    $naam .= ' ' . $this->voorletters;
                }
               if (!is_null($this->voorvoegsel)) {
                    $naam .= ' ' . $this->voorvoegsel;
                }                                           
                break;
            case "PE":
            //             Groot-Wijtzes, mevr. A.A. de    PE   achternaam_partner - voorvoegsel achternaam,  titel voorletters voorvoegsel_partner 
                $naam = $this->achternaam_partner;
                $naam .= '-';
                if(!is_null($this->voorvoegsel))  {
                    $naam .= $this->voorvoegsel . ' ';
                }
                $naam .= $this->achternaam;
                if (!is_null($this->titel) || !is_null($this->voorletters) || !is_null($this->voorvoegsel_partner) ) {
                    $naam .= ',';
                }
                if (!is_null($this->titel)) {
                    $naam .= ' ' . $this->titel;
                }
                if(!is_null($this->voorletters)) {
                    $naam .= ' ' . $this->voorletters;
                }
               if (!is_null($this->voorvoegsel_partner)) {
                    $naam .= ' ' . $this->voorvoegsel_partner;
                }                           
                break;
        } 
        return $naam;       
    }
    
    public function getPersoon2NaamVoluitAchter()
    {    /*  Voor persoon2 zijn bijv. achternaam en achternaam_partner net omgekeerd als voor persoon1
             Als achternaam_partner null is of leeg is dan is er geen persoon2 en wordt lege string geretourneerd */
        // naamVoluitAchter bestaat uit achternaam, titel voorletters voorvoegsel 
        // waarvan alleen achternaam gegarandeerd bestaat
        //Voorbeelden: Groot, dhr. M. de               E    achternaam, titel voorletters voorvoegsel
        //             Groot-Wijtzes, mevr. A.A. de    PE   achternaam_partner - voorvoegsel achternaam,  titel voorletters voorvoegsel_partner
        //             Boer, dhr. A. de                E
        //             Boer-van der Graaf, mevr. B. de PE   achternaam_partner - voorvoegsel achternaam, titel voorletters voorvoegsel_partner
        //             Boer, mevr. B. de                P   achternaam_partner, titel voorletters voorvoegsel_partner
        
        if (is_null($this->achternaam_partner) || trim($this->achternaam_partner) == '')
            return '';
        
        switch ($this->naamgebruik_partner)  {
            case "E":
                $naam = $this->achternaam_partner;
                if (!is_null($this->titel_partner) || !is_null($this->voorletters_partner) || !is_null($this->voorvoegsel_partner) ) {
                    $naam .= ',';
                }
                if (!is_null($this->titel_partner)) {
                    $naam .= ' ' . $this->titel_partner;
                }
                if(!is_null($this->voorletters_partner)) {
                    $naam .= ' ' . $this->voorletters_partner;
                }
                if (!is_null($this->voorvoegsel_partner)) {
                    $naam .= ' ' . $this->voorvoegsel_partner;
                }
                break;
            case "P":
                $naam = $this->achternaam;
                if (!is_null($this->titel_partner) || !is_null($this->voorletters_partner) || !is_null($this->voorvoegsel) ) {
                    $naam .= ',';
                }
                if (!is_null($this->titel_partner)) {
                    $naam .= ' ' . $this->titel_partner;
                }
                if(!is_null($this->voorletters_partner)) {
                    $naam .= ' ' . $this->voorletters_partner;
                }
               if (!is_null($this->voorvoegsel)) {
                    $naam .= ' ' . $this->voorvoegsel;
                }               
                break;
            case "EP":
              //              P  -  E  E      P    P   P
             //             Graaf-de Boer, mevr. B. van der EP   achternaam - voorvoegsel_partner Achternaam_partner, titel voorletters, voorvoegsel
                $naam = $this->achternaam_partner;
                $naam .= '-';
                if(!is_null($this->voorvoegsel))  {
                    $naam .= $this->voorvoegsel . ' ';
                }
                $naam .= $this->achternaam;
                if (!is_null($this->titel_partner) || !is_null($this->voorletters_partner) || !is_null($this->voorvoegsel_partner) ) {
                    $naam .= ',';
                }
                if (!is_null($this->titel_partner)) {
                    $naam .= ' ' . $this->titel_partner;
                }
                if(!is_null($this->voorletters_partner)) {
                    $naam .= ' ' . $this->voorletters_partner;
                }
               if (!is_null($this->voorvoegsel_partner)) {
                    $naam .= ' ' . $this->voorvoegsel_partner;
                }                                           
                break;
            case "PE":
            //               E  - P        P       P     P    E
            //             Groot-van der Wijtzes, mevr. A.A. de    PE   achternaam_partner - voorvoegsel achternaam,  titel voorletters voorvoegsel_partner 
                $naam = $this->achternaam;
                $naam .= '-';
                if(!is_null($this->voorvoegsel_partner))  {
                    $naam .= $this->voorvoegsel_partner . ' ';
                }
                $naam .= $this->achternaam_partner;
                if (!is_null($this->titel_partner) || !is_null($this->voorletters_partner) || !is_null($this->voorvoegsel) ) {
                    $naam .= ',';
                }
                if (!is_null($this->titel_partner)) {
                    $naam .= ' ' . $this->titel_partner;
                }
                if(!is_null($this->voorletters_partner)) {
                    $naam .= ' ' . $this->voorletters_partner;
                }
               if (!is_null($this->voorvoegsel)) {
                    $naam .= ' ' . $this->voorvoegsel;
                }                           
                break;
        } 
        return $naam;       
    }
    

    
    public function  getPersoon1GebruikteAchternaam()
    {
        $eigenVolleAchternaam  =  (!is_null($this->voorvoegsel) ? $this->voorvoegsel . ' ' : '' )  
                                  . $this->achternaam;
        $partnerVolleAchternaam = (!is_null($this->voorvoegsel_partner) ? $this->voorvoegsel_partner : '') 
                                  . (  (!is_null($this->voorvoegsel_partner) && !is_null($this->achternaam_partner))  ? ' ' : '')  
                                . (!is_null($this->achternaam_partner) ? $this->achternaam_partner : '') ;
        $tussenstreepje = ($partnerVolleAchternaam!='' ? ' - ' : '') ;
        
        switch ($this->naamgebruik)  {
            case "E":
                $gebruikteAchternaam = $eigenVolleAchternaam;
                break;
            case "P":
                $gebruikteAchternaam = $partnerVolleAchternaam;
                break;
            case "EP":
                $gebruikteAchternaam = $eigenVolleAchternaam . $tussenstreepje . $partnerVolleAchternaam;
                break;
            case "PE":
                $gebruikteAchternaam = $partnerVolleAchternaam . $tussenstreepje . $eigenVolleAchternaam;
                break;
        }
        return $gebruikteAchternaam;
     }     

    public function  getPersoon2GebruikteAchternaam()
    {
        /* Voor persoon2 gelden bijv. achternaam en achternaam_partner precies omgekeerd als bij persoon1 
           Als achternaam_partner null is of leeg, dan is getPersoon2GebruikteAchternaam ook leeg*/
        if (is_null($this->achternaam_partner) || trim(($this->achternaam_partner)) == '' )
            return '';
        $eigenVolleAchternaam  =  (!is_null($this->voorvoegsel_partner) ? $this->voorvoegsel_partner . ' ' : '' )  
                                  . $this->achternaam_partner;
        $partnerVolleAchternaam = (!is_null($this->voorvoegsel) ? $this->voorvoegsel : '') 
                                  . (  (!is_null($this->voorvoegsel) && !is_null($this->achternaam))  ? ' ' : '')  
                                . (!is_null($this->achternaam) ? $this->achternaam : '') ;
        $tussenstreepje = ($partnerVolleAchternaam!='' ? ' - ' : '') ;
        
        switch ($this->naamgebruik_partner)  {
            case "E":
                $gebruikteAchternaam = $eigenVolleAchternaam;
                break;
            case "P":
                $gebruikteAchternaam = $partnerVolleAchternaam;
                break;
            case "EP":
                $gebruikteAchternaam = $eigenVolleAchternaam . $tussenstreepje . $partnerVolleAchternaam;
                break;
            case "PE":
                $gebruikteAchternaam = $partnerVolleAchternaam . $tussenstreepje . $eigenVolleAchternaam;
                break;
        }
        return $gebruikteAchternaam;
     }     

    public function getAdresseernaam()
    {
        $adresseerNaam = $this->getPersoon1NaamVoluitTitel();
        if ($this->getPersoon2NaamVoluitTitel() != '' )
        {
           $adresseerNaam .= ' en ' . $this->getPersoon2NaamVoluitTitel();
        }
        return $adresseerNaam;
    }

    public function getSorteernaam() 
    {
        
        $sorteernaam = $this->getPersoon1NaamVoluitAchter();
        if ($this->getPersoon2NaamVoluitAchter() != '')  {
            $sorteernaam .= ' en ' . $this->getPersoon2NaamVoluitAchter();
        }
        return $sorteernaam;     
    } 
    public function getDropdownListNaam() 
    {
        $klantnr = $this->klantnr;
        $sorteernaam = $this->getSorteernaam();
        
        return "[" . $klantnr . "] " .$sorteernaam;     
    } 

    
    
    public static function displayBankRekNr($bankreknr)
    {
        /* 
            Formats the bankreknr $bankreknr, which consists of 18 characters,
            into 1 group of 4 giving country and control-code
                 1 group of 4 chars giving the abbreviation for the bank
                 2 groups of 4 plus 1 group of 2 chars giving the ten digits of the actual bankreknr
                 (the 1st digit will normally be a 0, because in the Netherlands only 9 digits were used)
         */
         $group1 = substr($bankreknr, 0, 4);
         $group2 = substr($bankreknr, 4, 4);
         $group3 = substr($bankreknr, 8, 4);
         $group4 = substr($bankreknr,12, 4 );
         $group5 = substr($bankreknr, 16, 2);
         
         $displayFormat =  $group1 . ' ' . $group2 . ' ' . $group3 . ' ' . $group4 . ' ' . $group5;
         return $displayFormat;    
    }

    public function getDisplayPriveRekNr()
    {
        return self::displayBankRekNr($this->prive_rek_nr);
    }     

    public function getDisplayBeheerRekNr()
    {
        return self::displayBankRekNr($this->beheer_rek_nr);
    }     
     
         
}