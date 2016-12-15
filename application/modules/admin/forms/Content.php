<?php

class Admin_Form_Content extends Zend_Form {

    public function init() {
        $this->setName('content');
        $config = Zend_Registry::get('config');
        $isEmptyMessage = 'Field cannot be empty';

        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('Name')
            ->setAttrib('class', 'form-control')
            ->setRequired(true)
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $desc = new Zend_Form_Element_Textarea('desc');
        $desc->setLabel('Description')
            ->setAttrib('class', 'form-control')
            ->setRequired(false);

        $content = new Zend_Form_Element_Textarea('content');
        $content->setLabel('Content')
            ->setAttrib('class', 'form-control')
            ->setRequired(false);

        $rating = new Zend_Form_Element_Text('rating');
        $rating->setLabel('Rating')
            ->setAttrib('class', 'form-control')
            ->setRequired(false);

        $url = new Zend_Form_Element_Text('url');
        $url->setLabel('Url')
            ->setAttrib('class', 'form-control')
            ->setRequired(false);

        $trailer = new Zend_Form_Element_Text('trailer');
        $trailer->setLabel('Trailer')
            ->setAttrib('class', 'form-control')
            ->setRequired(false);

        $cat = new Application_Model_DbTable_Category();
        $rezult = Array();
        foreach ($cat->getCategoriesList() as $arr => $item) {
            $rezult[$item['id']] = $item['name'];
        }
        $category = new Zend_Form_Element_Select("category");
        $category->setLabel("Category")
            ->setRequired(false)
            ->setAttrib('class', 'form-control')
            ->setMultiOptions($rezult);

        $slider = new Zend_Form_Element_Checkbox("slider");
        $slider->setLabel('Add to slider')
            ->setRequired(false);

        $main = new Zend_Form_Element_Checkbox("main_game");
        $main->setLabel('Set as main game on front page')
            ->setRequired(true);

        $main_img = new Zend_Form_Element_File('main_img');
        $main_img->setLabel('Main Image')
            ->setDescription("Size 960px x 400px")
            ->setRequired(true)
            ->setDestination($config['form']['games']['path'])
            ->addValidator('Count', false, 1)
            ->addValidator('Extension', false, 'jpg,png,gif')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $main_img_hidden = new Zend_Form_Element_Hidden('main_img_hidden');


        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Add')
            ->setAttrib('class', 'btn btn-success');

        $this->addElements(array($title, $desc, $content, $rating, $url, $trailer, $category, $slider, $main, $main_img, $main_img_hidden,$submit));
        $this->setMethod('post');
        $this->setAttrib('enctype', 'multipart/form-data');
    }
}