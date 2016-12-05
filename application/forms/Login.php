<?php

class Application_Form_Login extends Zend_Form {

    public function init() {
        $this->setName('loginform');

        $isEmptyMessage = 'Field cannot be empty';

        $username = new Zend_Form_Element_Text('login');

        $username->setLabel('Login:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $password = new Zend_Form_Element_Password('pass');

        $password->setLabel('Password:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Submit');

        $this->addElements(array($username, $password, $submit));

        $this->setMethod('post');
    }


}

