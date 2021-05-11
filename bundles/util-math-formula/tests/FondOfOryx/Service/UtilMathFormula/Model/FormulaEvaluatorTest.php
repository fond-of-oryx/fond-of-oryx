<?php

namespace FondOfOryx\Service\UtilMathFormula\Model;

use Codeception\Test\Unit;
use Exception;
use MathParser\Interpreting\Evaluator;
use MathParser\StdMathParser;
use Throwable;

class FormulaEvaluatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Service\UtilMathFormula\Model\FormulaEvaluator
     */
    protected $formulaEvaluator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->formulaEvaluator = new FormulaEvaluator(
            new StdMathParser(),
            new Evaluator()
        );
    }

    /**
     * @return void
     */
    public function testEvaluate(): void
    {
        static::assertEquals(
            4,
            $this->formulaEvaluator->evaluate('x+1', ['x' => 3])
        );
    }

    /**
     * @return void
     */
    public function testEvaluateWithInvalidVariableValue(): void
    {
        try {
            $this->formulaEvaluator->evaluate('x+1', ['x' => 'x']);
            static::fail();
        } catch (Throwable $exception) {
        }
    }

    /**
     * @return void
     */
    public function testEvaluateWithInvalidFormula(): void
    {
        try {
            $this->formulaEvaluator->evaluate('x/0', ['x' => '1']);
            static::fail();
        } catch (Exception $exception) {
        }
    }
}
