<?php

namespace FondOfOryx\Zed\CompanyProductListConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyProductListConnector\Business\Persister\CompanyProductListRelationPersisterInterface;
use FondOfOryx\Zed\CompanyProductListConnector\Business\Reader\ProductListReaderInterface;
use Generated\Shared\Transfer\CompanyProductListRelationTransfer;

class CompanyProductListConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Business\CompanyProductListConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Business\Persister\CompanyProductListRelationPersisterInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyProductListPersisterMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyProductListRelationTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyProductListRelationTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Business\Reader\ProductListReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListReaderMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Business\CompanyProductListConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CompanyProductListConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyProductListPersisterMock = $this->getMockBuilder(CompanyProductListRelationPersisterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyProductListRelationTransferMock = $this->getMockBuilder(CompanyProductListRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListReaderMock = $this->getMockBuilder(ProductListReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyProductListConnectorFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testPersistCompanyProductListRelation(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyProductListRelationPersister')
            ->willReturn($this->companyProductListPersisterMock);

        $this->companyProductListPersisterMock->expects(static::atLeastOnce())
            ->method('persist')
            ->with($this->companyProductListRelationTransferMock);

        $this->facade->persistCompanyProductListRelation($this->companyProductListRelationTransferMock);
    }

    /**
     * @return void
     */
    public function testGetAssignedProductListIdsByIdCompany(): void
    {
        $idCompany = 1;
        $productListIds = [1, 2, 3, 4];

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createProductListReader')
            ->willReturn($this->productListReaderMock);

        $this->productListReaderMock->expects(static::atLeastOnce())
            ->method('getIdsByIdCompany')
            ->with($idCompany)
            ->willReturn($productListIds);

        static::assertEquals(
            $productListIds,
            $this->facade->getAssignedProductListIdsByIdCompany($idCompany),
        );
    }
}
