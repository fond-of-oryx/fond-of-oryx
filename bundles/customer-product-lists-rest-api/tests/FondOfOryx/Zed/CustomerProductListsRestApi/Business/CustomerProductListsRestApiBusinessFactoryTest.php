<?php

namespace FondOfOryx\Zed\CustomerProductListsRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListsRestApi\Business\Persister\CustomerProductListRelationPersister;
use FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiEntityManager;
use FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiRepository;
use Psr\Log\LoggerInterface;
use Spryker\Shared\Log\Config\LoggerConfigInterface;

class CustomerProductListsRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiEntityManager|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Psr\Log\LoggerInterface
     */
    protected $loggerMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Business\CustomerProductListsRestApiBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(CustomerProductListsRestApiEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CustomerProductListsRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new class ($this->loggerMock) extends CustomerProductListsRestApiBusinessFactory {
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

        $this->businessFactory->setEntityManager($this->entityManagerMock);
        $this->businessFactory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCustomerProductListRelationPersister(): void
    {
        static::assertInstanceOf(
            CustomerProductListRelationPersister::class,
            $this->businessFactory->createCustomerProductListRelationPersister(),
        );
    }
}
