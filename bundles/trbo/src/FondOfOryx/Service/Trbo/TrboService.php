<?php

namespace FondOfOryx\Service\Trbo;

use Generated\Shared\Transfer\TrboDataTransfer;
use Spryker\Service\Kernel\AbstractService;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \FondOfOryx\Service\Trbo\TrboServiceFactory getFactory()
 */
class TrboService extends AbstractService implements TrboServiceInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Generated\Shared\Transfer\TrboDataTransfer|null
     */
    public function requestData(Request $request): ?TrboDataTransfer
    {
        return $this->getFactory()
            ->createTrboApi()
            ->requestData($request);
    }
}
