<?php

namespace FondOfOryx\Yves\Prepayment\Plugin;

use Exception;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Yves\Kernel\AbstractPlugin;
use Spryker\Yves\StepEngine\Dependency\Plugin\Handler\StepHandlerPluginInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \FondOfOryx\Yves\Prepayment\PrepaymentFactory getFactory()
 */
class PrepaymentHandlerPlugin extends AbstractPlugin implements StepHandlerPluginInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Generated\Shared\Transfer\QuoteTransfer|\Spryker\Shared\Kernel\Transfer\AbstractTransfer $quoteTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function addToDataClass(Request $request, AbstractTransfer $quoteTransfer)
    {
        if (($quoteTransfer instanceof QuoteTransfer) === false) {
            throw new Exception(sprintf('wrong transfer given %s!==%s!', QuoteTransfer::class, get_class($quoteTransfer)));
        }

        return $this->getFactory()->createPrepaymentHandler()->addPaymentToQuote($quoteTransfer);
    }
}
