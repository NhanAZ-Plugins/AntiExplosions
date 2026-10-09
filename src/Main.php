<?php

declare(strict_types=1);

namespace NhanAZ\AntiExplosions;

use pocketmine\event\entity\EntityPreExplodeEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {

	protected function onEnable(): void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveDefaultConfig();
	}

	public function onExplosionPrime(EntityPreExplodeEvent $event): void {
		$worldName = $event->getEntity()->getPosition()->getWorld()->getDisplayName();
		$worlds = $this->getConfig()->get("Worlds", []);
		if (!is_array($worlds)) {
			$worlds = [];
		}
		switch ($this->getConfig()->get("Mode", "all")) {
			case "all":
				$event->setBlockBreaking(false);
				break;
			case "whitelist":
				if (in_array($worldName, $worlds, true)) {
					$event->setBlockBreaking(false);
				}
				break;
			case "blacklist":
				if (!in_array($worldName, $worlds, true)) {
					$event->setBlockBreaking(false);
				}
				break;
			default:
				$event->setBlockBreaking(false);
				break;
		}
	}
}
