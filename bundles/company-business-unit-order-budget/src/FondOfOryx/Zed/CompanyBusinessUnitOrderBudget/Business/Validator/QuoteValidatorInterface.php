<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Validator;

use Generated\Shared\Transfer\QuoteTransfer;

interface QuoteValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return void
     */
    public function validate(QuoteTransfer $quoteTransfer): void;
}
