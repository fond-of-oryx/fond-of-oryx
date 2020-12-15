<?php

namespace FondOfOryx\Client\CustomerStatistic\Plugin\Customer;

use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Client\Customer\Dependency\Plugin\CustomerSessionSetPluginInterface;
use Spryker\Client\Kernel\AbstractPlugin;

/**
 * @method \FondOfOryx\Client\CustomerStatistic\CustomerStatisticFactory getFactory()
 */
class CustomerStatisticCustomerSessionSetPlugin extends AbstractPlugin implements CustomerSessionSetPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return void
     */
    public function execute(CustomerTransfer $customerTransfer): void
    {
        $this->getFactory()
            ->createCustomerStatisticZedStub()
            ->incrementLoginCount($customerTransfer);
    }
}
