<?php

namespace BedWars;

use BedWars\MySQLPingTask;
use BedWars\BedWars;
use pocketmine\utils\TextFormat;

class MySQLManager{
    
    private $plugin;

    public static $database;
    
    public function __construct(BedWars $plugin){
        $this->plugin = $plugin;
        $this->createMySQLConnection();
    }
    
    public function createMySQLConnection(){
        $database = new \mysqli("82.208.17.11", "224877_mysql_db", "centrum", "224877_mysql_db");
        self::setDatabase($database);
        if($database->connect_error) {
            $this->plugin->getLogger()->critical("Nepodarilo se navazat pripojeni s databazi". $database->connect_error);
        }
        else {
            $this->plugin->getLogger()->info("§2Navazano pripojeni k §l§fBed§4Wars §r§3MySQL §2Serveru!");
            $this->plugin->getServer()->getScheduler()->scheduleRepeatingTask(new MySQLPingTask(), 20);
        }
    }

    public static function getMysqliConnection() {
        return new \mysqli("82.208.17.11", "224877_mysql_db", "centrum", "224877_mysql_db");
    }

    public static function setDatabase(\mysqli $database){
        self::$database = $database;
    }
    
    public static function getDatabase() {
        return self::$database;
    }

}
