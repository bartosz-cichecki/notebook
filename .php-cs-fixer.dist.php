<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        '@PSR12' => true,
        'align_multiline_comment' => true,
        'array_syntax' => ['syntax' => 'short'],
        'backtick_to_shell_exec' => true,
        'combine_consecutive_issets' => true,
        'combine_consecutive_unsets' => true,
        'compact_nullable_typehint' => true,
        'concat_space' => ['spacing' => 'one'],
        'declare_strict_types' => true,
        'dir_constant' => true,
        'ereg_to_preg' => true,
        'explicit_indirect_variable' => true,
        'explicit_string_variable' => true,
        'is_null' => true,
        'native_constant_invocation' => true,
        'native_function_invocation' => true,
        'no_alias_functions' => true,
        'no_unset_on_property' => true,
        'no_useless_else' => true,
        'nullable_type_declaration_for_default_null_value' => true,
        'ordered_interfaces' => true,
        'strict_comparison' => true,
        'strict_param' => true,
        'yoda_style' => ['identical' => false, 'equal' => false],
    ])
    ->setFinder($finder)
;
