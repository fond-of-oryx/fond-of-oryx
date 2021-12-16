<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\AddressTransfer;

class RestAddressMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\AddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $addressTransferMock;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestAddressMapper
     */
    protected $restAddressMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->addressTransferMock = $this->getMockBuilder(AddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restAddressMapper = new RestAddressMapper();
    }

    /**
     * @return void
     */
    public function testFromAddress(): void
    {
        $addressData = ['firstName' => 'foo', 'lastName' => 'bar'];

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->with(true)
            ->willReturn($addressData);

        $restAddressTransfer = $this->restAddressMapper->fromAddress($this->addressTransferMock);

        static::assertEquals($addressData['firstName'], $restAddressTransfer->getFirstName());
        static::assertEquals($addressData['lastName'], $restAddressTransfer->getLastName());
    }
}
