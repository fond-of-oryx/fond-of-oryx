<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\RepresentationManagerInterface;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer;

class RepresentativeCompanyUserRestApiFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\RepresentativeCompanyUserRestApiFacade
     */
    protected $facade;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\RepresentativeCompanyUserRestApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\RepresentationManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representationManagerMock;

    /**
     * @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRepresentativeCompanyUserResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRepresentativeCompanyUserRequestTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->factoryMock = $this->getMockBuilder(RepresentativeCompanyUserRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representationManagerMock = $this
            ->getMockBuilder(RepresentationManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserResponseTransferMock = $this
            ->getMockBuilder(RestRepresentativeCompanyUserResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserRequestTransferMock = $this
            ->getMockBuilder(RestRepresentativeCompanyUserRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new RepresentativeCompanyUserRestApiFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testAddRepresentation(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createRepresentationManager')
            ->willReturn($this->representationManagerMock);

        $this->representationManagerMock->expects(static::atLeastOnce())
            ->method('addRepresentation')
            ->with($this->restRepresentativeCompanyUserRequestTransferMock)
            ->willReturn($this->restRepresentativeCompanyUserResponseTransferMock);

        static::assertEquals(
            $this->restRepresentativeCompanyUserResponseTransferMock,
            $this->facade->addRepresentation(
                $this->restRepresentativeCompanyUserRequestTransferMock,
            ),
        );
    }
}
