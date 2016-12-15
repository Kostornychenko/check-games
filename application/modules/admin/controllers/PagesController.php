<?php

class Admin_PagesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $list = new Application_Model_DbTable_Pages();
        $this->view->list = $list->getPagesList();
    }

    public function addAction() {
        $form = new Admin_Form_Pages();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $name = $form->getValue('title');
                $content = $form->getValue('content');

                $category = new Application_Model_DbTable_Pages();
                $category->addPage($name, $content);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function editAction() {
        $form = new Admin_Form_Pages();
        $form->submit->setLabel('Save');
        $this->view->form = $form;
        $id = $this->_getParam('id', 0);
        $category = new Application_Model_DbTable_Pages();

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $name = $form->getValue('title');
                $content = $form->getValue('content');

                $category = new Application_Model_DbTable_Pages();
                $category->updatePage($name, $content, $id);
                $this->_helper->redirector('index');
            } else {
                $formdata = $category->getPageById($id);
                $form->populate($formdata);
                $this->view->formdata = $formdata;
            }
        } else {
            $formdata = $category->getPageById($id);
            $form->populate($formdata);
            $this->view->formdata = $formdata;
        }
    }

    public function removeAction() {
        $id = $this->_getParam('id');

        $category = new Application_Model_DbTable_Pages();
        $category->removePage($id);

        $this->_helper->redirector('index', 'pages', 'admin');
    }

}

