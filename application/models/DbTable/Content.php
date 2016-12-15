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

    public function getSlider() {
        $select = $this->select()->where('slider = 1');
        $row = $this->fetchAll($select);
        return $row->toArray();
    }

    public function getMainGame() {
        $select = $this->select()->where('main_game = 1');
        $row = $this->fetchAll($select);
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

//    admin

    public function addGame($title, $desc, $content, $rating, $trailer, $url, $category, $slider, $main, $main_img) {
        $data = array(
            'slug' => mb_strtolower(str_replace(" ", "-", $title)),
            'title' => $title,
            'desc' => $desc,
            'content' => $content,
            'rating' => $rating,
            'url' => $url,
            'trailer' => $trailer,
            'main_img' => $main_img,
            'category' => $category,
            'slider' => $slider,
            'main_game' => $main,
            'date' => time()
        );
        $this->insert($data);
    }

    public function updateGame($title, $desc, $content, $rating, $trailer, $url, $category, $slider, $main, $main_img, $id) {
        $data = array(
            'slug' => mb_strtolower(str_replace(" ", "-", $title)),
            'title' => $title,
            'desc' => $desc,
            'content' => $content,
            'rating' => $rating,
            'url' => $url,
            'trailer' => $trailer,
            'main_img' => $main_img,
            'category' => $category,
            'slider' => $slider,
            'main_game' => $main,
            'date' => time()
        );
        $this->update($data, 'id = ' . (int)$id);
    }

    public function removeGame($id) {
        $this->delete('id = ' . (int)$id);
    }


}
?>