<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Dependency\Service;

use FondOfOryx\Service\UtilMathFormula\UtilMathFormulaServiceInterface;

class ShipmentTableRateToUtilMathFormulaServiceBridge implements ShipmentTableRateToUtilMathFormulaServiceInterface
{
    /**
     * @var \FondOfOryx\Service\UtilMathFormula\UtilMathFormulaServiceInterface
     */
    protected $utilMathFormulaService;

    /**
     * @param \FondOfOryx\Service\UtilMathFormula\UtilMathFormulaServiceInterface $utilMathFormulaService
     */
    public function __construct(UtilMathFormulaServiceInterface $utilMathFormulaService)
    {
        $this->utilMathFormulaService = $utilMathFormulaService;
    }

    /**
     * @param string $formula
     * @param float[] $variables
     *
     * @return float
     */
    public function evaluateFormula(string $formula, array $variables): float
    {
        return $this->utilMathFormulaService->evaluateFormula($formula, $variables);
    }
}
