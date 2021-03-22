<?php

namespace recurring_message\refaltor\task;

use pocketmine\scheduler\Task;
use pocketmine\Server;
use recurring_message\refaltor\Register;

class msgTask extends Task
{
    public $message;
    public $time;

    /** @var Register */
    public $register;

    public function __construct($message, $time, $register)
    {
        $this->message = $message;
        $this->time = $time;
        $this->register = $register;
    }

    public function onRun(int $currentTick)
    {
        $message = $this->message;
        $time = $this->time;
        Server::getInstance()->broadcastMessage($message);
        $this->register->getScheduler()->scheduleDelayedRepeatingTask(new msgTask($message, $time, $this->register), $time * 20, 20);
        $this->register->getScheduler()->cancelTask($this->getTaskId());
    }
}