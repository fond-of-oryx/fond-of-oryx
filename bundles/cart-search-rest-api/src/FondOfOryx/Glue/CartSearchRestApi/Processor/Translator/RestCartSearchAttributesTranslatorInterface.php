<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Translator;

use Generated\Shared\Transfer\RestCartSearchAttributesTransfer;

interface RestCartSearchAttributesTranslatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCartSearchAttributesTransfer $restCartSearchAttributesTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\RestCartSearchAttributesTransfer
     */
    public function translate(
        RestCartSearchAttributesTransfer $restCartSearchAttributesTransfer,
        string $locale
    ): RestCartSearchAttributesTransfer;
}
