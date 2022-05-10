<?php

namespace FondOfOryx\Shared\LogAwsCloudWatchConnector;

use Maxbanton\Cwh\Handler\CloudWatch;
use Monolog\Formatter\FormatterInterface;
use Monolog\Handler\HandlerInterface;

trait AwsCloudWatchHandlerPluginTrait
{
    /**
     * @var \Maxbanton\Cwh\Handler\CloudWatch|null
     */
    protected $handler;

    /**
     * @return \Maxbanton\Cwh\Handler\CloudWatch
     */
    protected function getHandler(): CloudWatch
    {
        if ($this->handler === null) {
            $this->handler = $this->getFactory()->createCloudWatchHandler();
        }

        return $this->handler;
    }

    /**
     * @param array $record
     *
     * @return bool
     */
    public function isHandling(array $record): bool
    {
        return $this->getHandler()->isHandling($record);
    }

    /**
     * @param array $record
     *
     * @return bool
     */
    public function handle(array $record): bool
    {
        return $this->getHandler()->handle($record);
    }

    /**
     * @param array $records
     *
     * @return void
     */
    public function handleBatch(array $records): void
    {
        $this->getHandler()->handleBatch($records);
    }

    /**
     * @param callable $callback
     *
     * @return \Monolog\Handler\HandlerInterface
     */
    public function pushProcessor($callback): HandlerInterface
    {
        return $this->getHandler()->pushProcessor($callback);
    }

    /**
     * @return callable
     */
    public function popProcessor(): callable
    {
        return $this->getHandler()->popProcessor();
    }

    /**
     * @param \Monolog\Formatter\FormatterInterface $formatter
     *
     * @return \Monolog\Handler\HandlerInterface
     */
    public function setFormatter(FormatterInterface $formatter): HandlerInterface
    {
        return $this->getHandler()->setFormatter($formatter);
    }

    /**
     * @return \Monolog\Formatter\FormatterInterface
     */
    public function getFormatter(): FormatterInterface
    {
        return $this->getHandler()->getFormatter();
    }

    /**
     * @return void
     */
    public function close(): void
    {
        $this->getHandler()->close();
    }
}
