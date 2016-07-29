<?php
namespace RemoveUnwantedItems;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
Use pocketmine\event\PlayerChatEvent
use pocketmine\item\Item;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerRespawnEvent;
class Main extends PluginBase implements Listener {
  public function onLoad() {
    $this->getLogger()->info(TextFormat::YELLOW . "Loading RemoveUnwantedItems...");
  }
 public function onEnable() {
    $this->saveDefaultConfig();
    $c = $this->getConfig()->getAll();
    $num = 0;
    foreach ($c["unwanted items"] as $i) {
      $r = explode(":",$i);
      $this->itemdata[$num] = array($r[0],$r[1],$r[2]);
      $num++;
    }
    $this->getServer()->getPluginManager()->registerEvents($this,$this);
    $this->getLogger()->info(TextFormat::YELLOW . "RemoveUnwantedItems enabled.");
  }
 
  public function playerSpawn(PlayerRespawnEvent $event) {
    if($event->getPlayer()->hasPermission("unwanted.items") {
      foreach($this->itemdata as $i) {
        $item = new Item(7,$i[1],$i[2]);
        $event->getPlayer()->getInventory()->removeItem($item);
        $this->getPlayer()->sendMessage("You are not allowed to keep $item")
      }
    }
  }
  public function onDisable() {
    $this->getLogger()->info(TextFormat::YELLOW . "Disabling RemoveUnwantedItems...");
  }
}
?>
