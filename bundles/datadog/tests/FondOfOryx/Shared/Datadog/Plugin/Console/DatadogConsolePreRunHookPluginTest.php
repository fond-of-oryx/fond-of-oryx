<?php

namespace FondOfOryx\Shared\Datadog\Plugin\Console;

use Codeception\Test\Unit;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DatadogConsolePreRunHookPluginTest extends Unit
{
    protected InputInterface|MockObject $inputMock;

    protected MockObject|OutputInterface $outputMock;

    protected DatadogConsolePreRunHookPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->inputMock = $this->getMockBuilder(InputInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->outputMock = $this->getMockBuilder(OutputInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new DatadogConsolePreRunHookPlugin();
    }

    /**
     * @return void
     */
    public function testPreRun(): void
    {
        static::assertEquals(0, $this->plugin->preRun($this->inputMock, $this->outputMock));
    }
}
