<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model;

use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserCollectionResponseTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer;

interface RepresentationManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer|\Generated\Shared\Transfer\RestErrorMessageTransfer
     */
    public function addRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer|RestErrorMessageTransfer;

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserCollectionResponseTransfer|\Generated\Shared\Transfer\RestErrorMessageTransfer
     */
    public function getRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserCollectionResponseTransfer|RestErrorMessageTransfer;

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer|\Generated\Shared\Transfer\RestErrorMessageTransfer
     */
    public function updateRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer|RestErrorMessageTransfer;

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer|\Generated\Shared\Transfer\RestErrorMessageTransfer
     */
    public function deleteRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer|RestErrorMessageTransfer;
}
