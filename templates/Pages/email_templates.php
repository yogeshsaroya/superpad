<?php $this->assign('title', 'Manage Email Templates'); ?>
<div class="app-content content ">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Manage Email Templates</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->Paginator->sort('type'); ?></th>
                                        <th><?php echo $this->Paginator->sort('subject'); ?></th>
                                        <th><?php echo $this->Paginator->sort('status'); ?></th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($data)) {
                                        foreach ($data as $list) { ?>
                                            <tr>

                                                <td><?php echo $list->type; ?></td>
                                                <td><?php echo $list->subject; ?></td>
                                                <td><?php 
                                                if($list->status == 1){ echo $this->Html->link('Active',SITEURL . "pages/email_templates?st=".$list->id,['class'=>'text-success'] );  }
                                                else{ echo $this->Html->link('Inactive',SITEURL . "pages/email_templates?st=".$list->id,['class'=>'text-danger'] );  }
                                                ?></td>
                                                <td>
                                                <?php echo $this->Html->link('Edit', SITEURL . "pages/edit_email_templates/" . $list->id, ['escape' => false, 'class' => '']); ?>
                                                </td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>

                            <div class="card-header">
                            <?php echo $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total, starting on record {{start}}, ending on {{end}}'); ?>
                                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                    <ul class="pagination">
                                        <?php
                                        echo $this->Paginator->first(__('First', true), array('tag' => 'li', 'escape' => false), array('type' => "button", 'class' => "btn btn-default"));
                                        echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&laquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                                        echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentLink' => true, 'currentClass' => 'active', 'currentTag' => 'a'));
                                        echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&raquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                                        echo $this->Paginator->last(__('Last', true), array('tag' => 'li', 'escape' => false), array('type' => "button", 'class' => "btn btn-default"));
                                        ?>
                                    </ul>
                                </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>