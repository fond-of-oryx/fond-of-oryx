<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Communication\Controller;

use Generated\Shared\Transfer\QuoteListTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\CartSearchRestApi\Business\CartSearchRestApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\QuoteListTransfer $quoteListTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteListTransfer
     */
    public function findQuotesAction(QuoteListTransfer $quoteListTransfer): QuoteListTransfer
    {
        return $this->getFacade()->findQuotes($quoteListTransfer);
    }
}
