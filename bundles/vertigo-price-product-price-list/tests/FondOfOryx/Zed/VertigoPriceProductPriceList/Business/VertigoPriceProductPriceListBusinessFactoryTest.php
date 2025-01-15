<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Business;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Requester\PriceProductPriceListRequester;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Dependency\Facade\VertigoPriceProductPriceListToProductFacadeInterface;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Dependency\Service\VertigoPriceProductPriceListToUtilEncodingServiceInterface;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Persistence\VertigoPriceProductPriceListRepository;
use FondOfOryx\Zed\VertigoPriceProductPriceList\VertigoPriceProductPriceListConfig;
use FondOfOryx\Zed\VertigoPriceProductPriceList\VertigoPriceProductPriceListDependencyProvider;
use Psr\Log\LoggerInterface;
use Spryker\Shared\Log\Config\LoggerConfigInterface;
use Spryker\Zed\Kernel\Container;

class VertigoPriceProductPriceListBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Persistence\VertigoPriceProductPriceListRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\VertigoPriceProductPriceListConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Psr\Log\LoggerInterface
     */
    protected $loggerMock;

    /**
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Dependency\Facade\VertigoPriceProductPriceListToProductFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productFacadeMock;

    /**
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Dependency\Service\VertigoPriceProductPriceListToUtilEncodingServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $utilEncodingServiceMock;

    /**
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\VertigoPriceProductPriceListBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(VertigoPriceProductPriceListRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(VertigoPriceProductPriceListConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productFacadeMock = $this->getMockBuilder(VertigoPriceProductPriceListToProductFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->utilEncodingServiceMock = $this->getMockBuilder(VertigoPriceProductPriceListToUtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new class ($this->loggerMock) extends VertigoPriceProductPriceListBusinessFactory {
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

        $this->factory->setRepository($this->repositoryMock);
        $this->factory->setConfig($this->configMock);
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreatePriceProductPriceListRequester(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case VertigoPriceProductPriceListDependencyProvider::SERVICE_UTIL_ENCODING:
                        return $self->utilEncodingServiceMock;
                    case VertigoPriceProductPriceListDependencyProvider::FACADE_PRODUCT:
                        return $self->productFacadeMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            PriceProductPriceListRequester::class,
            $this->factory->createPriceProductPriceListRequester(),
        );
    }
}
