<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business;

use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Expander\ReturnLabelRequestExpander;
use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Expander\ReturnLabelRequestExpanderInterface;
use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model\ReturnLabelGenerator;
use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model\ReturnLabelGeneratorInterface;
use FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeInterface;
use FondOfOryx\Zed\ReturnLabelsRestApi\ReturnLabelsRestApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class ReturnLabelsRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model\ReturnLabelGeneratorInterface
     */
    public function createReturnLabelGenerator(): ReturnLabelGeneratorInterface
    {
        return new ReturnLabelGenerator(
            $this->getReturnLabelFacade(),
            $this->createReturnLabelRequestExpander(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApi\Business\Expander\ReturnLabelRequestExpanderInterface
     */
    protected function createReturnLabelRequestExpander(): ReturnLabelRequestExpanderInterface
    {
        return new ReturnLabelRequestExpander(
            $this->getReturnLabelRequestExpanderPlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeInterface
     */
    protected function getReturnLabelFacade(): ReturnLabelsRestApiToReturnLabelFacadeInterface
    {
        return $this->getProvidedDependency(ReturnLabelsRestApiDependencyProvider::FACADE_RETURN_LABEL);
    }

    /**
     * @return array<\FondOfOryx\Zed\ReturnLabelsRestApiExtension\Dependency\Plugin\ReturnLabelRequestExpanderPluginInterface>
     */
    protected function getReturnLabelRequestExpanderPlugins(): array
    {
        return $this->getProvidedDependency(
            ReturnLabelsRestApiDependencyProvider::PLUGINS_RETURN_LABEL_REQUEST_EXPANDER,
        );
    }
}
