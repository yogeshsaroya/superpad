<?php $this->assign('title', 'Manage Users'); ?>
<div class="app-content content ">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Manage Users</h2>

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
                                        <th><?php echo $this->Paginator->sort('first_name'); ?></th>
                                        <th><?php echo $this->Paginator->sort('last_name'); ?></th>
                                        <th><?php echo $this->Paginator->sort('email'); ?></th>
                                        <th>Staked</th>
                                        <th><?php echo $this->Paginator->sort('kyc_completed','KYC Status'); ?></th>
                                        <th><?php echo $this->Paginator->sort('status'); ?></th>
                                        <th><?php echo $this->Paginator->sort('created') ?></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($data)) {
                                        foreach ($data as $list) { 
                                           $token_balance = array_sum(array_column($list->user_stakes, 'balance')); ?>
                                            <tr>
                                                <td><?php echo $list->first_name; ?></td>
                                                <td><?php echo $list->last_name; ?></td>
                                                <td><?php echo $list->email; ?></td>
                                                <td><?php echo (isset($token_balance) ? number_format($token_balance) : null ); ?></td>
                                                <td><?php 
                                                if($list->kyc_completed == 0){ } 
                                                elseif($list->kyc_completed == 1){ echo '<span class="badge rounded-pill bg-warning text-dark">In Review</span>';} 
                                                elseif($list->kyc_completed == 2){ echo '<span class="badge rounded-pill bg-success">Verifid</span>';} 
                                                elseif($list->kyc_completed == 3){ echo '<span class="badge rounded-pill bg-danger">Rejected</span>';} 
                                                
                                                ?></td>
                                                <td><?php
                                                    if ($list->status == 1) {
                                                        echo $this->Html->link('Active', SITEURL . "pages/users?st=" . $list->id, ['class' => 'text-success']);
                                                    } else {
                                                        echo $this->Html->link('Inactive', SITEURL . "pages/users?st=" . $list->id, ['class' => 'text-danger']);
                                                    } ?>
                                                </td>
                                                <td><?php echo $list->created->format('d/m/Y'); ?></td>
                                                
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown"><i data-feather="more-vertical"></i></button>
                                                        <div class="dropdown-menu">
                                                            <?php echo $this->Html->link('<i data-feather="edit-2" class="mr-50"></i> Edit', SITEURL . "pages/manage_user/" . $list->id, ['escape' => false, 'class' => 'dropdown-item']); ?>
                                                            <?php if($list->kyc_completed != 0){ echo $this->Html->link('<i data-feather="edit-2" class="mr-50"></i> KYC ', SITEURL . "pages/manage_kyc/" . $list->id, ['escape' => false, 'class' => 'dropdown-item']);} ?>
                                                            <?php echo $this->Html->link('<i data-feather="trash" class="mr-50"></i> Delete', SITEURL . "pages/users?del=" . $list->id, ['escape' => false, 'class' => 'dropdown-item', 'onclick' => "return confirm('Are you sure you want to delete this user?')"]); ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>

                            <div class="card">
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
</div>