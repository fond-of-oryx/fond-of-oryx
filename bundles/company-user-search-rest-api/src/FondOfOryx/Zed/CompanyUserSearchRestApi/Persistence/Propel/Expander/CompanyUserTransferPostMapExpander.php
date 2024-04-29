<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Expander;

use FondOfOryx\Zed\CompanyUserSearchRestApiExtension\Dependency\Plugin\CompanyUserTransferPostMapExpanderPluginInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUser;

class CompanyUserTransferPostMapExpander implements CompanyUserTransferPostMapExpanderInterface
{
    /**
     * @var array<CompanyUserTransferPostMapExpanderPluginInterface>
     */
    protected array $postMapExpanderPlugin;

    /**
     * @param array $postMapExpanderPlugin<CompanyUserTransferPostMapExpanderPluginInterface>
     */
    public function __construct(array $postMapExpanderPlugin)
    {
        $this->postMapExpanderPlugin = $postMapExpanderPlugin;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     * @param \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser $spyCompanyUser
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function expand(CompanyUserTransfer $companyUserTransfer, SpyCompanyUser $spyCompanyUser): CompanyUserTransfer
    {
        foreach ($this->postMapExpanderPlugin as $plugin){
            $companyUserTransfer = $plugin->expand($companyUserTransfer, $spyCompanyUser);
        }

        return $companyUserTransfer;
    }
}
