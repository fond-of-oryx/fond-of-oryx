<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\RestCustomerRegistrationRequestAttributesTransfer;

class RequestMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Mapper\RequestMapperInterface
     */
    protected $mapper;

    /**
     * @var \Generated\Shared\Transfer\RestCustomerRegistrationRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCustomerRegistrationRequestAttributesTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->restCustomerRegistrationRequestAttributesTransferMock = $this->getMockBuilder(RestCustomerRegistrationRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new RequestMapper();
    }

    /**
     * @return void
     */
    public function testMapRequestAttributesToTransfer(): void
    {
        $this->restCustomerRegistrationRequestAttributesTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn(['email' => 'foo@bar.com']);

        $mappedRequest = $this->mapper->mapRequestAttributesToTransfer($this->restCustomerRegistrationRequestAttributesTransferMock);
        $this->assertSame('foo@bar.com', $mappedRequest->getAttributes()->getEmail());
    }
}
