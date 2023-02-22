<?php

namespace FondOfOryx\Zed\CustomerApi\Business\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CustomerApiMapperTest extends Unit
{
    /**
     * @var (\Generated\Shared\Transfer\CustomerTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerTransfer|MockObject $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerApi\Business\Mapper\CustomerApiMapper
     */
    protected CustomerApiMapper $customerApiMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerApiMapper = new CustomerApiMapper();
    }

    /**
     * @return void
     */
    public function testFromCustomer(): void
    {
        $idCustomer = 1;

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn(
                [
                    'id_customer' => $idCustomer,
                ],
            );

        $customerApiTransfer = $this->customerApiMapper->fromCustomer($this->customerTransferMock);

        static::assertEquals(
            $idCustomer,
            $customerApiTransfer->getIdCustomer(),
        );
    }
}
