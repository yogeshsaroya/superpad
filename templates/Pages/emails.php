<?php $this->assign('title', 'Send Box - Email'); ?>
<style>
    
</style>
<div class="app-content content ">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Send Box - Email</h2>

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
                                        <th><?php echo $this->Paginator->sort('id'); ?></th>
                                        <th><?php echo $this->Paginator->sort('email_to'); ?></th>
                                        <th><?php echo $this->Paginator->sort('subject'); ?></th>
                                        <th><?php echo $this->Paginator->sort('status'); ?></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($data)) {
                                        foreach ($data as $list) { ?>
                                            <tr>
                                                <td><?php echo $list->id; ?></td>
                                                <td><?php echo $list->email_to; ?></td>
                                                <td><?php echo $this->Html->link($list->subject, SITEURL . "pages/read_email/".$list->id,['class'=>'magnificAjax']); ?></td>
                                                <td><?php 
                                                if($list->status == 1){ echo '<div class="badge badge-glow badge-success">Sent</div>';}
                                                elseif($list->status == 0){ echo '<div class="badge badge-secondary">Draft</div>';}
                                                else{ echo '<div class="badge badge-danger">Failed</div>';}  ?></td>
                                                <td><?php echo $this->Html->link(' View ', SITEURL . "pages/read_email/".$list->id,['class'=>'magnificAjax']); ?></td>
                                                

                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>


                        </div>

                    </div>

                    <div class="card">
                        <div class="card-header">
                            <?php echo $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total, starting on record {{start}}, ending on {{end}}');
                            //if (isset($paging['Newsletters']['count']) && $paging['Newsletters']['count'] > 1) {
                            ?>
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
                            <?php //} ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>