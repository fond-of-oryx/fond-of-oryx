<?php

namespace FondOfOryx\Zed\CustomerProductListConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListConnector\Business\Persister\CustomerProductListRelationPersister;
use FondOfOryx\Zed\CustomerProductListConnector\Business\Reader\ProductListReader;
use FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorEntityManager;
use FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorRepository;

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

        $this->factory = new CustomerProductListConnectorBusinessFactory();
        $this->factory->setEntityManager($this->entityManagerMock);
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCustomerProductListRelationPersister(): void
    {
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
