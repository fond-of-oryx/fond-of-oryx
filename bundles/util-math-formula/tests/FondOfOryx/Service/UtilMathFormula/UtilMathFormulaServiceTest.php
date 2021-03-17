<?php

namespace FondOfOryx\Service\UtilMathFormula;

use Codeception\Test\Unit;
use FondOfOryx\Service\UtilMathFormula\Model\FormulaEvaluatorInterface;

class UtilMathFormulaServiceTest extends Unit
{
    /**
     * @var \FondOfOryx\Service\UtilMathFormula\UtilMathFormulaServiceFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $utilMathFormulaServiceFactoryMock;

    /**
     * @var \FondOfOryx\Service\UtilMathFormula\Model\FormulaEvaluatorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $formulaEvaluatorMock;

    /**
     * @var \FondOfOryx\Service\UtilMathFormula\UtilMathFormulaService
     */
    protected $utilMathFormulaService;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->utilMathFormulaServiceFactoryMock = $this->getMockBuilder(UtilMathFormulaServiceFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->formulaEvaluatorMock = $this->getMockBuilder(FormulaEvaluatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->utilMathFormulaService = new UtilMathFormulaService();
        $this->utilMathFormulaService->setFactory($this->utilMathFormulaServiceFactoryMock);
    }

    /**
     * @return void
     */
    public function testEvaluateFormula(): void
    {
        $formula = 'x+1';
        $variables = ['x' => 1];
        $result = (float)2;

        $this->utilMathFormulaServiceFactoryMock->expects(static::atLeastOnce())
            ->method('createFormulaEvaluator')
            ->willReturn($this->formulaEvaluatorMock);

        $this->formulaEvaluatorMock->expects(static::atLeastOnce())
            ->method('evaluate')
            ->with($formula, $variables)
            ->willReturn($result);

        static::assertEquals(
            $result,
            $this->utilMathFormulaService->evaluateFormula($formula, $variables)
        );
    }
}
