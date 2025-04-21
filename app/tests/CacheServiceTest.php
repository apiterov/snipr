<?php

use App\Contract\CacheServiceInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CacheServiceTest extends TestCase
{
    private MockObject $cacheServiceMock;

    public function testSet(): void
    {
        $this->cacheServiceMock->method('set')->willReturn(true);
        $result = $this->cacheServiceMock->set('key', 'value');
        $this->assertTrue($result);
    }

    public function testGet(): void
    {
        $this->cacheServiceMock->method('get')->willReturn('value');
        $result = $this->cacheServiceMock->get('key');
        $this->assertEquals('value', $result);
    }

    public function testDelete(): void
    {
        $this->cacheServiceMock->method('delete')->willReturn(true);
        $result = $this->cacheServiceMock->delete('key');
        $this->assertTrue($result);
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    protected function setUp(): void
    {
        $this->cacheServiceMock = $this->createMock(CacheServiceInterface::class);
    }
}