<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\PluginExecutioner;

use Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkResponseTransfer;

class BulkDataPluginExecutioner implements BulkDataPluginExecutionerInterface
{
    /**
     * @var array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkDataExpanderPluginInterface>
     */
    protected array $expanderPlugins;

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
     * @param array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkDataExpanderPluginInterface> $expanderPlugins
     * @param array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkPreHandlingPluginInterface> $preHandlingPlugins
     * @param array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkPostHandlingPluginInterface> $postHandlingPlugins
     * @param array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkPreAssignPluginInterface> $preAssignPlugins
     * @param array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkPostAssignPluginInterface> $postAssignPlugins
     * @param array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkPreUnassignPluginInterface> $preUnassignPlugins
     * @param array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkPostUnassignPluginInterface> $postUnassignPlugins
     */
    public function __construct(
        array $expanderPlugins,
        array $preHandlingPlugins,
        array $postHandlingPlugins,
        array $preAssignPlugins,
        array $postAssignPlugins,
        array $preUnassignPlugins,
        array $postUnassignPlugins
    ) {
        $this->expanderPlugins = $expanderPlugins;
        $this->preHandlingPlugins = $preHandlingPlugins;
        $this->postHandlingPlugins = $postHandlingPlugins;
        $this->preAssignPlugins = $preAssignPlugins;
        $this->postAssignPlugins = $postAssignPlugins;
        $this->preUnassignPlugins = $preUnassignPlugins;
        $this->postUnassignPlugins = $postUnassignPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationCollectionTransfer
     * @return \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer
     */
    public function executeExpand(CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationCollectionTransfer): CompanyUsersBulkPreparationCollectionTransfer{
        foreach ($this->expanderPlugins as $plugin) {
            $companyUsersBulkPreparationCollectionTransfer = $plugin->expand($companyUsersBulkPreparationCollectionTransfer);
        }

        return $companyUsersBulkPreparationCollectionTransfer;
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
