<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Shared\ShipmentTableRate\ShipmentTableRateConstants;
use FondOfOryx\Zed\ShipmentTableRate\Dependency\Service\ShipmentTableRateToUtilMathFormulaServiceInterface;
use FondOfOryx\Zed\ShipmentTableRate\ShipmentTableRateConfig;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentGroupTransfer;
use Generated\Shared\Transfer\ShipmentTableRateTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;

class PriceCalculatorTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ShipmentTableRate\Business\Model\ShipmentTableRateReaderInterface
     */
    protected $shipmentTableRateReaderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ShipmentTableRate\ShipmentTableRateConfig
     */
    protected $shipmentTableRateConfigMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\Business\Model\VariableExtractorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $variableExtractorMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\Dependency\Service\ShipmentTableRateToUtilMathFormulaServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $utilMathFormulaServiceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ShipmentTableRateTransfer
     */
    protected $shipmentTableRateTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ShipmentGroupTransfer
     */
    protected $shipmentGroupTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ShipmentTransfer
     */
    protected $shipmentTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\Business\Model\PriceCalculator
     */
    protected $priceCalculator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->shipmentTableRateReaderMock = $this->getMockBuilder(ShipmentTableRateReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTableRateConfigMock = $this->getMockBuilder(ShipmentTableRateConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->variableExtractorMock = $this->getMockBuilder(VariableExtractorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->utilMathFormulaServiceMock = $this->getMockBuilder(ShipmentTableRateToUtilMathFormulaServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTableRateTransferMock = $this->getMockBuilder(ShipmentTableRateTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentGroupTransferMock = $this->getMockBuilder(ShipmentGroupTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTransferMock = $this->getMockBuilder(ShipmentTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceCalculator = new PriceCalculator(
            $this->shipmentTableRateReaderMock,
            $this->shipmentTableRateConfigMock,
            $this->utilMathFormulaServiceMock,
            $this->variableExtractorMock,
        );
    }

    /**
     * @return void
     */
    public function testCalculate(): void
    {
        $formula = 'p-5000';
        $variables = ['p' => (float)5495];
        $expectedPrice = 495;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentGroupTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentTableRateConfigMock->expects(static::never())
            ->method('getFallbackPrice');

        $this->shipmentTableRateReaderMock->expects(static::atLeastOnce())
            ->method('getByShipmentAndQuote')
            ->with($this->shipmentTransferMock, $this->quoteTransferMock)
            ->willReturn($this->shipmentTableRateTransferMock);

        $this->shipmentTableRateTransferMock->expects(static::atLeastOnce())
            ->method('getFormula')
            ->willReturn($formula);

        $this->variableExtractorMock->expects(static::atLeastOnce())
            ->method('extractFromQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($variables);

        $this->utilMathFormulaServiceMock->expects(static::atLeastOnce())
            ->method('evaluateFormula')
            ->with($formula, $variables)
            ->willReturn((float)$expectedPrice);

        $price = $this->priceCalculator->calculate($this->quoteTransferMock, $this->shipmentGroupTransferMock);

        static::assertEquals($expectedPrice, $price);
    }

    /**
     * @return void
     */
    public function testCalculateWithoutShipmentGroup(): void
    {
        $formula = 'p-5000';
        $variables = ['p' => (float)5495];
        $expectedPrice = 495;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentGroupTransferMock->expects(static::never())
            ->method('getShipment');

        $this->shipmentTableRateReaderMock->expects(static::atLeastOnce())
            ->method('getByShipmentAndQuote')
            ->with($this->shipmentTransferMock, $this->quoteTransferMock)
            ->willReturn($this->shipmentTableRateTransferMock);

        $this->shipmentTableRateTransferMock->expects(static::atLeastOnce())
            ->method('getFormula')
            ->willReturn($formula);

        $this->variableExtractorMock->expects(static::atLeastOnce())
            ->method('extractFromQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($variables);

        $this->utilMathFormulaServiceMock->expects(static::atLeastOnce())
            ->method('evaluateFormula')
            ->with($formula, $variables)
            ->willReturn((float)$expectedPrice);

        $price = $this->priceCalculator->calculate($this->quoteTransferMock, null);

        static::assertEquals($expectedPrice, $price);
    }

    /**
     * @return void
     */
    public function testCalculateWithoutShipment(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn(null);

        $this->shipmentGroupTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn(null);

        $this->shipmentTableRateConfigMock->expects(static::atLeastOnce())
            ->method('getFallbackPrice')
            ->willReturn(ShipmentTableRateConstants::FALLBACK_PRICE_DEFAULT_VALUE);

        $this->shipmentTableRateReaderMock->expects(static::never())
            ->method('getByShipmentAndQuote');

        $this->shipmentTableRateTransferMock->expects(static::never())
            ->method('getFormula');

        $this->variableExtractorMock->expects(static::never())
            ->method('extractFromQuote');

        $this->utilMathFormulaServiceMock->expects(static::never())
            ->method('evaluateFormula');

        $price = $this->priceCalculator->calculate($this->quoteTransferMock, $this->shipmentGroupTransferMock);

        static::assertEquals(ShipmentTableRateConstants::FALLBACK_PRICE_DEFAULT_VALUE, $price);
    }

    /**
     * @return void
     */
    public function testCalculateWithoutShipmentTableRate(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentGroupTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentTableRateReaderMock->expects(static::atLeastOnce())
            ->method('getByShipmentAndQuote')
            ->with($this->shipmentTransferMock, $this->quoteTransferMock)
            ->willReturn(null);

        $this->shipmentTableRateConfigMock->expects(static::atLeastOnce())
            ->method('getFallbackPrice')
            ->willReturn(ShipmentTableRateConstants::FALLBACK_PRICE_DEFAULT_VALUE);

        $this->shipmentTableRateTransferMock->expects(static::never())
            ->method('getFormula');

        $this->variableExtractorMock->expects(static::never())
            ->method('extractFromQuote');

        $this->utilMathFormulaServiceMock->expects(static::never())
            ->method('evaluateFormula');

        $price = $this->priceCalculator->calculate($this->quoteTransferMock, $this->shipmentGroupTransferMock);

        static::assertEquals(ShipmentTableRateConstants::FALLBACK_PRICE_DEFAULT_VALUE, $price);
    }
}
