<?php

class Topics {
    public function getTopics($section) {
        $query = Database::getFactory()->getConnection(SETTING["db-name"])->prepare("SELECT id AS 'tID', title, (SELECT COUNT(id) FROM forum_posts WHERE section_id = :id AND topic_id = tID) as replyCount FROM forum_posts WHERE section_id = :id AND topic_id = -1 ORDER BY posted DESC");
        $query->execute(array(":id" => $section));
        
        if ($query->rowCount() == 0) { return false; } 
        return $query->fetchAll();
    }

    public function getTopic($id) {
        $query = Database::getFactory()->getConnection(SETTING["db-name"])->prepare("SELECT forum_posts.id, forum_posts.title, forum_posts.content, accounts.steamName, accounts.steamID, accounts.steampfpmed, accounts.steampfplarge, forum_posts.posted FROM forum_posts INNER JOIN accounts WHERE forum_posts.id = :id AND accounts.steamID = forum_posts.author AND topic_id = -1 LIMIT 1");
        $query->execute(array(":id" => $id));
        
        if ($query->rowCount() == 0) { return false; } 

        $return = $query->fetch();
        $return->replies = self::getReplies($id);

        return $return;
    }

    public function getLastPost($section) {
        $query = Database::getFactory()->getConnection(SETTING["db-name"])->prepare("SELECT forum_posts.id, forum_posts.topic_id, forum_posts.title, forum_sections.id as `sID`, forum_sections.title as `sTitle`, accounts.steamName, accounts.steamID, accounts.steampfpmed, forum_posts.posted FROM forum_posts INNER JOIN accounts INNER JOIN forum_sections WHERE forum_sections.id = forum_posts.section_id AND accounts.steamID = forum_posts.author AND section_id = :id ORDER BY posted DESC LIMIT 1");
        $query->execute(array(":id" => $section));
        
        if ($query->rowCount() == 0) { return false; } 
        return $query->fetch();
    }

    public function getTopicFromUser($steamid) {
        $query = Database::getFactory()->getConnection(SETTING["db-name"])->prepare("SELECT forum_posts.id, forum_posts.topic_id, forum_posts.title, forum_sections.id as `sID`, forum_sections.title as `sTitle`, accounts.steamName, accounts.steamID, accounts.steampfpmed, forum_posts.posted FROM forum_posts INNER JOIN accounts INNER JOIN forum_sections WHERE forum_posts.author = :sid AND forum_sections.id = forum_posts.section_id AND accounts.steamID = forum_posts.author ORDER BY forum_posts.posted DESC LIMIT 25");
        $query->execute(array(":sid" => $steamid));
        
        if ($query->rowCount() == 0) { return false; } 
        return $query->fetchAll();
    }

    public function countPostsByUser($steamid) {
        $query = Database::getFactory()->getConnection(SETTING["db-name"])->prepare("SELECT COUNT(id) as `count` FROM forum_posts WHERE author = :sid");
        $query->execute(array(":sid" => $steamid));
        
        if ($query->rowCount() == 0) { return false; } 
        return $query->fetch();
    }

    public function getReplies($topic) {
        $query = Database::getFactory()->getConnection(SETTING["db-name"])->prepare("SELECT forum_posts.id, forum_posts.title, forum_posts.content, accounts.steamName, accounts.steamID, accounts.steampfpmed, accounts.steampfplarge, forum_posts.posted  FROM forum_posts INNER JOIN accounts WHERE accounts.steamID = forum_posts.author AND forum_posts.topic_id = :id ORDER BY posted ASC");
        $query->execute(array(":id" => $topic));
        
        if ($query->rowCount() == 0) { return false; } 
        return $query->fetchAll();
    }

    public function getLastReply($topic) {
        $query = Database::getFactory()->getConnection(SETTING["db-name"])->prepare("SELECT forum_posts.id, forum_posts.topic_id, forum_posts.title, accounts.steamName, accounts.steamID, accounts.steampfpmed, forum_posts.posted FROM forum_posts INNER JOIN accounts WHERE accounts.steamID = forum_posts.author AND topic_id = :id ORDER BY posted DESC LIMIT 1");
        $query->execute(array(":id" => $topic));
        
        if ($query->rowCount() == 0) { return false; } 
        return $query->fetch();
    }
}