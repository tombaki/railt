<?php
/**
 * This file is part of Railt package and has been autogenerated.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/railt/parser/blob/No version set (parsed as 1.0.0)/LICENSE.md
 * @see https://github.com/phplrt/parser/blob/2.2.1/LICENSE.md
 * @see https://github.com/phplrt/lexer/blob/2.2.1/LICENSE.md
 */
declare(strict_types=1);

namespace Railt\Parser\Runtime;

use Phplrt\Source\File;
use Railt\Ast\Node;
use Railt\Ast\Location;
use Phplrt\Parser\Rule\RuleInterface;
use Phplrt\Parser\Parser as BaseParser;
use Phplrt\Parser\Buffer\BufferInterface;
use Phplrt\Contracts\Lexer\LexerInterface;
use Phplrt\Parser\Builder\BuilderInterface;
use Phplrt\Contracts\Source\ReadableInterface;
use Railt\Parser\Extension\ExtensionInterface;
use Railt\Parser\Extension\ExtendableInterface;
use Railt\Parser\Exception\SyntaxErrorException;
use Phplrt\Parser\Exception\ParserRuntimeException;
use Phplrt\Parser\Rule\{Lexeme, Optional, Repetition, Alternation, Concatenation};

/**
 * @internal This class is generated by railt/parser, specifically by Railt\Parser\Generator\Generator
 */
final class Parser extends BaseParser implements ExtendableInterface
{
    /**
     * @var \ReflectionProperty
     */
    private \ReflectionProperty $grammar;

    /**
     * Parser constructor.
     *
     * @param LexerInterface $lexer
     * @param BuilderInterface $builder
     * @param string $root
     * @throws \Throwable
     */
    public function __construct(LexerInterface $lexer, BuilderInterface $builder, string $root)
    {
        $this->grammar = new \ReflectionProperty(parent::class, 'rules');
        $this->grammar->setAccessible(true);

        parent::__construct($lexer, $this->grammar(), [
            parent::CONFIG_AST_BUILDER  => $builder,
            parent::CONFIG_INITIAL_RULE => $root,
        ]);
    }

