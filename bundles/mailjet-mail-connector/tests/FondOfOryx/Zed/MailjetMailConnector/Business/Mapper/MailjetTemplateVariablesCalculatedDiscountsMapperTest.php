<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\CalculatedDiscountTransfer;

class MailjetTemplateVariablesCalculatedDiscountsMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CalculatedDiscountTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $calculatedDiscountTransferMock;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesCalculatedDiscountsMapper
     */
    protected $mapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->calculatedDiscountTransferMock = $this->getMockBuilder(CalculatedDiscountTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new MailjetTemplateVariablesCalculatedDiscountsMapper();
    }

    /**
     * @return void
     */
    public function testMap(): void
    {
        $this->calculatedDiscountTransferMock->expects(static::atLeastOnce())
            ->method('getDisplayName')
            ->willReturn('Display Name');

        $this->calculatedDiscountTransferMock->expects(static::atLeastOnce())
            ->method('getVoucherCode')
            ->willReturn('Voucher Code');

        $result = $this->mapper->map(new ArrayObject([$this->calculatedDiscountTransferMock]));

        static::assertCount(1, $result);
        static::assertCount(2, $result[0]);
    }
}
