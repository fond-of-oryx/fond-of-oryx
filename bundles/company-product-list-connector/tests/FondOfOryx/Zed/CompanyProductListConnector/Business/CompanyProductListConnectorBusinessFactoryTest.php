<?php

namespace FondOfOryx\Zed\CompanyProductListConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyProductListConnector\Business\Persister\CompanyProductListRelationPersister;
use FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorEntityManager;
use FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorRepository;

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
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Business\CompanyProductListConnectorBusinessFactory
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

        $this->entityManagerMock = $this->getMockBuilder(CompanyProductListConnectorEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanyProductListConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompanyProductListConnectorBusinessFactory();
        $this->factory->setEntityManager($this->entityManagerMock);
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyProductListRelationPersister(): void
    {
        static::assertInstanceOf(
            CompanyProductListRelationPersister::class,
            $this->factory->createCompanyProductListRelationPersister(),
        );
    }
}
