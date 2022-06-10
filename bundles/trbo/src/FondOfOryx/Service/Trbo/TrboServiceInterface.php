<?php

namespace FondOfOryx\Service\Trbo;

use Generated\Shared\Transfer\TrboTransfer;
use Symfony\Component\HttpFoundation\Request;

interface TrboServiceInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Generated\Shared\Transfer\TrboTransfer|null
     */
    public function requestData(Request $request): ?TrboTransfer;
}
