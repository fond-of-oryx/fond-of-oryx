<?php

namespace FondOfOryx\Zed\SplittableCheckoutCompanyUserConnector\Communication\Plugin\SplittableCheckoutExtension;

use FondOfOryx\Zed\SplittableCheckoutExtension\Dependency\Plugin\IdentifierExtractorPluginInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class CompanyUserIdentifierExtractorPlugin extends AbstractPlugin implements IdentifierExtractorPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return string|int|null
     */
    public function extract(QuoteTransfer $quoteTransfer)
    {
        $companyUserTransfer = $quoteTransfer->getCompanyUser();

        if ($companyUserTransfer === null || $companyUserTransfer->getIdCompanyUser() === null) {
            return null;
        }

        return $companyUserTransfer->getIdCompanyUser();
    }
}
