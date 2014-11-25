<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class UsersEmailForm extends CFormModel
{
    public $email;


    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // email is required
            array('email', 'required'),
            // email needs to be a valid email-adres
            array('email', 'email'),
            // email needs to be checked for existence in the database
            array('email', 'checkExistence'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'email'=>'E-mail adres',
        );
    }

    /**
     * Checks if the email exists in the database.
     * This is the 'checkExistence' validator as declared in rules().
     */
    public function checkExistence($attribute,$params)
    {
        if(!$this->hasErrors())
        {
            $userWithEmail = User::getUserByEmail($this->email);
            if(is_null($userWithEmail))
                $this->addError('email','Onbekend e-mail adres.');
        }
    }
}
