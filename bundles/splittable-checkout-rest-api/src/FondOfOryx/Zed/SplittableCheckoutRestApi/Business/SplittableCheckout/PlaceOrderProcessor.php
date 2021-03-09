<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckout;

use FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Validator\SplittableCheckoutValidatorInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCalculationFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCartFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCartsRestApiFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCheckoutFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface;
use Generated\Shared\Transfer\CheckoutDataTransfer;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteCollectionTransfer;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestCheckoutErrorTransfer;
use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCheckoutResponseTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutErrorTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;
use Generated\Shared\Transfer\SplittableCheckoutDataTransfer;
use Generated\Shared\Transfer\SplittableCheckoutResponseTransfer;

class PlaceOrderProcessor implements PlaceOrderProcessorInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface
     */
    protected $splittableCheckoutFacade;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCalculationFacadeInterface
     */
    protected $calculationFacade;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiExtension\Dependency\Plugin\QuoteMapperPluginInterface[]
     */
    protected $quoteMapperPlugins;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Validator\SplittableCheckoutValidatorInterface
     */
    protected $splittableCheckoutDataValidator;

    /**
     * PlaceOrderProcessor constructor.
     *
     * @param \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface $splittableCheckoutFacade
     * @param \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCalculationFacadeInterface $calculationFacade
     * @param \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Validator\SplittableCheckoutValidatorInterface $splittableCheckoutDataValidator
     * @param array $quoteMapperPlugins
     */
    public function __construct(
        SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface $splittableCheckoutFacade,
        SplittableCheckoutRestApiToCalculationFacadeInterface $calculationFacade,
        SplittableCheckoutValidatorInterface $splittableCheckoutDataValidator,
        array $quoteMapperPlugins
    ) {
        $this->splittableCheckoutFacade = $splittableCheckoutFacade;
        $this->calculationFacade = $calculationFacade;
        $this->quoteMapperPlugins = $quoteMapperPlugins;
        $this->splittableCheckoutDataValidator = $splittableCheckoutDataValidator;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer
     */
    public function placeOrder(
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
    ): RestSplittableCheckoutResponseTransfer {
        $splittableCheckoutResponseTransfer = $this->splittableCheckoutDataValidator
            ->validateSplittableCheckout($restSplittableCheckoutRequestAttributesTransfer);

        if ($splittableCheckoutResponseTransfer->getIsSuccess() === false) {
            return $splittableCheckoutResponseTransfer;
        }

        $quoteTransfer = $this->executeQuoteMapperPlugins(
            $restSplittableCheckoutRequestAttributesTransfer,
            $quoteTransfer
        );

        $quoteTransfer = $this->calculationFacade->recalculateQuote($quoteTransfer);

        return $this->executePlaceOrder($quoteTransfer);

        if ($splittableCheckoutResponseTransfer->getIsSuccess() === false) {
            return $this->createPlaceOrderErrorResponse($splittableCheckoutResponseTransfer);
        }

        return $this->createRestSplittableCheckoutResponseTransfer($splittableCheckoutResponseTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function executeQuoteMapperPlugins(
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        foreach ($this->quoteMapperPlugins as $quoteMapperPlugin) {
            $quoteTransfer = $quoteMapperPlugin->map(
                $restSplittableCheckoutRequestAttributesTransfer,
                $quoteTransfer
            );
        }

        return $quoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SplittableCheckoutResponseTransfer
     */
    protected function executePlaceOrder(QuoteTransfer $quoteTransfer): SplittableCheckoutResponseTransfer
    {
        $splittableCheckoutResponseTransfer = $this->splittableCheckoutFacade->placeOrder($quoteTransfer);

        if ($splittableCheckoutResponseTransfer->getIsSuccess() === false) {
            return $this->createPlaceOrderErrorResponse($splittableCheckoutResponseTransfer);
        }

        return $this->createRestSplittableCheckoutResponseTransfer($splittableCheckoutResponseTransfer);
    }


    /**
     * @param \Generated\Shared\Transfer\SplittableCheckoutResponseTransfer $splittableCheckoutResponseTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer
     */
    protected function createPlaceOrderErrorResponse(
        SplittableCheckoutResponseTransfer $splittableCheckoutResponseTransfer
    ): RestSplittableCheckoutResponseTransfer
    {
        $restSplittableCheckoutResponseTransfer = (new RestSplittableCheckoutResponseTransfer())
            ->setIsSuccess(false);

        if ($splittableCheckoutResponseTransfer->getErrors()->count() === 0) {
            return $restSplittableCheckoutResponseTransfer
                ->addError(
                    (new RestSplittableCheckoutErrorTransfer())
                        ->setErrorIdentifier(SplittableCheckoutRestApiConfig::ERROR_IDENTIFIER_ORDER_NOT_PLACED)
                );
        }


        foreach ($splittableCheckoutResponseTransfer->getErrors() as $errorTransfer) {
            $restSplittableCheckoutResponseTransfer->addError(
                (new RestSplittableCheckoutErrorTransfer())
                    ->setErrorIdentifier(SplittableCheckoutRestApiConfig::ERROR_IDENTIFIER_ORDER_NOT_PLACED)
                    ->setDetail($errorTransfer->getMessage())
                    ->setParameters($errorTransfer->getParameters())
            );
        }

        return $restSplittableCheckoutResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\SplittableCheckoutResponseTransfer $splittableCheckoutResponseTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer
     */
    protected function createRestSplittableCheckoutResponseTransfer(
        SplittableCheckoutResponseTransfer $splittableCheckoutResponseTransfer
    ): RestSplittableCheckoutResponseTransfer {
        return (new RestSplittableCheckoutResponseTransfer())
            ->setIsSuccess(true)
            ->setOrderReferences($splittableCheckoutResponseTransfer->getOrderReferences());
    }

}
