<?php

namespace FondOfOryx\Zed\CompanyUserApi\Business\Model;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

interface CompanyUserApiInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function add(ApiDataTransfer $apiDataTransfer): ApiItemTransfer;

    /**
     * @param int $idCompanyUser
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get(int $idCompanyUser): ApiItemTransfer;

    /**
     * @param int $idCompanyUser
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update(int $idCompanyUser, ApiDataTransfer $apiDataTransfer): ApiItemTransfer;

    /**
     * @param int $idCompanyUser
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function remove(int $idCompanyUser): ApiItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer;
}