    /**
     * @return array|RuleInterface[]
     */
    private function grammar(): array
    {
        return [
            0 => new Lexeme(
                'T_TRUE',
                true,
            ),
            'Alias' => new Concatenation(
                ['NameWithReserved', 155],
            ),
            'Argument' => new Concatenation(
                ['NameWithReserved', 148, 'Value'],
            ),
            'Arguments' => new Concatenation(
                [145, 146, 147],
            ),
            'BlockStringValue' => new Lexeme(
                'T_BLOCK_STRING',
                true,
            ),
            'BooleanValue' => new Alternation(
                [24, 25],
            ),
            'ConstValue' => new Alternation(
                ['IntValue', 'FloatValue', 'StringValue', 'BooleanValue', 'NullValue', 'EnumValue'],
            ),
            'Description' => new Optional(
                'StringValue',
            ),
            'Directive' => new Concatenation(
                [149, 'TypeName', 150],
            ),
            'DirectiveDefinition' => new Concatenation(
                ['Description', 'DirectiveDefinitionHead', 'DirectiveDefinitionBody'],
            ),
            'DirectiveDefinitionBody' => new Concatenation(
                [47, 'DirectiveLocations'],
            ),
            'DirectiveDefinitionHead' => new Concatenation(
                [42, 43, 'TypeName', 44, 45],
            ),
            'DirectiveIsRepeatable' => new Optional(
                46,
            ),
            'DirectiveLocation' => new Concatenation(
                ['NameWithReserved'],
            ),
            'DirectiveLocations' => new Concatenation(
                [51, 'DirectiveLocation', 52],
            ),
            'Directives' => new Repetition(
                'Directive',
                1,
                INF,
            ),
            'Document' => new Optional(
                185,
            ),
            'EnumTypeDefinition' => new Concatenation(
                ['Description', 'EnumTypeDefinitionExceptDescription'],
            ),
            'EnumTypeDefinitionBody' => new Concatenation(
                [56, 57, 58],
            ),
            'EnumTypeDefinitionExceptDescription' => new Concatenation(
                ['EnumTypeDefinitionHead', 53],
            ),
            'EnumTypeDefinitionHead' => new Concatenation(
                [54, 'TypeName', 55],
            ),
            'EnumTypeDefinitions' => new Repetition(
                'EnumValueDefinition',
                1,
                INF,
            ),
            'EnumTypeExtension' => new Concatenation(
                ['Description', 178, 'EnumTypeDefinitionExceptDescription'],
            ),
            'EnumValue' => new Concatenation(
                ['NameWithoutValues'],
            ),
            'EnumValueDefinition' => new Concatenation(
                ['Description', 'NameWithoutValues', 60, 61],
            ),
            'ExecutableLanguage' => new Repetition(
                'ExecutableDefinition',
                1,
                INF,
            ),
            'Field' => new Concatenation(
                [151, 'NameWithReserved', 152, 153, 154],
            ),
            'FieldArguments' => new Concatenation(
                [102, 103, 104],
            ),
            'FieldDefinition' => new Concatenation(
                ['Description', 'NameWithReserved', 98, 99, 'TypeHint', 100, 101],
            ),
            'FieldDefinitions' => new Repetition(
                'FieldDefinition',
                1,
                INF,
            ),
            'FloatValue' => new Alternation(
                [31, 32],
            ),
            'FragmentDefinition' => new Concatenation(
                [62, 'NameWithReserved', 63, 'NamedType', 64, 'SelectionSet'],
            ),
            'FragmentSpread' => new Concatenation(
                [156, 'NameWithReserved', 157],
            ),
            'ImplementsInterfaces' => new Concatenation(
                [85, 86, 'NamedType', 87],
            ),
            'ImplementsInterfacesDelimiter' => new Alternation(
                [88, 89],
            ),
            'InlineFragment' => new Concatenation(
                [160, 161, 162, 'SelectionSet'],
            ),
            'InlineStringValue' => new Lexeme(
                'T_STRING',
                true,
            ),
            'InputObjectTypeDefinition' => new Concatenation(
                ['Description', 'InputObjectTypeDefinitionExceptDescription'],
            ),
            'InputObjectTypeDefinitionBody' => new Concatenation(
                [68, 69, 70],
            ),
            'InputObjectTypeDefinitionExceptDescription' => new Concatenation(
                ['InputObjectTypeDefinitionHead', 65],
            ),
            'InputObjectTypeDefinitionHead' => new Concatenation(
                [66, 'TypeName', 67],
            ),
            'InputObjectTypeExtension' => new Concatenation(
                ['Description', 179, 'InputObjectTypeDefinitionExceptDescription'],
            ),
            'InputValueDefinition' => new Concatenation(
                ['Description', 'NameWithReserved', 74, 'TypeHint', 75, 76, 77],
            ),
            'InputValueDefinitions' => new Repetition(
                'InputValueDefinition',
                1,
                INF,
            ),
            'IntValue' => new Lexeme(
                'T_INT',
                true,
            ),
            'InterfaceTypeDefinition' => new Concatenation(
                ['Description', 'InterfaceTypeDefinitionExceptDescription'],
            ),
            'InterfaceTypeDefinitionBody' => new Concatenation(
                [81, 82, 83],
            ),
            'InterfaceTypeDefinitionExceptDescription' => new Concatenation(
                ['InterfaceTypeDefinitionHead', 78],
            ),
            'InterfaceTypeDefinitionHead' => new Concatenation(
                [79, 'TypeName', 80],
            ),
            'InterfaceTypeExtension' => new Concatenation(
                ['Description', 180, 'InterfaceTypeDefinitionExceptDescription'],
            ),
            'ListType' => new Concatenation(
                [20, 'TypeHint', 21],
            ),
            'ListValue' => new Concatenation(
                [26, 'ListValues', 27],
            ),
            'ListValues' => new Repetition(
                30,
                0,
                INF,
            ),
            'MutationOperation' => new Concatenation(
                [167, 168, 'OperationDefinitionBody'],
            ),
            'NameWithReserved' => new Alternation(
                ['NameWithoutValues', 0, 1, 2],
            ),
            'NameWithoutReserved' => new Lexeme(
                'T_NAME',
                true,
            ),
            'NameWithoutValues' => new Alternation(
                ['NameWithoutReserved', 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19],
            ),
            'NamedType' => new Concatenation(
                ['TypeName'],
            ),
            'NonNullType' => new Concatenation(
                [22, 23],
            ),
            'NullValue' => new Lexeme(
                'T_NULL',
                false,
            ),
            'ObjectField' => new Concatenation(
                ['NameWithReserved', 36, 'Value', 37],
            ),
            'ObjectFields' => new Repetition(
                'ObjectField',
                0,
                INF,
            ),
            'ObjectTypeDefinition' => new Concatenation(
                ['Description', 'ObjectTypeDefinitionExceptDescription'],
            ),
            'ObjectTypeDefinitionBody' => new Concatenation(
                [94, 95, 96],
            ),
            'ObjectTypeDefinitionExceptDescription' => new Concatenation(
                ['ObjectTypeDefinitionHead', 90],
            ),
            'ObjectTypeDefinitionHead' => new Concatenation(
                [91, 'TypeName', 92, 93],
            ),
            'ObjectTypeExtension' => new Concatenation(
                ['Description', 181, 'ObjectTypeDefinitionExceptDescription'],
            ),
            'ObjectValue' => new Concatenation(
                [33, 'ObjectFields', 34],
            ),
            'OperationDefinition' => new Alternation(
                ['QueryOperation', 'MutationOperation', 'SubscriptionOperation'],
            ),
            'OperationDefinitionBody' => new Concatenation(
                [171, 172, 'SelectionSet'],
            ),
            'OperationTypeDefinition' => new Concatenation(
                ['SchemaFieldName', 116, 'NamedType', 117],
            ),
            'OperationTypeDefinitions' => new Repetition(
                115,
                1,
                INF,
            ),
            'QueryOperation' => new Concatenation(
                [166, 'OperationDefinitionBody'],
            ),
            'RootDirectives' => new Repetition(
                'Directive',
                1,
                INF,
            ),
            'ScalarTypeDefinition' => new Concatenation(
                ['Description', 'ScalarTypeDefinitionExceptDescription'],
            ),
            'ScalarTypeDefinitionBody' => new Concatenation(
                [105, 'TypeName', 106],
            ),
            'ScalarTypeDefinitionExceptDescription' => new Concatenation(
                ['ScalarTypeDefinitionBody'],
            ),
            'ScalarTypeExtension' => new Concatenation(
                ['Description', 182, 'ScalarTypeDefinitionExceptDescription'],
            ),
            'SchemaDefinition' => new Concatenation(
                ['Description', 'SchemaDefinitionExceptDescription'],
            ),
            'SchemaDefinitionBody' => new Concatenation(
                [110, 111, 112],
            ),
            'SchemaDefinitionExceptDescription' => new Concatenation(
                ['SchemaDefinitionHead', 107],
            ),
            'SchemaDefinitionHead' => new Concatenation(
                [108, 109],
            ),
            'SchemaExtension' => new Concatenation(
                ['Description', 183, 'SchemaDefinitionExceptDescription'],
            ),
            'SchemaFieldName' => new Alternation(
                [118, 119, 120],
            ),
            'Selection' => new Alternation(
                ['Field', 'InlineFragment', 'FragmentSpread'],
            ),
            'SelectionSet' => new Concatenation(
                [173, 'Selections', 174],
            ),
            'Selections' => new Repetition(
                177,
                0,
                INF,
            ),
            'StringValue' => new Alternation(
                ['BlockStringValue', 'InlineStringValue'],
            ),
            'SubscriptionOperation' => new Concatenation(
                [169, 170, 'OperationDefinitionBody'],
            ),
            'TypeHint' => new Alternation(
                ['NonNullType', 'ListType', 'NamedType'],
            ),
            'TypeName' => new Concatenation(
                ['NameWithReserved'],
            ),
            'UnionTypeDefinition' => new Concatenation(
                ['Description', 'UnionTypeDefinitionExceptDescription'],
            ),
            'UnionTypeDefinitionBody' => new Concatenation(
                [124, 125],
            ),
            'UnionTypeDefinitionExceptDescription' => new Concatenation(
                ['UnionTypeDefinitionHead', 121],
            ),
            'UnionTypeDefinitionHead' => new Concatenation(
                [122, 'TypeName', 123],
            ),
            'UnionTypeDefinitionTargets' => new Concatenation(
                [129, 'NamedType', 130],
            ),
            'UnionTypeExtension' => new Concatenation(
                ['Description', 184, 'UnionTypeDefinitionExceptDescription'],
            ),
            'Value' => new Alternation(
                ['Variable', 'ConstValue', 'ListValue', 'ObjectValue'],
            ),
            'Variable' => new Concatenation(
                ['VariableName'],
            ),
            'VariableDefinition' => new Concatenation(
                ['Variable', 139, 'TypeHint', 140, 141],
            ),
            'VariableDefinitions' => new Concatenation(
                [134, 135, 136],
            ),
            'VariableName' => new Lexeme(
                'T_VARIABLE',
                true,
            ),
            1 => new Lexeme(
                'T_FALSE',
                true,
            ),
            2 => new Lexeme(
                'T_NULL',
                true,
            ),
            3 => new Lexeme(
                'T_TYPE',
                true,
            ),
            4 => new Lexeme(
                'T_ENUM',
                true,
            ),
            5 => new Lexeme(
                'T_UNION',
                true,
            ),
            6 => new Lexeme(
                'T_INTERFACE',
                true,
            ),
            7 => new Lexeme(
                'T_SCHEMA',
                true,
            ),
            8 => new Lexeme(
                'T_SCALAR',
                true,
            ),
            9 => new Lexeme(
                'T_DIRECTIVE',
                true,
            ),
            10 => new Lexeme(
                'T_INPUT',
                true,
            ),
            11 => new Lexeme(
                'T_FRAGMENT',
                true,
            ),
            12 => new Lexeme(
                'T_EXTEND',
                true,
            ),
            13 => new Lexeme(
                'T_EXTENDS',
                true,
            ),
            14 => new Lexeme(
                'T_IMPLEMENTS',
                true,
            ),
            15 => new Lexeme(
                'T_ON',
                true,
            ),
            16 => new Lexeme(
                'T_REPEATABLE',
                true,
            ),
            17 => new Lexeme(
                'T_QUERY',
                true,
            ),
            18 => new Lexeme(
                'T_MUTATION',
                true,
            ),
            19 => new Lexeme(
                'T_SUBSCRIPTION',
                true,
            ),
            20 => new Lexeme(
                'T_BRACKET_OPEN',
                false,
            ),
            21 => new Lexeme(
                'T_BRACKET_CLOSE',
                false,
            ),
            22 => new Alternation(
                ['ListType', 'NamedType'],
            ),
            23 => new Lexeme(
                'T_NON_NULL',
                false,
            ),
            24 => new Lexeme(
                'T_FALSE',
                true,
            ),
            25 => new Lexeme(
                'T_TRUE',
                true,
            ),
            26 => new Lexeme(
                'T_BRACKET_OPEN',
                false,
            ),
            27 => new Lexeme(
                'T_BRACKET_CLOSE',
                false,
            ),
            28 => new Lexeme(
                'T_COMMA',
                false,
            ),
            29 => new Optional(
                28,
            ),
            30 => new Concatenation(
                ['Value', 29],
            ),
            31 => new Lexeme(
                'T_FLOAT',
                true,
            ),
            32 => new Lexeme(
                'T_FLOAT_EXP',
                true,
            ),
            33 => new Lexeme(
                'T_BRACE_OPEN',
                false,
            ),
            34 => new Lexeme(
                'T_BRACE_CLOSE',
                false,
            ),
            35 => new Lexeme(
                'T_COMMA',
                false,
            ),
            36 => new Lexeme(
                'T_COLON',
                false,
            ),
            37 => new Optional(
                35,
            ),
            38 => new Lexeme(
                'T_PARENTHESIS_OPEN',
                false,
            ),
            39 => new Optional(
                'InputValueDefinitions',
            ),
            40 => new Lexeme(
                'T_PARENTHESIS_CLOSE',
                false,
            ),
            41 => new Concatenation(
                [38, 39, 40],
            ),
            42 => new Lexeme(
                'T_DIRECTIVE',
                false,
            ),
            43 => new Lexeme(
                'T_DIRECTIVE_AT',
                false,
            ),
            44 => new Optional(
                41,
            ),
            45 => new Optional(
                'DirectiveIsRepeatable',
            ),
            46 => new Lexeme(
                'T_REPEATABLE',
                true,
            ),
            47 => new Lexeme(
                'T_ON',
                false,
            ),
            48 => new Lexeme(
                'T_OR',
                false,
            ),
            49 => new Lexeme(
                'T_OR',
                false,
            ),
            50 => new Concatenation(
                [49, 'DirectiveLocation'],
            ),
            51 => new Optional(
                48,
            ),
            52 => new Repetition(
                50,
                0,
                INF,
            ),
            53 => new Optional(
                'EnumTypeDefinitionBody',
            ),
            54 => new Lexeme(
                'T_ENUM',
                false,
            ),
            55 => new Optional(
                'Directives',
            ),
            56 => new Lexeme(
                'T_BRACE_OPEN',
                false,
            ),
            57 => new Optional(
                'EnumTypeDefinitions',
            ),
            58 => new Lexeme(
                'T_BRACE_CLOSE',
                false,
            ),
            59 => new Lexeme(
                'T_COMMA',
                false,
            ),
            60 => new Optional(
                'Directives',
            ),
            61 => new Optional(
                59,
            ),
            62 => new Lexeme(
                'T_FRAGMENT',
                false,
            ),
            63 => new Lexeme(
                'T_ON',
                false,
            ),
            64 => new Optional(
                'Directives',
            ),
            65 => new Optional(
                'InputObjectTypeDefinitionBody',
            ),
            66 => new Lexeme(
                'T_INPUT',
                false,
            ),
            67 => new Optional(
                'Directives',
            ),
            68 => new Lexeme(
                'T_BRACE_OPEN',
                false,
            ),
            69 => new Optional(
                'InputValueDefinitions',
            ),
            70 => new Lexeme(
                'T_BRACE_CLOSE',
                false,
            ),
            71 => new Lexeme(
                'T_EQUAL',
                false,
            ),
            72 => new Concatenation(
                [71, 'Value'],
            ),
            73 => new Lexeme(
                'T_COMMA',
                false,
            ),
            74 => new Lexeme(
                'T_COLON',
                false,
            ),
            75 => new Optional(
                72,
            ),
            76 => new Optional(
                'Directives',
            ),
            77 => new Optional(
                73,
            ),
            78 => new Optional(
                'InterfaceTypeDefinitionBody',
            ),
            79 => new Lexeme(
                'T_INTERFACE',
                false,
            ),
            80 => new Optional(
                'Directives',
            ),
            81 => new Lexeme(
                'T_BRACE_OPEN',
                false,
            ),
            82 => new Optional(
                'FieldDefinitions',
            ),
            83 => new Lexeme(
                'T_BRACE_CLOSE',
                false,
            ),
            84 => new Concatenation(
                ['ImplementsInterfacesDelimiter', 'NamedType'],
            ),
            85 => new Lexeme(
                'T_IMPLEMENTS',
                false,
            ),
            86 => new Optional(
                'ImplementsInterfacesDelimiter',
            ),
            87 => new Repetition(
                84,
                0,
                INF,
            ),
            88 => new Lexeme(
                'T_COMMA',
                false,
            ),
            89 => new Lexeme(
                'T_AND',
                false,
            ),
            90 => new Optional(
                'ObjectTypeDefinitionBody',
            ),
            91 => new Lexeme(
                'T_TYPE',
                false,
            ),
            92 => new Optional(
                'ImplementsInterfaces',
            ),
            93 => new Optional(
                'Directives',
            ),
            94 => new Lexeme(
                'T_BRACE_OPEN',
                false,
            ),
            95 => new Optional(
                'FieldDefinitions',
            ),
            96 => new Lexeme(
                'T_BRACE_CLOSE',
                false,
            ),
            97 => new Lexeme(
                'T_COMMA',
                false,
            ),
            98 => new Optional(
                'FieldArguments',
            ),
            99 => new Lexeme(
                'T_COLON',
                false,
            ),
            100 => new Optional(
                'Directives',
            ),
            101 => new Optional(
                97,
            ),
            102 => new Lexeme(
                'T_PARENTHESIS_OPEN',
                false,
            ),
            103 => new Optional(
                'InputValueDefinitions',
            ),
            104 => new Lexeme(
                'T_PARENTHESIS_CLOSE',
                false,
            ),
            105 => new Lexeme(
                'T_SCALAR',
                false,
            ),
            106 => new Optional(
                'Directives',
            ),
            107 => new Optional(
                'SchemaDefinitionBody',
            ),
            108 => new Lexeme(
                'T_SCHEMA',
                false,
            ),
            109 => new Optional(
                'Directives',
            ),
            110 => new Lexeme(
                'T_BRACE_OPEN',
                false,
            ),
            111 => new Optional(
                'OperationTypeDefinitions',
            ),
            112 => new Lexeme(
                'T_BRACE_CLOSE',
                false,
            ),
            113 => new Lexeme(
                'T_COMMA',
                false,
            ),
            114 => new Optional(
                113,
            ),
            115 => new Concatenation(
                ['OperationTypeDefinition', 114],
            ),
            116 => new Lexeme(
                'T_COLON',
                false,
            ),
            117 => new Optional(
                'Directives',
            ),
            118 => new Lexeme(
                'T_QUERY',
                true,
            ),
            119 => new Lexeme(
                'T_MUTATION',
                true,
            ),
            120 => new Lexeme(
                'T_SUBSCRIPTION',
                true,
            ),
            121 => new Optional(
                'UnionTypeDefinitionBody',
            ),
            122 => new Lexeme(
                'T_UNION',
                false,
            ),
            123 => new Optional(
                'Directives',
            ),
            124 => new Lexeme(
                'T_EQUAL',
                false,
            ),
            125 => new Optional(
                'UnionTypeDefinitionTargets',
            ),
            126 => new Lexeme(
                'T_OR',
                false,
            ),
            127 => new Lexeme(
                'T_OR',
                false,
            ),
            128 => new Concatenation(
                [127, 'NamedType'],
            ),
            129 => new Optional(
                126,
            ),
            130 => new Repetition(
                128,
                0,
                INF,
            ),
            131 => new Lexeme(
                'T_COMMA',
                false,
            ),
            132 => new Optional(
                131,
            ),
            133 => new Concatenation(
                ['VariableDefinition', 132],
            ),
            134 => new Lexeme(
                'T_PARENTHESIS_OPEN',
                false,
            ),
            135 => new Repetition(
                133,
                0,
                INF,
            ),
            136 => new Lexeme(
                'T_PARENTHESIS_CLOSE',
                false,
            ),
            137 => new Lexeme(
                'T_EQUAL',
                false,
            ),
            138 => new Concatenation(
                [137, 'Value'],
            ),
            139 => new Lexeme(
                'T_COLON',
                false,
            ),
            140 => new Optional(
                138,
            ),
            141 => new Optional(
                'Directives',
            ),
            142 => new Lexeme(
                'T_COMMA',
                false,
            ),
            143 => new Optional(
                142,
            ),
            144 => new Concatenation(
                ['Argument', 143],
            ),
            145 => new Lexeme(
                'T_PARENTHESIS_OPEN',
                false,
            ),
            146 => new Repetition(
                144,
                0,
                INF,
            ),
            147 => new Lexeme(
                'T_PARENTHESIS_CLOSE',
                false,
            ),
            148 => new Lexeme(
                'T_COLON',
                false,
            ),
            149 => new Lexeme(
                'T_DIRECTIVE_AT',
                false,
            ),
            150 => new Optional(
                'Arguments',
            ),
            151 => new Optional(
                'Alias',
            ),
            152 => new Optional(
                'Arguments',
            ),
            153 => new Optional(
                'Directives',
            ),
            154 => new Optional(
                'SelectionSet',
            ),
            155 => new Lexeme(
                'T_COLON',
                false,
            ),
            156 => new Lexeme(
                'T_THREE_DOTS',
                false,
            ),
            157 => new Optional(
                'Directives',
            ),
            158 => new Lexeme(
                'T_ON',
                false,
            ),
            159 => new Concatenation(
                [158, 'NamedType'],
            ),
            160 => new Lexeme(
                'T_THREE_DOTS',
                false,
            ),
            161 => new Optional(
                159,
            ),
            162 => new Optional(
                'Directives',
            ),
            163 => new Lexeme(
                'T_QUERY',
                false,
            ),
            164 => new Optional(
                'NameWithReserved',
            ),
            165 => new Concatenation(
                [163, 164],
            ),
            166 => new Optional(
                165,
            ),
            167 => new Lexeme(
                'T_MUTATION',
                false,
            ),
            168 => new Optional(
                'NameWithReserved',
            ),
            169 => new Lexeme(
                'T_SUBSCRIPTION',
                false,
            ),
            170 => new Optional(
                'NameWithReserved',
            ),
            171 => new Optional(
                'VariableDefinitions',
            ),
            172 => new Optional(
                'Directives',
            ),
            173 => new Lexeme(
                'T_BRACE_OPEN',
                false,
            ),
            174 => new Lexeme(
                'T_BRACE_CLOSE',
                false,
            ),
            175 => new Lexeme(
                'T_COMMA',
                false,
            ),
            176 => new Optional(
                175,
            ),
            177 => new Concatenation(
                ['Selection', 176],
            ),
            178 => new Lexeme(
                'T_EXTEND',
                false,
            ),
            179 => new Lexeme(
                'T_EXTEND',
                false,
            ),
            180 => new Lexeme(
                'T_EXTEND',
                false,
            ),
            181 => new Lexeme(
                'T_EXTEND',
                false,
            ),
            182 => new Lexeme(
                'T_EXTEND',
                false,
            ),
            183 => new Lexeme(
                'T_EXTEND',
                false,
            ),
            184 => new Lexeme(
                'T_EXTEND',
                false,
            ),
            185 => new Alternation(
                ['ExecutableLanguage', 'TypeSystemLanguage'],
            ),
            186 => new Optional(
                'RootDirectives',
            ),
            187 => new Repetition(
                'TypeSystemStatement',
                0,
                INF,
            ),
            'TypeSystemLanguage' => new Concatenation(
                [186, 187],
            ),
            'ExecutableDefinition' => new Alternation(
                ['FragmentDefinition', 'OperationDefinition'],
            ),
            'TypeSystemStatement' => new Alternation(
                ['TypeSystemDefinition', 'TypeSystemExtension'],
            ),
            'TypeSystemDefinition' => new Alternation(
                ['SchemaDefinition', 'TypeDefinition', 'DirectiveDefinition'],
            ),
            'TypeDefinition' => new Alternation(
                ['ScalarTypeDefinition', 'ObjectTypeDefinition', 'InterfaceTypeDefinition', 'UnionTypeDefinition', 'EnumTypeDefinition', 'InputObjectTypeDefinition'],
            ),
            'TypeSystemExtension' => new Alternation(
                ['SchemaExtension', 'TypeExtension'],
            ),
            'TypeExtension' => new Alternation(
                ['ScalarTypeExtension', 'ObjectTypeExtension', 'InterfaceTypeExtension', 'UnionTypeExtension', 'EnumTypeExtension', 'InputObjectTypeExtension'],
            ),
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function next(ReadableInterface $source, BufferInterface $buffer, $state)
    {
        $from = $buffer->current()->getOffset();

        $result = parent::next($source, $buffer, $state);

        if ($result instanceof Node) {
            $result->loc = new Location($source, $from, $buffer->current()->getOffset());
        }

        return $result;
    }

    /**
     * {@inheritDoc}
     */
    public function parse($source): iterable
    {
        $source = File::new($source);

        try {
            return parent::parse($source);
        } catch (ParserRuntimeException $e) {
            throw new SyntaxErrorException($e->getMessage(), $source, $e->getToken()->getOffset());
        }
    }

    /**
     * {@inheritDoc}
     */
    public function extend(ExtensionInterface $extension): void
    {
        $rules = $this->grammar->getValue($this);

        $stream = $extension->rules();

        while ($stream->valid()) {
            [$key, $value] = [$stream->key(), $stream->current()];

            switch (true) {
                case $key === null || \is_int($key):
                    $rules[] = $value;
                    $key = \array_key_last($rules);
                    break;

                case \is_string($key):
                    $rules[$key] = $value;
                    break;

                default:
                    throw new \InvalidArgumentException('Unrecognized rule name ' . $key);
            }

            $stream->send($key);
        }

        $this->grammar->setValue($this, $rules);
    }
}
