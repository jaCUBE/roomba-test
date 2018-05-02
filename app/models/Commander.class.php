<?php

/**
 * Commanding center a.k.a. brain for Roomba.
 * @class Command
 * @author Jakub Rychecký <jakub@rychecky.cz>
 */

// @TODO Maybe utilize Iterator (SplDoublyLinkedList)?

class Commander
{
    /**
     * @var array $queue Coomands in queue
     */
    public $queue = [];

    /**
     * @var int $backoff_state Current state of back off strategy (0 = disabled)
     */
    public $backoff_state = 0;


    /**
     * Commander constructor.
     * @param array $commands Command queue in array
     */

    public function __construct(array $commands)
    {
        // Filter only correct commands
        $this->queue = array_filter($commands, function ($command) {
            return in_array($command, Command::list());
        });

        $this->resetQueueKeys();
    }

    /**
     * Resets queue array keys in order to keep current command in the index of zero.
     * @return void
     */
    protected function resetQueueKeys(): void
    {
        $this->queue = array_values($this->queue);
    }

    /**
     * Pop up current command for Roomba.
     * @return string Current command
     */

    public function getCommand(): string
    {
        // Retrieves current command if there are any
        if ($this->hasCommands()) {
            $command = @$this->queue[0];
            $this->doneCommand();
        }

        return $command ?? '';
    }

    /**
     * Checks if there are any commands in queue.
     * @return bool Are there any commands in queue?
     */

    public function hasCommands(): bool
    {
        return !empty($this->queue);
    }

    /**
     * Marks current command as done.
     * @return void
     */

    public function doneCommand(): void
    {
        // Unsets current command and resets keys
        unset($this->queue[0]);
        $this->resetQueueKeys();
    }

    /**
     * Add back off strategy of appropriate state into the command queue.
     * @return void
     */

    public function addBackOff(): void
    {
        // Adds backoff strategy and raise back off by one
        $this->addCommands(Command::backoff($this->backoff_state));
        $this->backoff_state++;
    }


    /**
     * Adds array of commands into the front of queue.
     * @param array $commands Commands in array
     * @return void
     */
    public function addCommands(array $commands): void
    {
        $this->queue = array_merge($commands, $this->queue);
        $this->resetQueueKeys();
    }


    /**
     * Resets back off strategy state to zero.
     * @return void
     */

    public function resetBackOff(): void
    {
        $this->backoff_state = 0;
    }

}