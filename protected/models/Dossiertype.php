<?php

/**
 * This is the model class for table "dossiertype".
 *
 * The followings are the available columns in table 'dossiertype':
 * @property string $code
 * @property string $type
 * @property string $subtype
 * @property integer $volgorde
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id

 *
 * The followings are the available model relations:
 * @property Dossier[] $dossiers
 */
class Dossiertype extends Bb1ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Dossiertype the static model class
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
		return 'dossiertype';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, type, subtype, volgorde', 'required'),
			array('create_user_id, update_user_id, volgorde', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>4),
            array('code', 'length', 'min' => 4),
            array('code', 'checkRange',  'minValue' =>"1000",
                                         'maxValue' => "4999"),

            array('code', 'numerical', 'integerOnly'=>true),
            array( 'code', 'unique',
                   'allowEmpty' => false,
                   'message' => 'Deze waarde is al gebruikt, de waarde moet uniek zijn.'
                 ),
			array('type, subtype', 'length', 'max'=>45),
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('code, type, subtype, volgorde', 'safe', 'on'=>'search'),
		);
	}
    /**
    * validator function which checks that the value of the $attribute of this model 
    * is between $params['minValue']   and $params['maxValue']  (inclusive)
    * The functions adds an error to the model giving the error description
    * @param mixed $attribute
    * @param mixed $params
    */
    public function checkRange($attribute,$params)
    {
        if ($this->$attribute < $params['minValue'] || $this->$attribute > $params['maxValue'])
        {
            $this->addError($attribute,'Code moet groter of gelijk ' . $params['minValue'] .
                                       ' en kleiner of gelijk ' . $params['maxValue'] . ' zijn.');
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
			'dossiers' => array(self::HAS_MANY, 'Dossier', 'dossiertype_code'),
            'budgetposts' => array(self::HAS_MANY, 'BudgetPost', 'dossiertype_code'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'code' => 'Code',
			'type' => 'Type',
			'subtype' => 'Subtype',
            'volgorde' => 'Volgorde',
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

		$criteria->compare('code',$this->code,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('subtype',$this->subtype,true);
        $criteria->compare('volgorde', $this->volgorde);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_id',$this->update_user_id);
        $criteria->order ='volgorde ASC';
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getTypeEnSubtype()
    {
        return $this->type . " - " . $this->subtype;
    }


    /**
     * deze functie maakt volgorde + spatie + subtype
     * beschikbaar als een nieuwe property volgnrnaam
     * dit is analoog aan wat ik bij budget_categorie
     * als een enkel veld in de database tabel heb staan
     *
     *
     */

    public function getVolgnrnaam()
    {
        return $this->volgorde . " " .$this->subtype;
    }
    public function getDsrTypeOptions()
    {
        
        $dsrTypeArr = array();
        $dsrTypeArr['Inkomsten'] = 'Inkomsten';
        $dsrTypeArr['Uitgaven']  = 'Uitgaven' ;
        $dsrTypeArr['Schulden']  = 'Schulden' ;
        $dsrTypeArr['Administratief'] = 'Administratief';
        return $dsrTypeArr;         
    }

}