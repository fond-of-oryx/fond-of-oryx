<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business;

use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;

interface RepresentativeCompanyUserTradeFairFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function createRepresentativeCompanyUserTradeFair(
        RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
    ): RepresentativeCompanyUserTradeFairTransfer;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function updateRepresentativeCompanyUserTradeFair(
        RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
    ): RepresentativeCompanyUserTradeFairTransfer;

    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function findTradeFairRepresentationByUuid(string $uuid): RepresentativeCompanyUserTradeFairTransfer;

    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function deleteRepresentativeCompanyUserTradeFair(string $uuid): RepresentativeCompanyUserTradeFairTransfer;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer
     */
    public function getRepresentativeCompanyUserTradeFair(
        RepresentativeCompanyUserTradeFairFilterTransfer $filterTransfer
    ): RepresentativeCompanyUserTradeFairCollectionTransfer;

    /**
     * @return void
     */
    public function checkForTradeFairExpiration(): void;
}
