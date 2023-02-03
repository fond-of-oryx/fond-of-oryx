<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Business;

use FondOfOryx\Zed\ThirtyFiveUpApi\Business\Model\ThirtyFiveUpOrderApi;
use FondOfOryx\Zed\ThirtyFiveUpApi\Business\Model\ThirtyFiveUpOrderApiInterface;
use FondOfOryx\Zed\ThirtyFiveUpApi\Business\Model\Validator\ThirtyFiveUpApiValidator;
use FondOfOryx\Zed\ThirtyFiveUpApi\Business\Model\Validator\ThirtyFiveUpApiValidatorInterface;
use FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToApiFacadeInterface;
use FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeInterface;
use FondOfOryx\Zed\ThirtyFiveUpApi\ThirtyFiveUpApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ThirtyFiveUpApi\Persistence\ThirtyFiveUpApiRepositoryInterface getRepository()()
 */
class ThirtyFiveUpApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ThirtyFiveUpApi\Business\Model\ThirtyFiveUpOrderApiInterface
     */
    public function createThirtyFiveUpApi(): ThirtyFiveUpOrderApiInterface
    {
        return new ThirtyFiveUpOrderApi(
            $this->getApiFacade(),
            $this->getThirtyFiveUpFacade(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ThirtyFiveUpApi\Business\Model\Validator\ThirtyFiveUpApiValidatorInterface
     */
    public function createThirtyFiveUpApiValidator(): ThirtyFiveUpApiValidatorInterface
    {
        return new ThirtyFiveUpApiValidator();
    }

    /**
     * @return \FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToApiFacadeInterface
     */
    protected function getApiFacade(): ThirtyFiveUpApiToApiFacadeInterface
    {
        return $this->getProvidedDependency(ThirtyFiveUpApiDependencyProvider::FACADE_API);
    }

    /**
     * @return \FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeInterface
     */
    protected function getThirtyFiveUpFacade(): ThirtyFiveUpApiToThirtyFiveUpFacadeInterface
    {
        return $this->getProvidedDependency(ThirtyFiveUpApiDependencyProvider::FACADE_THIRTY_FIVE_UP);
    }
}
