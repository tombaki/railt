<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Tests\SDL\Language\Directive;

use Railt\Io\File;
use Railt\Reflection\Contracts\Definitions\Directive\Location;
use Railt\SDL\Exceptions\TypeConflictException;
use Railt\SDL\Reflection\CompilerInterface;
use Railt\Tests\SDL\Language\AbstractLanguageTestCase;

/**
 * Class DirectiveLocationsTestCase
 */
class DirectiveLocationsTestCase extends AbstractLanguageTestCase
{
    /**
     * @return array
     * @throws \Exception
     */
    public function locationsProvider(): array
    {
        $result = [];

        foreach ($this->getCompilers() as $compiler) {
            foreach (Location::TARGET_GRAPHQL_SDL as $definition) {
                foreach (Location::TARGET_GRAPHQL_SDL as $implementation) {
                    $result[] = [$compiler, $definition, $implementation];
                }
            }
        }

        return $result;
    }

    /**
     * @dataProvider locationsProvider
     *
     * @param CompilerInterface $compiler
     * @param string $definition
     * @param string $implementation
     * @return void
     */
    public function testLocations(CompilerInterface $compiler, string $definition, string $implementation): void
    {
        $isPositiveTest = $definition === $implementation;

        $source = File::fromSources(
            'directive @test on ' . $definition . "\n" .
            $this->getBody($implementation)
        );

        try {
            $compiler->compile($source);

            $error = ($isPositiveTest ? 'Must be positive:' : 'Must be negative:') .
                "\n" . $source->getContents() .
                "\n" . \str_repeat('-', 80);
            $this->assertTrue($isPositiveTest, $error);
        } catch (TypeConflictException $e) {
            $error = ($isPositiveTest ? 'Must be positive:' : 'Must be negative:') .
                "\n" . $source->getContents() .
                "\n" . \str_repeat('-', 80);
            $this->assertFalse($isPositiveTest, $error);
        }
    }

    /**
     * @param string $location
     * @return string
     */
    private function getBody(string $location): string
    {
        switch ($location) {
            case Location::TARGET_SCHEMA:
                return 'type T {} schema @test { query: T }';

            case Location::TARGET_OBJECT:
                return 'type T @test {}';

            case Location::TARGET_INPUT_OBJECT:
                return 'input T @test {}';

            case Location::TARGET_INPUT_FIELD_DEFINITION:
                return 'input T { field: String @test }';

            case Location::TARGET_ENUM:
                return 'enum T @test { Value }';

            case Location::TARGET_ENUM_VALUE:
                return 'enum T { Value @test }';

            case Location::TARGET_UNION:
                return 'union T @test = String | Int';

            case Location::TARGET_INTERFACE:
                return 'interface T @test {}';

            case Location::TARGET_SCALAR:
                return 'scalar T @test';

            case Location::TARGET_FIELD_DEFINITION:
                return 'type T { field: String @test }';

            case Location::TARGET_ARGUMENT_DEFINITION:
                return 'type T { field(arg: String @test): String }';
        }

        throw new \InvalidArgumentException('Invalid location ' . $location);
    }
}