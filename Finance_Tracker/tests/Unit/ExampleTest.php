<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }
/**
 * Test that false is false.
 */
public function test_that_false_is_false(): void
{
    $this->assertFalse(false);
}

/**
 * Test that a string equals itself.
 */
public function test_string_equality(): void
{
    $this->assertEquals('Finance Tracker', 'Finance Tracker');
}

/**
 * Test that an array contains a specific value.
 */
public function test_array_contains_value(): void
{
    $array = ['income', 'expense', 'savings'];
    $this->assertContains('expense', $array);
}

/**
 * Test that an array has a specific key.
 */
public function test_array_has_key(): void
{
    $array = ['type' => 'income', 'amount' => 100];
    $this->assertArrayHasKey('amount', $array);
}

/**
 * Test that two numbers add up correctly.
 */
public function test_addition(): void
{
    $this->assertEquals(5, 2 + 3);
}

/**
 * Test that a value is null.
 */
public function test_value_is_null(): void
{
    $value = null;
    $this->assertNull($value);
}
}


