<?php

namespace FondOfOryx\Zed\EasyApi\Business;

use Generated\Shared\Transfer\EasyApiFilterTransfer;
use Generated\Shared\Transfer\EasyApiRequestTransfer;
use Generated\Shared\Transfer\EasyApiResponseTransfer;

interface EasyApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\EasyApiFilterTransfer $filterTransfer
     * @return \Generated\Shared\Transfer\EasyApiResponseTransfer
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function findDocument(EasyApiFilterTransfer $filterTransfer): EasyApiResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\EasyApiRequestTransfer $requestTransfer
     * @return \Generated\Shared\Transfer\EasyApiResponseTransfer
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     */
    public function getFile(EasyApiRequestTransfer $requestTransfer): EasyApiResponseTransfer;
}
