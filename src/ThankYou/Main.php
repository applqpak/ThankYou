<?php

  namespace ThankYou;
  
  use pocketmine\plugin\PluginBase;
  use pocketmine\event\Listener;
  use pocketmine\utils\TextFormat as TF;
  use pocketmine\command\Command;
  use pocketmine\command\CommandSender;
  
  class Main extends PluginBase implements Listener {
  
    public function onEnable() {
    
      $this->getServer()->getPluginManager()->registerEvents($this, $this);
      
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
    
      if(strtolower($cmd->getName()) === "thank") {
      
        if(!(isset($args[0]) and isset($args[1]))) {
        
          $sender->sendMessage(TF::RED . "Error: not enough args. Usage: /thank <player> < reason >");
          
          return true;
          
        } else {
        
          $name = $args[0];
          
          $player = $this->getServer()->getPlayer($name);
          
          $sender_name = $sender->getName();
          
          if($player === null) {
          
            $sender->sendMessage(TF::RED . "Player " . $name . " was not found.");
            
            return true;
            
          } else {
          
            $player_name = $player->getName();
            
            $player_display_name = $player->getDisplayName();
          
            unset($args[0]);
            
            $reason = implode(" ", $args);
            
            $this->getServer()->broadcastMessage(TF::YELLOW . $player_name . " has been thanked by " . $display_name . " for " . $reason);
            
            $player->sendMessage(TF::GREEN . "You have been thanked by " . $sender_name . " for " . $reason);
            
            $sender->sendMessage(TF::GREEN . "You thanked " . $player_name . ".");
            
            return true;
            
          }
          
        }
        
      }
      
    }
    
  }
  
?>
