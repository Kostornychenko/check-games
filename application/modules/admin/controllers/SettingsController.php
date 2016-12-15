<?php

class Admin_SettingsController extends Zend_Controller_Action
{

    public function init(){
        /* Initialize action controller here */
    }

    public function indexAction() {
        $form = new Admin_Form_Settings();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $left = $form->getValue('left_banner');
                $right = $form->getValue('right_banner');

                $settings = new Application_Model_DbTable_Settings();
                $settings->updateSettings($left, $right);
                $this->_helper->redirector('index');
            } else {
                $settings = new Application_Model_DbTable_Settings();
                $formdata = $settings->getSettings();
                $form->populate($formdata[0]);
            }
        } else {
            $settings = new Application_Model_DbTable_Settings();
            $formdata = $settings->getSettings();
            $form->populate($formdata[0]);
        }
    }



}

