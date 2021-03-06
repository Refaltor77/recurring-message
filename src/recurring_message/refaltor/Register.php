<?php

namespace recurring_message\refaltor;

use pocketmine\plugin\PluginBase;
use recurring_message\refaltor\task\msgTask;

class Register extends PluginBase{
    public function onEnable()
    {
        $this->saveDefaultConfig();
        foreach ($this->getConfig()->get("message") as $values){
            $message = explode("<:>", $values);
            $this->getScheduler()->scheduleDelayedRepeatingTask(new msgTask($message[0], $message[1], $this), $this->secToTick($message[1]), 20);
        }
    }
    public function secToTick(int $sec): int { return $sec * 20; }

}
