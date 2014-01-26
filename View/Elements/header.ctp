<header role="banner" class="navbar navbar-inverse navbar-fixed-top bs-docs-nav">
  <div class="container">
    <div class="navbar-header">
      <button data-target=".bs-navbar-collapse" data-toggle="collapse" type="button" class="navbar-toggle">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?=$this->Html->link("Amanager", array('controller'=>'amanager'),array('title'=>'Amanager', 'escape'=>false, 'class'=>'navbar-brand'));?>
    </div>
    <?php echo $this->element('navbar-fixed-top'); ?>
  </div>
</header>