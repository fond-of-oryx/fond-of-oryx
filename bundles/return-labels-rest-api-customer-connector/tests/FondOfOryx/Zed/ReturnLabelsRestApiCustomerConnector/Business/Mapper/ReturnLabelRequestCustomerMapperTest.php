<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerTransfer;

class ReturnLabelRequestCustomerMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Mapper\ReturnLabelRequestCustomerMapperInterface
     */
    protected $mapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new ReturnLabelRequestCustomerMapper();
    }

    /**
     * @return void
     */
    public function testFromCustomerTransfer(): void
    {
        $email = 'john.doe@mailinator.com';

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getEmail')
            ->willReturn($email);

        $returnLabelRequestCustomerTransfer = $this->mapper->fromCustomerTransfer($this->customerTransferMock);

        static::assertEquals($email, $returnLabelRequestCustomerTransfer->getEmail());
    }
}
