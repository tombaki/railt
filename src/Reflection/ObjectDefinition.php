<?php
/**
 * This file is part of Railgun package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Railgun\Reflection;

use Hoa\Compiler\Llk\TreeNode;
use Serafim\Railgun\Reflection\Abstraction\InterfaceTypeInterface;
use Serafim\Railgun\Reflection\Abstraction\ObjectTypeInterface;
use Serafim\Railgun\Reflection\Common\Directives;
use Serafim\Railgun\Reflection\Common\Fields;
use Serafim\Railgun\Reflection\Common\HasLinkingStageInterface;
use Serafim\Railgun\Reflection\Common\HasName;
use Serafim\Railgun\Reflection\Common\LinkingStage;

/**
 * Class ObjectDefinition
 * @package Serafim\Railgun\Reflection
 */
class ObjectDefinition extends Definition implements
    ObjectTypeInterface,
    HasLinkingStageInterface
{
    use HasName;
    use Fields;
    use Directives;
    use LinkingStage;

    /**
     * @var array|InterfaceTypeInterface[]
     */
    private $interfaces = [];

    /**
     * @param Document $document
     * @param TreeNode $ast
     * @return TreeNode|null
     * @throws \Serafim\Railgun\Compiler\Exceptions\TypeNotFoundException
     */
    public function compile(Document $document, TreeNode $ast): ?TreeNode
    {
        switch ($ast->getId()) {
            case '#Implements':
                /** @var TreeNode $child */
                foreach ($ast->getChildren() as $child) {
                    $name = $child->getChild(0)->getValueValue();
                    $this->interfaces[$name] = $document->load($name);
                }
        }

        return $ast;
    }

    /**
     * @return iterable
     */
    public function getInterfaces(): iterable
    {
        return array_values($this->interfaces);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasInterface(string $name): bool
    {
        return array_key_exists($name, $this->interfaces);
    }

    /**
     * @param string $name
     * @return null|InterfaceTypeInterface
     */
    public function getInterface(string $name): ?InterfaceTypeInterface
    {
        return $this->interfaces[$name] ?? null;
    }

    /**
     * @return string
     */
    public function getTypeName(): string
    {
        return 'Object';
    }
}
