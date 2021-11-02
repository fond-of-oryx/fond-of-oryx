<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Dependency\Service;

interface ShipmentTableRateToUtilMathFormulaServiceInterface
{
    /**
     * @param string $formula
     * @param array<float> $variables
     *
     * @return float
     */
    public function evaluateFormula(string $formula, array $variables): float;
}
