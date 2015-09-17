<?php

$site = panel()->site();
$user = panel()->user();

$options = array();

if($user->hasPermission('panel.subpages.modify', $site)) {
  $options[] = array(
    'text' => l('dashboard.index.pages.edit'),
    'icon' => 'pencil',
    'link' => $site->url('subpages')
  );
}

if($user->hasPermission('panel.subpages.create', $site) and $addbutton = $site->addButton()) {
  $options[] = array(
    'text'  => l('dashboard.index.pages.add'),
    'icon'  => 'plus-circle',
    'link'  => $addbutton->url(),
    'modal' => $addbutton->modal(),
    'key'   => '+',
  );
}

return array(
  'title' => array(
    'text'       => l('dashboard.index.pages.title'),
    'link'       => $site->url('subpages'),
    'compressed' => true
  ),
  'options' => $options,
  'html'  => function() use($site, $user) {
    return tpl::load(__DIR__ . DS . 'pages.html.php', array(
      'pages'   => $site->children(),
    ));
  }
);
