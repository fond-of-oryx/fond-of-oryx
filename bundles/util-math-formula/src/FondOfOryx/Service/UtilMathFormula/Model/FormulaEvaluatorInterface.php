<?php

namespace FondOfOryx\Service\UtilMathFormula\Model;

interface FormulaEvaluatorInterface
{
    /**
     * @param string $formula
     * @param float[] $variables
     *
     * @return float
     */
    public function evaluate(string $formula, array $variables): float;
}
