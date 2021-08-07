<?php

namespace Teofanis\LaravelUtils\Tests;

use Teofanis\LaravelUtils\Facades\Utils;

class StringSupportTest extends TestCase
{
    /** @test */
    public function test_checks_if_a_string_starts_with_given_string()
    {
        $string = "the beginning of the string";
        $outcome = Utils::startsWith("the", $string);
        $this->assertTrue($outcome);
        $outcome = Utils::startsWith("something", $string);
        $this->assertFalse($outcome);
    }

    /** @test */
    public function test_checks_if_a_string_ends_with_given_string()
    {
        $string = "the beginning of the string";
        $outcome = Utils::endsWith("string", $string);
        $this->assertTrue($outcome);
        $outcome = Utils::endsWith("something", $string);
        $this->assertFalse($outcome);
    }

    /** @test */
    public function test_get_specific_part_from_a_given_string()
    {
        $string = "I have a five parts";
        $outcome = Utils::getToken($string, 5, " "); //haystack part of the string and the delimeter
        $this->assertTrue($outcome === "parts");

        $string = "config.settings.button.color";
        $outcome = Utils::getToken($string, 3); //default delim is "."
        $this->assertTrue($outcome === "button");

        $outcome = Utils::getToken($string, 10);
        $this->assertTrue($outcome === "");
    }

    /** @test */
    public function test_un_prefix_part_from_given_string()
    {
        $string = "RemoveMe from this sentence";
        $outcome = Utils::unPrefix("RemoveMe", $string);
        $this->assertEquals(" from this sentence", $outcome);
        $outcome = Utils::unPrefix("RemoveMeSomethingNonExistent", $string);
        $this->assertEquals($string, $outcome);
    }

    /** @test */
    public function test_un_postfix_part_from_given_string()
    {
        $string = "This sentence is too long";
        $outcome = Utils::unPostfix("too long", $string);
        $this->assertEquals("This sentence is ", $outcome);
        $outcome = Utils::unPostfix("this does not exist", $string);
        $this->assertEquals($string, $outcome);
    }

    /** @test */
    public function test_count_parts_of_a_given_string()
    {
        $string = "This is five parts long.";
        $outcome = Utils::countTokens($string, " ");
        $this->assertEquals($outcome, 5);
    }

    /** @test */
    public function test_get_left_x_characters_from_string()
    {
        $string = "This is five parts long.";
        $outcome = Utils::left($string, 4);
        $this->assertEquals($outcome, "This");
    }

    /** @test */
    public function test_get_right_x_characters_from_string()
    {
        $string = "This is five parts long.";
        $outcome = Utils::right($string, 5);
        $this->assertEquals($outcome, "long.");
    }

    /** @test */
    public function test_string_is_contained_within_another_string()
    {
        $string = "This is a string with something to look for".
        $find = "look";
        $outcome = Utils::stringContains($find, $string);
        $this->assertTrue($outcome);
        $find = "false";
        $outcome = Utils::stringContains($find, $string);
        $this->assertFalse($outcome);
    }

    /** @test */
    public function test_remove_leading_symbol_from_string()
    {
        $string = "/path/to/somewhere";
        $outcome = Utils::removeLeading("/", $string);
        $this->assertEquals($outcome, "path/to/somewhere");
        $outcome = Utils::removeLeading("/does/not/exist", $string);
        $this->assertEquals($outcome, $string);
    }

    /** @test */
    public function test_remove_trailing_symbol_from_string()
    {
        $string = "url/some/endpoint/";
        $outcome = Utils::removeTrailing("/endpoint/", $string);
        $this->assertEquals($outcome, "url/some");
        $outcome = Utils::removeTrailing("doesnt/exist", $string);
        $this->assertEquals($outcome, $string);
    }

    // /** @test */
    // public function test_extract_first_part_of_a_given_string()
    // {
    //     $string = "This is a test sentence";
    //     foreach(explode(" ", $string) as $value) {
    //         $outcome = Utils::extractFirstToken($string, " ");
    //         $this->assertTrue($outcome === $value);
    //     }
    // }
}
