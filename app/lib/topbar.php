<?php

class Topbar {

  public $view = null;
  public $breadcrumb = array();
  public $html = null;

  public function __construct($view, $input) {

    $this->view = $view;

    $class = is_object($input) ? get_class($input) : (string)$input;
    $file  = panel()->roots()->topbars() . DS . str::lower($class) . '.php';

    if(file_exists($file)) {

      $callback = require($file);
      $callback($this, $input);

    } else {
      throw new Exception('Missing topbar definition');
    }

  }

  public function append($url, $title) {

    $this->breadcrumb[] = array(
      'title' => $title,
      'url'   => $url
    );

  }

  public function menu() {
    return new Snippet('menu');
  }

  public function breadcrumb() {
    return new Snippet('breadcrumb', array(
      'items' => $this->breadcrumb
    ));
  }

  public function message() {

    if($message = s::get('message') and is_array($message)) {

      $text = a::get($message, 'text');
      $type = a::get($message, 'type', 'notification');

      $element = new Brick('div');
      $element->addClass('message');

      if($type == 'error') {
        $element->addClass('message-is-alert');      
      } else {
        $element->addClass('message-is-notice');
      }

      $element->append(function() use($text) {
        $content = new Brick('span');
        $content->addClass('message-content');
        $content->text($text);
        return $content;
      });

      $element->append(function() {
        $toggle = new Brick('a');
        $toggle->attr('href', url::current());
        $toggle->addClass('message-toggle');
        $toggle->html('<i>&times;</i>');
        return $toggle;
      });

      s::remove('message');

      return $element;

    }

  }

  public function render() {

    $element = new Brick('header', '', array('class' => 'topbar'));
    $element->append($this->menu());
    $element->append($this->breadcrumb());
    $element->append($this->html);
    $element->append($this->message());

    return $element;

  }

  public function __toString() {
    return (string)$this->render();
  }

}