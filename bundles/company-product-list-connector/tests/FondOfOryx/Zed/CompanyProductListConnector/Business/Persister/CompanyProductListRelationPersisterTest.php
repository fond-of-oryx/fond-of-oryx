<?php

namespace FondOfOryx\Zed\CompanyProductListConnector\Business\Persister;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyProductListConnector\Business\Reader\ProductListReaderInterface;
use FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CompanyProductListRelationTransfer;

class CompanyProductListRelationPersisterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Business\Reader\ProductListReaderInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $productListReaderMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Business\Reader\ProductListReaderInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $entityManagerMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyProductListRelationTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyProductListRelationTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Business\Persister\CompanyProductListRelationPersister
     */
    protected $companyProductListRelationPersister;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productListReaderMock = $this->getMockBuilder(ProductListReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(CompanyProductListConnectorEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyProductListRelationTransferMock = $this->getMockBuilder(CompanyProductListRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyProductListRelationPersister = new CompanyProductListRelationPersister(
            $this->productListReaderMock,
            $this->entityManagerMock,
        );
    }

    /**
     * @return void
     */
    public function testPersist(): void
    {
        $idCompany = 1;
        $newProductListIds = [1, 3, 5];
        $currentProductListIds = [3, 4, 5];

        $this->companyProductListRelationTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompany')
            ->willReturn($idCompany);

        $this->companyProductListRelationTransferMock->expects(static::atLeastOnce())
            ->method('getProductListIds')
            ->willReturn($newProductListIds);

        $this->productListReaderMock->expects(static::atLeastOnce())
            ->method('getIdsByIdCompany')
            ->with($idCompany)
            ->willReturn($currentProductListIds);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('assignProductListsToCompany')
            ->with(
                static::callback(
                    static function (array $productListIdsToAssign) {
                        return count($productListIdsToAssign) === 1
                            && array_values($productListIdsToAssign)[0] === 1;
                    },
                ),
                $idCompany,
            );

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('deAssignProductListsFromCompany')
            ->with(
                static::callback(
                    static function (array $productListIdsToDeAssign) {
                        return count($productListIdsToDeAssign) === 1
                            && array_values($productListIdsToDeAssign)[0] === 4;
                    },
                ),
                $idCompany,
            );

         $this->companyProductListRelationPersister->persist($this->companyProductListRelationTransferMock);
    }

    /**
     * @return void
     */
    public function testPersistWithInvalidCompanyProductListRelationTransfer(): void
    {
        $idCompany = null;

        $this->companyProductListRelationTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompany')
            ->willReturn($idCompany);

        $this->companyProductListRelationTransferMock->expects(static::never())
            ->method('getProductListIds');

        $this->productListReaderMock->expects(static::never())
            ->method('getIdsByIdCompany');

        $this->entityManagerMock->expects(static::never())
            ->method('assignProductListsToCompany');

        $this->entityManagerMock->expects(static::never())
            ->method('deAssignProductListsFromCompany');

        $this->companyProductListRelationPersister->persist($this->companyProductListRelationTransferMock);
    }
}
