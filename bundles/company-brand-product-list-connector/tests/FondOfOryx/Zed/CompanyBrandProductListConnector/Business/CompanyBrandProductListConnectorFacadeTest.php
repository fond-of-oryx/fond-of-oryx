<?php

namespace FondOfOryx\Zed\CompanyBrandProductListConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBrandProductListConnector\Business\Persister\CompanyBrandRelationPersisterInterface;
use Generated\Shared\Transfer\CompanyProductListRelationTransfer;

class CompanyBrandProductListConnectorFacadeTest extends Unit
{
 /**
  * @var \FondOfOryx\Zed\CompanyBrandProductListConnector\Business\Persister\CompanyBrandRelationPersisterInterface|\PHPUnit\Framework\MockObject\MockObject
  */
    protected $companyBrandRelationPersisterMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBrandProductListConnector\Business\CompanyBrandProductListConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyProductListRelationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyProductListRelationTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBrandProductListConnector\Business\CompanyBrandProductListConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBrandRelationPersisterMock = $this->getMockBuilder(CompanyBrandRelationPersisterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this->getMockBuilder(CompanyBrandProductListConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyProductListRelationTransferMock = $this->getMockBuilder(CompanyProductListRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyBrandProductListConnectorFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testPersistCompanyBrandRelationByCompanyProductListRelation(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyBrandRelationPersister')
            ->willReturn($this->companyBrandRelationPersisterMock);

        $this->companyBrandRelationPersisterMock->expects(static::atLeastOnce())
            ->method('persistByCompanyProductListRelation')
            ->with($this->companyProductListRelationTransferMock);

        $this->facade->persistCompanyBrandRelationByCompanyProductListRelation(
            $this->companyProductListRelationTransferMock,
        );
    }
}
