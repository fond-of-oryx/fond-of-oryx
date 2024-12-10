<?php

namespace FondOfOryx\Zed\CompanyProductListConnector\Business;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CompanyProductListConnector\Business\Persister\CompanyProductListRelationPersister;
use FondOfOryx\Zed\CompanyProductListConnector\Business\Reader\ProductListReader;
use FondOfOryx\Zed\CompanyProductListConnector\CompanyProductListConnectorDependencyProvider;
use FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorEntityManager;
use FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorRepository;
use Psr\Log\LoggerInterface;
use Spryker\Shared\Log\Config\LoggerConfigInterface;
use Spryker\Zed\Kernel\Container;

class CompanyProductListConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorEntityManager|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorRepository|\PHPUnit\Framework\MockObject\MockObject|mixed
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
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Business\CompanyProductListConnectorBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(CompanyProductListConnectorEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanyProductListConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new class ($this->loggerMock) extends CompanyProductListConnectorBusinessFactory {
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
    public function testCreateCompanyProductListRelationPersister(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) {
                switch ($key) {
                    case CompanyProductListConnectorDependencyProvider::PLUGINS_COMPANY_PRODUCT_LIST_RELATION_POST_PERSIST:
                        return [];
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            CompanyProductListRelationPersister::class,
            $this->factory->createCompanyProductListRelationPersister(),
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
