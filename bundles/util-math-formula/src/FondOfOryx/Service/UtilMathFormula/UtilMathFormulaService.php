<?php

namespace FondOfOryx\Service\UtilMathFormula;

use Spryker\Service\Kernel\AbstractService;

/**
 * @method \FondOfOryx\Service\UtilMathFormula\UtilMathFormulaServiceFactory getFactory()
 */
class UtilMathFormulaService extends AbstractService implements UtilMathFormulaServiceInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $formula
     * @param array<float> $variables
     *
     * @return float
     */
    public function evaluateFormula(string $formula, array $variables = []): float
    {
        return $this->getFactory()->createFormulaEvaluator()->evaluate($formula, $variables);
    }
}
