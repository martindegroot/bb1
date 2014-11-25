<?php

/**
 * This is the model class for table "relatie".
 *
 * The followings are the available columns in table 'relatie':
 * @property string $code
 * @property string $naam
 * @property string $naamregel2
 * @property string $straathuisnr
 * @property string $postcode
 * @property string $woonplaats
 * @property string $telefoonnr
 * @property string $faxnr
 * @property string $email
 * @property string $bank_rek_nr
 * @property string $omschrijving
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 *
 * The followings are the available model relations:
 * @property Dossier[] $dossiers
 */
class Relatie extends Bb1ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Relatie the static model class
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
		return 'relatie';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, naam', 'required'),
			array('create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>4),
			array('naam, naamregel2, straathuisnr, woonplaats, email', 'length', 'max'=>45),
			array('postcode', 'length', 'max'=>7),
			array('telefoonnr, faxnr', 'length', 'max'=>15),
			array('bank_rek_nr', 'length', 'max'=>18),
			array('omschrijving', 'length', 'max'=>150),
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('code, naam, naamregel2, straathuisnr, postcode, woonplaats, telefoonnr, faxnr, email, bank_rek_nr, omschrijving', 'safe', 'on'=>'search'),
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
			'dossiers' => array(self::HAS_MANY, 'Dossier', 'relatie_code'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'code' => 'Code',
			'naam' => 'Naam',
			'naamregel2' => 'Naam regel 2',
			'straathuisnr' => 'Straat en huisnummer',
			'postcode' => 'Postcode',
			'woonplaats' => 'Woonplaats',
			'telefoonnr' => 'Telefoonnummer',
			'faxnr' => 'Faxnummer',
			'email' => 'E-mail adres',
			'bank_rek_nr' => 'Bankrekening nummer',
			'omschrijving' => 'Omschrijving',
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
		$criteria->compare('naam',$this->naam,true);
		$criteria->compare('naamregel2',$this->naamregel2,true);
		$criteria->compare('straathuisnr',$this->straathuisnr,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('woonplaats',$this->woonplaats,true);
		$criteria->compare('telefoonnr',$this->telefoonnr,true);
		$criteria->compare('faxnr',$this->faxnr,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('bank_rek_nr',$this->bank_rek_nr,true);
		$criteria->compare('omschrijving',$this->omschrijving,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_id',$this->update_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}