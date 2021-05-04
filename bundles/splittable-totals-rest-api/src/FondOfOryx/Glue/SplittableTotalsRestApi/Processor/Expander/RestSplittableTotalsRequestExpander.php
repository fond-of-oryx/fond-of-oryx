<?php

namespace FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Expander;

use FondOfOryx\Glue\SplittableTotalsRestApi\SplittableTotalsRestApiConfig;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RestSplittableTotalsRequestExpander implements RestSplittableTotalsRequestExpanderInterface
{
    /**
     * @var \FondOfOryx\Glue\SplittableTotalsRestApi\SplittableTotalsRestApiConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Glue\SplittableTotalsRestApi\SplittableTotalsRestApiConfig $config
     */
    public function __construct(SplittableTotalsRestApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer
     */
    public function expand(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer,
        RestRequestInterface $restRequest
    ): RestSplittableTotalsRequestTransfer {
        $restSplittableTotalsRequestTransfer = $this->expandWithCustomer(
            $restSplittableTotalsRequestTransfer,
            $restRequest
        );

        return $this->expandWithPaymentSelection($restSplittableTotalsRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer
     */
    protected function expandWithCustomer(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer,
        RestRequestInterface $restRequest
    ): RestSplittableTotalsRequestTransfer {
        $getUserMethod = 'getUser';

        if (method_exists($restRequest, 'getRestUser')) {
            $getUserMethod = 'getRestUser';
        }

        if ($restRequest->$getUserMethod() === null) {
            return $restSplittableTotalsRequestTransfer;
        }

        /** @var \Generated\Shared\Transfer\RestUserTransfer|\Spryker\Glue\GlueApplication\Rest\Request\Data\UserInterface $restUser */
        $restUser = $restRequest->$getUserMethod();

        return $restSplittableTotalsRequestTransfer->setIdCustomer(
            $restUser->getSurrogateIdentifier()
        );
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer
     */
    protected function expandWithPaymentSelection(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
    ): RestSplittableTotalsRequestTransfer {
        $restPaymentTransfers = $restSplittableTotalsRequestTransfer->getPayments();
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

        return $restSplittableTotalsRequestTransfer;
    }
}
