<?php

/**
 * phpcs:disable SlevomatCodingStandard.Functions.DisallowTrailingCommaInClosureUse
 */

namespace FondOfOryx\Zed\CompanyBrandProductListConnector\Business\Persister;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBrandProductListConnector\Business\Reader\BrandReaderInterface;
use FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandCompanyFacadeInterface;
use Generated\Shared\Transfer\CompanyBrandRelationTransfer;
use Generated\Shared\Transfer\CompanyProductListRelationTransfer;

class CompanyBrandRelationPersisterTest extends Unit
{
 /**
  * @var \FondOfOryx\Zed\CompanyBrandProductListConnector\Business\Reader\BrandReaderInterface|\PHPUnit\Framework\MockObject\MockObject
  */
    protected $brandReaderMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandCompanyFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandCompanyFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyProductListRelationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyProductListRelationTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBrandProductListConnector\Business\Persister\CompanyBrandRelationPersister
     */
    protected $companyBrandRelationPersister;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->brandReaderMock = $this->getMockBuilder(BrandReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandCompanyFacadeMock = $this->getMockBuilder(
            CompanyBrandProductListConnectorToBrandCompanyFacadeInterface::class,
        )->disableOriginalConstructor()->getMock();

        $this->companyProductListRelationTransferMock = $this->getMockBuilder(CompanyProductListRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBrandRelationPersister = new CompanyBrandRelationPersister(
            $this->brandReaderMock,
            $this->brandCompanyFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testPersistByCompanyProductListRelation(): void
    {
        $brandIds = [1, 2, 3];
        $idCompany = 1;

        $this->companyProductListRelationTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompany')
            ->willReturn($idCompany);

        $this->brandReaderMock->expects(static::atLeastOnce())
            ->method('getBrandIdsByCompanyProductListRelation')
            ->with($this->companyProductListRelationTransferMock)
            ->willReturn($brandIds);

        $this->brandCompanyFacadeMock->expects(static::atLeastOnce())
            ->method('saveCompanyBrandRelation')
            ->with(
                static::callback(
                    static function (
                        CompanyBrandRelationTransfer $companyBrandRelationTransfer
                    ) use (
                        $idCompany,
                        $brandIds,
                    ) {
                        return $companyBrandRelationTransfer->getIdCompany() === $idCompany
                            && $companyBrandRelationTransfer->getIdBrands() === $brandIds;
                    },
                ),
            );

        $this->companyBrandRelationPersister->persistByCompanyProductListRelation(
            $this->companyProductListRelationTransferMock,
        );
    }

    /**
     * @return void
     */
    public function testPersistByCompanyProductListRelationWithoutIdCompany(): void
    {
        $this->companyProductListRelationTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompany')
            ->willReturn(null);

        $this->brandReaderMock->expects(static::never())
            ->method('getBrandIdsByCompanyProductListRelation');

        $this->brandCompanyFacadeMock->expects(static::never())
            ->method('saveCompanyBrandRelation');

        $this->companyBrandRelationPersister->persistByCompanyProductListRelation(
            $this->companyProductListRelationTransferMock,
        );
    }
}
