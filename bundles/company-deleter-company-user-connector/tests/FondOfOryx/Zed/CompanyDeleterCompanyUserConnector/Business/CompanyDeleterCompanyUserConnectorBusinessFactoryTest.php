<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Business\Model\CompanyUserDeleter;
use FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Persistence\CompanyDeleterCompanyUserConnectorEntityManager;
use Spryker\Zed\Kernel\Container;

class CompanyDeleterCompanyUserConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Persistence\CompanyDeleterCompanyUserConnectorEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Business\CompanyDeleterCompanyUserConnectorBusinessFactory
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

        $this->entityManagerMock = $this->getMockBuilder(CompanyDeleterCompanyUserConnectorEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new CompanyDeleterCompanyUserConnectorBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
        $this->businessFactory->setEntityManager($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyUserDeleter(): void
    {
        static::assertInstanceOf(
            CompanyUserDeleter::class,
            $this->businessFactory->createCompanyUserDeleter(),
        );
    }
}
