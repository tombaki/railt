<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Compiler;

use Railt\Reflection\Abstraction\DocumentTypeInterface;
use Railt\Reflection\Abstraction\ScalarTypeInterface;
use Railt\Reflection\Abstraction\SchemaTypeInterface;
use Railt\Reflection\Dictionary;
use Railt\Reflection\Exceptions\TypeConflictException;
use Railt\Reflection\Reflection\Common\HasDefinitions;

/**
 * Class Stdlib
 * @package Railt\Reflection\Compiler
 */
final class Stdlib implements DocumentTypeInterface
{
    use HasDefinitions;
    /**
     * @var Dictionary
     */
    private $dictionary;

    /**
     * GraphQL Stdlib constructor.
     * @param Dictionary $dictionary
     * @throws TypeConflictException
     */
    public function __construct(Dictionary $dictionary)
    {
        $this->dictionary = $dictionary;
        $this->boot();
    }

    /**
     * @throws TypeConflictException
     */
    private function boot(): void
    {
        $scalars = ['ID', 'Int', 'Float', 'String', 'Boolean', 'Any'];

        foreach ($scalars as $scalar) {
            $this->registerScalar($scalar);
        }
    }

    /**
     * @param string $name
     * @return ScalarTypeInterface
     * @throws TypeConflictException
     */
    public function registerScalar(string $name): ScalarTypeInterface
    {
        $scalar = new Stdlib\Scalar($this, $name);

        $this->dictionary->register($scalar);

        return $scalar;
    }

    /**
     * @return string
     */
    public function getTypeName(): string
    {
        return 'GraphQL Standard';
    }

    /**
     * @return DocumentTypeInterface
     */
    public function getDocument(): DocumentTypeInterface
    {
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFileName(): string
    {
        return 'GraphQL::StdLib';
    }

    /**
     * @return null|SchemaTypeInterface
     */
    public function getSchema(): ?SchemaTypeInterface
    {
        return null;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return 0;
    }

    /**
     * @return bool
     */
    public function isStdlib(): bool
    {
        return true;
    }
}
