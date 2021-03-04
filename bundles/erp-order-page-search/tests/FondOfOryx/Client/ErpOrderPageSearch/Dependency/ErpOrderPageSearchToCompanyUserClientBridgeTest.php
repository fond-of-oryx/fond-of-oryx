<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Client\CompanyUser\CompanyUserClientInterface;

class ErpOrderPageSearchToCompanyUserClientBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToCompanyUserClientBridge
     */
    protected $erpOrderPageSearchToCompanyUserClientBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CustomerTransfer
     */
    protected $customerTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\CompanyUser\CompanyUserClientInterface
     */
    protected $companyUserClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserCollectionTransfer
     */
    protected $companyUserCollectionMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserClientMock = $this->getMockBuilder(CompanyUserClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCollectionMock = $this->getMockBuilder(CompanyUserCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchToCompanyUserClientBridge = new ErpOrderPageSearchToCompanyUserClientBridge(
            $this->companyUserClientMock
        );
    }

    /**
     * @return void
     */
    public function testGetActiveCompanyUsersByCustomerReference(): void
    {
        $this->companyUserClientMock->expects(static::atLeastOnce())
            ->method('getActiveCompanyUsersByCustomerReference')
            ->with($this->customerTransferMock)
            ->willReturn($this->companyUserCollectionMock);

        $this->assertInstanceOf(
            CompanyUserCollectionTransfer::class,
            $this->erpOrderPageSearchToCompanyUserClientBridge
                ->getActiveCompanyUsersByCustomerReference($this->customerTransferMock)
        );
    }
}
