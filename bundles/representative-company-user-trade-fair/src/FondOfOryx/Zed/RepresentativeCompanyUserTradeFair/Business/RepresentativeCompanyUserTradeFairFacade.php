<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business;

use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business\RepresentativeCompanyUserTradeFairBusinessFactory getFactory()
 */
class RepresentativeCompanyUserTradeFairFacade extends AbstractFacade implements RepresentativeCompanyUserTradeFairFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function createRepresentativeCompanyUserTradeFair(
        RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
    ): RepresentativeCompanyUserTradeFairTransfer {
        return $this->getFactory()->createTradeFairRepresentationManager()->create($representativeCompanyUserTradeFairTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function updateRepresentativeCompanyUserTradeFair(
        RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
    ): RepresentativeCompanyUserTradeFairTransfer {
        return $this->getFactory()->createTradeFairRepresentationManager()->update($representativeCompanyUserTradeFairTransfer);
    }

    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function findTradeFairRepresentationByUuid(string $uuid): RepresentativeCompanyUserTradeFairTransfer
    {
        return $this->getFactory()->createTradeFairRepresentationManager()->findByUuid($uuid);
    }

    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function deleteRepresentativeCompanyUserTradeFair(string $uuid): RepresentativeCompanyUserTradeFairTransfer
    {
        return $this->getFactory()->createTradeFairRepresentationManager()->delete($uuid);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer
     */
    public function getRepresentativeCompanyUserTradeFair(
        RepresentativeCompanyUserTradeFairFilterTransfer $filterTransfer
    ): RepresentativeCompanyUserTradeFairCollectionTransfer {
        return $this->getFactory()->createTradeFairRepresentationManager()->get($filterTransfer);
    }

    /**
     * @return void
     */
    public function checkForTradeFairExpiration(): void
    {
        $this->getFactory()->createTradeFairRepresentationManager()->checkForExpiration();
    }
}
