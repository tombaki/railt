<?php
/**
 * This file is part of Railgun package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Railgun\Adapters\Webonyx;

use GraphQL\Type\Definition\Type;
use Serafim\Railgun\Adapters\Webonyx\Builders\DefinitionsBuilder;
use Serafim\Railgun\Adapters\Webonyx\Builders\PartialsBuilder;
use Serafim\Railgun\Adapters\Webonyx\Builders\TypesBuilder;
use Serafim\Railgun\Adapters\Webonyx\Support\IterablesBuilder;
use Serafim\Railgun\Adapters\Webonyx\Support\NameBuilder;
use Serafim\Railgun\Contracts\Types\TypeInterface;
use Serafim\Railgun\Contracts\TypesRegistryInterface;

/**
 * Class Builder
 * @package Serafim\Railgun\Adapters
 */
class Builder implements BuilderInterface
{
    use NameBuilder;
    use IterablesBuilder;

    /**
     * @var TypesRegistry
     */
    private $registry;

    /**
     * @var TypesBuilder|null
     */
    private $types;

    /**
     * @var PartialsBuilder|null
     */
    private $partials;

    /**
     * @var DefinitionsBuilder|null
     */
    private $definitions;

    /**
     * WebonyxDataTransfer constructor.
     * @param TypesRegistryInterface $registry
     * @throws \InvalidArgumentException
     */
    public function __construct(TypesRegistryInterface $registry)
    {
        $this->registry = new TypesRegistry($registry, function (TypeInterface $type): Type {
            return $this->getTypesBuilder()->build($type);
        });
    }

    /**
     * @return TypesBuilder
     */
    public function getTypesBuilder(): TypesBuilder
    {
        if ($this->types === null) {
            $this->types = new TypesBuilder($this);
        }

        return $this->types;
    }

    /**
     * @param string $name
     * @return Type
     * @throws \InvalidArgumentException
     */
    public function type(string $name): Type
    {
        return $this->registry->get($name);
    }

    /**
     * @return DefinitionsBuilder
     */
    public function getDefinitionsBuilder(): DefinitionsBuilder
    {
        if ($this->definitions === null) {
            $this->definitions = new DefinitionsBuilder($this);
        }

        return $this->definitions;
    }

    /**
     * @return PartialsBuilder
     */
    public function getPartialsBuilder(): PartialsBuilder
    {
        if ($this->partials === null) {
            $this->partials = new PartialsBuilder($this);
        }

        return $this->partials;
    }

    /**
     * @return iterable|Type[]
     */
    public function getTypes(): iterable
    {
        $internal = Type::getInternalTypes();

        foreach ($this->registry->all() as $type) {
            if (!in_array($type, $internal, true)) {
                yield $type;
            }
        }
    }
}
