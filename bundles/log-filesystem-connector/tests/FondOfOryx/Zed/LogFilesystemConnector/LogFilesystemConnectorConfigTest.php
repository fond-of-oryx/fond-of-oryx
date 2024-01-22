<?php

namespace FondOfOryx\Zed\LogFilesystemConnector;

use Codeception\Test\Unit;
use Monolog\Logger;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Shared\Log\LogConstants;

class LogFilesystemConnectorConfigTest extends Unit
{
    protected LogFilesystemConnectorConfig|MockObject $config;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->config = $this->getMockBuilder(LogFilesystemConnectorConfig::class)
            ->onlyMethods(['get'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testGetApplicationLogDestinationPath(): void
    {
        $applicationLogDestinationPath = sprintf(
            '%s/data/log/%s/Zed/application.log',
            APPLICATION_ROOT_DIR,
            APPLICATION_STORE,
        );

        static::assertEquals($applicationLogDestinationPath, $this->config->getApplicationLogDestinationPath());
    }

    /**
     * @return void
     */
    public function testGetExceptionLogDestinationPath(): void
    {
        $exceptionLogDestinationPath = sprintf(
            '%s/data/log/%s/Zed/exception.log',
            APPLICATION_ROOT_DIR,
            APPLICATION_STORE,
        );

        static::assertEquals($exceptionLogDestinationPath, $this->config->getExceptionLogDestinationPath());
    }

    /**
     * @return void
     */
    public function testGetMaxFiles(): void
    {
        static::assertEquals(10, $this->config->getMaxFiles());
    }

    /**
     * @return void
     */
    public function testGetLogLeve(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->with(LogConstants::LOG_LEVEL)
            ->willReturn(Logger::INFO);

        static::assertEquals(Logger::INFO, $this->config->getLogLevel());
    }
}
