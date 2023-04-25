<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer;

class PermissionRequestMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRepresentativeCompanyUserAttributesTransferMock;

    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper\PermissionRequestMapperInterface
     */
    protected $mapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restRepresentativeCompanyUserAttributesTransferMock = $this->getMockBuilder(RestRepresentativeCompanyUserAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new PermissionRequestMapper();
    }

    /**
     * @return void
     */
    public function testFromRestRequest(): void
    {
        $identifier = 'asd';

        $this->restRepresentativeCompanyUserAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getReferenceDistributor')
            ->willReturn($identifier);

        $result = $this->mapper->fromAttributesTransfer($this->restRepresentativeCompanyUserAttributesTransferMock);

        static::assertEquals($identifier, $result->getDistributorReference());
    }
}
