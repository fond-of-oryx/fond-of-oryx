<?php

namespace FondOfOryx\Zed\ReturnLabel\Business;

use FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapter;
use FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface;
use FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelAddressMapper;
use FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelAddressMapperInterface;
use FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyUnitAddressReader;
use FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyUnitAddressReaderInterface;
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
            $this->createCompanyUnitAddressReader(),
            $this->createReturnLabelAdapter(),
            $this->createReturnLabelAddressMapper()
        );
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyUnitAddressReaderInterface
     */
    public function createCompanyUnitAddressReader(): CompanyUnitAddressReaderInterface
    {
        return new CompanyUnitAddressReader($this->getRepository());
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
     * @return ReturnLabelAddressMapperInterface
     */
    public function createReturnLabelAddressMapper(): ReturnLabelAddressMapperInterface
    {
        return new ReturnLabelAddressMapper();
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
