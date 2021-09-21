<?php

namespace FondOfOryx\Zed\DeliveryDateRestriction\Business\Expander;

use Exception;
use FondOfOryx\Zed\DeliveryDateRestriction\Business\Exception\CustomDeliveryDatesNotAllowedException;
use FondOfOryx\Zed\DeliveryDateRestriction\Business\Validator\QuoteValidatorInterface;
use Generated\Shared\Transfer\MessageTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class QuoteExpander implements QuoteExpanderInterface
{
    public const MESSAGE_TYPE_ERROR = 'error';

    public const MESSAGE_INVALID_QUOTE = 'delivery_date_restriction.invalid_quote';
    public const MESSAGE_CUSTOM_DELIVERY_DATES_NOT_ALLOWED = 'delivery_date_restriction.custom_delivery_dates_not_allowed';

    /**
     * @var \FondOfOryx\Zed\DeliveryDateRestriction\Business\Validator\QuoteValidatorInterface
     */
    protected $quoteValidator;

    /**
     * @param \FondOfOryx\Zed\DeliveryDateRestriction\Business\Validator\QuoteValidatorInterface $quoteValidator
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
        } catch (CustomDeliveryDatesNotAllowedException $exception) {
            $message = static::MESSAGE_CUSTOM_DELIVERY_DATES_NOT_ALLOWED;
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
