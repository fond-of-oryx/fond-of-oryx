<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerRegistrationResponseTransfer;

class ResponseMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Mapper\ResponseMapperInterface
     */
    protected $mapper;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->customerRegistrationResponseTransferMock = $this->getMockBuilder(CustomerRegistrationResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new ResponseMapper();
    }

    /**
     * @return void
     */
    public function testMapRequestAttributesToTransfer(): void
    {
        $this->customerRegistrationResponseTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->mapper->mapResponseToRestResponseTransfer($this->customerRegistrationResponseTransferMock);
    }
}
