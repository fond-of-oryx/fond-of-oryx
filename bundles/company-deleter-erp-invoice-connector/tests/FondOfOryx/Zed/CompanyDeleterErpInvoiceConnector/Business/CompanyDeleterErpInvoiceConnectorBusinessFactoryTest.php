<?php

namespace FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Business\Model\ErpInvoiceDeleter;
use FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Persistence\CompanyDeleterErpInvoiceConnectorEntityManager;
use Spryker\Zed\Kernel\Container;

class CompanyDeleterErpInvoiceConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Persistence\CompanyDeleterErpInvoiceConnectorEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Business\CompanyDeleterErpInvoiceConnectorBusinessFactory
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

        $this->entityManagerMock = $this->getMockBuilder(CompanyDeleterErpInvoiceConnectorEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new CompanyDeleterErpInvoiceConnectorBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
        $this->businessFactory->setEntityManager($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testCreateErpInvoiceDeleter(): void
    {
        static::assertInstanceOf(
            ErpInvoiceDeleter::class,
            $this->businessFactory->createErpInvoiceDeleter(),
        );
    }
}
