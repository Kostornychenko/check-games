<?php

class Admin_Form_Settings extends Zend_Form {

    public function init() {
        $this->setName('settings');

        $left = new Zend_Form_Element_Textarea('left_banner');
        $left->setLabel('Code of left banner')
            ->setAttrib('class', 'form-control')
            ->setRequired(false);

        $right = new Zend_Form_Element_Textarea('right_banner');
        $right->setLabel('Code of right banner')
            ->setAttrib('class', 'form-control')
            ->setRequired(false);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Save')
            ->setAttrib('class', 'btn btn-success');

        $this->addElements(array($left, $right, $submit));
        $this->setMethod('post');
        $this->setAttrib('enctype', 'multipart/form-data');
    }
}