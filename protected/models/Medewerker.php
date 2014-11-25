<?php

/**
 * This is the model class for table "medewerker".
 *
 * The followings are the available columns in table 'medewerker':
 * @property integer $id
 * @property string $naam
 * @property string $email
 * @property string $role
 * @property string $username
 *
 * The followings are the available model relations:
 * @property User[] $users
 */
class Medewerker extends Bb1ActiveRecord
{
    
    const ROLE_BUDGETBEHEERDER     = 'budgetbeheerder';
    const ROLE_APPLICATEBEHEERDER  = 'applicatiebeheerder';
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Medewerker the static model class
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
		return 'medewerker';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('naam', 'required'),
			array('naam', 'length', 'max'=>45),
			array('email', 'length', 'max'=>45),
            array('email', 'email'),
            array('role', 'required'),
            array('role', 'length', 'max'=>45),
            array('username', 'required'),
            array('username', 'length', 'max'=>45),            
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, naam, email role username', 'safe', 'on'=>'search'),
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
			'user' => array(self::HAS_ONE, 'User', 'medewerker_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'naam' => 'Naam',
			'email' => 'Email adres',
            'role'  => 'Bevoegdheid',
            'username' => 'Gebruikersnaam',
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
		$criteria->compare('naam',$this->naam,true);
		$criteria->compare('email',$this->email,true);
        $criteria->compare('role',$this->role,true);
        $criteria->compare('username',$this->username,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getRoleOptions()
    {
        return array(
                     self::ROLE_BUDGETBEHEERDER          => self::ROLE_BUDGETBEHEERDER,
                     self::ROLE_APPLICATEBEHEERDER       => self::ROLE_APPLICATEBEHEERDER,
                    );
    }    
    
}