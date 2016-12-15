<?php
class Application_Model_DbTable_Pages extends Zend_Db_Table_Abstract {
    protected $_name = 'pages';

    public function getPagesList() {
        $select = $this->select()->order('id ASC');
        $row = $this->fetchAll($select);
        return $row->toArray();
    }

    public function getPageById($id) {
        $row = $this->fetchRow('id = '.$id);
        return $row->toArray();
    }

    public function getPageBySlug($slug) {
        $row = $this->fetchRow('slug = "'.$slug.'"');
        return $row->toArray();
    }

//admin
    public function addPage($name, $content) {
        $data = array(
            'title' => $name,
            'content' => $content,
            'slug' => mb_strtolower(str_replace(" ", "-", $name))
        );
        $this->insert($data);
    }

    public function updatePage($name, $content, $id) {
        $data = array(
            'title' => $name,
            'content' => $content,
            'slug' => mb_strtolower(str_replace(" ", "-", $name))
        );
        $this->update($data, 'id = ' . (int)$id);
    }

    public function removePage($id) {
        $this->delete('id = ' . (int)$id);
    }
}
?>