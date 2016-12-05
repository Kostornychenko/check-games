<?php
class Application_Model_DbTable_Category extends Zend_Db_Table_Abstract {
    protected $_name = 'category';

    public function getCategoriesList() {
        $select = $this->select()->order('id ASC');
        $row = $this->fetchAll($select);
        return $row->toArray();
    }

    public function removeItem($id) {
        $this->delete('id = ' . (int)$id);
    }

    public function getCategoryById($id) {
        $row = $this->fetchRow('id = '.$id);
        return $row->toArray();
    }

    public function getCategoryBySlug($slug) {
        $row = $this->fetchRow('slug = "'.$slug.'"');
        return $row->toArray();
    }
}
?>