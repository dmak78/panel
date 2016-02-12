<div class="bars cf <?php e($page->blueprint()->show_sidebar(), ' bars-with-sidebar-left'); ?>">

  <?php if($page->blueprint()->show_sidebar()): ?>
  <?php echo $sidebar ?>
  <?php endif ?>

  <div class="mainbar">
    <div class="section">

      <?php if(!$page->isWritable()): ?>
      <div class="form">
        <h2 class="hgroup hgroup-single-line hgroup-compressed cf">
          <span class="hgroup-title"><?php _l('pages.show.error.permissions.title') ?></span>
        </h2>
        <div class="text">
          <p><?php _l('pages.show.error.permissions.text') ?></p>
        </div>
        <div>
          <a href="<?php __($page->url('edit')) ?>" class="btn btn-rounded">
            <?php _l('pages.show.error.permissions.retry') ?>
          </a>
        </div>
      </div>
      <?php else: ?>
      <?php echo $form ?>
      <?php endif ?>

    </div>
  </div>

</div>

<?php echo $uploader ?>