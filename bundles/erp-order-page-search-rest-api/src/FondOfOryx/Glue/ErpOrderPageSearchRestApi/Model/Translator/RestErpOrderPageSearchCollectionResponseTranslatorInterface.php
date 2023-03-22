<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Translator;

use Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer;

interface RestErpOrderPageSearchCollectionResponseTranslatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer $restErpOrderPageSearchCollectionResponseTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer
     */
    public function translate(
        RestErpOrderPageSearchCollectionResponseTransfer $restErpOrderPageSearchCollectionResponseTransfer,
        string $locale
    ): RestErpOrderPageSearchCollectionResponseTransfer;
}
