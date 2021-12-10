<?php

namespace FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Form\DataProvider;

use Generated\Shared\Transfer\CustomerProductListConnectorFormTransfer;

interface CustomerProductListConnectorFormDataProviderInterface
{
    /**
     * @return array
     */
    public function getOptions(): array;

    /**
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CustomerProductListConnectorFormTransfer
     */
    public function getData(int $idCustomer): CustomerProductListConnectorFormTransfer;
}
