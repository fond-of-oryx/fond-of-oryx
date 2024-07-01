<?php

namespace FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin;

use Generated\Shared\Transfer\DocumentRestRequestTransfer;
use Generated\Shared\Transfer\EasyApiFilterTransfer;

interface DocumentTypePluginInterface
{
    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @param \Generated\Shared\Transfer\DocumentRestRequestTransfer $documentRestRequestTransfer
     *
     * @return \Generated\Shared\Transfer\EasyApiFilterTransfer
     */
    public function createEasyApiFilter(DocumentRestRequestTransfer $documentRestRequestTransfer): EasyApiFilterTransfer;
}
