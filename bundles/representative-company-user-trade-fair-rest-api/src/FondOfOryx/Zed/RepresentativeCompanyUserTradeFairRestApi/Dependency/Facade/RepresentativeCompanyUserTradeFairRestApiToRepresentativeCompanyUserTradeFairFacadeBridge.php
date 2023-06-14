<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade;

use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business\RepresentativeCompanyUserTradeFairFacadeInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;

class RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeBridge implements RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business\RepresentativeCompanyUserTradeFairFacadeInterface
     */
    protected $facade;

    /**
     * @param \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business\RepresentativeCompanyUserTradeFairFacadeInterface $representativeCompanyUserTradeFairFacade
     */
    public function __construct(RepresentativeCompanyUserTradeFairFacadeInterface $representativeCompanyUserTradeFairFacade)
    {
        $this->facade = $representativeCompanyUserTradeFairFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function addRepresentativeCompanyUserTradeFair(
        RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
    ): RepresentativeCompanyUserTradeFairTransfer {
        return $this->facade->createRepresentativeCompanyUserTradeFair($representativeCompanyUserTradeFairTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function updateRepresentativeCompanyUserTradeFair(
        RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
    ): RepresentativeCompanyUserTradeFairTransfer {
        return $this->facade->updateRepresentativeCompanyUserTradeFair($representativeCompanyUserTradeFairTransfer);
    }

    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function findTradeFairRepresentationByUuid(string $uuid): RepresentativeCompanyUserTradeFairTransfer
    {
        return $this->facade->findTradeFairRepresentationByUuid($uuid);
    }

    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function deleteRepresentativeCompanyUserTradeFair(string $uuid): RepresentativeCompanyUserTradeFairTransfer
    {
        return $this->facade->deleteRepresentativeCompanyUserTradeFair($uuid);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer
     */
    public function getRepresentativeCompanyUserTradeFair(
        RepresentativeCompanyUserTradeFairFilterTransfer $filterTransfer
    ): RepresentativeCompanyUserTradeFairCollectionTransfer {
        return $this->facade->getRepresentativeCompanyUserTradeFair($filterTransfer);
    }
}
