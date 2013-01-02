<?php echo $this->Html->script('jquery/plugins/bootstrap-dropdown', array('inline' => false)); // Include jQuery library  ?>
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="/" class="brand">Acess Manager</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="">
                <a href="./index.html">Home</a>
              </li>
              <li class="active">
                <a href="./getting-started.html">Manager Users </a>
              </li>
              <li class="">
                <a href="./scaffolding.html">Manger Groups</a>
              </li>
              <li class="">
                <a href="./base-css.html">Manger Rules</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
