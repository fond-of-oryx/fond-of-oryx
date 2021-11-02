<?php

namespace FondOfOryx\Service\UtilMathFormula;

use Codeception\Test\Unit;
use FondOfOryx\Service\UtilMathFormula\Model\FormulaEvaluator;

class UtilMathFormulaServiceFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Service\UtilMathFormula\UtilMathFormulaServiceFactory
     */
    protected $utilMathServiceFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->utilMathServiceFactory = new UtilMathFormulaServiceFactory();
    }

    /**
     * @return void
     */
    public function testCreateFormulaEvaluator(): void
    {
        static::assertInstanceOf(
            FormulaEvaluator::class,
            $this->utilMathServiceFactory->createFormulaEvaluator(),
        );
    }
}
