<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Translator;

use Codeception\Test\Unit;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Dependency\Client\OrderBudgetSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestOrderBudgetSearchAttributesTransfer;
use Generated\Shared\Transfer\RestOrderBudgetSearchSortTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class RestOrderBudgetSearchAttributesTranslatorTest extends Unit
{
    /**
     * @var (\FondOfOryx\Glue\OrderBudgetSearchRestApi\Dependency\Client\OrderBudgetSearchRestApiToGlossaryStorageClientInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetSearchRestApiToGlossaryStorageClientInterface|MockObject $glossaryStorageClientMock;

    /**
     * @var (\Generated\Shared\Transfer\RestOrderBudgetSearchAttributesTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestOrderBudgetSearchAttributesTransfer|MockObject $restOrderBudgetSearchAttributesTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\RestOrderBudgetSearchSortTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RestOrderBudgetSearchSortTransfer $restOrderBudgetSearchSortTransferMock;

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Translator\RestOrderBudgetSearchAttributesTranslator
     */
    protected RestOrderBudgetSearchAttributesTranslator $restOrderBudgetSearchAttributesTranslator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->glossaryStorageClientMock = $this->getMockBuilder(OrderBudgetSearchRestApiToGlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOrderBudgetSearchAttributesTransferMock = $this->getMockBuilder(RestOrderBudgetSearchAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOrderBudgetSearchSortTransferMock = $this->getMockBuilder(RestOrderBudgetSearchSortTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOrderBudgetSearchAttributesTranslator = new RestOrderBudgetSearchAttributesTranslator(
            $this->glossaryStorageClientMock,
        );
    }

    /**
     * @return void
     */
    public function testTranslate(): void
    {
        $locale = 'de_DE';
        $untranslated = [
            'name_asc' => 'order_budget_search_rest_api.sort.name_asc',
            'name_desc' => 'order_budget_search_rest_api.sort.name_desc',
        ];
        $translated = [
            'name_asc' => 'Name aufsteigend',
            'name_desc' => 'Name absteigend',
        ];

        $this->restOrderBudgetSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn($this->restOrderBudgetSearchSortTransferMock);

        $this->restOrderBudgetSearchSortTransferMock->expects(static::atLeastOnce())
            ->method('getSortParamLocalizedNames')
            ->willReturn($untranslated);

        $this->glossaryStorageClientMock->expects(static::atLeastOnce())
            ->method('translate')
            ->withConsecutive([$untranslated['name_asc'], $locale], [$untranslated['name_desc'], $locale])
            ->willReturnOnConsecutiveCalls($translated['name_asc'], $translated['name_desc']);

        $this->restOrderBudgetSearchSortTransferMock->expects(static::atLeastOnce())
            ->method('setSortParamLocalizedNames')
            ->with(
                static::callback(
                    static function (array $sortParamLocalizedNames) use ($translated) {
                        return $sortParamLocalizedNames == $translated;
                    },
                ),
            )->willReturn($this->restOrderBudgetSearchSortTransferMock);

        static::assertEquals(
            $this->restOrderBudgetSearchAttributesTransferMock,
            $this->restOrderBudgetSearchAttributesTranslator->translate(
                $this->restOrderBudgetSearchAttributesTransferMock,
                $locale,
            ),
        );
    }

    /**
     * @return void
     */
    public function testTranslateWithNullableSort(): void
    {
        $locale = 'de_DE';

        $this->restOrderBudgetSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn(null);

        $this->glossaryStorageClientMock->expects(static::never())
            ->method('translate');

        static::assertEquals(
            $this->restOrderBudgetSearchAttributesTransferMock,
            $this->restOrderBudgetSearchAttributesTranslator->translate(
                $this->restOrderBudgetSearchAttributesTransferMock,
                $locale,
            ),
        );
    }
}
