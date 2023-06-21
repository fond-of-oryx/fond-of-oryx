<?php

namespace FondOfOryx\Zed\InactiveQuoteItemFilter\Dependency\Facade;

use Generated\Shared\Transfer\MessageTransfer;
use Spryker\Zed\Messenger\Business\MessengerFacadeInterface;

class InactiveQuoteItemFilterToMessengerFacadeBridge implements InactiveQuoteItemFilterToMessengerFacadeInterface
{
    /**
     * @var \Spryker\Zed\Messenger\Business\MessengerFacadeInterface
     */
    protected MessengerFacadeInterface $messengerFacade;

    /**
     * @param \Spryker\Zed\Messenger\Business\MessengerFacadeInterface $messengerFacade
     */
    public function __construct(MessengerFacadeInterface $messengerFacade)
    {
        $this->messengerFacade = $messengerFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\MessageTransfer $message
     *
     * @return void
     */
    public function addInfoMessage(MessageTransfer $message): void
    {
        $this->messengerFacade->addInfoMessage($message);
    }
}
