<?php

class Admin_CategoriesController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $list = new Application_Model_DbTable_Category();
        $this->view->list = $list->getCategoriesList();
    }

    public function editAction() {
        $form = new Admin_Form_Category();
        $form->submit->setLabel('Save');
        $this->view->form = $form;
        $id = $this->_getParam('id', 0);
        $category = new Application_Model_DbTable_Category();

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $name = $form->getValue('name');
                $content = $form->getValue('content');

                $category = new Application_Model_DbTable_Category();
                $category->updateCategory($name, $content, $id);
                $this->_helper->redirector('index');
            } else {
                $formdata = $category->getCategoryById($id);
                $form->populate($formdata);
                $this->view->formdata = $formdata;
            }
        } else {
            $formdata = $category->getCategoryById($id);
            $form->populate($formdata);
            $this->view->formdata = $formdata;
        }
    }

    public function removeAction() {
        $id = $this->_getParam('id');

        $category = new Application_Model_DbTable_Category();
        $category->removeCategory($id);

        $this->_helper->redirector('index', 'categories', 'admin');
    }

    public function addAction() {
        $form = new Admin_Form_Category();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $name = $form->getValue('name');
                $content = $form->getValue('content');

                $category = new Application_Model_DbTable_Category();
                $category->addCategory($name, $content);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }


}







