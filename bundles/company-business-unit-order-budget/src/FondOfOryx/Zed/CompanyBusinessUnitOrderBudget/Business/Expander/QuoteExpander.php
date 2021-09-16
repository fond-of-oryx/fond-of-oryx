<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander;

use Exception;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Validator\QuoteValidatorInterface;
use Generated\Shared\Transfer\MessageTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class QuoteExpander implements QuoteExpanderInterface
{
    public const MESSAGE_TYPE_ERROR = 'error';

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
        try {
            $this->quoteValidator->validate($quoteTransfer);
        } catch (Exception $exception) {
            $messageTransfer = (new MessageTransfer())->setType(static::MESSAGE_TYPE_ERROR)
                ->setValue($exception->getMessage());

            $quoteTransfer->addValidationMessage($messageTransfer);
        }

        return $quoteTransfer;
    }
}
