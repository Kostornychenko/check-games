<?php

class Admin_GamesController extends Zend_Controller_Action
{

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $list = new Application_Model_DbTable_Content();
        $category = new Application_Model_DbTable_Category();
        foreach ( $list->getItemsList() as $arr => $item) {
            $cat = $category->getCategoryById($item['category']);
            $item['cat'] = $cat['name'];
            $temp[] = $item;

        }
        $this->view->list = $temp;
    }

    public function addAction()
    {
        $form = new Admin_Form_Content();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $title = $form->getValue('title');
                $desc = $form->getValue('desc');
                $content = $form->getValue('content');
                $rating = $form->getValue('rating');
                $url = $form->getValue('url');
                $trailer = $form->getValue('trailer');
                $category = $form->getValue('category');
                $slider = $form->getValue('slider');
                $main = $form->getValue('main_game');
                $main_img = $form->getValue('main_img');

                $game = new Application_Model_DbTable_Content();
                $game->addGame($title, $desc, $content, $rating, $trailer, $url, $category, $slider, $main, $main_img);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function editAction() {
        $form = new Admin_Form_Content();
        $this->view->form = $form;
        $form->submit->setLabel('Save');
        $id = $this->_getParam('id', 0);

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $title = $form->getValue('title');
                $desc = $form->getValue('desc');
                $content = $form->getValue('content');
                $rating = $form->getValue('rating');
                $url = $form->getValue('url');
                $trailer = $form->getValue('trailer');
                $category = $form->getValue('category');
                $slider = $form->getValue('slider');
                $main = $form->getValue('main_game');
                $main_img = $form->getValue('main_img');
                if(!$main_img){
                    $main_img = $form->getValue('main_img_hidden');
                }

                $game = new Application_Model_DbTable_Content();
                $game->updateGame($title, $desc, $content, $rating, $trailer, $url, $category, $slider, $main, $main_img, $id);
                $this->_helper->redirector('index');
            } else {
                $game = new Application_Model_DbTable_Content();
                $formdata = $game->getItemById($id);
                $formdata['main_img_hidden'] = $formdata['main_img'];
                $form->populate($formdata);
                $this->view->formdata = $formdata;
            }
        } else {
            $game = new Application_Model_DbTable_Content();
            $formdata = $game->getItemById($id);
            $formdata['main_img_hidden'] = $formdata['main_img'];
            $form->populate($formdata);
            $this->view->formdata = $formdata;
        }
    }

    public function removeAction() {
        $id = $this->_getParam('id');

        $category = new Application_Model_DbTable_Content();
        $category->removeGame($id);

        $this->_helper->redirector('index', 'games', 'admin');
    }

}

