<?php

namespace FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Communication;

use FondOfOryx\Zed\CreditMemoPayoneDebitConnector\CreditMemoPayoneDebitConnectorDependencyProvider;
use FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Dependency\Facade\CreditMemoPayoneDebitConnectorToCreditMemoInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

class CreditMemoPayoneDebitConnectorCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Dependency\Facade\CreditMemoPayoneDebitConnectorToCreditMemoInterface
     */
    public function getCreditMemoFacade(): CreditMemoPayoneDebitConnectorToCreditMemoInterface
    {
        return $this->getProvidedDependency(CreditMemoPayoneDebitConnectorDependencyProvider::FACADE_CREDIT_MEMO);
    }
}
