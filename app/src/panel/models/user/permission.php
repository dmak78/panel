<?php

namespace Kirby\Panel\Models\User;

use Exception;
use Kirby\Panel\Models\Page\Blueprint;

class Permission {

  public $user;
  public $page;


  public function __construct($role, $page = null) {
    $this->role = $role;

    if(!is_null($page)) $this->page = $page;
  }

  public function hasPermission($permission) {
    $method = str_replace('panel.', '', $permission);
    $method = str_replace('.', '_', $method);
    $call   = array($this, $method);
    if(is_callable($call)) {
      return call_user_func($call);
    } else {
      throw new Exception('Call to missing permission function: ' . $method);
    }
  }


  // Site
  public function site_update() {
    return
      $this->role->hasPermission('panel.site.update');
  }


  // Page
  public function page_modify() {
    return
      $this->hasPermission('panel.page.update') or
      $this->hasPermission('panel.page.move') or
      $this->hasPermission('panel.page.hide') or
      $this->hasPermission('panel.page.delete');
  }

  public function page_update() {
    return
      $this->role->hasPermission('panel.page.update');
  }

  public function page_move() {
    return
      $this->role->hasPermission('panel.page.move');
  }

  public function page_hide() {
    return
      $this->role->hasPermission('panel.page.hide');
  }

  public function page_delete() {
    return
      $this->role->hasPermission('panel.page.delete');
  }


  // Subpages
  public function subpages_create() {
    return
      $this->role->hasPermission('panel.page.create');
  }

  public function subpages_modify() {
    foreach($this->page->children() as $subpage) {
      $this->page = $subpage;
      if($this->hasPermission('panel.page.modify')) return true;
    }
    return false;
  }

  public function subpages_sort() {
    return
      $this->role->hasPermission('panel.page.sort');
  }


  // File
  public function file_modify() {
    return
      $this->hasPermission('panel.file.replace') or
      $this->hasPermission('panel.file.update') or
      $this->hasPermission('panel.file.delete');
  }

  public function file_upload() {
    return
      $this->role->hasPermission('panel.file.upload');
  }

  public function file_replace() {
    return
      $this->role->hasPermission('panel.file.replace');
  }

  public function file_update() {
    return
      $this->role->hasPermission('panel.file.update');
  }

  public function file_delete() {
    return
      $this->role->hasPermission('panel.file.delete');
  }


  // User
  public function user_add() {
    return $this->role->hasPermission('panel.user.add');
  }

  public function user_edit() {
    return
      $this->role->hasPermission('panel.user.edit') or
      $this->hasPermission('panel.user.role');
  }

  public function user_role() {
    return $this->role->hasPermission('panel.user.role');
  }

  public function user_delete() {
    return $this->role->hasPermission('panel.user.delete');
  }


}
