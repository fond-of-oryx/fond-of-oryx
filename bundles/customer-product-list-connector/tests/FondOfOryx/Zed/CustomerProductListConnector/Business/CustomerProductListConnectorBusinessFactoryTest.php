<?php

namespace FondOfOryx\Zed\CustomerProductListConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListConnector\Business\Persister\CustomerProductListRelationPersister;
use FondOfOryx\Zed\CustomerProductListConnector\Business\Reader\ProductListReader;
use FondOfOryx\Zed\CustomerProductListConnector\CustomerProductListConnectorDependencyProvider;
use FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorEntityManager;
use FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorRepository;
use Psr\Log\LoggerInterface;
use Spryker\Shared\Log\Config\LoggerConfigInterface;
use Spryker\Zed\Kernel\Container;

class CustomerProductListConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorEntityManager|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorRepository|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $repositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Psr\Log\LoggerInterface
     */
    protected $loggerMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnector\Business\CustomerProductListConnectorBusinessFactory
     */
    protected $factory;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(CustomerProductListConnectorEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CustomerProductListConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new class ($this->loggerMock) extends CustomerProductListConnectorBusinessFactory {
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
            protected function getLogger(?LoggerConfigInterface $loggerConfig = null): LoggerInterface
            {
                return $this->logger;
            }
        };
        $this->factory->setEntityManager($this->entityManagerMock);
        $this->factory->setRepository($this->repositoryMock);
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCustomerProductListRelationPersister(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [CustomerProductListConnectorDependencyProvider::PLUGINS_CUSTOMER_PRODUCT_LIST_RELATION_POST_PERSIST],
            )->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CustomerProductListConnectorDependencyProvider::PLUGINS_CUSTOMER_PRODUCT_LIST_RELATION_POST_PERSIST],
            )->willReturnOnConsecutiveCalls([]);

        static::assertInstanceOf(
            CustomerProductListRelationPersister::class,
            $this->factory->createCustomerProductListRelationPersister(),
        );
    }

    /**
     * @return void
     */
    public function testCreateProductListReader(): void
    {
        static::assertInstanceOf(
            ProductListReader::class,
            $this->factory->createProductListReader(),
        );
    }
}
