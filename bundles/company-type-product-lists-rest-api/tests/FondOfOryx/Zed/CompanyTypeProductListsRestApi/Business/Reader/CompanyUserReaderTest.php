<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Persistence\CompanyTypeProductListsRestApiRepositoryInterface;
use Generated\Shared\Transfer\RestProductListsAttributesTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

class CompanyUserReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Persistence\CompanyTypeProductListsRestApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListsAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListsAttributesTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CompanyUserReader
     */
    protected $companyUserReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompanyTypeProductListsRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateRequestTransferMock = $this->getMockBuilder(RestProductListUpdateRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListsAttributesTransferMock = $this->getMockBuilder(RestProductListsAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReader = new CompanyUserReader(
            $this->repositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testGetAuthorizedIdsByRestProductListUpdateRequest(): void
    {
        $idCustomer = 1;
        $companyIdsToAssign = ['279e5abf-6595-4d46-9386-3adff1ac10d8'];
        $companyIdsToDeassign = ['2f99e222-cb9a-4532-9579-517405244f03'];
        $customerIdsToAssign = ['FOO--1'];
        $customerIdsToDeassign = ['FOO--2'];
        $companyUserIds = [1, 10];

        $this->restProductListUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restProductListUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getProductList')
            ->willReturn($this->restProductListsAttributesTransferMock);

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerIdsToAssign')
            ->willReturn($customerIdsToAssign);

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerIdsToDeassign')
            ->willReturn($customerIdsToDeassign);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getAuthorizedCompanyUserIdsByCurrentIdCustomerAndCustomerReferences')
            ->with(
                $idCustomer,
                array_merge($customerIdsToAssign, $customerIdsToDeassign),
            )->willReturn(
                [$companyUserIds[0]],
            );

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyIdsToAssign')
            ->willReturn($companyIdsToAssign);

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyIdsToDeassign')
            ->willReturn($companyIdsToDeassign);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getAuthorizedCompanyUserIdsByCurrentIdCustomerAndCompanyUuids')
            ->with(
                $idCustomer,
                array_merge($companyIdsToAssign, $companyIdsToDeassign),
            )->willReturn(
                [$companyUserIds[1]],
            );

        static::assertEquals(
            $companyUserIds,
            $this->companyUserReader->getAuthorizedIdsByRestProductListUpdateRequest(
                $this->restProductListUpdateRequestTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGetAuthorizedIdsByRestProductListUpdateRequestWithoutIdCustomer(): void
    {
        $idCustomer = null;
        $this->restProductListUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restProductListUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getProductList')
            ->willReturn($this->restProductListsAttributesTransferMock);

        $this->restProductListsAttributesTransferMock->expects(static::never())
            ->method('getCustomerIdsToAssign');

        $this->restProductListsAttributesTransferMock->expects(static::never())
            ->method('getCustomerIdsToDeassign');

        $this->repositoryMock->expects(static::never())
            ->method('getAuthorizedCompanyUserIdsByCurrentIdCustomerAndCustomerReferences');

        $this->restProductListsAttributesTransferMock->expects(static::never())
            ->method('getCompanyIdsToAssign');

        $this->restProductListsAttributesTransferMock->expects(static::never())
            ->method('getCompanyIdsToDeassign');

        $this->repositoryMock->expects(static::never())
            ->method('getAuthorizedCompanyUserIdsByCurrentIdCustomerAndCompanyUuids');

        static::assertEquals(
            [],
            $this->companyUserReader->getAuthorizedIdsByRestProductListUpdateRequest(
                $this->restProductListUpdateRequestTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGetAuthorizedIdsByRestProductListUpdateRequestWithoutCompanyIds(): void
    {
        $idCustomer = 1;
        $companyIdsToAssign = [];
        $companyIdsToDeassign = [];
        $customerIdsToAssign = ['FOO--1'];
        $customerIdsToDeassign = ['FOO--2'];
        $companyUserIds = [1];

        $this->restProductListUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restProductListUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getProductList')
            ->willReturn($this->restProductListsAttributesTransferMock);

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerIdsToAssign')
            ->willReturn($customerIdsToAssign);

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerIdsToDeassign')
            ->willReturn($customerIdsToDeassign);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getAuthorizedCompanyUserIdsByCurrentIdCustomerAndCustomerReferences')
            ->with(
                $idCustomer,
                array_merge($customerIdsToAssign, $customerIdsToDeassign),
            )->willReturn(
                $companyUserIds,
            );

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyIdsToAssign')
            ->willReturn($companyIdsToAssign);

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyIdsToDeassign')
            ->willReturn($companyIdsToDeassign);

        $this->repositoryMock->expects(static::never())
            ->method('getAuthorizedCompanyUserIdsByCurrentIdCustomerAndCompanyUuids');

        static::assertEquals(
            $companyUserIds,
            $this->companyUserReader->getAuthorizedIdsByRestProductListUpdateRequest(
                $this->restProductListUpdateRequestTransferMock,
            ),
        );
    }
}
