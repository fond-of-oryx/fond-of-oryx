<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CompanyReaderInterface;
use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CompanyUserReaderInterface;
use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CustomerReaderInterface;
use Generated\Shared\Transfer\RestProductListsAttributesTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

class RestProductListUpdateRequestExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CompanyUserReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserReaderMock;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CustomerReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerReaderMock;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CompanyReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyReaderMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListsAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListsAttributesTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Expander\RestProductListUpdateRequestExpander
     */
    protected $restProductListUpdateRequestExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUserReaderMock = $this->getMockBuilder(CompanyUserReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerReaderMock = $this->getMockBuilder(CustomerReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyReaderMock = $this->getMockBuilder(CompanyReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateRequestTransferMock = $this->getMockBuilder(RestProductListUpdateRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListsAttributesTransferMock = $this->getMockBuilder(RestProductListsAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateRequestExpander = new RestProductListUpdateRequestExpander(
            $this->companyUserReaderMock,
            $this->customerReaderMock,
            $this->companyReaderMock,
        );
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $authorizedCompanyUserIds = [1, 10];
        $whitelistedCustomerReferences = ['FOO--1', 'FOO--2'];
        $whitelistedCompanyUuids = ['279e5abf-6595-4d46-9386-3adff1ac10d8', '2f99e222-cb9a-4532-9579-517405244f03'];
        $companyIdsToAssign = ['279e5abf-6595-4d46-9386-3adff1ac10d8', 'dff9ed24-7dc2-40c5-bf98-83db8809756a'];
        $companyIdsToDeassign = ['2f99e222-cb9a-4532-9579-517405244f03', '5615f7eb-6a54-4345-927f-6d3ed23d6f07'];
        $customerIdsToAssign = ['FOO--1', 'FOO--3'];
        $customerIdsToDeassign = ['FOO--2', 'FOO--4'];

        $this->restProductListUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getProductList')
            ->willReturn($this->restProductListsAttributesTransferMock);

        $this->companyUserReaderMock->expects(static::atLeastOnce())
            ->method('getAuthorizedIdsByRestProductListUpdateRequest')
            ->with($this->restProductListUpdateRequestTransferMock)
            ->willReturn($authorizedCompanyUserIds);

        $this->customerReaderMock->expects(static::atLeastOnce())
            ->method('getWhitelistedReferencesByCompanyUserIds')
            ->with($authorizedCompanyUserIds)
            ->willReturn($whitelistedCustomerReferences);

        $this->companyReaderMock->expects(static::atLeastOnce())
            ->method('getWhitelistedUuidsByCompanyUserIds')
            ->with($authorizedCompanyUserIds)
            ->willReturn($whitelistedCompanyUuids);

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyIdsToAssign')
            ->willReturn($companyIdsToAssign);

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('setCompanyIdsToAssign')
            ->with([$companyIdsToAssign[0]])
            ->willReturn($this->restProductListsAttributesTransferMock);

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyIdsToDeassign')
            ->willReturn($companyIdsToDeassign);

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('setCompanyIdsToDeassign')
            ->with([$companyIdsToDeassign[0]])
            ->willReturn($this->restProductListsAttributesTransferMock);

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerIdsToAssign')
            ->willReturn($customerIdsToAssign);

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('setCustomerIdsToAssign')
            ->with([$customerIdsToAssign[0]])
            ->willReturn($this->restProductListsAttributesTransferMock);

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerIdsToDeassign')
            ->willReturn($customerIdsToDeassign);

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('setCustomerIdsToDeassign')
            ->with([$customerIdsToDeassign[0]])
            ->willReturn($this->restProductListsAttributesTransferMock);

        static::assertEquals(
            $this->restProductListUpdateRequestTransferMock,
            $this->restProductListUpdateRequestExpander->expand($this->restProductListUpdateRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithInvalidData(): void
    {
        $this->restProductListUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getProductList')
            ->willReturn(null);

        $this->companyUserReaderMock->expects(static::never())
            ->method('getAuthorizedIdsByRestProductListUpdateRequest');

        $this->customerReaderMock->expects(static::never())
            ->method('getWhitelistedReferencesByCompanyUserIds');

        $this->companyReaderMock->expects(static::never())
            ->method('getWhitelistedUuidsByCompanyUserIds');

        static::assertEquals(
            $this->restProductListUpdateRequestTransferMock,
            $this->restProductListUpdateRequestExpander->expand($this->restProductListUpdateRequestTransferMock),
        );
    }
}
