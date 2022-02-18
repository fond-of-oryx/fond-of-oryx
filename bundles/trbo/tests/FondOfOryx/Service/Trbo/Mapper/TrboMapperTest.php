<?php

namespace FondOfOryx\Service\Trbo\Mapper;

use Codeception\Test\Unit;

class TrboMapperTest extends Unit
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @var \FondOfOryx\Service\Trbo\Mapper\TrboMapper
     */
    protected $mapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->data = [
            'data' => [
                ['contentfulEntry' => '6XYCb2RiH3gcPFTDMObBA0'],
            ],
            'tracking' => [
                [
                    'module_id' => 199885,
                    'campaign_id' => '85011',
                    'module_name' => 's2s-Test',
                    'campaign_name' => 's2s-Test',
                    'user_type' => 'trbo',
                ],
            ],
        ];

        $this->mapper = new TrboMapper();
    }

    /**
     * @return void
     */
    public function testMapDataToTransfer(): void
    {
        $trboDataTransfer = $this->mapper->mapApiResponseToTransfer($this->data);

        static::assertCount(1, $trboDataTransfer->getData());

        foreach ($trboDataTransfer->getData() as $data) {
            static::assertArrayHasKey('contentfulEntry', $data);
            static::assertArrayHasKey('module_id', $data);
            static::assertArrayHasKey('campaign_id', $data);
        }
    }
}
