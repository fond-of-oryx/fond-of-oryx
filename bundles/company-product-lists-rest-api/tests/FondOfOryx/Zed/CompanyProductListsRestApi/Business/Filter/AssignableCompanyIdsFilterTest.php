<?php

namespace FondOfOryx\Zed\CompanyProductListsRestApi\Business\Filter;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiRepositoryInterface;
use Generated\Shared\Transfer\RestProductListsAttributesTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

class AssignableCompanyIdsFilterTest extends Unit
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
     * @var \FondOfOryx\Zed\CompanyProductListsRestApi\Business\Filter\AssignableCompanyIdsFilter
     */
    protected $assignableCompanyIdsFilter;

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

        $this->assignableCompanyIdsFilter = new AssignableCompanyIdsFilter($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testFilter(): void
    {
        $assignedCompanyIds = [1, 2, 3, 5];
        $companyUuidsToAssign = ['54fcde8c-fc6d-49a0-8ad6-b8e285dc1546', '597cd4a5-c793-4a8c-acde-619e44a2657b'];
        $companyIdsToAssign = [1, 4];
        $idCustomer = 10;

        $this->restProductListsUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getProductList')
            ->willReturn($this->restProductListsAttributesTransferMock);

        $this->restProductListsUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyIdsToAssign')
            ->willReturn($companyUuidsToAssign);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getCompanyIdsByCompanyUuidsAndIdCustomer')
            ->with($companyUuidsToAssign, $idCustomer)
            ->willReturn($companyIdsToAssign);

        static::assertEquals(
            [4],
            $this->assignableCompanyIdsFilter->filter(
                $assignedCompanyIds,
                $this->restProductListsUpdateRequestTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testFilterWithNonExistingCompanyUuid(): void
    {
        $assignedCompanyIds = [1, 2, 3, 5];
        $companyUuidsToAssign = ['54fcde8c-fc6d-49a0-8ad6-b8e285dc1546', '597cd4a5-c793-4a8c-acde-619e44a2657b'];
        $companyIdsToAssign = [];
        $idCustomer = 10;

        $this->restProductListsUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getProductList')
            ->willReturn($this->restProductListsAttributesTransferMock);

        $this->restProductListsUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyIdsToAssign')
            ->willReturn($companyUuidsToAssign);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getCompanyIdsByCompanyUuidsAndIdCustomer')
            ->with($companyUuidsToAssign, $idCustomer)
            ->willReturn($companyIdsToAssign);

        static::assertEquals(
            [],
            $this->assignableCompanyIdsFilter->filter(
                $assignedCompanyIds,
                $this->restProductListsUpdateRequestTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testFilterWithoutCompanyIdsToAssign(): void
    {
        $assignedCompanyIds = [1, 2, 3, 5];
        $companyUuidsToAssign = [];
        $idCustomer = 10;

        $this->restProductListsUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getProductList')
            ->willReturn($this->restProductListsAttributesTransferMock);

        $this->restProductListsUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyIdsToAssign')
            ->willReturn($companyUuidsToAssign);

        $this->repositoryMock->expects(static::never())
            ->method('getCompanyIdsByCompanyUuidsAndIdCustomer');

        static::assertEquals(
            [],
            $this->assignableCompanyIdsFilter->filter(
                $assignedCompanyIds,
                $this->restProductListsUpdateRequestTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testFilterWithoutIdCustomer(): void
    {
        $assignedCompanyIds = [1, 2, 3, 5];
        $idCustomer = null;

        $this->restProductListsUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getProductList')
            ->willReturn($this->restProductListsAttributesTransferMock);

        $this->restProductListsUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restProductListsAttributesTransferMock->expects(static::never())
            ->method('getCompanyIdsToAssign');

        $this->repositoryMock->expects(static::never())
            ->method('getCompanyIdsByCompanyUuidsAndIdCustomer');

        static::assertEquals(
            [],
            $this->assignableCompanyIdsFilter->filter(
                $assignedCompanyIds,
                $this->restProductListsUpdateRequestTransferMock,
            ),
        );
    }
}
