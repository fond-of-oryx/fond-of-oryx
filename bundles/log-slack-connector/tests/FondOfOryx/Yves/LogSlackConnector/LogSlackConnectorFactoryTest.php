<?php

namespace FondOfOryx\Yves\LogSlackConnector;

use Codeception\Test\Unit;
use Monolog\Handler\SlackHandler;
use Monolog\Logger;

class LogSlackConnectorFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Yves\LogSlackConnector\LogSlackConnectorFactory
     */
    protected $factory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Yves\LogSlackConnector\LogSlackConnectorConfig
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

        $this->factory = new LogSlackConnectorFactory();
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
