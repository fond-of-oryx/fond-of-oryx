<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter;

use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\InputBag;

class CompanyRoleNameFilter implements CompanyRoleNameFilterInterface
{
 /**
  * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
  *
  * @return array<string>
  */
    public function filterFromRestRequest(RestRequestInterface $restRequest): array
    {
        $bag = $restRequest->getHttpRequest()->query;

        $companyRoles =  $bag->all('company-role-name');

        return $companyRoles;
    }
}
