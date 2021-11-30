<?php

namespace FondOfOryx\Service\Trbo;

use Generated\Shared\Transfer\TrboDataTransfer;
use Symfony\Component\HttpFoundation\Request;

interface TrboServiceInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Generated\Shared\Transfer\TrboDataTransfer|null
     */
    public function requestData(Request $request): ?TrboDataTransfer;
}
