<?php
/**
 * Created by PhpStorm.
 * User: jaCUBE
 * Date: 26.04.2018
 * Time: 23:03
 */


class Commander
{
    public $queue = [];
    public $backoff_state = 0;

    public function __construct(array $commands)
    {
        $this->queue = $commands;
    }

    public function getCommand(): string
    {
        if ($this->hasCommands()) {
            $command = @$this->queue[0];
            $this->doneCommand();
        }

        return $command ?? '';
    }

    public function hasCommands(): bool
    {
        return !empty($this->queue);
    }

    public function doneCommand(): void
    {
        $command = @$this->queue[0];
        $this->addToHistory($command);
        unset($this->queue[0]);
        $this->resetQueueKeys();
    }

    protected function addToHistory(string $command): void
    {
        $this->history[] = ['c' => $command, 'b' => $this->backoff_state];
    }

    protected function resetQueueKeys(): void
    {
        $this->queue = array_values($this->queue);
    }

    public function raiseBackoff(): void
    {
        $this->addCommands($this->backoff());
        $this->backoff_state++;
    }

    public function addCommands(array $commands): void
    {
        $this->queue = array_merge($commands, $this->queue);
        $this->resetQueueKeys();
    }

    public function backoff(): array
    {
        $backoff = [
            ['TR', 'A'],
            ['TL', 'B', 'TR', 'A'],
            ['TL', 'TL', 'A'],
            ['TR', 'B', 'TR', 'A'],
            ['TL', 'TL', 'A']
        ];

        return $backoff[$this->backoff_state];
    }

    public function clearBackoff(): void
    {
        $this->backoff_state = 0;
    }

}