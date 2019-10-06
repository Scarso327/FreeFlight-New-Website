<?php

class Forum {
    public function getCategories() {
        $query = Database::getFactory()->getConnection(SETTING["db-name"])->prepare("SELECT * FROM forum_categories ORDER BY `order`");
        $query->execute();
        
        if ($query->rowCount() == 0) { return false; } 

        $return = array();

        foreach($query->fetchAll() as $category) {
            $category->sections = self::getSections($category->id);
            array_push($return, $category);
        }

        return $return;
    }

    public function getSections($category) {
        $query = Database::getFactory()->getConnection(SETTING["db-name"])->prepare("SELECT * FROM forum_sections WHERE category_id = :id ORDER BY `order`");
        $query->execute(array(":id" => $category));
        
        if ($query->rowCount() == 0) { return false; } 
        return $query->fetchAll();
    }

    public function getSection($section) {
        $query = Database::getFactory()->getConnection(SETTING["db-name"])->prepare("SELECT * FROM forum_sections WHERE id = :id LIMIT 1");
        $query->execute(array(":id" => $section));
        
        if ($query->rowCount() == 0) { return false; } 
        return $query->fetch();
    }
}