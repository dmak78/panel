<?php

class ChildrenCollection extends Children {

  public function __construct($page) {

    parent::__construct($page);

    $page->reset();

    $inventory = $page->inventory();

    foreach($inventory['children'] as $dirname) {
      $child = new PageModel($page, $dirname);
      $this->data[$child->id()] = $child;
    }

    $sort = $page->blueprint()->pages()->sort();

    switch($sort) {
      case 'flip':
        $this->flip();
        break;
      default;
        $parts = str::split($sort, ' ');
        if(count($parts) > 0) {
          call(array($this, 'sortBy'), $parts);
        }
        break;
    }

  }

  public function create($uid, $template, $content = array()) {

    if(empty($template)) {
      throw new Exception(l('pages.add.error.template'));
    }

    $uid       = empty($uid) ? str::random(32) : $uid;
    $blueprint = blueprint::find($template);
    $data      = array();

    foreach($blueprint->fields() as $key => $field) {
      $data[$key] = $field->default();        
    }

    if(empty($data['title'])) {
      $data['title'] = '(' . l('untitled') . ')';
    }

    $data = array_merge($data, $content);

    // create the new page and convert it to a page model
    $page = new PageModel($this->page, parent::create($uid, $template, $data)->dirname());

    if(!$page) {
      throw new Exception('The page could not be created');
    }

    // subpage builder
    foreach((array)$page->blueprint()->pages()->build() as $build) {
      $missing = a::missing($build, array('title', 'template', 'uid'));
      if(!empty($missing)) continue;
      $page->children()->create($build['uid'], $build['template'], array('title' => $build['title']));
    }

    s::set('draft', $page->id());

    return $page;

  }


}