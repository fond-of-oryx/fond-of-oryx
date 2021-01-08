<?php

namespace FondOfOryx\Zed\CustomerStatistic\Communication\Plugin\AuthRestApiExtension;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OauthResponseTransfer;
use Spryker\Zed\AuthRestApiExtension\Dependency\Plugin\PostAuthPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CustomerStatistic\Business\CustomerStatisticFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticRepositoryInterface getRepository()()
 */
class CustomerStatisticPostAuthPlugin extends AbstractPlugin implements PostAuthPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\OauthResponseTransfer $oauthResponseTransfer
     *
     * @return void
     */
    public function postAuth(OauthResponseTransfer $oauthResponseTransfer): void
    {
        $customerReference = $oauthResponseTransfer->getCustomerReference();

        if ($customerReference === null) {
            return;
        }

        $idCustomer = $this->getRepository()->getIdCustomerByCustomerReference($customerReference);

        if ($idCustomer === null) {
            return;
        }

        $customerTransfer = (new CustomerTransfer())
            ->setIdCustomer($idCustomer);

        $this->getFacade()->incrementLoginCount($customerTransfer);
    }
}
