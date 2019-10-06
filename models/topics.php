<?php

class Topics {
    public function getTopics($section) {
        $query = Database::getFactory()->getConnection(SETTING["db-name"])->prepare("SELECT * FROM forum_topics WHERE section_id = :id");
        $query->execute(array(":id" => $section));
        
        if ($query->rowCount() == 0) { return false; } 
        return $query->fetchAll();
    }

    public function getTopic($id) {
        $query = Database::getFactory()->getConnection(SETTING["db-name"])->prepare("SELECT forum_topics.id, forum_topics.title, accounts.steamName, accounts.steamID, accounts.steampfpmed, forum_topics.posted FROM forum_topics INNER JOIN accounts WHERE forum_topics.id = :id AND accounts.steamID = forum_topics.author LIMIT 1");
        $query->execute(array(":id" => $id));
        
        if ($query->rowCount() == 0) { return false; } 
        return $query->fetch();
    }
}