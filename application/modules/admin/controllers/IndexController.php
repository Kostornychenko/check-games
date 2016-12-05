<?php

class Admin_IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $user = Zend_Auth::getInstance()->getIdentity();
        if ($user->role != 'admin') {
            $this->_helper->redirector('login', 'auth', 'default');
        }
    }


}

