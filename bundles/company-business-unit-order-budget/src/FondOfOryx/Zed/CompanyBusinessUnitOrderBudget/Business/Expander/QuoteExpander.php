<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander;

use Exception;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Exception\NotEnoughOrderBudgetException;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Validator\QuoteValidatorInterface;
use Generated\Shared\Transfer\MessageTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class QuoteExpander implements QuoteExpanderInterface
{
    public const MESSAGE_TYPE_ERROR = 'error';

    public const MESSAGE_INVALID_QUOTE = 'company_business_unit_order_budget.invalid_quote';
    public const MESSAGE_NOT_ENOUGH_ORDER_BUDGET = 'company_business_unit_order_budget.no_enough_order_budget';

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Validator\QuoteValidatorInterface
     */
    protected $quoteValidator;

    /**
     * @param \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Validator\QuoteValidatorInterface $quoteValidator
     */
    public function __construct(QuoteValidatorInterface $quoteValidator)
    {
        $this->quoteValidator = $quoteValidator;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $message = null;

        try {
            $this->quoteValidator->validate($quoteTransfer);
        } catch (NotEnoughOrderBudgetException $exception) {
            $message = static::MESSAGE_NOT_ENOUGH_ORDER_BUDGET;
        } catch (Exception $exception) {
            $message = static::MESSAGE_INVALID_QUOTE;
        }

        if ($message === null) {
            return $quoteTransfer;
        }

        $messageTransfer = (new MessageTransfer())->setType(static::MESSAGE_TYPE_ERROR)
            ->setValue($message);

        return $quoteTransfer->addValidationMessage($messageTransfer);
    }
}
