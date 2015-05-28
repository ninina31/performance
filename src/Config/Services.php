<?php

$container['database'] = array(
  'class' => 'Mpwar\Component\Database\Sql'
);

$container['twig'] = array(
  'class' => 'Mpwar\Component\Template\TwigTemplate'
);

$container['smarty'] = array(
  'class' => 'Mpwar\Component\Template\SmartyTemplate'
);

$container['redis'] = array(
    'class' => 'Mpwar\Component\Predis\Redis'
);
