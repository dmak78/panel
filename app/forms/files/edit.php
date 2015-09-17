<?php

return function($file) {

  // file info display
  $info = array();

  $info[] = $file->type();
  $info[] = $file->niceSize();

  if((string)$file->dimensions() != '0 x 0') {
    $info[] = $file->dimensions();
  }

  // setup the default fields
  $fields = array(
    '_name' => array(
      'label'     => 'files.show.name.label',
      'type'      => 'filename',
      'extension' => $file->extension(),
      'required'  => true,
      'default'   => $file->name(),
    ),
    '_info' => array(
      'label'    => 'files.show.info.label',
      'type'     => 'text',
      'readonly' => true,
      'icon'     => 'info',
      'default'  => implode(' / ', $info),
    ),
    '_link' => array(
      'label'    => 'files.show.link.label',
      'type'     => 'text',
      'readonly' => true,
      'icon'     => 'chain',
      'default'  => $file->url()
    )
  );

  $form = new Kirby\Panel\Form(array_merge($fields, $file->getFormFields()), $file->getFormData());

  $form->centered = true;
  $form->buttons->cancel = '';

  // disable form if permission is missing
  if(!panel()->user()->hasPermission('panel.file.update', $file->page())) {
    $form->buttons->submit = false;
    foreach($form->fields() as $field) {
        $field->readonly = true;
        $field->disabled = true;
    }
  }

  return $form;

};
