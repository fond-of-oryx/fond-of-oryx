<?php

namespace FondOfOryx\Yves\Feed\Controller;

use FondOfOryx\Shared\Feed\FeedConstants;
use FondOfOryx\Yves\Feed\Response\CsvResponse;
use Spryker\Shared\Config\Config;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method \FondOfOryx\Yves\Feed\FeedFactory getFactory()
 * @method \FondOfOryx\Client\Feed\FeedClientInterface getClient()
 */
class FeedController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function availabilityFeedAction(Request $request): Response
    {
        if (!$this->isAuthorized($request)) {
            throw new NotFoundHttpException();
        }

        return new CsvResponse($this->getFactory()->createAvailabilityFeed()->create());
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function availabilityAlertFeedAction(Request $request): Response
    {
        if (!$this->isAuthorized($request)) {
            throw new NotFoundHttpException();
        }

        return new CsvResponse($this->getFactory()->createAvailabilityAlertFeed()->create());
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return bool
     */
    protected function isAuthorized(Request $request): bool
    {
        return $request->getUser() === Config::get(FeedConstants::FEED_USER) && $request->getPassword() === Config::get(FeedConstants::FEED_PASSWORD);
    }
}
