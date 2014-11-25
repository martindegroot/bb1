<?php

/**
 * This is the model class for table "budget_post".
 *
 * The followings are the available columns in table 'budget_post':
 * @property integer $id
 * @property integer $budgetkop_id
 * @property string $omschrijving
 * @property string $tegenrek_naam
 * @property string $tegenrek_nr
 * @property string $bedrag
 * @property string $bedragpermaand
 * @property string $begin_datum
 * @property string $eind_datum
 * @property string $frequentie
 * @property string $eerste_datum
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 * @property string  $dossiertype_code
 * @property int     $dossiertype_volgorde
 *
 * The followings are the available model relations:
 * @property BudgetKop $budgetkop
 * @property BudgetRegel[] $budgetRegels
 * @property DossierType $dossiertype
 */
class BudgetPost extends Bb1ActiveRecord
{
    const INKUITG_INK  = 'I';
    const INKUITG_UITG = 'U';    
      
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BudgetPost the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'budget_post';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('budgetkop_id', 'required'),
            
            // tijdelijk required uitzetten voor volgende drie velden:
         /*   array('omschrijving, tegenrek_naam, tegenrek_nr', 'required') ,  */
            
            array('bedrag', 'required') ,
            array('begin_datum, eind_datum', 'required'),
            array('frequentie, eerste_datum', 'required'),
			array('id, budgetkop_id, create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			array('omschrijving, tegenrek_naam', 'length', 'max'=>45),
            array('tegenrek_nr', 'length', 'is' =>18),		
			array('bedrag, bedragpermaand', 'length', 'max'=>8),
			array('begin_datum, eind_datum, eerste_datum, create_time, update_time', 'safe'),
            array('dossiertype_code', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, budgetkop_id, omschrijving, tegenrek_naam, tegenrek_nr, bedrag, bedragpermaand, ' .
			       'begin_datum, eind_datum, frequentie, eerste_datum, create_time, create_user_id, update_time, ' .
                   'update_user_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'budgetkop' => array(self::BELONGS_TO, 'BudgetKop', 'budgetkop_id'),
			'budgetRegels' => array(self::HAS_MANY, 'BudgetRegel', 'budgetpost_id'),
            'dossiertype' => array(self::BELONGS_TO, 'Dossiertype', 'dossiertype_code'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'budgetkop_id' => 'Budgetkop-ID',
			'omschrijving' => 'Omschrijving',
			'tegenrek_naam' => 'Naam tegenrekening',
			'tegenrek_nr' => 'Nummer tegenrekening',
			'bedrag' => 'Bedrag',
			'bedragpermaand' => 'Bedrag per maand',
			'begin_datum' => 'Begindatum',
			'eind_datum' => 'Einddatum',
			'frequentie' => 'Frequentie',
			'eerste_datum' => 'Datum eerste keer',
			'create_time' => 'Create Time',
			'create_user_id' => 'Create User',
			'update_time' => 'Update Time',
			'update_user_id' => 'Update User',
        
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
		$criteria->compare('budgetkop_id',$this->budgetkop_id);
		$criteria->compare('omschrijving',$this->omschrijving,true);
		$criteria->compare('tegenrek_naam',$this->tegenrek_naam,true);
		$criteria->compare('tegenrek_nr',$this->tegenrek_nr,true);
		$criteria->compare('bedrag',$this->bedrag,true);
		$criteria->compare('bedragpermaand',$this->bedragpermaand,true);
		$criteria->compare('begin_datum',$this->begin_datum,true);
		$criteria->compare('eind_datum',$this->eind_datum,true);
		$criteria->compare('frequentie',$this->frequentie);
		$criteria->compare('eerste_datum',$this->eerste_datum,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_id',$this->update_user_id);

        $criteria->order = 'dossiertype_volgorde ASC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
   public function getInkUitgOptions()
   {
        return array(
                        self::INKUITG_INK  => 'Inkomsten',
                        self::INKUITG_UITG => 'Uitgaven',
                    );
   }  


    public function getDossiertypeOptions()
    {
        $cmd = Yii::app()->db->createCommand();
        $cmd->select = 'code, volgorde, subtype, type';
        $cmd->from = 'dossiertype';
        $cmd->order= 'volgorde ASC';
        $result = $cmd->query();

        $dossiertypearr = array();
        foreach($result as $row) {
            $dossiertypearr[$row['code']] = $row['type'] . ": " . $row['subtype'];

        }
        return $dossiertypearr;
    }



   public function getFrequentieOptions()
   {
        return array(    
                         'maandelijks' => 'maandelijks',
                         'vier-wekelijks' => 'vier-wekelijks',
                         'wekelijks'  => 'wekelijks',
                         'per kwartaal' => 'per kwartaal',
                         'jaarlijks'  => 'jaarlijks',
                         'twee-wekelijks' => 'twee-wekelijks',                                
                         'twee-maandelijks' => 'twee-maandelijks',                       
                         'half-jaarlijks' => 'half-jaarlijks',                       
                          'eenmalig' => 'eenmalig',
                    );
   }  
      
      
}