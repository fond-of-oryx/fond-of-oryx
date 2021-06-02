<?php

namespace FondOfOryx\Zed\CreditMemo\Dependency\Facade;

use Generated\Shared\Transfer\LocaleTransfer;

interface CreditMemoToLocaleFacadeInterface
{
    /**
     * @param int $id
     *
     * @throws \Spryker\Zed\Locale\Business\Exception\MissingLocaleException
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getLocaleById(int $id): LocaleTransfer;
}
