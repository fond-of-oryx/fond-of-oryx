<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Validator;

use Generated\Shared\Transfer\QuoteTransfer;

interface QuoteValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @throws \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Exception\NotEnoughOrderBudgetException
     *
     * @return void
     */
    public function validate(QuoteTransfer $quoteTransfer): void;
}
