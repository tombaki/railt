<?php

/**
 * This file is part of GraphQL TypeSystem package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Railt\TypeSystem;

use GraphQL\Contracts\TypeSystem\FieldInterface;
use GraphQL\Contracts\TypeSystem\Type\OutputTypeInterface;
use GraphQL\Contracts\TypeSystem\Type\WrappingTypeInterface;
use Railt\TypeSystem\Common\ArgumentsTrait;
use Railt\TypeSystem\Common\DeprecationTrait;
use Railt\TypeSystem\Common\DescriptionTrait;
use Railt\TypeSystem\Common\NameTrait;
use Railt\TypeSystem\Reference\Reference;
use Railt\TypeSystem\Reference\TypeReferenceInterface;
use Serafim\Immutable\Immutable;

/**
 * {@inheritDoc}
 */
final class Field extends Definition implements FieldInterface
{
    use NameTrait;
    use ArgumentsTrait;
    use DescriptionTrait;
    use DeprecationTrait;

    /**
     * @var TypeReferenceInterface|WrappingTypeInterface
     */
    protected $type;

    /**
     * InputField constructor.
     *
     * @param string $name
     * @param TypeReferenceInterface|WrappingTypeInterface $type
     * @param iterable $properties
     */
    public function __construct(string $name, $type, iterable $properties = [])
    {
        $this->setName($name);
        $this->setType($type);

        $this->fill($properties, [
            'description'       => fn(?string $description) => $this->setDescription($description),
            'arguments'         => fn(iterable $arguments) => $this->addArguments($arguments),
            'deprecationReason' => fn(?string $message) => $this->setDeprecationReason($message),
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function getType(): OutputTypeInterface
    {
        return Reference::resolve($this, $this->type, OutputTypeInterface::class);
    }

    /**
     * @internal Please note that this method changes the internals of the current
     *           object, and its improper use can violate the integrity of the data.
     *
     * @param TypeReferenceInterface|WrappingTypeInterface $type
     * @return void
     */
    public function setType($type): void
    {
        \assert($type instanceof WrappingTypeInterface || $type instanceof TypeReferenceInterface);

        $this->type = $type;
    }

    /**
     * @psalm-suppress LessSpecificReturnStatement
     * @psalm-return self
     *
     * @param TypeReferenceInterface|WrappingTypeInterface $type
     * @return object|self|$this
     */
    public function withType($type): self
    {
        return Immutable::execute(fn() => $this->setType($type));
    }
}
