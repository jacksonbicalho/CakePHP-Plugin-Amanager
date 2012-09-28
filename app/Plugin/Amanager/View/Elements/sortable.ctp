<?php
  echo $this->Html->scriptBlock(
    '$(window).load(function () {

      // Return a helper with preserved width of cells
      var fixHelper = function(e, ui) {
        ui.children().each(function() {
          $(this).width($(this).width());

          $(this).children().each(function() {
            $(this).width($(this).width());
          });

        });
        return ui;
      };

      // Inicia os elementos com id sortable
      $("#sortable").sortable({
        helper: fixHelper,
      })


    });

    function openSortTableModal(){
      $("#actions-order").modal("show");
    }
    function closeSortTableModal(){
      $("#actions-order").modal("toggle");
    }
    ',
      array('inline' => false)
  );
  $this->Js->get('#salvar');
  $this->Js->event(
    'click',
    $this->Js->request(
      array(
        'action' => 'reorder',
        //'admin' => 'false',
      ),
      array(
        'method' => 'post',
        'dataExpression' => true,
        'data' => '$("#sortable").sortable("serialize")',
        'async' => true,
        'complete' => 'closeSortTableModal()'
      )
    )
  );
  $this->Js->get('#sortable');
  $this->Js->sortable(
    array(
      'cursor' => 'move',
      'axis' => 'y',
      'cancel'=> '.cancel',
      'helper'=> 'fixHelper',
      'update' => 'openSortTableModal()',
    )
  );
?>
    <div id="actions-order" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="actions-order-Label" aria-hidden="true">
      <div class="alert-info">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 class="alert-heading" id="actions-order-Label"><?php echo __('Attention!', true); ?></h3>
        </div>
        <div class="modal-body alert-info">
          <p><?php echo __('The new ordinance will only be saved when you click the save button.', true)?></p>
        </div>
      </div>
      <div class="modal-footer">
      <?php echo $this->Form->button(__('Save', true), array('action' => "#", 'id' => 'salvar', "class" => "btn", 'title' => 'Clique para salvar a nova ordenção' )); ?>
      <?php echo $this->Html->link(__('Cancel', true), $this->Html->url(null, true), array('id' => 'salvar', "class" => "btn", 'title' => 'Clique para salvar a nova ordenção')); ?>
      </div>
    </div>