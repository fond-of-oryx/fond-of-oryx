<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission;

use Codeception\Test\Unit;
use FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\Zed\RepresentativeCompanyUserTradeFairRestApiPermissionStubInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionResponseTransfer;

class RepresentativeCompanyUserTradeFairRestApiPermissionClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\RepresentativeCompanyUserTradeFairRestApiPermissionFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RepresentativeCompanyUserTradeFairRestApiPermissionFactory $factoryMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\Zed\RepresentativeCompanyUserTradeFairRestApiPermissionStubInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RepresentativeCompanyUserTradeFairRestApiPermissionStubInterface $zedStubMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RepresentativeCompanyUserTradeFairRestApiPermissionResponseTransfer $representativeCompanyUserTradeFairRestApiPermissionResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer $representativeCompanyUserTradeFairRestApiPermissionRequestTransferMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\RepresentativeCompanyUserTradeFairRestApiPermissionClient
     */
    protected RepresentativeCompanyUserTradeFairRestApiPermissionClient $client;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiPermissionFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedStubMock = $this->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiPermissionStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTradeFairRestApiPermissionResponseTransferMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiPermissionResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTradeFairRestApiPermissionRequestTransferMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->client = new RepresentativeCompanyUserTradeFairRestApiPermissionClient();
        $this->client->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testHasPermissionToManageOwnTradeFairRepresentations(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createRepresentativeCompanyUserTradeFairRestApiPermissionStub')
            ->willReturn($this->zedStubMock);

        $this->representativeCompanyUserTradeFairRestApiPermissionResponseTransferMock->expects(static::atLeastOnce())
            ->method('getHasPermissionToManageOwnTradeFairRepresentations')
            ->willReturn(true);

        $this->zedStubMock->expects(static::atLeastOnce())
            ->method('hasPermissionToManageOwnTradeFairRepresentations')
            ->with($this->representativeCompanyUserTradeFairRestApiPermissionRequestTransferMock)
            ->willReturn($this->representativeCompanyUserTradeFairRestApiPermissionResponseTransferMock);

        static::assertTrue(
            $this->client->hasPermissionToManageOwnTradeFairRepresentations(
                $this->representativeCompanyUserTradeFairRestApiPermissionRequestTransferMock,
            ),
        );
    }
}
