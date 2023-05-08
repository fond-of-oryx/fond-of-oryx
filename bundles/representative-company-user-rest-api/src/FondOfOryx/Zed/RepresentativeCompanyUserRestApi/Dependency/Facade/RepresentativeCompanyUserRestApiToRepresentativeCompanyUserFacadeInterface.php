<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade;

use Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;

interface RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function addRepresentativeCompanyUser(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): RepresentativeCompanyUserTransfer;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function updateRepresentativeCompanyUser(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): RepresentativeCompanyUserTransfer;

    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function findRepresentationByUuid(string $uuid): RepresentativeCompanyUserTransfer;

    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function deleteRepresentativeCompanyUser(string $uuid): RepresentativeCompanyUserTransfer;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     */
    public function getRepresentativeCompanyUser(RepresentativeCompanyUserFilterTransfer $filterTransfer): RepresentativeCompanyUserCollectionTransfer;
}
