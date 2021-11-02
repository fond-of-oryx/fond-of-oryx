<?php

namespace FondOfOryx\Service\UtilMathFormula;

use FondOfOryx\Service\UtilMathFormula\Model\FormulaEvaluator;
use FondOfOryx\Service\UtilMathFormula\Model\FormulaEvaluatorInterface;
use MathParser\Interpreting\Evaluator;
use MathParser\StdMathParser;
use Spryker\Service\Kernel\AbstractServiceFactory;

class UtilMathFormulaServiceFactory extends AbstractServiceFactory
{
    /**
     * @return \FondOfOryx\Service\UtilMathFormula\Model\FormulaEvaluatorInterface
     */
    public function createFormulaEvaluator(): FormulaEvaluatorInterface
    {
        return new FormulaEvaluator(
            $this->createParser(),
            $this->createEvaluator(),
        );
    }

    /**
     * @return \MathParser\StdMathParser
     */
    protected function createParser(): StdMathParser
    {
        return new StdMathParser();
    }

    /**
     * @return \MathParser\Interpreting\Evaluator
     */
    protected function createEvaluator(): Evaluator
    {
        return new Evaluator();
    }
}
