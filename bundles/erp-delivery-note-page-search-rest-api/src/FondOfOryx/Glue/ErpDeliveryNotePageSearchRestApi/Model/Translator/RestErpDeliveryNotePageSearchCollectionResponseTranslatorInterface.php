<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Translator;

use Generated\Shared\Transfer\RestErpDeliveryNotePageSearchCollectionResponseTransfer;

interface RestErpDeliveryNotePageSearchCollectionResponseTranslatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestErpDeliveryNotePageSearchCollectionResponseTransfer $restErpDeliveryNotePageSearchCollectionResponseTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\RestErpDeliveryNotePageSearchCollectionResponseTransfer
     */
    public function translate(
        RestErpDeliveryNotePageSearchCollectionResponseTransfer $restErpDeliveryNotePageSearchCollectionResponseTransfer,
        string $locale
    ): RestErpDeliveryNotePageSearchCollectionResponseTransfer;
}
