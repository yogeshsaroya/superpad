<?php $this->assign('title', 'New IDO Applications'); ?>
<style> 
img {
    vertical-align: middle;
    border-style: none;
    background: #fff;
}
</style>
<div class="app-content content ">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">New IDO Applications</h2>

                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12  ">
                
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
                                        <th><?php echo $this->Paginator->sort('name'); ?></th>
                                        <th><?php echo $this->Paginator->sort('token_name'); ?></th>
                                        <th><?php echo $this->Paginator->sort('token_symbol'); ?></th>
                                        <th><?php echo $this->Paginator->sort('blockchain') ?></th>
                                        <th><?php echo $this->Paginator->sort('email') ?></th>
                                        <th><?php echo $this->Paginator->sort('audited') ?></th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($data)) {
                                        foreach ($data as $list) { ?>
                                            <tr>
                                                <td><?php echo $list->name;?></td>
                                                <td><?php echo $list->token_name;?></td>
                                                <td><?php echo $list->token_symbol;?></td>
                                                <td><?php echo $list->blockchain;?></td>
                                                <td><?php echo $list->email;?></td>
                                                <td><?php echo $list->audited;?></td>
                                                <td><?php echo $this->Html->link(' View ', SITEURL . "pages/view_ido/".$list->id,['class'=>'magnificAjax']); ?></td>
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