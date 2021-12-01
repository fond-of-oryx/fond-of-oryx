<?php

namespace FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \FondOfOryx\Zed\CompanyCompanyUserGui\Persistence\CompanyCompanyUserGuiRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\CompanyCompanyUserGui\Communication\CompanyCompanyUserGuiCommunicationFactory getFactory()
 */
class SuggestController extends AbstractController
{
    /**
     * @var string
     */
    protected const PARAM_TERM = 'term';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexAction(Request $request): JsonResponse
    {
        $term = $request->query->get(static::PARAM_TERM);

        $response = $this->getFactory()->createSuggestionReader()->getByTerm($term);

        return $this->jsonResponse($response);
    }
}
