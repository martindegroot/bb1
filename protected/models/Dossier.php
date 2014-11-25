<?php

/**
 * This is the model class for table "dossier".
 *
 * The followings are the available columns in table 'dossier':
 * @property string $dossiernr
 * @property integer $klantnr
 * @property string $dossiertype_code
 * @property string $relatie_code
 * @property integer $volgnr
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 *
 * The followings are the available model relations:
 * @property Document[] $documents
 * @property Dossiertype $dossiertype
 * @property Klant $klant
 * @property Relatie $relatie
 */
class Dossier extends Bb1ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Dossier the static model class
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
		return 'dossier';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dossiernr, klantnr, dossiertype_code, relatie_code, volgnr', 'required'),
			array('klantnr, volgnr, create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			array('dossiernr', 'length', 'max'=>20),
			array('dossiertype_code, relatie_code', 'length', 'max'=>4),
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('dossiernr, klantnr, dossiertype_code, relatie_code, volgnr', 'safe', 'on'=>'search'),
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
			'documents' => array(self::HAS_MANY, 'Document', 'dossiernr'),
			'dossiertype' => array(self::BELONGS_TO, 'Dossiertype', 'dossiertype_code'),
			'klant' => array(self::BELONGS_TO, 'Klant', 'klantnr'),
			'relatie' => array(self::BELONGS_TO, 'Relatie', 'relatie_code'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'dossiernr' => 'Dossiernr',
			'klantnr' => 'Klantnr',
			'dossiertype_code' => 'Dossiertype Code',
			'relatie_code' => 'Relatie Code',
			'volgnr' => 'Volgnr',
			'create_time' => 'Create Time',
			'create_user_id' => 'Create User',
			'update_time' => 'Update Time',
			'update_user_id' => 'Update User',
            'relatie_code_label' => 'Relatie',
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

		$criteria->compare('dossiernr',$this->dossiernr,true);
		$criteria->compare('klantnr',$this->klantnr);
		$criteria->compare('dossiertype_code',$this->dossiertype_code,true);
		$criteria->compare('relatie_code',$this->relatie_code,true);
		$criteria->compare('volgnr',$this->volgnr);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_id',$this->update_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getRelatieOptions()
    {
        $cmd = Yii::app()->db->createCommand();
        $cmd->select = 'code, naam';
        $cmd->from = 'relatie';
        $cmd->order= 'naam ASC';
        $result = $cmd->query();
               
        $relatiearr = array();
        foreach($result as $row) {
            $relatiearr[$row['code']] = "[" . $row['code']. "] " . $row['naam'];
            
        }
        return $relatiearr; 
    }
    
    public function getKlantOptions()
    {
        $klanten = Klant::model()->findAll();
        $klantenArr = array();
        foreach($klanten as $klant) {
            $klantenArr[$klant->klantnr] = $klant->getDropdownListNaam();
            
        }
        return $klantenArr;         
    }
    public function getDossiertypeOptions()
    {
        $dossiertypen = Dossiertype::model()->findAll();
        $dossiertypeArr = array();
        foreach($dossiertypen as $dossiertype) {
            $dossiertypeArr[$dossiertype->code] = "[" . $dossiertype->code . "] "
                                                   . $dossiertype->getTypeEnSubtype();
            
        }
        return $dossiertypeArr;         
    }
    
    public function getRelatie_code_label()
    {
        return "Relatie";
    }    
}