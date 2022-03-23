<?php

namespace FondOfOryx\Client\ErpDeliveryNotePageSearch;

use Codeception\Test\Unit;
use FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client\ErpDeliveryNotePageSearchToSearchClientInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

class ErpDeliveryNotePageSearchClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchClientInterface
     */
    protected $erpDeliveryNotePageSearchClient;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchFactory
     */
    protected $erpDeliveryNotePageSearchFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client\ErpDeliveryNotePageSearchToSearchClientInterface
     */
    protected $erpDeliveryNotePageSearchToSearchClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    protected $pluginQueryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpDeliveryNotePageSearchFactoryMock = $this->getMockBuilder(ErpDeliveryNotePageSearchFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->pluginQueryMock = $this->getMockBuilder(QueryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchToSearchClientMock = $this->getMockBuilder(ErpDeliveryNotePageSearchToSearchClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchClient = new class () extends ErpDeliveryNotePageSearchClient {
            /**
             * @uses \Spryker\Client\Permission\PermissionClientInterface
             *
             * @param string $permissionKey
             * @param array|string|int|null $context
             *
             * @return bool
             */
            protected function can($permissionKey, $context = null): bool
            {
                return true;
            }
        };

        $this->erpDeliveryNotePageSearchClient->setFactory($this->erpDeliveryNotePageSearchFactoryMock);
    }

    /**
     * @return void
     */
    public function testSearch(): void
    {
        $searchString = 'search-string';
        $this->erpDeliveryNotePageSearchFactoryMock->expects(static::atLeastOnce())
            ->method('createSearchQuery')
            ->with($searchString)
            ->willReturn($this->pluginQueryMock);

        $this->erpDeliveryNotePageSearchFactoryMock->expects(static::atLeastOnce())
            ->method('getSearchClient')
            ->willReturn($this->erpDeliveryNotePageSearchToSearchClientMock);

        $this->erpDeliveryNotePageSearchFactoryMock->expects(static::atLeastOnce())
            ->method('getSearchQueryExpanderPlugins')
            ->willReturn([]);

        $this->erpDeliveryNotePageSearchFactoryMock->expects(static::atLeastOnce())
            ->method('getSearchResultFormatterPlugins')
            ->willReturn([]);

        $this->erpDeliveryNotePageSearchToSearchClientMock->expects(static::atLeastOnce())
            ->method('expandQuery')
            ->with($this->pluginQueryMock, [], [])
            ->willReturn($this->pluginQueryMock);

        $this->erpDeliveryNotePageSearchToSearchClientMock->expects(static::atLeastOnce())
            ->method('search')
            ->willReturn([]);

        $this->assertIsArray($this->erpDeliveryNotePageSearchClient->search($searchString));
    }
}
