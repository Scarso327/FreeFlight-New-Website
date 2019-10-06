<?php

class Accounts {
    public function IsUser($steamid) {
        $query = Database::getFactory()->getConnection(SETTING["db-name"])->prepare("SELECT steamid FROM accounts WHERE steamid = :steamid limit 1");
        $query->execute(array(":steamid" => $steamid));
        
        if ($query->rowCount() == 0) { return false; } 
        return true;
    }

    public function GetUser($steamid) {
        $query = Database::getFactory()->getConnection(SETTING["db-name"])->prepare("SELECT * FROM accounts WHERE steamid = :steamid limit 1");
        $query->execute(array(":steamid" => $steamid));
        
        if ($query->rowCount() == 0) { return false; } 
        return $query->fetch();
    }

    public function UpdateLastVisit($steamid) {
        $query = Database::getFactory()->getConnection(SETTING["db-name"])->prepare("UPDATE accounts SET last_visit = NOW() WHERE steamid = :steamid");
        $query->execute(array(':steamid' => $steamid));
        
        if($query->rowCount() > 0) { return true; }
        return false;
    }

    public function createUser($name = null, $steamid = null) {
        if($name != null && $steamid != null) {
            $query = Database::getFactory()->getConnection(SETTING["db-name"])->prepare("INSERT INTO accounts (name, steamID) VALUES (:name, :steamID)");
            $query->execute(array(':name' => $name, ':steamID' => $steamid));
            if ($query->rowCount() == 1) { return true; }
        }

        return false;
    }

    public function updateSteam($steamid, $steaminfo) {
        $statement = "UPDATE accounts
                      SET steamName = :steamName, steamid = :steamid, steampfp = :steampfp, steampfpmed = :steampfpmed, steampfplarge = :steampfplarge
                      WHERE steamid = :steamid LIMIT 1";
        $db = Database::getFactory()->getConnection(SETTING["db-name"]);
        $query = $db->prepare($statement);
        $query->execute(array(
            ':steamid' => $steamid, 
            ':steamName' => $steaminfo["steam-name"],
            ':steampfp' => $steaminfo["steam-pfp"],
            ':steampfpmed' => $steaminfo["steam-pfp-medium"],
            ':steampfplarge' => $steaminfo["steam-pfp-full"]
        ));
        
        if($query->rowCount() > 0) { return true; }
        return false;
    }

    public function checkToken($steamid, $token) {
        $query = Database::getFactory()->getConnection(SETTING["db-name"])->prepare("SELECT steamid FROM accounts WHERE steamid = :steamid AND remember_token = :token limit 1");
        $query->execute(array(":steamid" => $steamid, ":token" => $token));
        
        if ($query->rowCount() == 0) { return false; } 
        return true;
    }

    public function setToken($steamid) {
        if (!(self::IsUser($steamid))) { return false; }

        // Create the token!
        $token = Application::randomStrGen(64);

        // Update our database!
        $statement = "UPDATE accounts SET remember_token = :token WHERE steamid = :steamid";
        $db = Database::getFactory()->getConnection(SETTING["db-name"]);
        $query = $db->prepare($statement);
        $query->execute(array(
            ':steamid' => $steamid, 
            ':token' => $token
        ));

        return $token;
    }
}