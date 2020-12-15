<?php

namespace FondOfOryx\Zed\CustomerStatistic\Business;

use Generated\Shared\Transfer\CustomerStatisticResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\CustomerStatistic\Business\CustomerStatisticBusinessFactory getFactory()
 */
class CustomerStatisticFacade extends AbstractFacade implements CustomerStatisticFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerStatisticResponseTransfer
     */
    public function incrementLoginCount(
        CustomerTransfer $customerTransfer
    ): CustomerStatisticResponseTransfer {
        return $this->getFactory()
            ->createLoginCountIncrementer()
            ->increment($customerTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api

     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function expandCustomer(CustomerTransfer $customerTransfer): CustomerTransfer
    {
        return $this->getFactory()
            ->createCustomerExpander()
            ->expand($customerTransfer);
    }
}
