<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Translator;

use Generated\Shared\Transfer\RestErpInvoicePageSearchCollectionResponseTransfer;

interface RestErpInvoicePageSearchCollectionResponseTranslatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestErpInvoicePageSearchCollectionResponseTransfer $restErpInvoicePageSearchCollectionResponseTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\RestErpInvoicePageSearchCollectionResponseTransfer
     */
    public function translate(
        RestErpInvoicePageSearchCollectionResponseTransfer $restErpInvoicePageSearchCollectionResponseTransfer,
        string $locale
    ): RestErpInvoicePageSearchCollectionResponseTransfer;
}
