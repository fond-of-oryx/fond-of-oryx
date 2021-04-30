<?php

namespace FondOfOryx\Service\UtilMathFormula;

interface UtilMathFormulaServiceInterface
{
    /**
     * Specification:
     * - Evaluate formula with given variables.
     *
     * @api
     *
     * @param string $formula
     * @param float[] $variables
     *
     * @return float
     */
    public function evaluateFormula(string $formula, array $variables = []): float;
}
