<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Business\Model;

use FondOfOryx\Zed\ShipmentTableRate\Dependency\Service\ShipmentTableRateToUtilMathFormulaServiceInterface;
use FondOfOryx\Zed\ShipmentTableRate\ShipmentTableRateConfig;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentGroupTransfer;

class PriceCalculator implements PriceCalculatorInterface
{
    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\Business\Model\ShipmentTableRateReaderInterface
     */
    protected $shipmentTableRateReader;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\ShipmentTableRateConfig
     */
    protected $shipmentTableRateConfig;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\Dependency\Service\ShipmentTableRateToUtilMathFormulaServiceInterface
     */
    protected $utilMathFormulaService;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\Business\Model\VariableExtractorInterface
     */
    protected $variableExtractor;

    /**
     * @param \FondOfOryx\Zed\ShipmentTableRate\Business\Model\ShipmentTableRateReaderInterface $shipmentTableRateReader
     * @param \FondOfOryx\Zed\ShipmentTableRate\ShipmentTableRateConfig $shipmentTableRateConfig
     * @param \FondOfOryx\Zed\ShipmentTableRate\Dependency\Service\ShipmentTableRateToUtilMathFormulaServiceInterface $utilMathFormulaService
     * @param \FondOfOryx\Zed\ShipmentTableRate\Business\Model\VariableExtractorInterface $variableExtractor
     */
    public function __construct(
        ShipmentTableRateReaderInterface $shipmentTableRateReader,
        ShipmentTableRateConfig $shipmentTableRateConfig,
        ShipmentTableRateToUtilMathFormulaServiceInterface $utilMathFormulaService,
        VariableExtractorInterface $variableExtractor
    ) {
        $this->shipmentTableRateReader = $shipmentTableRateReader;
        $this->shipmentTableRateConfig = $shipmentTableRateConfig;
        $this->utilMathFormulaService = $utilMathFormulaService;
        $this->variableExtractor = $variableExtractor;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\ShipmentGroupTransfer|null $shipmentGroupTransfer
     *
     * @return int
     */
    public function calculate(QuoteTransfer $quoteTransfer, ?ShipmentGroupTransfer $shipmentGroupTransfer = null): int
    {
        $shipmentTransfer = $quoteTransfer->getShipment();

        if ($shipmentGroupTransfer !== null) {
            $shipmentTransfer = $shipmentGroupTransfer->getShipment();
        }

        if ($shipmentTransfer === null) {
            return $this->shipmentTableRateConfig->getFallbackPrice();
        }

        $shipmentTableRateTransfer = $this->shipmentTableRateReader->getByShipmentAndQuote(
            $shipmentTransfer,
            $quoteTransfer,
        );

        if ($shipmentTableRateTransfer === null || $shipmentTableRateTransfer->getFormula() === null) {
            return $this->shipmentTableRateConfig->getFallbackPrice();
        }

        return (int)$this->utilMathFormulaService->evaluateFormula(
            $shipmentTableRateTransfer->getFormula(),
            $this->variableExtractor->extractFromQuote($quoteTransfer),
        );
    }
}
