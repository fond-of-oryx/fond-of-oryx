<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderExpenseMapper;
use Generated\Shared\Transfer\JellyfishOrderExpenseTransfer;
use Orm\Zed\Sales\Persistence\SpySalesExpense;

class JellyfishOrderExpenseMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderExpenseMapperInterface
     */
    protected $jellyfishOrderExpenseMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesExpense
     */
    protected $spySalesExpenseMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->spySalesExpenseMock = $this->getMockBuilder(SpySalesExpense::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderExpenseMapper = new JellyfishOrderExpenseMapper();
    }

    /**
     * @return void
     */
    public function testFromSalesOrderItem(): void
    {
        $data = [
            'type' => 'shippment',
            'name' => 'default',
            'tax_rate' => 19,
            'price' => 1990,
            'tax_amount' => 250,
        ];

        $this->spySalesExpenseMock->expects($this->atLeastOnce())
            ->method('getType')
            ->willReturn($data['type']);

        $this->spySalesExpenseMock->expects($this->atLeastOnce())
            ->method('getName')
            ->willReturn($data['name']);

        $this->spySalesExpenseMock->expects($this->atLeastOnce())
            ->method('getTaxRate')
            ->willReturn($data['tax_rate']);

        $this->spySalesExpenseMock->expects($this->atLeastOnce())
            ->method('getPrice')
            ->willReturn($data['price']);

        $this->spySalesExpenseMock->expects($this->atLeastOnce())
            ->method('getTaxAmount')
            ->willReturn($data['tax_amount']);

        $jellyfishOrderExpenseTransfer = $this->jellyfishOrderExpenseMapper->fromSalesExpense($this->spySalesExpenseMock);

        $this->assertInstanceOf(JellyfishOrderExpenseTransfer::class, $jellyfishOrderExpenseTransfer);
        $this->assertEquals($data['type'], $jellyfishOrderExpenseTransfer->getType());
        $this->assertEquals($data['name'], $jellyfishOrderExpenseTransfer->getName());
        $this->assertEquals($data['tax_rate'], $jellyfishOrderExpenseTransfer->getTaxRate());
        $this->assertEquals($data['price'], $jellyfishOrderExpenseTransfer->getUnitPrice());
        $this->assertEquals($data['tax_amount'], $jellyfishOrderExpenseTransfer->getUnitTaxAmount());
    }
}
