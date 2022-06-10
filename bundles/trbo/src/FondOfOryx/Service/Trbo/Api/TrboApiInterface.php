<?php

namespace FondOfOryx\Service\Trbo\Api;

use Generated\Shared\Transfer\TrboTransfer;
use Symfony\Component\HttpFoundation\Request;

interface TrboApiInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return \Generated\Shared\Transfer\TrboTransfer|null
     */
    public function requestData(Request $request): ?TrboTransfer;
}
