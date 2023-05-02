<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager;

use Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;

interface RepresentationManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function addRepresentation(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): RepresentativeCompanyUserTransfer;

    /**
     * @param string $uuid
     * @param string $state
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function flagState(string $uuid, string $state): RepresentativeCompanyUserTransfer;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer $representativeCompanyUserCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     */
    public function setAllInProcess(
        RepresentativeCompanyUserCollectionTransfer $representativeCompanyUserCollectionTransfer
    ): RepresentativeCompanyUserCollectionTransfer;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return void
     */
    public function checkForExpiration(RepresentativeCompanyUserFilterTransfer $filterTransfer): void;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return void
     */
    public function checkForActivation(RepresentativeCompanyUserFilterTransfer $filterTransfer): void;
}
