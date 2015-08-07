<?php

// register all available routes
return array(

  // Sandbox
  array(
    'pattern' => 'sandbox', 
    'action'  => 'SandboxController::index',
    'filter'  => 'auth',
    'method'  => 'ALL'
  ),

  // Authentication
  array(
    'pattern' => 'login/(:any?)',
    'action'  => 'AuthController::login',
    'filter'  => 'isInstalled',
    'method'  => 'GET|POST'
  ),
  array(
    'pattern' => 'logout',
    'action'  => 'AuthController::logout',
    'method'  => 'GET',
    'filter'  => 'auth',
  ),

  // Installation
  array(
    'pattern' => 'install',
    'action'  => 'InstallationController::index',
    'method'  => 'GET|POST'
  ),

  // Dashboard
  array(
    'pattern' => '/',
    'action'  => 'DashboardController::index',
    'filter'  => array('auth', 'isInstalled'),
  ),

  // Options
  array(
    'pattern' => 'options',
    'action'  => 'OptionsController::index',
    'method'  => 'GET|POST',
    'filter'  => 'auth'
  ),

  // Files
  array(
    'pattern' => array(
      'site(/)file/(:any)/edit',
      'pages/(:all)/file/(:any)/edit',
    ),
    'action'  => 'FilesController::edit',
    'filter'  => 'auth',
    'method'  => 'POST|GET',
  ),
  array(
    'pattern' => array(
      'site(/)file/(:any)/context',
      'pages/(:all)/file/(:any)/context',
    ),
    'action'  => 'FilesController::context',
    'filter'  => 'auth',
    'method'  => 'GET',
  ),
  array(
    'pattern' => array(
      'site(/)file/(:any)/delete',
      'pages/(:all)/file/(:any)/delete',
    ),
    'action'  => 'FilesController::delete',
    'filter'  => 'auth',
    'method'  => 'POST|GET',
  ),
  array(
    'pattern' => array(
      'site(/)file/(:any)/replace',
      'pages/(:all)/file/(:any)/replace',
    ),
    'action'  => 'FilesController::replace',
    'filter'  => 'auth',
    'method'  => 'POST',
  ),
  array(
    'pattern' => array(
      'site(/)files',
      'pages/(:all)/files',
    ),
    'action'  => 'FilesController::index',
    'filter'  => 'auth',
    'method'  => 'POST|GET',
  ),

  // editors
  array(
    'pattern' => array(
      'site(/)field/(:any)/link',
      'pages/(:all)/field/(:any)/link',
    ),
    'action'  => 'EditorController::link',
    'filter'  => 'auth',
    'method'  => 'POST|GET'
  ),
  array(
    'pattern' => array(
      'site(/)field/(:any)/email',
      'pages/(:all)/field/(:any)/email',
    ),
    'action'  => 'EditorController::email',
    'filter'  => 'auth',
    'method'  => 'POST|GET'
  ),

  // structure editor routes
  array(
    'pattern' => array(
      'site(/)field/(:any)/structure/add',
      'pages/(:all)/field/(:any)/structure/add',
    ),
    'action'  => 'StructureController::add',
    'filter'  => 'auth',
    'method'  => 'POST|GET'
  ),
  array(
    'pattern' => array(
      'site(/)field/(:any)/structure/sort',
      'pages/(:all)/field/(:any)/structure/sort',
    ),
    'action'  => 'StructureController::sort',
    'filter'  => 'auth',
    'method'  => 'POST|GET'
  ),
  array(
    'pattern' => array(
      'site(/)field/(:any)/structure/(:any)/update',
      'pages/(:all)/field/(:any)/structure/(:any)/update',
    ),
    'action'  => 'StructureController::update',
    'filter'  => 'auth',
    'method'  => 'POST|GET'
  ),
  array(
    'pattern' => array(
      'site(/)field/(:any)/structure/(:any)/delete',
      'pages/(:all)/field/(:any)/structure/(:any)/delete',
    ),
    'action'  => 'StructureController::delete',
    'filter'  => 'auth',
    'method'  => 'POST|GET'
  ),

  // Search
  array(
    'pattern' => array(
      'site(/)search',
      'pages/(:all)/search',
    ),
    'action'  => 'PagesController::search',
    'filter'  => 'auth',
    'method'  => 'POST|GET'
  ),

  // New Page
  array(
    'pattern' => array(
      'site(/)add/(:any?)',
      'pages/(:all)/add/(:any?)',
    ),
    'action'  => 'PagesController::add',
    'filter'  => 'auth',
    'method'  => 'POST|GET'
  ),

  // Page
  array(
    'pattern' => 'pages/(:all)/edit',
    'action'  => 'PagesController::edit',
    'filter'  => 'auth',
    'method'  => 'POST|GET'
  ),

  // URL Settings
  array(
    'pattern' => 'pages/(:all)/url',
    'action'  => 'PagesController::url',
    'filter'  => 'auth',
    'method'  => 'POST|GET'
  ),

  // Toggle visibility
  array(
    'pattern' => 'pages/(:all)/toggle',
    'action'  => 'PagesController::toggle',
    'filter'  => 'auth',
    'method'  => 'POST|GET'
  ),

  // Delete a page
  array(
    'pattern' => 'pages/(:all)/delete',
    'action'  => 'PagesController::delete',
    'filter'  => 'auth',
    'method'  => 'POST|GET'
  ),

  // Keeping page changes
  array(
    'pattern' => array(
      'site(/)keep',
      'pages/(:all)/keep',
    ),
    'action'  => 'PagesController::keep',
    'method'  => 'GET|POST',
    'filter'  => 'auth',
  ),

  // Discarding page changes
  array(
    'pattern' => array(
      'site(/)discard',
      'pages/(:all)/discard',
    ),
    'action'  => 'PagesController::discard',
    'method'  => 'GET|POST',
    'filter'  => 'auth',
  ),

  // Page context menu
  array(
    'pattern' => 'pages/(:all)/context',
    'action'  => 'PagesController::context',
    'method'  => 'GET',
    'filter'  => 'auth',
  ),

  // Upload a file
  array(
    'pattern' => array(
      'site(/)upload',
      'pages/(:all)/upload',
    ),
    'action'  => 'FilesController::upload',
    'filter'  => 'auth',
    'method'  => 'POST'
  ),

  // Subpages
  array(
    'pattern' => array(
      'site(/)subpages',
      'pages/(:all)/subpages',
    ),
    'action'  => 'SubpagesController::index',
    'filter'  => 'auth',
    'method'  => 'POST|GET'
  ),

  // Users
  array(
    'pattern' => 'users',
    'action'  => 'UsersController::index',
    'filter'  => 'auth'
  ),
  array(
    'pattern' => 'users/add',
    'action'  => 'UsersController::add',
    'filter'  => 'auth',
    'method'  => 'POST|GET'
  ),
  array(
    'pattern' => 'users/(:any)/edit',
    'action'  => 'UsersController::edit',
    'filter'  => 'auth',
    'method'  => 'POST|GET'
  ),
  array(
    'pattern' => 'users/(:any)/delete',
    'action'  => 'UsersController::delete',
    'filter'  => 'auth',
    'method'  => 'POST|GET'
  ),

  // Avatars
  array(
    'pattern' => 'users/(:any)/avatar',
    'action'  => 'AvatarsController::upload',
    'filter'  => 'auth',
    'method'  => 'POST'
  ),
  array(
    'pattern' => 'users/(:any)/avatar/delete',
    'action'  => 'AvatarsController::delete',
    'filter'  => 'auth',
    'method'  => 'POST|GET'
  ),

  // helpers
  array(
    'pattern' => 'api/slug',
    'action'  => 'HelpersController::slug',
    'filter'  => 'auth',
  ),
  array(
    'pattern' => 'api/autocomplete/(:any)',
    'action'  => 'HelpersController::autocomplete',
    'filter'  => 'auth',
  ),

);