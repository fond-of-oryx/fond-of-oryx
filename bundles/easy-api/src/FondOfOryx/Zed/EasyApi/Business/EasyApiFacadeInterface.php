<?php

namespace FondOfOryx\Zed\EasyApi\Business;

use Generated\Shared\Transfer\EasyApiFilterTransfer;
use Generated\Shared\Transfer\EasyApiRequestTransfer;
use Generated\Shared\Transfer\EasyApiResponseTransfer;

interface EasyApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\EasyApiFilterTransfer $filterTransfer
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return \Generated\Shared\Transfer\EasyApiResponseTransfer
     */
    public function findDocument(EasyApiFilterTransfer $filterTransfer): EasyApiResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\EasyApiRequestTransfer $requestTransfer
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return \Generated\Shared\Transfer\EasyApiResponseTransfer
     */
    public function getFile(EasyApiRequestTransfer $requestTransfer): EasyApiResponseTransfer;
}
