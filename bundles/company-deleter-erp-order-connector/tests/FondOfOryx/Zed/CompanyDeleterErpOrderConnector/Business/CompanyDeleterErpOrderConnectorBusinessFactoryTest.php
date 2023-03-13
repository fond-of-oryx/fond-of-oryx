<?php

namespace FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Business\Model\ErpOrderDeleter;
use FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Persistence\CompanyDeleterErpOrderConnectorEntityManager;
use Spryker\Zed\Kernel\Container;

class CompanyDeleterErpOrderConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Persistence\CompanyDeleterErpOrderConnectorEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Business\CompanyDeleterErpOrderConnectorBusinessFactory
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

        $this->entityManagerMock = $this->getMockBuilder(CompanyDeleterErpOrderConnectorEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new CompanyDeleterErpOrderConnectorBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
        $this->businessFactory->setEntityManager($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testCreateErpOrderDeleter(): void
    {
        static::assertInstanceOf(
            ErpOrderDeleter::class,
            $this->businessFactory->createErpOrderDeleter(),
        );
    }
}
