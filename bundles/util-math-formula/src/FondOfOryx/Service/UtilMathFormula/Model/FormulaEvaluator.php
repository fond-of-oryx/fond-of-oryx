<?php

namespace FondOfOryx\Service\UtilMathFormula\Model;

use Exception;
use FondOfOryx\Service\UtilMathFormula\Exception\FormulaEvaluationException;
use MathParser\Interpreting\Evaluator;
use MathParser\StdMathParser;

class FormulaEvaluator implements FormulaEvaluatorInterface
{
    /**
     * @var \MathParser\StdMathParser
     */
    protected $parser;

    /**
     * @var \MathParser\Interpreting\Evaluator
     */
    protected $evaluator;

    /**
     * @param \MathParser\StdMathParser $parser
     * @param \MathParser\Interpreting\Evaluator $evaluator
     */
    public function __construct(StdMathParser $parser, Evaluator $evaluator)
    {
        $this->parser = $parser;
        $this->evaluator = $evaluator;
    }

    /**
     * @param string $formula
     * @param array<float> $variables
     *
     * @throws \FondOfOryx\Service\UtilMathFormula\Exception\FormulaEvaluationException
     *
     * @return float
     */
    public function evaluate(string $formula, array $variables): float
    {
        try {
            /** @var \MathParser\Parsing\Nodes\Node $abstractSyntaxTree */
            $abstractSyntaxTree = $this->parser->parse($formula);
            $this->evaluator->setVariables($variables);

            return $abstractSyntaxTree->accept($this->evaluator);
        } catch (Exception $exception) {
            throw new FormulaEvaluationException(
                sprintf('Could not evaluate formula "%s" with given variables %s', $formula, json_encode($variables)),
            );
        }
    }
}
