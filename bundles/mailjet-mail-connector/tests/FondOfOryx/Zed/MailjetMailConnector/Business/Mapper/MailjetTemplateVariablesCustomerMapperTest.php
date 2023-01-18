<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerTransfer;

class MailjetTemplateVariablesCustomerMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesCustomerMapper
     */
    protected $mapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new MailjetTemplateVariablesCustomerMapper();
    }

    /**
     * @return void
     */
    public function testMap(): void
    {
        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getFirstName')
            ->willReturn('John');

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getLastName')
            ->willReturn('Doe');

        $response = $this->mapper->map($this->customerTransferMock);

        static::assertCount(2, $response);
        static::assertEquals($response[MailjetTemplateVariablesCustomerMapper::FIRST_NAME], 'John');
        static::assertEquals($response[MailjetTemplateVariablesCustomerMapper::LAST_NAME], 'Doe');
    }
}
