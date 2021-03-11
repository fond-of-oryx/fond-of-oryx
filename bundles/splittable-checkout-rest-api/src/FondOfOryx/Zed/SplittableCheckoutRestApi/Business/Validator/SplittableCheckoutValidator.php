<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Validator;

use FondOfOryx\Shared\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckout\Quote\QuoteReaderInterface;
use Generated\Shared\Transfer\RestSplittableCheckoutErrorTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;
use Generated\Shared\Transfer\SplittableCheckoutDataTransfer;
use Generated\Shared\Transfer\SplittableCheckoutResponseTransfer;

class SplittableCheckoutValidator implements SplittableCheckoutValidatorInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckout\Quote\QuoteReaderInterface
     */
    protected $quoteReader;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiExtension\Dependency\Plugin\SplittableCheckoutDataValidatorPluginInterface[]
     */
    protected $splittableCheckoutDataValidatorPlugins;

    /**
     * @param \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckout\Quote\QuoteReaderInterface $quoteReader
     * @param \FondOfOryx\Zed\SplittableCheckoutRestApiExtension\Dependency\Plugin\SplittableCheckoutDataValidatorPluginInterface[] $splittableCheckoutDataValidatorPlugins
     */
    public function __construct(
        QuoteReaderInterface $quoteReader,
        array $splittableCheckoutDataValidatorPlugins
    ) {
        $this->quoteReader = $quoteReader;
        $this->splittableCheckoutDataValidatorPlugins = $splittableCheckoutDataValidatorPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     *
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Validator\RestSplittableCheckoutDataResponseTransfer
     */
    public function validateSplittableCheckout(
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
    ): RestSplittableCheckoutResponseTransfer {
        $quoteTransfer = $this->quoteReader->findCustomerQuoteByUuid($restSplittableCheckoutRequestAttributesTransfer);
        $restSplittableCheckoutResponseTransfer = new RestSplittableCheckoutResponseTransfer();

        $splittableCheckoutDataTransfer = (new SplittableCheckoutDataTransfer())
            ->fromArray($restSplittableCheckoutRequestAttributesTransfer->toArray(), true)
            ->setQuote($quoteTransfer);

        $restSplittableCheckoutResponseTransfer = $this->executeSplittableCheckoutDataValidatorPlugins(
            $splittableCheckoutDataTransfer,
            $restSplittableCheckoutResponseTransfer
        );

        return $this->getRestSplittableCheckoutResponse(
            $splittableCheckoutDataTransfer,
            $restSplittableCheckoutResponseTransfer
        );
    }

    /**
     * @param \Generated\Shared\Transfer\SplittableCheckoutDataTransfer $splittableCheckoutDataTransfer
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer $restSplittableCheckoutResponseTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer
     */
    protected function executeSplittableCheckoutDataValidatorPlugins(
        SplittableCheckoutDataTransfer $splittableCheckoutDataTransfer,
        RestSplittableCheckoutResponseTransfer $restSplittableCheckoutResponseTransfer
    ): RestSplittableCheckoutResponseTransfer {
        foreach ($this->splittableCheckoutDataValidatorPlugins as $splittableCheckoutDataValidatorPlugin) {
            $splittableCheckoutResponseTransfer = $splittableCheckoutDataValidatorPlugin
                ->validateSplittableCheckoutData($splittableCheckoutDataTransfer);

            if ($splittableCheckoutResponseTransfer->getIsSuccess() === false) {
                $restSplittableCheckoutResponseTransfer = $this->copySplittableCheckoutResponseErrors(
                    $splittableCheckoutResponseTransfer,
                    $restSplittableCheckoutResponseTransfer
                );
            }
        }

        return $restSplittableCheckoutResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\SplittableCheckoutResponseTransfer $splittableCheckoutResponseTransfer
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer $restSplittableCheckoutResponseTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer
     */
    protected function copySplittableCheckoutResponseErrors(
        SplittableCheckoutResponseTransfer $splittableCheckoutResponseTransfer,
        RestSplittableCheckoutResponseTransfer $restSplittableCheckoutResponseTransfer
    ): RestSplittableCheckoutResponseTransfer {
        foreach ($splittableCheckoutResponseTransfer->getErrors() as $splittableCheckoutErrorTransfer) {
            $restSplittableCheckoutResponseTransfer->addError(
                (new RestSplittableCheckoutErrorTransfer())
                    ->setErrorIdentifier(SplittableCheckoutRestApiConfig::ERROR_IDENTIFIER_ORDER_NOT_PLACED)
                    ->setDetail($splittableCheckoutErrorTransfer->getMessage())
            );
        }

        return $restSplittableCheckoutResponseTransfer->setIsSuccess(false);
    }

    /**
     * @param \Generated\Shared\Transfer\SplittableCheckoutDataTransfer $splittableCheckoutDataTransfer
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer $restSplittableCheckoutResponseTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer
     */
    protected function getRestSplittableCheckoutResponse(
        SplittableCheckoutDataTransfer $splittableCheckoutDataTransfer,
        RestSplittableCheckoutResponseTransfer $restSplittableCheckoutResponseTransfer
    ): RestSplittableCheckoutResponseTransfer {
        $restSplittableCheckoutResponseTransfer->setSplittableCheckoutData($splittableCheckoutDataTransfer);

        if (
            $restSplittableCheckoutResponseTransfer->getIsSuccess() === true
            || $restSplittableCheckoutResponseTransfer->getErrors()->count() === 0
        ) {
            return $restSplittableCheckoutResponseTransfer->setIsSuccess(true);
        }

        return $restSplittableCheckoutResponseTransfer
            ->addError(
                (new RestSplittableCheckoutErrorTransfer())
                    ->setErrorIdentifier(SplittableCheckoutRestApiConfig::ERROR_IDENTIFIER_ORDER_NOT_PLACED)
            );
    }
}
