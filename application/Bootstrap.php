<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initLayoutLoader() {
        $fc = Zend_Controller_Front::getInstance();
        $fc->registerPlugin(new Application_Plugin_LayoutLoader());
    }

    protected function _initConfig() {
        Zend_Registry::set('config', $this->getOptions());
    }

    protected function _initAcl() {
            $acl = new Zend_Acl();

            /*Default Resources*/
            $acl->addResource('default-index');
            $acl->addResource('default-auth');
            $acl->addResource('default-error');

            /*Admin Resources*/
            $acl->addResource('admin-index');
            $acl->addResource('admin-games');
            $acl->addResource('admin-categories');
            $acl->addResource('admin-pages');
            $acl->addResource('admin-slider');
            $acl->addResource('admin-settings');

            /*Roles*/
            $acl->addRole('guest');
            $acl->addRole('admin', 'guest');

            /*Guest Access*/
            $acl->allow('guest', 'default-index', array('index', 'item', 'category', 'page'));
            $acl->allow('guest', 'default-auth', array('index', 'register', 'login', 'logout'));
            $acl->allow('guest', 'default-error', array('error'));

            /*Admin Access*/
            $acl->allow('guest', 'admin-index', array('index'));
            $acl->allow('admin', 'admin-index', array('index'));
            $acl->allow('admin', 'admin-games', array('index', 'edit', 'add', 'remove'));
            $acl->allow('admin', 'admin-slider', array('index'));
            $acl->allow('admin', 'admin-pages', array('index', 'edit', 'add', 'remove'));
            $acl->allow('admin', 'admin-categories', array('index', 'edit', 'add', 'remove'));
            $acl->allow('admin', 'admin-settings', array('index'));


            $fc = Zend_Controller_Front::getInstance();
            $fc->registerPlugin(new Application_Plugin_AccessCheck($acl, Zend_Auth::getInstance()));
        }

    protected function _initRoutes() {
        $front = Zend_Controller_Front::getInstance();
        $front->setControllerDirectory(array(
            'default' => '/default/controllers',
            'admin'    => '/admin/controllers'
        ));
        $router = $front->getRouter();

        /*category*/
        $category = new Zend_Controller_Router_Route(
            'category/:slug',
            array(
                'module'=>'default',
                'controller' => 'index',
                'action'     => 'category'
            ),
            array(
                1 => 'slug'
            )
        );
        $router->addRoute('category', $category);

        /*page*/
        $page = new Zend_Controller_Router_Route(
            'page/:slug',
            array(
                'module'=>'default',
                'controller' => 'index',
                'action'     => 'page'
            ),
            array(
                1 => 'slug'
            )
        );
        $router->addRoute('page', $page);

        /*item*/
        $item = new Zend_Controller_Router_Route_Regex(
            '(.+)\.html',
            array(
                'module'=>'default',
                'controller' => 'index',
                'action'     => 'item'
            ),
            array(
                1 => 'slug',

            ),
            '%s.html'
        );
        $router->addRoute('item', $item);


    }
}

