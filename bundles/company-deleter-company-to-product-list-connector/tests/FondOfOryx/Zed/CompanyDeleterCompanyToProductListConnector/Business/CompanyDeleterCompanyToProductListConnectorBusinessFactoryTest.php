<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Business\Model\CompanyToProductListDeleter;
use FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Persistence\CompanyDeleterCompanyToProductListConnectorEntityManager;
use Spryker\Zed\Kernel\Container;

class CompanyDeleterCompanyToProductListConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Persistence\CompanyDeleterCompanyToProductListConnectorEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Business\CompanyDeleterCompanyToProductListConnectorBusinessFactory
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

        $this->entityManagerMock = $this->getMockBuilder(CompanyDeleterCompanyToProductListConnectorEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new CompanyDeleterCompanyToProductListConnectorBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
        $this->businessFactory->setEntityManager($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyToProductListDeleter(): void
    {
        static::assertInstanceOf(
            CompanyToProductListDeleter::class,
            $this->businessFactory->createCompanyToProductListDeleter(),
        );
    }
}
