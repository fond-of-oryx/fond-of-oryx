<?php

namespace FondOfOryx\Zed\LogSlackConnector\Communication;

use Codeception\Test\Unit;
use FondOfOryx\Zed\LogSlackConnector\LogSlackConnectorConfig;
use Monolog\Handler\SlackHandler;
use Monolog\Logger;

class LogSlackConnectorCommunicationFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\LogSlackConnector\Communication\LogSlackConnectorCommunicationFactory
     */
    protected $factory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\LogSlackConnector\LogSlackConnectorConfig
     */
    protected $configMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->configMock = $this->getMockBuilder(LogSlackConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new LogSlackConnectorCommunicationFactory();
        $this->factory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateSlackHandler(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getLogLevel')
            ->willReturn(Logger::ERROR);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSlackToken')
            ->willReturn('');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSlackChannel')
            ->willReturn('');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSlackUsername')
            ->willReturn('');

        static::assertInstanceOf(
            SlackHandler::class,
            $this->factory->createSlackHandler(),
        );
    }
}
