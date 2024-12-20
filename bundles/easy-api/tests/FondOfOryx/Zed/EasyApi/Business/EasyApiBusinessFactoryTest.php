<?php

namespace FondOfOryx\Zed\EasyApi\Business;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\EasyApi\Business\Model\ApiWrapper;
use FondOfOryx\Zed\EasyApi\Dependency\Client\EasyApiToGuzzleClientInterface;
use FondOfOryx\Zed\EasyApi\EasyApiConfig;
use FondOfOryx\Zed\EasyApi\EasyApiDependencyProvider;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Log\LoggerInterface;
use Spryker\Shared\Log\Config\LoggerConfigInterface;
use Spryker\Zed\Kernel\Container;

class EasyApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\EasyApi\Dependency\Client\EasyApiToGuzzleClientInterface
     */
    protected MockObject|EasyApiToGuzzleClientInterface $guzzleClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected MockObject|Container $containerMock;

    /**
     * @var \Psr\Log\LoggerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected LoggerInterface|MockObject $loggerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\EasyApi\EasyApiConfig
     */
    protected MockObject|EasyApiConfig $configMock;

    /**
     * @var \FondOfOryx\Zed\EasyApi\Business\EasyApiBusinessFactory
     */
    protected EasyApiBusinessFactory $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->guzzleClientMock = $this->getMockBuilder(EasyApiToGuzzleClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(EasyApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new class ($this->loggerMock) extends EasyApiBusinessFactory {
            /**
             * @var \Psr\Log\LoggerInterface
             */
            protected LoggerInterface $loggerMock;

            /**
             * @param \Psr\Log\LoggerInterface $logger
             */
            public function __construct(LoggerInterface $logger)
            {
                $this->loggerMock = $logger;
            }

            /**
             * @param \Spryker\Shared\Log\Config\LoggerConfigInterface|null $loggerConfig
             *
             * @return \Psr\Log\LoggerInterface
             */
            protected function getLogger(?LoggerConfigInterface $loggerConfig = null): LoggerInterface
            {
                return $this->loggerMock;
            }
        };
        $this->businessFactory->setContainer($this->containerMock);
        $this->businessFactory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateApiWrapper(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case EasyApiDependencyProvider::CLIENT_GUZZLE:
                        return $self->guzzleClientMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            ApiWrapper::class,
            $this->businessFactory->createApiWrapper(),
        );
    }
}
