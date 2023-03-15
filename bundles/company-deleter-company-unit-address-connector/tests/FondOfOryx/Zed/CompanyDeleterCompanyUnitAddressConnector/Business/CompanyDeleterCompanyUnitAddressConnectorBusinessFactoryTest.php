<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Business\Model\CompanyUnitAddressDeleter;
use FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Persistence\CompanyDeleterCompanyUnitAddressConnectorEntityManager;
use Spryker\Zed\Kernel\Container;

class CompanyDeleterCompanyUnitAddressConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Persistence\CompanyDeleterCompanyUnitAddressConnectorEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Business\CompanyDeleterCompanyUnitAddressConnectorBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(CompanyDeleterCompanyUnitAddressConnectorEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new CompanyDeleterCompanyUnitAddressConnectorBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
        $this->businessFactory->setEntityManager($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyUnitAddressDeleter(): void
    {
        static::assertInstanceOf(
            CompanyUnitAddressDeleter::class,
            $this->businessFactory->createCompanyUnitAddressDeleter(),
        );
    }
}
