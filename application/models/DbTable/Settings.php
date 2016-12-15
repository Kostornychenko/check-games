<?php
class Application_Model_DbTable_Settings extends Zend_Db_Table_Abstract {
    protected $_name = 'settings';

    public function getSettings() {
        $select = $this->select()->order('id ASC');
        $row = $this->fetchAll($select);
        return $row->toArray();
    }

//admin

    public function updateSettings($left, $right, $id = 1) {
        $data = array(
            'left_banner' => $left,
            'right_banner' => $right
        );
        $this->update($data, 'id = ' . (int)$id);
    }


}
?>