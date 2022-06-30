<?php

namespace FondOfOryx\Zed\CustomerAddressSalesConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerAddressSalesConnector\Business\Writer\SalesOrderAddressWriter;
use FondOfOryx\Zed\CustomerAddressSalesConnector\Persistence\CustomerAddressSalesConnectorEntityManager;

class CustomerAddressSalesConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerAddressSalesConnector\Persistence\CustomerAddressSalesConnectorEntityManager|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CustomerAddressSalesConnector\Business\CustomerAddressSalesConnectorBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(CustomerAddressSalesConnectorEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CustomerAddressSalesConnectorBusinessFactory();
        $this->factory->setEntityManager($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testCreateSalesOrderAddressWriter(): void
    {
        static::assertInstanceOf(
            SalesOrderAddressWriter::class,
            $this->factory->createSalesOrderAddressWriter(),
        );
    }
}
