<?php

namespace FondOfOryx\Glue\DocumentsRestApi\Processor\Reader;

use Exception;
use FondOfOryx\Glue\DocumentsRestApi\Dependency\Client\DocumentsRestApiToEasyApiInterface;
use FondOfOryx\Glue\DocumentsRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\DocumentsRestApi\Processor\Mapper\DocumentRestRequestMapperInterface;
use Generated\Shared\Transfer\DocumentTransfer;
use Generated\Shared\Transfer\EasyApiRequestTransfer;
use Psr\Log\LoggerInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Throwable;

class DocumentReader implements DocumentReaderInterface
{
    protected DocumentsRestApiToEasyApiInterface $client;

    protected DocumentRestRequestMapperInterface $requestMapper;

    protected RestResponseBuilderInterface $responseBuilder;

    protected LoggerInterface $logger;

    /**
     * @var array<\FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentTypePluginInterface>
     */
    protected array $documentTypePlugins;

    /**
     * @param \FondOfOryx\Glue\DocumentsRestApi\Dependency\Client\DocumentsRestApiToEasyApiInterface $client
     * @param \FondOfOryx\Glue\DocumentsRestApi\Processor\Mapper\DocumentRestRequestMapperInterface $requestMapper
     * @param \FondOfOryx\Glue\DocumentsRestApi\Processor\Builder\RestResponseBuilderInterface $responseBuilder
     * @param \Psr\Log\LoggerInterface $logger
     * @param array<\FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentTypePluginInterface> $documentTypePlugins
     */
    public function __construct(
        DocumentsRestApiToEasyApiInterface $client,
        DocumentRestRequestMapperInterface $requestMapper,
        RestResponseBuilderInterface $responseBuilder,
        LoggerInterface $logger,
        array $documentTypePlugins
    ) {
        $this->client = $client;
        $this->requestMapper = $requestMapper;
        $this->responseBuilder = $responseBuilder;
        $this->logger = $logger;
        $this->documentTypePlugins = $documentTypePlugins;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function find(RestRequestInterface $restRequest): RestResponseInterface
    {
        $filter = $this->requestMapper->fromRestRequest($restRequest);
        $easyApiFilter = null;
        foreach ($this->documentTypePlugins as $documentTypePlugin) {
            if ($documentTypePlugin->getType() === $filter->getType()) {
                $easyApiFilter = $documentTypePlugin->createEasyApiFilter($filter);
            }
        }

        if ($easyApiFilter === null) {
            $this->logger->error(sprintf('Missing plugin for document type "%s"', $filter->getType()));

            return $this->responseBuilder->buildErrorRestResponse();
        }

        $error = $easyApiFilter->getError();
        if ($error !== null) {
            $this->logger->error(sprintf('%s: %s | %s', $filter->getId(), $error->getMessage(), $error->getValue()));

            return $this->responseBuilder->buildErrorRestResponse($error->getMessage(), $error->getValue(), (int)$error->getValue());
        }

        $response = $this->client->findDocument($easyApiFilter);

        if ($response->getStatus() !== 'success') {
            return $this->responseBuilder->buildErrorRestResponse();
        }

        if ($response->getStatusCode() === 204) {
            return $this->responseBuilder->buildErrorRestResponse(
                $response->getMessage(),
                (string)$response->getStatusCode(),
                $response->getStatusCode(),
            );
        }

        try {
            if ($response->getHash() !== sha1($response->getData())) {
                return $this->responseBuilder->buildErrorRestResponse();
            }
            $data = json_decode($response->getData(), true);

            $document = (new DocumentTransfer())->fromArray($data, true);

            $fileRequest = (new EasyApiRequestTransfer())->setUri($this->resolveAttachmentUri($document));
            $document = $this->client->getDocument($fileRequest);
        } catch (Throwable $throwable) {
            $this->logger->error($throwable->getMessage(), $throwable->getTrace());

            return $this->responseBuilder->buildErrorRestResponse();
        }

        return $this->responseBuilder->buildDocumentResponse($document);
    }

    /**
     * @param \Generated\Shared\Transfer\DocumentTransfer $document
     *
     * @throws \Exception
     *
     * @return string
     */
    public function resolveAttachmentUri(DocumentTransfer $document): string
    {
        foreach ($document->getItems() as $item) {
            foreach ($item->getAttachments() as $attachment) {
                return sprintf('%s/attachments/%s', $item->getId(), $attachment->getId());
            }
        }

        throw new Exception('Could not resolve attachment url!');
    }
}
