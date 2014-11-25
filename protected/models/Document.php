<?php

/**
 * This is the model class for table "document".
 *
 * The followings are the available columns in table 'document':
 * @property integer $id
 * @property string $scandatumtijd
 * @property string $postdatum
 * @property string $van_naam
 * @property string $aan_naam
 * @property string $onderwerp
 * @property string $keywords
 * @property integer $klantnr
 * @property string $dossiernr
 * @property string $tekstinhoud
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 * @property string $padnaam
 *
 * The followings are the available model relations:
 * @property Dossier $dossiernr0
 * @property Klant $klantnr0
 */
class Document extends Bb1ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Document the static model class
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
		return 'document';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('klantnr, scandatumtijd, tekstinhoud', 'required'),
		/*	array('scandatumtijd, postdatum, klantnr, tekstinhoud', 'required'),   */
			array('klantnr, create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			array('van_naam, aan_naam', 'length', 'max'=>45),
			array('onderwerp', 'length', 'max'=>100),
			array('keywords', 'length', 'max'=>255),
			array('dossiernr', 'length', 'max'=>20),
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, scandatumtijd, postdatum, van_naam, aan_naam, onderwerp, keywords, klantnr, dossiernr, htminhoud, tekstinhoud, create_time, create_user_id, update_time, update_user_id', 'safe', 'on'=>'search'),
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
			'dossiernr0' => array(self::BELONGS_TO, 'Dossier', 'dossiernr'),
			'klant' => array(self::BELONGS_TO, 'Klant', 'klantnr'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'scandatumtijd' => 'Scandatum',
			'postdatum' => 'Postdatum',
            'padnaam' => 'Volledige bestandsnaam',
			'van_naam' => 'Van Naam',
			'aan_naam' => 'Aan Naam',
			'onderwerp' => 'Onderwerp',
			'keywords' => 'Trefwoorden',
			'klantnr' => 'Klantnr',
			'dossiernr' => 'Dossiernr',
			'tekstinhoud' => 'Tekstinhoud',
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
		$criteria->compare('scandatumtijd',$this->scandatumtijd,true);
		$criteria->compare('postdatum',$this->postdatum,true);
		$criteria->compare('van_naam',$this->van_naam,true);
		$criteria->compare('aan_naam',$this->aan_naam,true);
		$criteria->compare('onderwerp',$this->onderwerp,true);
		$criteria->compare('keywords',$this->keywords,true);
		$criteria->compare('klantnr',$this->klantnr);
		$criteria->compare('dossiernr',$this->dossiernr,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_id',$this->update_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}