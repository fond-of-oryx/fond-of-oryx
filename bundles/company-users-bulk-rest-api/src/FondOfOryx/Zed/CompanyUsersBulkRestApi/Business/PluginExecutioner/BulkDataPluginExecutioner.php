<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\PluginExecutioner;

use Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkResponseTransfer;

class BulkDataPluginExecutioner implements BulkDataPluginExecutionerInterface
{
    /**
     * @var array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkItemPreEnrichmentPluginInterface>
     */
    protected array $preEnrichmentPlugins;

    /**
     * @var array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkItemPostEnrichmentPluginInterface>
     */
    protected array $postEnrichmentPlugins;

    /**
     * @var array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkPreHandlingPluginInterface>
     */
    protected array $preHandlingPlugins;

    /**
     * @var array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkPostHandlingPluginInterface>
     */
    protected array $postHandlingPlugins;

    /**
     * @var array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkPreAssignPluginInterface>
     */
    protected array $preAssignPlugins;

    /**
     * @var array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkPostAssignPluginInterface>
     */
    protected array $postAssignPlugins;

    /**
     * @var array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkPreUnassignPluginInterface>
     */
    protected array $preUnassignPlugins;

    /**
     * @var array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkPostUnassignPluginInterface>
     */
    protected array $postUnassignPlugins;

    /**
     * @param array<\FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\PluginExecutioner\CompanyUsersBulkItemPreEnrichmentPluginInterface> $preEnrichmentPlugins
     * @param array<\FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\PluginExecutioner\CompanyUsersBulkItemPostEnrichmentPluginInterface> $postEnrichmentPlugins
     * @param array<\FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\PluginExecutioner\CompanyUsersBulkPreHandlingPluginInterface> $preHandlingPlugins
     * @param array<\FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\PluginExecutioner\CompanyUsersBulkPostHandlingPluginInterface> $postHandlingPlugins
     * @param array<\FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\PluginExecutioner\CompanyUsersBulkPreAssignPluginInterface> $preAssignPlugins
     * @param array<\FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\PluginExecutioner\CompanyUsersBulkPostAssignPluginInterface> $postAssignPlugins
     * @param array<\FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\PluginExecutioner\CompanyUsersBulkPreUnassignPluginInterface> $preUnassignPlugins
     * @param array<\FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\PluginExecutioner\CompanyUsersBulkPostUnassignPluginInterface> $postUnassignPlugins
     */
    public function __construct(
        array $preEnrichmentPlugins,
        array $postEnrichmentPlugins,
        array $preHandlingPlugins,
        array $postHandlingPlugins,
        array $preAssignPlugins,
        array $postAssignPlugins,
        array $preUnassignPlugins,
        array $postUnassignPlugins
    ) {
        $this->preEnrichmentPlugins = $preEnrichmentPlugins;
        $this->postEnrichmentPlugins = $postEnrichmentPlugins;
        $this->preHandlingPlugins = $preHandlingPlugins;
        $this->postHandlingPlugins = $postHandlingPlugins;
        $this->preAssignPlugins = $preAssignPlugins;
        $this->postAssignPlugins = $postAssignPlugins;
        $this->preUnassignPlugins = $preUnassignPlugins;
        $this->postUnassignPlugins = $postUnassignPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer $companyUsersBulkPreparationTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer
     */
    public function executePreEnrichmentPlugins(CompanyUsersBulkPreparationTransfer $companyUsersBulkPreparationTransfer): CompanyUsersBulkPreparationTransfer
    {
        foreach ($this->preEnrichmentPlugins as $plugin) {
            $companyUsersBulkPreparationTransfer = $plugin->preEnrichment($companyUsersBulkPreparationTransfer);
        }

        return $companyUsersBulkPreparationTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer $companyUsersBulkPreparationTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer
     */
    public function executePostEnrichmentPlugins(CompanyUsersBulkPreparationTransfer $companyUsersBulkPreparationTransfer): CompanyUsersBulkPreparationTransfer
    {
        foreach ($this->postEnrichmentPlugins as $plugin) {
            $companyUsersBulkPreparationTransfer = $plugin->postEnrichment($companyUsersBulkPreparationTransfer);
        }

        return $companyUsersBulkPreparationTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer $restCompanyUsersBulkRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer
     */
    public function executePreHandlePlugins(RestCompanyUsersBulkRequestTransfer $restCompanyUsersBulkRequestTransfer): RestCompanyUsersBulkRequestTransfer
    {
        foreach ($this->preHandlingPlugins as $plugin) {
            $restCompanyUsersBulkRequestTransfer = $plugin->preHandling($restCompanyUsersBulkRequestTransfer);
        }

        return $restCompanyUsersBulkRequestTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkResponseTransfer $restCompanyUsersBulkResponseTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyUsersBulkResponseTransfer
     */
    public function executePostHandlePlugins(RestCompanyUsersBulkResponseTransfer $restCompanyUsersBulkResponseTransfer): RestCompanyUsersBulkResponseTransfer
    {
        foreach ($this->postHandlingPlugins as $plugin) {
            $restCompanyUsersBulkResponseTransfer = $plugin->postHandling($restCompanyUsersBulkResponseTransfer);
        }

        return $restCompanyUsersBulkResponseTransfer;
    }
}
