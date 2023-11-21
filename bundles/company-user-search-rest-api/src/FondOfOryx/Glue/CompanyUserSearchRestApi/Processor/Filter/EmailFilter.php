<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter;

use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\InputBag;

class EmailFilter implements EmailFilterInterface
{
 /**
  * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
  *
  * @return array<string>
  */
    public function filterFromRestRequest(RestRequestInterface $restRequest): array
    {
        $bag = $restRequest->getHttpRequest()->query;
        /** @phpstan-ignore-next-line */
        $emails = $bag instanceof InputBag ? $bag->all('email') : $bag->get('email');

        /** @phpstan-ignore-next-line */
        if (!is_array($emails)) {
            return [];
        }

        return $emails;
    }
}
