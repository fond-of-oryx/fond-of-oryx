<?php

namespace FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Business\Writer\SalesOrderAddressWriter;
use FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Persistence\CompanyUnitAddressSalesConnectorEntityManager;

class CompanyUnitAddressSalesConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Persistence\CompanyUnitAddressSalesConnectorEntityManager|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Business\CompanyUnitAddressSalesConnectorBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(CompanyUnitAddressSalesConnectorEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompanyUnitAddressSalesConnectorBusinessFactory();
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
