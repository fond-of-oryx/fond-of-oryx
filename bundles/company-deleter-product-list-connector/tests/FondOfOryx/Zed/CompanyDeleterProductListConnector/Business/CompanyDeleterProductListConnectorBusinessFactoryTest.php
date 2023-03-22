<?php

namespace FondOfOryx\Zed\CompanyDeleterProductListConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterProductListConnector\Business\Model\CompanyToProductListDeleter;
use FondOfOryx\Zed\CompanyDeleterProductListConnector\Persistence\CompanyDeleterProductListConnectorEntityManager;
use Spryker\Zed\Kernel\Container;

class CompanyDeleterProductListConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterProductListConnector\Persistence\CompanyDeleterProductListConnectorEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterProductListConnector\Business\CompanyDeleterProductListConnectorBusinessFactory
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

        $this->entityManagerMock = $this->getMockBuilder(CompanyDeleterProductListConnectorEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new CompanyDeleterProductListConnectorBusinessFactory();
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
