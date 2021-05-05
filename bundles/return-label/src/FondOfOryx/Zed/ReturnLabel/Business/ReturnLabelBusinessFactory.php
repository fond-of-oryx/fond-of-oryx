<?php

namespace FondOfOryx\Zed\ReturnLabel\Business;

use FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapter;
use FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface;
use FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelAddressMapper;
use FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelAddressMapperInterface;
use FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelCustomerMapper;
use FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelCustomerMapperInterface;
use FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyBusinessUnitResourceReaderInterface;
use FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyBusinessUnitResourceResourceReader;
use FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyUnitAddressResourceReader;
use FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyUnitAddressResourceReaderInterface;
use FondOfOryx\Zed\ReturnLabel\Business\Model\ReturnLabelGenerator;
use FondOfOryx\Zed\ReturnLabel\Business\Model\ReturnLabelGeneratorInterface;
use FondOfOryx\Zed\ReturnLabel\Dependency\Service\ReturnLabelToUtilEncodingServiceInterface;
use FondOfOryx\Zed\ReturnLabel\ReturnLabelDependencyProvider;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig getConfig()
 * @method \FondOfOryx\Zed\ReturnLabel\Persistence\ReturnLabelRepositoryInterface getRepository()
 */
class ReturnLabelBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ReturnLabel\Business\Model\ReturnLabelGeneratorInterface
     */
    public function createReturnLabelGenerator(): ReturnLabelGeneratorInterface
    {
        return new ReturnLabelGenerator(
            $this->createCompanyUnitAddressResourceReader(),
            $this->createCompanyBusinessUnitResourceReader(),
            $this->createReturnLabelAdapter(),
            $this->createReturnLabelCustomerMapper(),
            $this->getConfig()
        );
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyUnitAddressResourceReaderInterface
     */
    public function createCompanyUnitAddressResourceReader(): CompanyUnitAddressResourceReaderInterface
    {
        return new CompanyUnitAddressResourceReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyBusinessUnitResourceReaderInterface
     */
    public function createCompanyBusinessUnitResourceReader(): CompanyBusinessUnitResourceReaderInterface
    {
        return new CompanyBusinessUnitResourceResourceReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface
     */
    public function createReturnLabelAdapter(): ReturnLabelAdapterInterface
    {
        return new ReturnLabelAdapter(
            $this->createHttpClient(),
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelAddressMapperInterface
     */
    public function createReturnLabelAddressMapper(): ReturnLabelAddressMapperInterface
    {
        return new ReturnLabelAddressMapper();
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelCustomerMapperInterface
     */
    public function createReturnLabelCustomerMapper(): ReturnLabelCustomerMapperInterface
    {
        return new ReturnLabelCustomerMapper(
            $this->createReturnLabelAddressMapper(),
            $this->getConfig()
        );
    }

    /**
     * @return \GuzzleHttp\ClientInterface
     */
    public function createHttpClient(): HttpClientInterface
    {
        return new HttpClient();
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabel\Dependency\Service\ReturnLabelToUtilEncodingServiceInterface
     */
    public function getUtilEncodingService(): ReturnLabelToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(ReturnLabelDependencyProvider::SERVICE_UTIL_ENCODING);
    }
}
