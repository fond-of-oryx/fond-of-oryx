<?php

namespace FondOfOryx\Zed\EasyApi\Business\Model;

use FondOfOryx\Zed\EasyApi\Dependency\Client\EasyApiToGuzzleClientInterface;
use FondOfOryx\Zed\EasyApi\EasyApiConfig;
use Generated\Shared\Transfer\EasyApiFilterTransfer;
use Generated\Shared\Transfer\EasyApiRequestTransfer;
use Generated\Shared\Transfer\EasyApiResponseTransfer;
use GuzzleHttp\Exception\RequestException;
use Psr\Log\LoggerInterface;

class ApiWrapper implements ApiWrapperInterface
{
    /**
     * @var \FondOfOryx\Zed\EasyApi\Dependency\Client\EasyApiToGuzzleClientInterface
     */
    protected EasyApiToGuzzleClientInterface $guzzle;

    /**
     * @var \FondOfOryx\Zed\EasyApi\EasyApiConfig
     */
    protected EasyApiConfig $config;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @param \FondOfOryx\Zed\EasyApi\Dependency\Client\EasyApiToGuzzleClientInterface $guzzleClient
     * @param \FondOfOryx\Zed\EasyApi\EasyApiConfig $config
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(EasyApiToGuzzleClientInterface $guzzleClient, EasyApiConfig $config, LoggerInterface $logger)
    {
        $this->guzzle = $guzzleClient;
        $this->config = $config;
        $this->logger = $logger;
    }

    /**
     * @param \Generated\Shared\Transfer\EasyApiFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\EasyApiResponseTransfer
     */
    public function findDocument(EasyApiFilterTransfer $filterTransfer): EasyApiResponseTransfer
    {
        $uri = sprintf('%s/%s', $this->config->getEasyApiUri(), 'api/content/search');

        $response = $this->request($uri, 'post', $filterTransfer);

        if ($response->getStatus() === 'success') {
            $response->setType('json');
            $response->setHash(sha1($response->getData()));
        }

        return $response;
    }

    /**
     * @param \Generated\Shared\Transfer\EasyApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\EasyApiResponseTransfer
     */
    public function getFile(EasyApiRequestTransfer $requestTransfer): EasyApiResponseTransfer
    {
        $uri = $requestTransfer->getUri();
        if ($uri === null) {
            $requestTransfer
                ->requireId()
                ->requireDocumentReference();

            $uri = sprintf('%s/attachments/%s', $requestTransfer->getId(), $requestTransfer->getDocumentReference());
        }

        if (!str_starts_with($uri, $this->config->getEasyApiUri())) {
            $uri = sprintf('%s/%s/%s', $this->config->getEasyApiUri(), 'api/content/docs', $uri);
        }

        $response = $this->request($uri, 'get');

        if ($response->getStatus() === 'success') {
            $response->setData(base64_encode($response->getData()));
            $response->setType('base64string');
            $response->setHash(sha1($response->getData()));
        }

        return $response;
    }

    /**
     * @param string $uri
     * @param string $method
     * @param \Generated\Shared\Transfer\EasyApiFilterTransfer|null $filterTransfer
     *
     * @return \Generated\Shared\Transfer\EasyApiResponseTransfer
     */
    protected function request(string $uri, string $method, ?EasyApiFilterTransfer $filterTransfer = null): EasyApiResponseTransfer
    {
        $responseTransfer = new EasyApiResponseTransfer();
        $body = [];
        try {
            if ($filterTransfer !== null) {
                $body = $this->prepareBody($filterTransfer);
            }
            $response = $this->guzzle->request(
                $method,
                $uri,
                array_merge(
                    $this->config->getHeader(),
                    $body,
                ),
            );

            $responseTransfer->setStatus('success');
            $responseTransfer->setData($response->getBody()->getContents());
        } catch (RequestException $e) {
            $this->logger->error(sprintf(
                '%s %s Reason: %s',
                $uri,
                $method,
                $e->getResponse()->getBody(),
            ));

            $responseTransfer->setStatus('error');
            $responseTransfer->setMessage($e->getResponse()->getBody());
        }

        return $responseTransfer->setStatusCode($response->getStatusCode());
    }

    /**
     * @param \Generated\Shared\Transfer\EasyApiFilterTransfer $filterTransfer
     *
     * @return array
     */
    protected function prepareBody(EasyApiFilterTransfer $filterTransfer): array
    {
        $transferData = $filterTransfer->toArray(true, true);

        $transferData['conditions'] = $this->buildConditions($filterTransfer);

        return ['body' => json_encode($this->cleanBody($transferData))];
    }

    /**
     * @param \Generated\Shared\Transfer\EasyApiFilterTransfer $filterTransfer
     *
     * @return array<string, string>
     */
    public function buildConditions(EasyApiFilterTransfer $filterTransfer): array
    {
        $conditions = [];
        foreach ($filterTransfer->getConditions() as $condition) {
            $conditions[$condition->getField()] = $condition->getValue();
        }

        return $conditions;
    }

    /**
     * @param array<string, string> $body
     *
     * @return array<string, string>
     */
    protected function cleanBody(array $body): array
    {
        $cleanedBody = [];
        foreach ($this->config->getAllowedBodyFields() as $key) {
            if (array_key_exists($key, $body)) {
                $cleanedBody[$key] = $body[$key];
            }
        }

        return $cleanedBody;
    }
}
