<?php

/**
 * This is the model class for table "tabel_id".
 *
 * The followings are the available columns in table 'tabel_id':
 * @property string $tabelnaam
 * @property integer $lastid
 */
class TabelId extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TabelId the static model class
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
		return 'tabel_id';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tabelnaam, lastid', 'required'),
			array('lastid', 'numerical', 'integerOnly'=>true),
			array('tabelnaam', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('tabelnaam, lastid', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'tabelnaam' => 'Tabelnaam',
			'lastid' => 'Lastid',
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

		$criteria->compare('tabelnaam',$this->tabelnaam,true);
		$criteria->compare('lastid',$this->lastid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public static function getLastUsedId($tabelnaam)
    {
         // find the record in table "tabel_id" waarvoor column tabelnaam de waarde $tabelnaam heeft
         
        $sql = "SELECT lastid FROM tabel_id WHERE tabelnaam = '" . $tabelnaam . "'";
        $command = Yii::app()->db->createCommand($sql);
        $lastid = $command->queryScalar();
        // if $lastid == FALSE it means there is not yet a record with PK tabelnaam == $tabelnaam
        // therefore, insert a new record with tabelnaam = $tabelnaam and lastid = 0
        if($lastid===FALSE)
        {
            $sql = "INSERT INTO tabel_id (tabelnaam, lastid ) VALUES('". $tabelnaam . "', 0)";
            $cmd = Yii::app()->db->createCommand($sql);
            $cmd->execute();
            $lastid = 0;
        }
        return $lastid;   
    } 
    public static function getLastUsedCode($tabelnaam)
    {
         // find the record in table "tabel_id" waarvoor column tabelnaam de waarde $tabelnaam heeft
         
        $sql = "SELECT lastcode FROM tabel_id WHERE tabelnaam = '" . $tabelnaam . "'";
        $command = Yii::app()->db->createCommand($sql);
        $lastcode = $command->queryScalar();
        // if $lastcode == FALSE it means there is not yet a record with PK tabelnaam == $tabelnaam
        // therefore, insert a new record with tabelnaam = $tabelnaam and lastcode = "0000"
        if($lastcode===FALSE)
        {
            $sql = "INSERT INTO tabel_id (tabelnaam, lastcode ) VALUES('". $tabelnaam . "', '0000')";
            $cmd = Yii::app()->db->createCommand($sql);
            $cmd->execute();
            $lastcode = "0000";
        }
        return $lastcode;   
    } 
    public static function incrementCode($code)
    {
        $intCode = intval($code);
        $intNewCode = $intCode + 1;
        $newCode = strval($intNewCode);
        while (strlen($newCode) < 4)
        {
            $newCode = '0' . $newCode;
        }
        return $newCode;
    }
        
    public static function updateLastId($tabelnaam, $newLastId) 
    {
       $sql = "UPDATE tabel_id SET lastid=" .$newLastId . " WHERE tabelnaam ='" . $tabelnaam . "'";
        $command = Yii::app()->db->createCommand($sql);
        $command->execute();
    } 
    
    public static function updateLastCode($tabelnaam, $newLastCode) 
    {
       $sql = "UPDATE tabel_id SET lastcode=" .$newLastCode . " WHERE tabelnaam ='" . $tabelnaam . "'";
        $command = Yii::app()->db->createCommand($sql);
        $command->execute();
    }          
}