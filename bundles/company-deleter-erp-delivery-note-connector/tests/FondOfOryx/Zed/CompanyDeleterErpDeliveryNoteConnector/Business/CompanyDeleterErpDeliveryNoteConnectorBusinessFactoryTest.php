<?php

namespace FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Business\Model\ErpDeliveryNoteDeleter;
use FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Persistence\CompanyDeleterErpDeliveryNoteConnectorEntityManager;
use Spryker\Zed\Kernel\Container;

class CompanyDeleterErpDeliveryNoteConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Persistence\CompanyDeleterErpDeliveryNoteConnectorEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Business\CompanyDeleterErpDeliveryNoteConnectorBusinessFactory
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

        $this->entityManagerMock = $this->getMockBuilder(CompanyDeleterErpDeliveryNoteConnectorEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new CompanyDeleterErpDeliveryNoteConnectorBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
        $this->businessFactory->setEntityManager($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testCreateErpDeliveryNoteDeleter(): void
    {
        static::assertInstanceOf(
            ErpDeliveryNoteDeleter::class,
            $this->businessFactory->createErpDeliveryNoteDeleter(),
        );
    }
}
