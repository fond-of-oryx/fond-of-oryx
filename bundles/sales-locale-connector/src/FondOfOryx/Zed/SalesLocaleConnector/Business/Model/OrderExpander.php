<?php

namespace FondOfOryx\Zed\SalesLocaleConnector\Business\Model;

use FondOfOryx\Zed\SalesLocaleConnector\Dependency\Facade\SalesLocaleConnectorToLocaleFacadeInterface;
use Generated\Shared\Transfer\OrderTransfer;

class OrderExpander implements OrderExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\SalesLocaleConnector\Dependency\Facade\SalesLocaleConnectorToLocaleFacadeInterface
     */
    protected $localeFacade;

    /**
     * @param \FondOfOryx\Zed\SalesLocaleConnector\Dependency\Facade\SalesLocaleConnectorToLocaleFacadeInterface $localeFacade
     */
    public function __construct(SalesLocaleConnectorToLocaleFacadeInterface $localeFacade)
    {
        $this->localeFacade = $localeFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function expand(OrderTransfer $orderTransfer): OrderTransfer
    {
        $fkLocale = $orderTransfer->getFkLocale();

        if ($fkLocale === null || $orderTransfer->getLocale() !== null) {
            return $orderTransfer;
        }

        $locale = $this->localeFacade->getLocaleById($fkLocale);

        return $orderTransfer->setLocale($locale);
    }
}
