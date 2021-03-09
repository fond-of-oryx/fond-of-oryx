<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\RequestAttributesExpander;

use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Customer\CustomerMapper;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Customer\CustomerMapperInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class SplittableCheckoutRequestAttributesExpander implements SplittableCheckoutRequestAttributesExpanderInterface
{
    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig
     */
    protected $config;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Customer\CustomerMapper
     */
    protected $customerMapper;

    /**
     * @var \Spryker\Glue\CheckoutRestApiExtension\Dependency\Plugin\CheckoutRequestExpanderPluginInterface[]
     */
    protected $checkoutRequestExpanderPlugins;

    /**
     * SplittableCheckoutRequestAttributesExpander constructor.
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig $config
     */
    public function __construct(
        CustomerMapper $customerMapper,
        SplittableCheckoutRestApiConfig $config,
        array $checkoutRequestExpanderPlugins
    ) {
        $this->customerMapper = $customerMapper;
        $this->config = $config;
        $this->checkoutRequestExpanderPlugins = $checkoutRequestExpanderPlugins;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer
     */
    public function expandSplittableCheckoutRequestAttributes(
        RestRequestInterface $restRequest,
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
    ): RestSplittableCheckoutRequestAttributesTransfer {
        $restSplittableCheckoutRequestAttributesTransfer =
            $this->expandCustomerData($restRequest, $restSplittableCheckoutRequestAttributesTransfer);

        $restSplittableCheckoutRequestAttributesTransfer =
            $this->expandPaymentSelection($restSplittableCheckoutRequestAttributesTransfer);

        return $this->executeSplittableCheckoutRequestExpanderPlugins(
            $restRequest,
            $restSplittableCheckoutRequestAttributesTransfer
        );
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer
     */
    protected function expandCustomerData(
        RestRequestInterface $restRequest,
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
    ): RestSplittableCheckoutRequestAttributesTransfer {
        $restCustomerTransfer = $this->customerMapper
            ->mapRestCustomerTransferFromRestSplittableCheckoutRequest($restRequest, $restSplittableCheckoutRequestAttributesTransfer);
        $restSplittableCheckoutRequestAttributesTransfer->setCustomer($restCustomerTransfer);

        return $restSplittableCheckoutRequestAttributesTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer
     */
    protected function expandPaymentSelection(
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
    ): RestSplittableCheckoutRequestAttributesTransfer
    {
        $payments = $restSplittableCheckoutRequestAttributesTransfer->getPayments();
        $paymentProviderMethodToStateMachineMapping = $this->config->getPaymentProviderMethodToStateMachineMapping();

        foreach ($payments as $payment) {
            if (isset($paymentProviderMethodToStateMachineMapping[$payment->getPaymentProviderName()][$payment->getPaymentMethodName()])) {
                $payment->setPaymentSelection($paymentProviderMethodToStateMachineMapping[$payment->getPaymentProviderName()][$payment->getPaymentMethodName()]);
            }
        }

        return $restSplittableCheckoutRequestAttributesTransfer;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer
     */
    protected function executeSplittableCheckoutRequestExpanderPlugins(
        RestRequestInterface $restRequest,
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
    ): RestSplittableCheckoutRequestAttributesTransfer {
        foreach ($this->checkoutRequestExpanderPlugins as $checkoutRequestExpanderPlugin) {
            $restSplittableCheckoutRequestAttributesTransfer = $checkoutRequestExpanderPlugin->expand(
                $restRequest,
                $restSplittableCheckoutRequestAttributesTransfer
            );
        }

        return $restSplittableCheckoutRequestAttributesTransfer;
    }
}
