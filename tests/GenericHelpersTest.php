<?php

namespace Teofanis\LaravelUtils\Tests;

use Teofanis\LaravelUtils\Facades\Utils;

class GenericHelpersTest extends TestCase
{
    /** @test */
    public function test_compile_html_with_blade()
    {
        $html = '<a href="{!!$link!!}">{{$linkText}}</a>';
        $compiled = Utils::bladeCompile($html, ['link' => 'https://google.com/', 'linkText' => 'here']);
        $actual = '<a href="https://google.com/">here</a>';
        $this->assertTrue($compiled === $actual);
    }

    /** @test */
    public function test_hydrates_and_compiles_html_string()
    {
        $this->assertTrue(
            Utils::hydrateAndCompile(
                __('Click {$here} to enter our new {$webpage} only available until {$time}'),
                ['here' => 'ENTER', 'webpage' => 'page', 'time' => '00:00']
            ) ===
            "Click ENTER to enter our new page only available until 00:00"
        );
    }
}
