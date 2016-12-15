<?php

class Admin_Form_Category extends Zend_Form {

    public function init() {
        $this->setName('category');

        $isEmptyMessage = 'Field cannot be empty';

        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name')
            ->setAttrib('class', 'form-control')
            ->setRequired(true)
            ->addValidator('NotEmpty', true,
            array('messages' => array('isEmpty' => $isEmptyMessage))
        );

        $content = new Zend_Form_Element_Textarea('content');
        $content->setLabel('Description')
            ->setAttrib('class', 'form-control')
            ->setRequired(false);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Add')
            ->setAttrib('class', 'btn btn-success');

        $this->addElements(array($name, $content, $submit));
        $this->setMethod('post');
        $this->setAttrib('enctype', 'multipart/form-data');
    }
}