<?php

$config = Symfony\CS\Config\Symfony23Config::create();
$config->fixers([
    'align_double_arrow',
    'ordered_use',
    'short_array_syntax',
    '-phpdoc_no_package',
    '-phpdoc_separation',
    '-phpdoc_short_description',
    '-phpdoc_to_comment',
    '-pre_increment',
    '-unalign_double_arrow',
    '-unalign_equals',
]);
$config->setDir(__DIR__);
$config->getFinder()->exclude('App/ProtocolBuffersBundle/GeneratedMessage');

return $config;
