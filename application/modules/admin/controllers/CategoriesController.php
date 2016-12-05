<?php

class Admin_CategoriesController extends Zend_Controller_Action {

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        /*categories list*/
        $list = new Application_Model_DbTable_Category();
        $this->view->list = $list->getCategoriesList();
    }

    public function editAction()
    {
        // action body
    }

    public function removeAction() {
        $id = $this->_getParam('id');

        $item = new Application_Model_DbTable_Category();
        $item->removeItem($id);

        $this->_helper->redirector('index', 'categories', 'admin');
    }


}





