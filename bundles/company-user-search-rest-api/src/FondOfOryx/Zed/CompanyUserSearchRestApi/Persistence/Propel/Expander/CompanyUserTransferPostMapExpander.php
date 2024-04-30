<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Expander;

use Generated\Shared\Transfer\CompanyUserTransfer;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUser;

class CompanyUserTransferPostMapExpander implements CompanyUserTransferPostMapExpanderInterface
{
    /**
     * @var array<\FondOfOryx\Zed\CompanyUserSearchRestApiExtension\Dependency\Plugin\CompanyUserTransferPostMapExpanderPluginInterface>
     */
    protected array $postMapExpanderPlugins;

    /**
     * @param array<\FondOfOryx\Zed\CompanyUserSearchRestApiExtension\Dependency\Plugin\CompanyUserTransferPostMapExpanderPluginInterface> $postMapExpanderPlugins
     */
    public function __construct(array $postMapExpanderPlugins)
    {
        $this->postMapExpanderPlugins = $postMapExpanderPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     * @param \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser $spyCompanyUser
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function expand(CompanyUserTransfer $companyUserTransfer, SpyCompanyUser $spyCompanyUser): CompanyUserTransfer
    {
        foreach ($this->postMapExpanderPlugins as $plugin) {
            $companyUserTransfer = $plugin->expand($companyUserTransfer, $spyCompanyUser);
        }

        return $companyUserTransfer;
    }
}
