<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $role
 * @property integer $klantnr
 * @property string $last_login_time
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 *
 * The followings are the available model relations:
 * @property Klant $klantnr0
 */
class User extends Bb1ActiveRecord
{
    public $password_repeat;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, role', 'required'),
            array('password, password_repeat', 'required', 'on'=> 'updatePassword'),
            array('username', 'unique'),
			array('klantnr', 'numerical', 'integerOnly'=>true),
			array('username, role', 'length', 'max'=>45),
			array('password', 'length', 'max'=>255),
            array('password', 'compare', 'on' => 'insert, updatePassword'),
            array('password_repeat', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, role, klantnr, last_login_time, create_time, create_user_id, update_time, update_user_id', 'safe', 'on'=>'search'),
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
			'klant' => array(self::BELONGS_TO, 'Klant', 'klant_id'),
            'medewerker' => array(self::BELONGS_TO,'Medewerker', 'medewerker_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Gebruikersnaam',
			'password' => 'Wachtwoord',
            'password_repeat' => 'Wachtwoord herhaling',
			'role' => 'Bevoegdheid',
			'klantnr' => 'Klantnr',
			'last_login_time' => 'Last Login Time',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('klantnr',$this->klantnr);
		$criteria->compare('last_login_time',$this->last_login_time,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_id',$this->update_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    /**
     * apply a hash on the password before we store it in the database
     */
//    protected function afterValidate()
//    {   
//      parent::afterValidate();
//      if(!$this->hasErrors())
//      $this->password = $this->hashPassword($this->password);
//   }

      /**
       * Generates the password hash.
       */
        public function hashPassword($password)
      {
          return md5($password) ;
      }    

      /**
       * Checks if the given password is correct.
       * @param string the password to be validated
       * @return boolean whether the password is valid
       */
      public function validatePassword($password)
      {
        return $this->hashPassword($password)===$this->password;
      }
      /**
      * loggedInUser return the User class object which corresponds with
      * the WebUser (id of WebUser == id of User object)
      * The method returns null if the webuser is not logged in but is a Guest
      * @return User loggedInUser
      */
      public static function loggedInUser()
      {
            // If current webUser is not logged in, but a guest, return null
            if (Yii::app()->user->isGuest)  
            {
                return null;
            } 
            $idLoggedInUser = Yii::app()->user->id;
            return User::model()->findByPk($idLoggedInUser);
      } 
      
      public static function loggedInUserHeeftKlantnr($klantnr) 
      {
         $loggedInUser = self::loggedInUser();
         if (is_null($loggedInUser->klantnr)
            ||
            is_null($klantnr)) 
         {
             $result = false;
         }
         else
         {
             $result = ($loggedInUser->klantnr == $klantnr);
         }
         return $result;
      } 
      
      /**
      * Determines if loggedInUser is allowed to update this user's password 
      * 
      * @return bool allowed
      */
      public function allowLoggedInUserToUpdateMyPassword()
      {
            /* 
            1) Als de role van de loggedinuser == klant dan mag deze user alleen het wachtwoord wijzigen
            van zichzelf 
            Als de role van de loggedinuser == budgetbeheerder of admin dan mag de loggedinuser
            elk password updaten van een user die role klant heeft en als de role budgetbeheerder is
            ook het password van zichzelf
            alleen als de role van de loggedinuser == admin, dan mag het password van elke user geupdate worden
         */
         $allowed = false;
         $loggedInUser =  User::loggedInUser(); 
         // als de current user niet ingelogd is, maar een guest is, dan is $loggedInUser == null
         // in dat geval false retourneren, want een guest mag zeker niets doen 
         if (is_null($loggedInUser))
         {
             return $allowed;
         }
         $roleLoggedInUser = $loggedInUser->getAssignedRole();
         $thisRole = $this->getAssignedRole();
         $allowed = false;
         switch ($roleLoggedInUser) {
             case 'klant':
                // toegestaan: alleen wachtwoord van zichzelf
                $allowed = ($loggedInUser->id == $this->id);
                break;
             case 'budgetbeheerder':
                // toegestaan: users met role klant en zichzelf
                $allowed = (    $thisRole == 'klant'
                                ||
                                $loggedInUser->id == $this->id
                           );
                break;
             case 'admin':
                // toegestaan: alle users, d.w.z. klanten, budgetbeheerders en admin users
                $allowed = true;
                break;
         }
         return $allowed;
         
         
      }
    /**
     * Gets the role assigned to the user
     * @param no params required or allowed
     * @return string the role assigned to the user in table auth_assignment
     * @see User.php, public function getAssignedRole()
     */      
      public function getAssignedRole()
      {
         /*
           De role van de user wordt opgehaald uit tabel auth_assignment
           Het record waarvoor kolom userid == id van deze user ($this->id)
           wordt geselecteerd, en de assigned role staat dan in kolom itemname van dat record.
         */ 
         
         $sql = 'SELECT itemname FROM auth_assignment WHERE userid = :ditid';
         $cmd = Yii::app()->db->createCommand($sql);
         $thisid = $this->id;
         $cmd->bindParam(':ditid', $thisid);
         $dummy1 = 'hallo';
         $role = $cmd->queryScalar();
         return $role;
      }
      /**
      * Zoekt een user record op grond van input parameter $email.
      * De $email waarde wordt gezocht in de tabel klant en in de tabel medewerker
      * Als geen user record gevonden wordt dan wordt null geretourneerd,
      * anders wordt het user object geretourneerd
      * 
      * @param mixed $email
      */
      public static function getUserByEmail($email)
      {
          $sql = "SELECT u.id  FROM USER u, klant k ";
          $sql .= " WHERE u.klant_id = k.id ";
          $sql .= " AND k.email = '" . $email . "' ";
          $sql .= " UNION ALL ";
          $sql .= " SELECT  u.id  FROM USER u, medewerker m ";
          $sql .= " WHERE u.medewerker_id = m.id  ";
          $sql .= " AND m.email = '" . $email . "' ";
          $cmd = Yii::app()->db->createCommand($sql);
          $user_id = $cmd->queryScalar(); 
          if($user_id==false) 
          {   $foundUser = null;
           
          }
          else
          {
             $foundUser = User::model()->with('klant')->with('medewerker')->findByPk($user_id);   
          } 
          return $foundUser;        
      }
}