<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Translator;

use Generated\Shared\Transfer\RestOrderBudgetSearchAttributesTransfer;

interface RestOrderBudgetSearchAttributesTranslatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestOrderBudgetSearchAttributesTransfer $restOrderBudgetSearchAttributesTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\RestOrderBudgetSearchAttributesTransfer
     */
    public function translate(
        RestOrderBudgetSearchAttributesTransfer $restOrderBudgetSearchAttributesTransfer,
        string $locale
    ): RestOrderBudgetSearchAttributesTransfer;
}
