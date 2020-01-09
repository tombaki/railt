<?php
/** @var Analyzer $ctx */

use Phplrt\Compiler\Analyzer;

echo "<?php\n";
?>

/**
 *
 * This file is part of Railt package and has been autogenerated.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

declare(strict_types=1);

namespace Railt\Introspection;

use Phplrt\Contracts\Ast\NodeInterface;
use Phplrt\Contracts\Grammar\RuleInterface;
use Phplrt\Contracts\Lexer\TokenInterface;
use Phplrt\Contracts\Parser\Exception\ParserRuntimeExceptionInterface;
use Phplrt\Contracts\Parser\ParserInterface;
use Phplrt\Contracts\Source\ReadableInterface;
use Phplrt\Lexer\Lexer;
use Phplrt\Parser\Builder\BuilderInterface;
use Phplrt\Parser\Parser as Runtime;
use Railt\TypeSystem\Value;

/**
 * Class Parser
 */
class Parser implements ParserInterface, BuilderInterface
{
    /**
     * @var string[]
     */
    private const LEXEMES = [
<?php foreach ($ctx->tokens[Analyzer::STATE_DEFAULT] as $token => $pattern): ?>
        '<?=$token?>' => <?=\var_export($pattern, true)?>,
<?php endforeach; ?>
    ];

    /**
     * @var string[]
     */
    private const SKIPS = [
<?php foreach ($ctx->skip as $token): ?>
        '<?=$token?>',
<?php endforeach; ?>
    ];

    /**
     * @var ParserInterface|Runtime
     */
    private ParserInterface $runtime;

    /**
     * Parser constructor.
     */
    public function __construct()
    {
        $lexer = new Lexer(self::LEXEMES, self::SKIPS);

        $this->runtime = new Runtime($lexer, $this->grammar(), [
            Runtime::CONFIG_AST_BUILDER  => $this,
            Runtime::CONFIG_INITIAL_RULE => <?=\var_export($ctx->initial, true)?>,
        ]);
    }

    /**
     * @return array|RuleInterface[]
     */
    private function grammar(): array
    {
        return [
<?php foreach ($ctx->rules as $id => $rule): ?>
            <?=\var_export($id, true)?> => new \<?=\get_class($rule)?>(
<?php foreach ($rule->getConstructorArguments() as $argument): ?>
                <?=\var_export($argument, true)?>,
<?php endforeach; ?>
            ),
<?php endforeach; ?>
        ];
    }

    /**
     * @param ReadableInterface $file
     * @param RuleInterface $rule
     * @param TokenInterface $token
     * @param int|string $state
     * @param array|iterable|NodeInterface|TokenInterface $children
     * @return mixed|null
     */
    public function build(ReadableInterface $file, RuleInterface $rule, TokenInterface $token, $state, $children)
    {
        switch ($state) {
<?php foreach ($ctx->reducers as $id => $reducer): ?>
            case <?=\var_export($id, true)?>:
                <?=$reducer?>

<?php endforeach; ?>
        }

        return null;
    }

    /**
     * @param ReadableInterface|resource|string $source
     * @return iterable
     * @throws ParserRuntimeExceptionInterface
     * @throws \Throwable
     */
    public function parse($source): iterable
    {
        return $this->runtime->parse($source);
    }
}
