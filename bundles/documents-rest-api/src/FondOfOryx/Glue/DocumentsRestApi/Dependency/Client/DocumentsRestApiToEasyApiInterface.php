<?php

namespace FondOfOryx\Glue\DocumentsRestApi\Dependency\Client;

use Generated\Shared\Transfer\EasyApiFilterTransfer;
use Generated\Shared\Transfer\EasyApiRequestTransfer;
use Generated\Shared\Transfer\EasyApiResponseTransfer;

interface DocumentsRestApiToEasyApiInterface
{
    /**
     * @param \Generated\Shared\Transfer\EasyApiFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\EasyApiResponseTransfer
     */
    public function findDocument(EasyApiFilterTransfer $filterTransfer): EasyApiResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\EasyApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\EasyApiResponseTransfer
     */
    public function getDocument(EasyApiRequestTransfer $requestTransfer): EasyApiResponseTransfer;
}
