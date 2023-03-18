<?php

declare(strict_types=1);

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude(['vendor', 'var'])
;

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        'yoda_style' => false,
        'declare_strict_types' => true,
        'concat_space' => ['spacing' => 'one'], // makes "$a.$b" look like "$a . $b"
        'phpdoc_align' => ['align' => 'left'],
        'class_attributes_separation' => [
            // places a single space between properties and methods
            'elements' => ['method' => 'one', 'property' => 'only_if_meta', 'trait_import' => 'one']
        ],
        'blank_line_before_statement' => true,
    ])
    ->setFinder($finder)
    ;