<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Expander;

use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompanySearchResultItemTransfer;

class RestCompanySearchResultItemExpander implements RestCompanySearchResultItemExpanderInterface
{
    /**
     * @var array<\FondOfOryx\Glue\CompanySearchRestApiExtension\Dependency\Plugin\RestCompanySearchResultItemExpanderPluginInterface>
     */
    protected array $restCompanySearchResultItemExpanderPlugins;

    /**
     * @param array<\FondOfOryx\Glue\CompanySearchRestApiExtension\Dependency\Plugin\RestCompanySearchResultItemExpanderPluginInterface> $restCompanySearchResultItemExpanderPlugins
     */
    public function __construct(array $restCompanySearchResultItemExpanderPlugins)
    {
        $this->restCompanySearchResultItemExpanderPlugins = $restCompanySearchResultItemExpanderPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanySearchResultItemTransfer $restCompanySearchResultItemTransfer
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanySearchResultItemTransfer
     */
    public function expand(
        RestCompanySearchResultItemTransfer $restCompanySearchResultItemTransfer,
        CompanyTransfer $companyTransfer
    ): RestCompanySearchResultItemTransfer {
        foreach ($this->restCompanySearchResultItemExpanderPlugins as $restCompanySearchResultItemExpanderPlugin) {
            $restCompanySearchResultItemExpanderPlugin->expand($restCompanySearchResultItemTransfer, $companyTransfer);
        }

        return $restCompanySearchResultItemTransfer;
    }
}
