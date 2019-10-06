<?php

class Topics {
    public function getTopics($section) {
        $query = Database::getFactory()->getConnection(SETTING["db-name"])->prepare("SELECT * FROM forum_topics WHERE section_id = :id ORDER BY posted DESC");
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

    public function getTopicFromUser($steamid) {
        $query = Database::getFactory()->getConnection(SETTING["db-name"])->prepare("SELECT forum_topics.id, forum_topics.title, forum_sections.id as `sID`, forum_sections.title as `sTitle`, accounts.steamName, accounts.steamID, accounts.steampfpmed, forum_topics.posted FROM forum_topics INNER JOIN accounts INNER JOIN forum_sections WHERE forum_topics.author = :sid AND forum_sections.id = forum_topics.section_id AND accounts.steamID = forum_topics.author ORDER BY forum_topics.posted DESC LIMIT 25");
        $query->execute(array(":sid" => $steamid));
        
        if ($query->rowCount() == 0) { return false; } 
        return $query->fetchAll();
    }
}