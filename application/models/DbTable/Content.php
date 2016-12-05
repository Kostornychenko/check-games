<?php
class Application_Model_DbTable_Content extends Zend_Db_Table_Abstract {
    protected $_name = 'content';

    public function getItemsList() {
        $select = $this->select()->order('id ASC');
        $row = $this->fetchAll($select);
        return $row->toArray();
    }

    public function getItemById($id) {
        $row = $this->fetchRow('id = '.$id);
        return $row->toArray();
    }

    public function getItemBySlug($slug) {
        $row = $this->fetchRow('slug = "'.$slug.'"');
        return $row->toArray();
    }

    public function getItemsByCategory($id) {
        $row = $this->fetchAll('category = '.$id);
        return $row->toArray();
    }
}
?>