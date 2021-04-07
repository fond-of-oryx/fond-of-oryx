<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business;

use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Mapper\ReturnLabelRequestMapper;
use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Mapper\ReturnLabelRequestMapperInterface;
use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model\CompanyUnitAddressReader;
use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model\CompanyUnitAddressReaderInterface;
use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model\ReturnLabelGenerator;
use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model\ReturnLabelGeneratorInterface;
use FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeInterface;
use FondOfOryx\Zed\ReturnLabelsRestApi\ReturnLabelsRestApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepositoryInterface getRepository()
 */
class ReturnLabelsRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model\ReturnLabelGeneratorInterface
     */
    public function createReturnLabelGenerator(): ReturnLabelGeneratorInterface
    {
        return new ReturnLabelGenerator(
            $this->createCompanyUnitAddressReader(),
            $this->getReturnLabelFacade(),
            $this->createReturnLabelRequestMapper()
        );
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model\CompanyUnitAddressReaderInterface
     */
    protected function createCompanyUnitAddressReader(): CompanyUnitAddressReaderInterface
    {
        return new CompanyUnitAddressReader(
            $this->getRepository()
        );
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApi\Business\Mapper\ReturnLabelRequestMapperInterface
     */
    protected function createReturnLabelRequestMapper(): ReturnLabelRequestMapperInterface
    {
        return new ReturnLabelRequestMapper();
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeInterface
     */
    protected function getReturnLabelFacade(): ReturnLabelsRestApiToReturnLabelFacadeInterface
    {
        return $this->getProvidedDependency(ReturnLabelsRestApiDependencyProvider::FACADE_RETURN_LABEL);
    }
}
