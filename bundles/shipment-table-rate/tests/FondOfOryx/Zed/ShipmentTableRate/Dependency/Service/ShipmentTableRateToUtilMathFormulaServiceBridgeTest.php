<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Dependency\Service;

use Codeception\Test\Unit;
use FondOfOryx\Service\UtilMathFormula\UtilMathFormulaServiceInterface;

class ShipmentTableRateToUtilMathFormulaServiceBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Service\UtilMathFormula\UtilMathFormulaServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $utilMathFormulaServiceMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\Dependency\Service\ShipmentTableRateToUtilMathFormulaServiceBridge
     */
    protected $shipmentTableRateToUtilMathFormulaServiceBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->utilMathFormulaServiceMock = $this->getMockBuilder(UtilMathFormulaServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTableRateToUtilMathFormulaServiceBridge = new ShipmentTableRateToUtilMathFormulaServiceBridge(
            $this->utilMathFormulaServiceMock
        );
    }

    /**
     * @return void
     */
    public function testEvaluateFormula(): void
    {
        $formula = 'priceToPay/10000';
        $variables = [
            'priceToPay' => (float)10000,
        ];
        $result = (float)1;

        $this->utilMathFormulaServiceMock->expects(static::atLeastOnce())
            ->method('evaluateFormula')
            ->with($formula, $variables)
            ->willReturn($result);

        static::assertEquals(
            $result,
            $this->shipmentTableRateToUtilMathFormulaServiceBridge->evaluateFormula($formula, $variables)
        );
    }
}
