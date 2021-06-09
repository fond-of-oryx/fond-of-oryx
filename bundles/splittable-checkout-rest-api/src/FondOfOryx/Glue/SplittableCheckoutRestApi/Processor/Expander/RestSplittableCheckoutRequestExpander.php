<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Expander;

use FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RestSplittableCheckoutRequestExpander implements RestSplittableCheckoutRequestExpanderInterface
{
    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig $config
     */
    public function __construct(SplittableCheckoutRestApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer
     */
    public function expand(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer,
        RestRequestInterface $restRequest
    ): RestSplittableCheckoutRequestTransfer {
        $restSplittableCheckoutRequestTransfer = $this->expandWithCustomer(
            $restSplittableCheckoutRequestTransfer,
            $restRequest
        );

        return $this->expandWithPaymentSelection($restSplittableCheckoutRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer
     */
    protected function expandWithCustomer(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer,
        RestRequestInterface $restRequest
    ): RestSplittableCheckoutRequestTransfer {
        $getUserMethod = 'getUser';

        if (method_exists($restRequest, 'getRestUser')) {
            $getUserMethod = 'getRestUser';
        }

        if ($restRequest->$getUserMethod() === null) {
            return $restSplittableCheckoutRequestTransfer;
        }

        /** @var \Generated\Shared\Transfer\RestUserTransfer|\Spryker\Glue\GlueApplication\Rest\Request\Data\UserInterface $restUser */
        $restUser = $restRequest->$getUserMethod();

        return $restSplittableCheckoutRequestTransfer->setCustomerReference(
            $restUser->getNaturalIdentifier()
        );
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer
     */
    protected function expandWithPaymentSelection(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
    ): RestSplittableCheckoutRequestTransfer {
        $restPaymentTransfers = $restSplittableCheckoutRequestTransfer->getPayments();
        $paymentProviderMethodToStateMachineMapping = $this->config->getPaymentProviderMethodToStateMachineMapping();

        foreach ($restPaymentTransfers as $restPaymentTransfer) {
            $paymentProviderName = $restPaymentTransfer->getPaymentProviderName();
            $paymentMethodName = $restPaymentTransfer->getPaymentMethodName();

            if ($paymentProviderName === null || $paymentMethodName === null) {
                continue;
            }

            if (!isset($paymentProviderMethodToStateMachineMapping[$paymentProviderName][$paymentMethodName])) {
                continue;
            }

            $restPaymentTransfer->setPaymentSelection(
                $paymentProviderMethodToStateMachineMapping[$paymentProviderName][$paymentMethodName]
            );
        }

        return $restSplittableCheckoutRequestTransfer;
    }
}
