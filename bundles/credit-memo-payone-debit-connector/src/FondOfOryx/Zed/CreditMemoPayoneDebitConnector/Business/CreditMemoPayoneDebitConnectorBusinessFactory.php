<?php

namespace FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Business;

use FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Business\Expander\CreditMemoPayoneDebitConnectorIsDebitExpander;
use FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Business\Expander\CreditMemoPayoneDebitConnectorIsDebitExpanderInterface;
use FondOfOryx\Zed\CreditMemoPayoneDebitConnector\CreditMemoPayoneDebitConnectorDependencyProvider;
use FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Dependency\Facade\CreditMemoPayoneDebitConnectorToSalesFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class CreditMemoPayoneDebitConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Business\Expander\CreditMemoPayoneDebitConnectorIsDebitExpanderInterface
     */
    public function createCreditMemoIsDebitExpander(): CreditMemoPayoneDebitConnectorIsDebitExpanderInterface
    {
        return new CreditMemoPayoneDebitConnectorIsDebitExpander(
            $this->getSalesFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Dependency\Facade\CreditMemoPayoneDebitConnectorToSalesFacadeInterface
     */
    protected function getSalesFacade(): CreditMemoPayoneDebitConnectorToSalesFacadeInterface
    {
        return $this->getProvidedDependency(CreditMemoPayoneDebitConnectorDependencyProvider::FACADE_SALES);
    }
}
