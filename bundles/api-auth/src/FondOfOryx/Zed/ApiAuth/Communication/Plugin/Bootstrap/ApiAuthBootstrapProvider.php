<?php

namespace FondOfOryx\Zed\ApiAuth\Communication\Plugin\Bootstrap;

use FondOfOryx\Shared\ApiAuth\ApiAuthConstants;
use Silex\Application;
use Silex\ServiceProviderInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method \FondOfOryx\Zed\ApiAuth\Business\ApiAuthFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ApiAuth\ApiAuthConfig getConfig()
 */
class ApiAuthBootstrapProvider extends AbstractPlugin implements ServiceProviderInterface
{
    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    public function register(Application $app)
    {
    }

    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    public function boot(Application $app)
    {
        $apiAuthFacade = $this->getFacade();

        $app->before(function (Request $request) use ($apiAuthFacade) {
            $authorizationHeader = $request->headers->get(ApiAuthConstants::HEADER_AUTHORIZATION);

            if (!$authorizationHeader || !$apiAuthFacade->isAuthenticated($authorizationHeader)) {
                return new Response('', 403);
            }

            return null;
        }, Application::EARLY_EVENT);
    }
}
