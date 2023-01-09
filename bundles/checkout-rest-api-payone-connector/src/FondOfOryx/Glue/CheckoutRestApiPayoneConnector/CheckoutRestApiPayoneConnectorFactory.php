<?php

namespace FondOfOryx\Glue\CheckoutRestApiPayoneConnector;

use FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Dependency\CheckoutRestApiPayoneConnectorToStoreClientBridgeInterface;
use FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Handler\PayoneHandler;
use FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Handler\PayoneHandlerInterface;
use FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Processor\Validator\PayoneCreditCardValidator;
use FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Processor\Validator\PayoneEWalletValidator;
use FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Processor\Validator\ValidatorInterface;
use Generated\Shared\Transfer\PaymentTransfer;
use Spryker\Glue\Kernel\AbstractFactory;

class CheckoutRestApiPayoneConnectorFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Handler\PayoneHandlerInterface
     */
    public function createPayoneHandler(): PayoneHandlerInterface
    {
        return new PayoneHandler($this->getStoreClient());
    }

    /**
     * @param string $paymentSelection
     *
     * @return \FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Processor\Validator\ValidatorInterface|null
     */
    public function getValidatorStrategy(string $paymentSelection): ?ValidatorInterface
    {
        switch ($paymentSelection) {
            case PaymentTransfer::PAYONE_CREDIT_CARD:
                return $this->getPayoneCreditCardValidator();
            case PaymentTransfer::PAYONE_E_WALLET:
                return $this->getPayoneEWalletValidator();
            default:
                return null;
        }
    }

    /**
     * @return \FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Processor\Validator\ValidatorInterface
     */
    protected function getPayoneCreditCardValidator(): ValidatorInterface
    {
        return new PayoneCreditCardValidator();
    }

    /**
     * @return \FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Processor\Validator\ValidatorInterface
     */
    protected function getPayoneEWalletValidator(): ValidatorInterface
    {
        return new PayoneEWalletValidator();
    }

    /**
     * @return \FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Dependency\CheckoutRestApiPayoneConnectorToStoreClientBridgeInterface
     */
    public function getStoreClient(): CheckoutRestApiPayoneConnectorToStoreClientBridgeInterface
    {
        return $this->getProvidedDependency(CheckoutRestApiPayoneConnectorDependencyProvider::STORE_CLIENT);
    }
}
