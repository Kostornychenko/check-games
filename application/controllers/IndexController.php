<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        /*categories list*/
        $categories = new Application_Model_DbTable_Category();
        $this->view->categories = $categories->getCategoriesList();

        /*pages list*/
        $pages = new Application_Model_DbTable_Pages();
        $this->view->pages = $pages->getPagesList();
    }

    public function indexAction() {
        $items = new Application_Model_DbTable_Content();
        $this->view->items = $items->getItemsList();
    }

    public function itemAction() {
        $slug = $this->_getParam('slug');

        $post = new Application_Model_DbTable_Content();
        $this->view->post = $post->getItemBySlug($slug);

    }

    public function categoryAction() {
        $slug = $this->_getParam('slug');

        $category = new Application_Model_DbTable_Category();
        $this->view->category = $category = $category->getCategoryBySlug($slug);

        $items = new Application_Model_DbTable_Content();
        $this->view->items = $items->getItemsByCategory((int)$category['id']);
    }


}



