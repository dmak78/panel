<div class="big-header">
  <h1><?php __($page->title()) ?></h1>
</div>

<div class="section grey">
  <h2 class="hgroup cf">

    <span class="hgroup-options shiv shiv-dark shiv-left cf">
      <a class="hgroup-option-left" href="<?php _u() ?>">
        <?php i('arrow-circle-left', 'left')?> Back to Dashboard
      </a>
      <?php if($addbutton and $page->children()->count()): ?>
      <a data-modal title="+" class="hgroup-option-right" href="<?php __($addbutton->url() . '?_redirect=' . $page->uri('subpages')) ?>">
        <?php i('plus-circle', 'left') ?>
        Add Category
      </a>
      <?php endif ?>
    </span>
  </h2>

  <?php if($page->hasChildren()): ?>
  <div class="grid subpages-grid">

    <div class="grid-item">
      <h3>
        <a href="<?php echo $visible->firstPage() ?>">
          Content
        </a>
      </h3>

      <div class="dropzone subpages">
        <div class="items<?php e($sortable, ' sortable') ?>" id="visible-children" 
          data-flip="<?php echo $flip ?>" 
          data-start="<?php echo $visible->start() ?>" 
          data-total="<?php echo $visible->total() ?>"
          data-csrf="<?php echo panel()->csrf() ?>">
          <?php foreach($visible->pages() as $subpage): ?>
          <?php echo new Kirby\Panel\Snippet('subpages/custom/program_category', array('page' => $page, 'subpage' => $subpage)) ?>
          <?php endforeach ?>
        </div>
      </div>

      <?php echo $visible->pagination() ?>

      <?php if(!$visible->total()): ?>
      <div class="subpages-help subpages-help-left marginalia text">
        <?php _l('subpages.index.visible.help') ?>
      </div>
      <?php endif ?>

    </div><!--

 --><div class="grid-item">
      <h3>
        <a href="<?php echo $invisible->firstPage() ?>">
          Inactive
        </a>
      </h3>

      <div class="dropzone subpages">
        <div class="items<?php e($sortable, ' sortable') ?>" id="invisible-children">
        <?php foreach($invisible->pages() as $subpage): ?>
          <?php echo new Kirby\Panel\Snippet('subpages/custom/program_category', array('page' => $page, 'subpage' => $subpage)) ?>
        <?php endforeach ?>
        </div>
      </div>

      <?php echo $invisible->pagination() ?>

      <?php if(!$invisible->total()): ?>
      <div class="subpages-help subpages-help-right marginalia text">
        <?php _l('subpages.index.invisible.help') ?>
      </div>
      <?php endif ?>

    </div>

  </div>

  <?php else: ?>
    
    <?php if($addbutton): ?>
    <div class="instruction">
      <div class="instruction-content">
        <p class="instruction-text"><?php _l('subpages.index.add.first.text') ?></p>
        <a data-shortcut="+" data-modal class="btn btn-rounded" href="<?php __($addbutton->url() . '?_redirect=' . $page->uri('subpages')) ?>">
          <?php _l('subpages.index.add.first.button') ?>
        </a>
      </div>
    </div>
    <?php endif ?>

  <?php endif ?>

</div>

<script>

(function() {

  $('.visibility').on('click', function(e){
    e.preventDefault();
    var $this = $(e.target);
    var $item = $this.parents('.item');
    var id = $item.attr('id');
    $.post(window.location.href, {action: 'toggle', id: id}, function(data) {
      app.content.reload();
    });

  });

  $('.subpages .sortable').sortable({
    connectWith: '.sortable',
    update: function(e, ui) {

      var $this = $(this);
      console.log($this);
      if($this.attr('id') == 'visible-children') {

        var start = parseInt($this.data('start'));
        var total = $this.data('total');
        var flip  = $this.data('flip');
        var index = $this.find('.item').index(ui.item);
        var id    = ui.item.attr('id');

        if(flip == '1') {
          // if this is an invisible element the 
          // total number of items in the visible list has
          // to be adjusted to get the right result for the
          // sorting number
          if(ui.sender && ui.sender.attr('id') == 'invisible-children') {
            total++;
          }
          var to = total - start - index + 1;
        } else {
          var to = index + start;              
        }
        if(ui.item.parent().attr('id') !== 'invisible-children') {
          $.post(window.location.href, {action: 'sort', id: id, to: to}, function(data) {
            app.content.reload();
          });
        }

      }
    },
    receive : function(event, ui) {

      if($(this).attr('id') == 'invisible-children') {
        $.post(window.location.href, {action: 'hide', id: ui.item.attr('id')}, function(data) {
          app.content.reload();
        });
      }

    }
  }).disableSelection();

})();

</script>