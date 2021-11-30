<?php

namespace FondOfOryx\Service\Trbo;

use Codeception\Test\Unit;
use GuzzleHttp\Client;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Spryker\Service\Kernel\Container;
use Spryker\Shared\Log\Config\LoggerConfigInterface;

class TrboServiceFactoryTest extends Unit
{
    /**
     * @var \Psr\Log\LoggerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $loggerMock;

    /**
     * @var \GuzzleHttp\ClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var \FondOfOryx\Service\Trbo\Api\TrboApiConfiguration|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $trboApiConfigurationMock;

    /**
     * @var \FondOfOryx\Service\Trbo\Mapper\TrboMapper|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $trboMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Service\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Service\Trbo\TrboConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Service\Trbo\TrboServiceFactory
     */
    protected $trboFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->loggerMock = $this->getMockBuilder(Logger::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(TrboConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->trboFactory = new class ($this->loggerMock) extends TrboServiceFactory {
            /**
             * @var \Psr\Log\LoggerInterface
             */
            protected $logger;

            /**
             * @param \Psr\Log\LoggerInterface $logger
             */
            public function __construct(LoggerInterface $logger)
            {
                $this->logger = $logger;
            }

            /**
             * @param \Spryker\Shared\Log\Config\LoggerConfigInterface|null $loggerConfig
             *
             * @return \Psr\Log\LoggerInterface
             */
            public function getLogger(?LoggerConfigInterface $loggerConfig = null): LoggerInterface
            {
                return $this->logger;
            }
        };
        $this->trboFactory->setContainer($this->containerMock);
        $this->trboFactory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateTrboApi(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(TrboDependencyProvider::HTTP_CLIENT)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(TrboDependencyProvider::HTTP_CLIENT)
            ->willReturn($this->clientMock);

        $this->trboFactory->createTrboApi();
    }
}
