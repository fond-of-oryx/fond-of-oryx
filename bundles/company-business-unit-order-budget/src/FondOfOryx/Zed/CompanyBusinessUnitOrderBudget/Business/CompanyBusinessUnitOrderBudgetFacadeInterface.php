<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

interface CompanyBusinessUnitOrderBudgetFacadeInterface
{
    /**
     * Specification:
     * - Creates order budget for given company business unit
     * - Skips if already exists
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return void
     */
    public function createOrderBudgetForCompanyBusinessUnit(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
    ): void;

    /**
     * Specification:
     * - Expands quote with validation message
     * - Skips if user has permission to alter cart without limit
     * - Adds error message if company business unit order budget is lower then subtotal
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expandQuote(QuoteTransfer $quoteTransfer): QuoteTransfer;

    /**
     * Specification:
     * - Checks if company business unit order budget is lower than subtotal
     * - Throws exception if quote is not valid
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return void
     */
    public function validateQuote(QuoteTransfer $quoteTransfer): void;

    /**
     * Specification:
     * - Reduces company business unit order budget by quote
     * - Skips if user has permission to alter cart without limit
     * - Throws exception if quote is not valid
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return void
     */
    public function reduceOrderBudgetByQuote(QuoteTransfer $quoteTransfer): void;
}
