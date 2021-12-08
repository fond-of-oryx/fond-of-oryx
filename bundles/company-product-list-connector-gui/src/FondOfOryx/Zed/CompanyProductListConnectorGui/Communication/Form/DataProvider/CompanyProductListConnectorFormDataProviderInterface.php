<?php

namespace FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Form\DataProvider;

use Generated\Shared\Transfer\CompanyProductListConnectorFormTransfer;

interface CompanyProductListConnectorFormDataProviderInterface
{
    /**
     * @return array
     */
    public function getOptions(): array;

    /**
     * @param int $idCompany
     *
     * @return \Generated\Shared\Transfer\CompanyProductListConnectorFormTransfer
     */
    public function getData(int $idCompany): CompanyProductListConnectorFormTransfer;
}
