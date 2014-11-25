<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class KlantContactForm extends CFormModel
{
    public $klantnaam;
    public $klantnr;
    public $klantemail;
    public $subject;
    public $body;

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            // klantnaam, $klantnr, klantemail, subject and body are required
            array('klantnaam, klantnr, klantemail, subject, body', 'required'),
            // email has to be a valid email address
            array('klantemail', 'email'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return array(
            'klantnaam' => 'Naam',
            'klantemail' => 'E-mail adres',
            'klantnr' => 'Klantnr',
            'subject' => 'Onderwerp',
            'body' => 'Bericht-tekst'
        );
    }
}