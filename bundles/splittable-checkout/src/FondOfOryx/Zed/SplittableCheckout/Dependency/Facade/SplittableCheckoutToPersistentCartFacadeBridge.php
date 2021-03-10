<?php

namespace FondOfOryx\Zed\SplittableCheckout\Dependency\Facade;

use Generated\Shared\Transfer\PersistentCartChangeTransfer;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\PersistentCart\Business\PersistentCartFacadeInterface;

class SplittableCheckoutToPersistentCartFacadeBridge implements SplittableCheckoutToPersistentCartFacadeInterface
{
    /**
     * @var \Spryker\Zed\PersistentCart\Business\PersistentCartFacadeInterface
     */
    protected $persistentCartFacade;

    /**
     * @param \Spryker\Zed\PersistentCart\Business\PersistentCartFacadeInterface $persistentCartFacade
     */
    public function __construct(PersistentCartFacadeInterface $persistentCartFacade)
    {
        $this->persistentCartFacade = $persistentCartFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     */
    public function createQuote(QuoteTransfer $quoteTransfer): QuoteResponseTransfer
    {
        return $this->persistentCartFacade->createQuote($quoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\PersistentCartChangeTransfer $persistentCartChangeTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     */
    public function add(PersistentCartChangeTransfer $persistentCartChangeTransfer): QuoteResponseTransfer
    {
        return $this->persistentCartFacade->add($persistentCartChangeTransfer);
    }
}
