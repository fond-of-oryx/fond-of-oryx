<?php

namespace FondOfOryx\Zed\CompanyProductListsRestApi\Business\Filter;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiRepositoryInterface;
use Generated\Shared\Transfer\RestProductListsAttributesTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

class DeassignableCompanyIdsFilterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListsUpdateRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListsAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListsAttributesTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListsRestApi\Business\Filter\DeassignableCompanyIdsFilter
     */
    protected $deassignableCompanyIdsFilter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompanyProductListsRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListsUpdateRequestTransferMock = $this->getMockBuilder(RestProductListUpdateRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListsAttributesTransferMock = $this->getMockBuilder(RestProductListsAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->deassignableCompanyIdsFilter = new DeassignableCompanyIdsFilter($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testFilter(): void
    {
        $deassignedCompanyIds = [1, 2, 3, 5];
        $companyUuidsToDeassign = ['54fcde8c-fc6d-49a0-8ad6-b8e285dc1546', '597cd4a5-c793-4a8c-acde-619e44a2657b'];
        $companyIdsToDeassign = [1, 4];
        $idCustomer = 10;

        $this->restProductListsUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getProductList')
            ->willReturn($this->restProductListsAttributesTransferMock);

        $this->restProductListsUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyIdsToDeassign')
            ->willReturn($companyUuidsToDeassign);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getCompanyIdsByCompanyUuidsAndIdCustomer')
            ->with($companyUuidsToDeassign, $idCustomer)
            ->willReturn($companyIdsToDeassign);

        static::assertEquals(
            [1],
            $this->deassignableCompanyIdsFilter->filter(
                $deassignedCompanyIds,
                $this->restProductListsUpdateRequestTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testFilterWithNonExistingCompanyUuid(): void
    {
        $deassignedCompanyIds = [1, 2, 3, 5];
        $companyUuidsToDeassign = ['54fcde8c-fc6d-49a0-8ad6-b8e285dc1546', '597cd4a5-c793-4a8c-acde-619e44a2657b'];
        $companyIdsToDeassign = [];
        $idCustomer = 10;

        $this->restProductListsUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getProductList')
            ->willReturn($this->restProductListsAttributesTransferMock);

        $this->restProductListsUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyIdsToDeassign')
            ->willReturn($companyUuidsToDeassign);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getCompanyIdsByCompanyUuidsAndIdCustomer')
            ->with($companyUuidsToDeassign, $idCustomer)
            ->willReturn($companyIdsToDeassign);

        static::assertEquals(
            [],
            $this->deassignableCompanyIdsFilter->filter(
                $deassignedCompanyIds,
                $this->restProductListsUpdateRequestTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testFilterWithoutCompanyIdsToDeassign(): void
    {
        $deassignedCompanyIds = [1, 2, 3, 5];
        $companyUuidsToDeassign = [];
        $idCustomer = 10;

        $this->restProductListsUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getProductList')
            ->willReturn($this->restProductListsAttributesTransferMock);

        $this->restProductListsUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyIdsToDeassign')
            ->willReturn($companyUuidsToDeassign);

        $this->repositoryMock->expects(static::never())
            ->method('getCompanyIdsByCompanyUuidsAndIdCustomer');

        static::assertEquals(
            [],
            $this->deassignableCompanyIdsFilter->filter(
                $deassignedCompanyIds,
                $this->restProductListsUpdateRequestTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testFilterWithoutIdCustomer(): void
    {
        $deassignedCompanyIds = [1, 2, 3, 5];
        $idCustomer = null;

        $this->restProductListsUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getProductList')
            ->willReturn($this->restProductListsAttributesTransferMock);

        $this->restProductListsUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restProductListsAttributesTransferMock->expects(static::never())
            ->method('getCompanyIdsToDeassign');

        $this->repositoryMock->expects(static::never())
            ->method('getCompanyIdsByCompanyUuidsAndIdCustomer');

        static::assertEquals(
            [],
            $this->deassignableCompanyIdsFilter->filter(
                $deassignedCompanyIds,
                $this->restProductListsUpdateRequestTransferMock,
            ),
        );
    }
}
