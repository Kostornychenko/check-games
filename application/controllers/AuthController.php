<?php

class AuthController extends Zend_Controller_Action {

    public function init() {
        /*categories list*/
        $categories = new Application_Model_DbTable_Category();
        $this->view->categories = $categories->getCategoriesList();

        /*pages list*/
        $pages = new Application_Model_DbTable_Pages();
        $this->view->pages = $pages->getPagesList();
    }

    public function indexAction() {
        $this->_helper->redirector('login');
    }

    public function loginAction() {
        if (Zend_Auth::getInstance()->hasIdentity()) {
            $this->_helper->redirector('index', 'index', 'default');
        }

        $form = new Application_Form_Login();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
                $authAdapter->setTableName('users')
                    ->setIdentityColumn('login')
                    ->setCredentialColumn('password');
                $username = $this->getRequest()->getPost('login');
                $password = $this->getRequest()->getPost('pass');
                $authAdapter->setIdentity($username)
                    ->setCredential(md5($password));
                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($authAdapter);

                if ($result->isValid()) {
                    $identity = $authAdapter->getResultRowObject();
                    $authStorage = $auth->getStorage();
                    $authStorage->write($identity);
                    $user = Zend_Auth::getInstance()->getIdentity();
                    if ($user->role == 'admin') {
                        $this->_helper->redirector('index', 'index', 'admin');
                    } else {
                        $this->_helper->redirector('index', 'index', 'default');
                    }
                } else {
                    $this->view->errMessage = 'Login or password incorrect. Try again please!';
                }
            }
        }
    }

    public function logoutAction() {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('index', 'index', 'default');
    }

}

