<?php
declare(strict_types=1);

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

$header = <<<'EOF'
NOTICE OF LICENSE

This source file is subject to the Open Software License (OSL 3.0)
PHP version 5.6+

@category  BridgeSDK
@package   Ecommercebridgesdk
@author    202-ecommerce <tech@202-ecommerce.com>
@copyright 2022 (c) 202-ecommerce
@license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
@link      https://docs.bridgeapi.io/
EOF;

$finder = PhpCsFixer\Finder::create()
    ->ignoreDotFiles(false)
    ->ignoreVCSIgnored(true)
    ->exclude(['tests'])
    ->in(__DIR__)
;

$config = new PhpCsFixer\Config();
$config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PHP74Migration' => true,
        '@PHP74Migration:risky' => true,
        '@PHPUnit75Migration:risky' => true,
        '@PhpCsFixer' => true,
        '@PhpCsFixer:risky' => true,
        'general_phpdoc_annotation_remove' => ['annotations' => ['expectedDeprecation']], // one should use PHPUnit built-in method instead
        'header_comment' => ['header' => $header, 'separate' => 'bottom', 'comment_type' => 'PHPDoc'],
        'heredoc_indentation' => false, // TODO switch on when # of PR's is lower
        'modernize_strpos' => true, // needs PHP 8+ or polyfill
        'use_arrow_functions' => false, // TODO switch on when # of PR's is lower
        'visibility_required' => ['elements' => ['property', 'method']],
        'declare_strict_types' => false,
        'void_return' => false,
        'phpdoc_no_empty_return' => false,
    ])
    ->setFinder($finder)
;

// special handling of fabbot.io service if it's using too old PHP CS Fixer version
if (false !== getenv('FABBOT_IO')) {
    try {
        PhpCsFixer\FixerFactory::create()
            ->registerBuiltInFixers()
            ->registerCustomFixers($config->getCustomFixers())
            ->useRuleSet(new PhpCsFixer\RuleSet($config->getRules()))
        ;
    } catch (PhpCsFixer\ConfigurationException\InvalidConfigurationException $e) {
        $config->setRules([]);
    } catch (UnexpectedValueException $e) {
        $config->setRules([]);
    } catch (InvalidArgumentException $e) {
        $config->setRules([]);
    }
}

return $config;