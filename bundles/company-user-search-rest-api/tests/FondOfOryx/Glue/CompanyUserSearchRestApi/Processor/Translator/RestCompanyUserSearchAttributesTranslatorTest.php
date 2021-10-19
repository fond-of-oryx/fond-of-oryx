<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Translator;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Dependency\Client\CompanyUserSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestCompanyUserSearchAttributesTransfer;
use Generated\Shared\Transfer\RestCompanyUserSearchSortTransfer;

class RestCompanyUserSearchAttributesTranslatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Dependency\Client\CompanyUserSearchRestApiToGlossaryStorageClientInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $glossaryStorageClientMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyUserSearchAttributesTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanyUserSearchAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyUserSearchSortTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanyUserSearchSortTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Translator\RestCompanyUserSearchAttributesTranslator
     */
    protected $restCompanyUserSearchAttributesTranslator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->glossaryStorageClientMock = $this->getMockBuilder(CompanyUserSearchRestApiToGlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUserSearchAttributesTransferMock = $this->getMockBuilder(RestCompanyUserSearchAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUserSearchSortTransferMock = $this->getMockBuilder(RestCompanyUserSearchSortTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUserSearchAttributesTranslator = new RestCompanyUserSearchAttributesTranslator(
            $this->glossaryStorageClientMock
        );
    }

    /**
     * @return void
     */
    public function testTranslate(): void
    {
        $locale = 'de_DE';
        $untranslated = [
            'name_asc' => 'companies_rest_api.sort.name_asc',
            'name_desc' => 'companies_rest_api.sort.name_desc',
        ];
        $translated = [
            'name_asc' => 'Name aufsteigend',
            'name_desc' => 'Name absteigend',
        ];

        $this->restCompanyUserSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn($this->restCompanyUserSearchSortTransferMock);

        $this->restCompanyUserSearchSortTransferMock->expects(static::atLeastOnce())
            ->method('getSortParamLocalizedNames')
            ->willReturn($untranslated);

        $this->glossaryStorageClientMock->expects(static::atLeastOnce())
            ->method('translate')
            ->withConsecutive([$untranslated['name_asc'], $locale], [$untranslated['name_desc'], $locale])
            ->willReturnOnConsecutiveCalls($translated['name_asc'], $translated['name_desc']);

        $this->restCompanyUserSearchSortTransferMock->expects(static::atLeastOnce())
            ->method('setSortParamLocalizedNames')
            ->with(
                static::callback(
                    static function (array $sortParamLocalizedNames) use ($translated) {
                        return $sortParamLocalizedNames == $translated;
                    }
                )
            )->willReturn($this->restCompanyUserSearchSortTransferMock);

        static::assertEquals(
            $this->restCompanyUserSearchAttributesTransferMock,
            $this->restCompanyUserSearchAttributesTranslator->translate(
                $this->restCompanyUserSearchAttributesTransferMock,
                $locale
            )
        );
    }

    /**
     * @return void
     */
    public function testTranslateWithNullableSort(): void
    {
        $locale = 'de_DE';

        $this->restCompanyUserSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn(null);

        $this->glossaryStorageClientMock->expects(static::never())
            ->method('translate');

        static::assertEquals(
            $this->restCompanyUserSearchAttributesTransferMock,
            $this->restCompanyUserSearchAttributesTranslator->translate(
                $this->restCompanyUserSearchAttributesTransferMock,
                $locale
            )
        );
    }
}
