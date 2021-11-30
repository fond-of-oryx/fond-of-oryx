<?php

namespace FondOfOryx\Service\Trbo\Api;

use Generated\Shared\Transfer\TrboDataTransfer;
use Symfony\Component\HttpFoundation\Request;

interface TrboApiInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return \Generated\Shared\Transfer\TrboDataTransfer|null
     */
    public function requestData(Request $request): ?TrboDataTransfer;
}
