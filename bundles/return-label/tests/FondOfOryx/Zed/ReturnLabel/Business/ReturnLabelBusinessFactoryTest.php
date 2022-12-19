<?php

namespace FondOfOryx\Zed\ReturnLabel\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabel\Business\Model\ReturnLabelGenerator;
use FondOfOryx\Zed\ReturnLabel\Dependency\Service\ReturnLabelToUtilEncodingServiceBridge;
use FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig;
use FondOfOryx\Zed\ReturnLabel\ReturnLabelDependencyProvider;
use Psr\Log\LoggerInterface;
use Spryker\Shared\Log\Config\LoggerConfigInterface;
use Spryker\Zed\Kernel\Container;

class ReturnLabelBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $loggerMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Dependency\Service\ReturnLabelToUtilEncodingServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelToUtilEncodingServiceMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\ReturnLabelBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(ReturnLabelConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelToUtilEncodingServiceMock = $this->getMockBuilder(ReturnLabelToUtilEncodingServiceBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new class ($this->loggerMock) extends ReturnLabelBusinessFactory {
            /**
             * @var \Psr\Log\LoggerInterface
             */
            protected $loggerMock;

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
            public function getLogger(?LoggerConfigInterface $loggerConfig = null): LoggerInterface
            {
                return $this->loggerMock;
            }
        };
        $this->factory->setContainer($this->containerMock);
        $this->factory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateReturnLabelGenerator(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([ReturnLabelDependencyProvider::SERVICE_UTIL_ENCODING])
            ->willReturnOnConsecutiveCalls($this->returnLabelToUtilEncodingServiceMock);

        static::assertInstanceOf(
            ReturnLabelGenerator::class,
            $this->factory->createReturnLabelGenerator(),
        );
    }
}
