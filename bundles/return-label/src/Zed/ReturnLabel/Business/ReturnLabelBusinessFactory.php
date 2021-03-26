<?php


namespace FondOfOryx\Zed\ReturnLabel\Business;


use FondOfOryx\Zed\ReturnLabel\Business\Model\ReturnLabelApi;
use FondOfOryx\Zed\ReturnLabel\Business\Model\ReturnLabelApiInterface;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ReturnLabel\Persistence\ReturnLabelRepository getRepository()
 */
class ReturnLabelBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return ReturnLabelApiInterface
     */
    public function createReturnLabelApi(): ReturnLabelApiInterface
    {
        return new ReturnLabelApi(
            $this->getRepository(),
            $this->createHttpClient()
        );
    }

    /**
     * @return GuzzleHttpClientInterface
     */
    public function createHttpClient(): HttpClientInterface
    {
        return new HttpClient();
    }
}
