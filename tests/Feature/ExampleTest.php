<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * 功能测试
 * 比如定义一个接口，对整个接口的进行测试，就属于功能测试
 * 如果对这个接口里面使用的各个函数进行测试，就属于单元测试
 */
class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
