<?php

use PHPUnit\Framework\TestCase;

class CommanderTest extends TestCase
{

    /**
     * Tests command management of commander.
     */
    public function testCommandManagement()
    {
        $commander = new Commander(['TL', 'C']);

        $this->assertEquals($commander->getCommand(), 'TL');
        $this->assertEquals($commander->hasCommands(), true);
        $this->assertEquals($commander->getCommand(), 'C');
        $this->assertEquals($commander->hasCommands(), false);
    }


    /**
     * Tests command management of commander.
     */
    public function testBackoff()
    {
        $commander = new Commander([]);

        $this->assertEquals($commander->backoff_state, 0);
        $commander->addBackOff();
        $this->assertEquals($commander->backoff_state, 1);
        $this->assertEquals($commander->queue, Command::backoff(0));

    }


}