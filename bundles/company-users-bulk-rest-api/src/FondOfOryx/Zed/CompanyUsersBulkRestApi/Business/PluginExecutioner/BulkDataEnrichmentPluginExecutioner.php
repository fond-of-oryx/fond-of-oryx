<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\PluginExecutioner;

use FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkItemPostEnrichmentPluginInterface;
use FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkItemPreEnrichmentPluginInterface;
use Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkItemTransfer;

class BulkDataEnrichmentPluginExecutioner implements BulkDataEnrichmentPluginExecutionerInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkItemPreEnrichmentPluginInterface[]
     */
    protected array $prePlugins;
    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkItemPostEnrichmentPluginInterface[]
     */
    protected array $postPlugins;

    /**
     * @param CompanyUsersBulkItemPreEnrichmentPluginInterface[] $prePlugins
     * @param CompanyUsersBulkItemPostEnrichmentPluginInterface[] $postPlugins
     */
    public function __construct(array $prePlugins, array $postPlugins)
    {
        $this->prePlugins = $prePlugins;
        $this->postPlugins = $postPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer $companyUsersBulkPreparationTransfer
     * @return \Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer
     */
    public function executePrePlugins(CompanyUsersBulkPreparationTransfer $companyUsersBulkPreparationTransfer): CompanyUsersBulkPreparationTransfer
    {
        foreach ($this->prePlugins as $plugin) {
            $companyUsersBulkPreparationTransfer = $plugin->preEnrichment($companyUsersBulkPreparationTransfer);
        }

        return $companyUsersBulkPreparationTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer $companyUsersBulkPreparationTransfer
     * @return \Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer
     */
    public function executePostPlugins(CompanyUsersBulkPreparationTransfer $companyUsersBulkPreparationTransfer): CompanyUsersBulkPreparationTransfer
    {
        foreach ($this->postPlugins as $plugin) {
            $companyUsersBulkPreparationTransfer = $plugin->postEnrichment($companyUsersBulkPreparationTransfer);
        }

        return $companyUsersBulkPreparationTransfer;
    }
}
