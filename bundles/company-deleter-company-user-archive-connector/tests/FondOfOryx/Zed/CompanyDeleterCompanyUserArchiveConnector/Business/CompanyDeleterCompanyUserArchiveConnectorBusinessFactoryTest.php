<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Business\Model\CompanyUserArchiveDeleter;
use FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Persistence\CompanyDeleterCompanyUserArchiveConnectorEntityManager;
use Spryker\Zed\Kernel\Container;

class CompanyDeleterCompanyUserArchiveConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Persistence\CompanyDeleterCompanyUserArchiveConnectorEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Business\CompanyDeleterCompanyUserArchiveConnectorBusinessFactory
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

        $this->entityManagerMock = $this->getMockBuilder(CompanyDeleterCompanyUserArchiveConnectorEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new CompanyDeleterCompanyUserArchiveConnectorBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
        $this->businessFactory->setEntityManager($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyUserArchiveDeleter(): void
    {
        static::assertInstanceOf(
            CompanyUserArchiveDeleter::class,
            $this->businessFactory->createCompanyUserArchiveDeleter(),
        );
    }
}
