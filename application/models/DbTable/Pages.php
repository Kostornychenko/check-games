<?php
class Application_Model_DbTable_Pages extends Zend_Db_Table_Abstract {
    protected $_name = 'pages';

    public function getPagesList() {
        $select = $this->select()->order('id ASC');
        $row = $this->fetchAll($select);
        return $row->toArray();
    }
}
?>