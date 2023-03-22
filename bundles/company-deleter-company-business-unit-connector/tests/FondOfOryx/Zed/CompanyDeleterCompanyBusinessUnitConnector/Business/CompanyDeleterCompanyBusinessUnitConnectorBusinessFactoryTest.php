<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Business\Model\BusinessUnitDeleter;
use FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Persistence\CompanyDeleterCompanyBusinessUnitConnectorEntityManager;
use Spryker\Zed\Kernel\Container;

class CompanyDeleterCompanyBusinessUnitConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Persistence\CompanyDeleterCompanyBusinessUnitConnectorEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Business\CompanyDeleterCompanyBusinessUnitConnectorBusinessFactory
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

        $this->entityManagerMock = $this->getMockBuilder(CompanyDeleterCompanyBusinessUnitConnectorEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new CompanyDeleterCompanyBusinessUnitConnectorBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
        $this->businessFactory->setEntityManager($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testCreateBusinessUnitDeleter(): void
    {
        static::assertInstanceOf(
            BusinessUnitDeleter::class,
            $this->businessFactory->createBusinessUnitDeleter(),
        );
    }
}
