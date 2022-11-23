<?php

namespace FondOfOryx\Zed\CompanyProductListsRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyProductListsRestApi\Business\Persister\CompanyProductListRelationPersister;
use FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiEntityManager;
use FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiRepository;
use Psr\Log\LoggerInterface;
use Spryker\Shared\Log\Config\LoggerConfigInterface;

class CompanyProductListsRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiEntityManager|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Psr\Log\LoggerInterface
     */
    protected $loggerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListsRestApi\Business\CompanyProductListsRestApiBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(CompanyProductListsRestApiEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanyProductListsRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new class ($this->loggerMock) extends CompanyProductListsRestApiBusinessFactory {
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
    public function testCreateCompanyProductListRelationPersister(): void
    {
        static::assertInstanceOf(
            CompanyProductListRelationPersister::class,
            $this->businessFactory->createCompanyProductListRelationPersister(),
        );
    }
}
