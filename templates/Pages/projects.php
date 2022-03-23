<?php $this->assign('title', 'Manage Projects'); ?>
<div class="app-content content ">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Manage Projects</h2>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrumb-right">
                    <div class="dropdown">
                        <?php echo $this->Html->link('Add New Project', '/pages/manage_project', ['class' => 'btn btn-primary mr-1 waves-effect waves-float waves-light']); ?>
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
                                        <th><?php echo $this->Paginator->sort('logo'); ?></th>
                                        <th><?php echo $this->Paginator->sort('title'); ?></th>
                                        <th><?php echo $this->Paginator->sort('type'); ?></th>
                                        <th><?php echo $this->Paginator->sort('total_raise'); ?></th>
                                        <th><?php echo $this->Paginator->sort('ticket_allocation'); ?></th>
                                        <th><?php echo $this->Paginator->sort('initial_token_circulation'); ?></th>
                                        <th><?php echo $this->Paginator->sort('product_status'); ?></th>
                                        <th><?php echo $this->Paginator->sort('blockchain_id'); ?></th>
                                        <th><?php echo $this->Paginator->sort('start_date'); ?></th>
                                        <th><?php echo $this->Paginator->sort('end_date'); ?></th>
                                        <th><?php echo $this->Paginator->sort('is_featured'); ?></th>
                                        <th><?php echo $this->Paginator->sort('status') ?></th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($data)) {
                                        foreach ($data as $list) { ?>
                                            <tr>
                                                <td><?php echo $this->Html->image(SITEURL . 'cdn/project_logo/' . $list->logo, ['alt' => 'logo', 'width' => 64]); ?></td>
                                                <td><?php echo $this->Html->Link($list->title, SITEURL . "explore/" . $list->slug, ['target' => '_blank']); ?></td>
                                                <td><?php echo $list->type; ?></td>
                                                <td><?php echo $this->Number->currency($list->total_raise, 'USD'); ?></td>
                                                <td><?php echo $this->Number->currency($list->ticket_allocation,'USD'); ?></td>
                                                <td><?php echo number_format($list->initial_token_circulation); ?></td>
                                                <td><?php echo $list->product_status; ?></td>
                                                <td><?php if(isset($list->blockchain->name)) echo $list->blockchain->name; ?></td>
                                                <td><?php if(!empty($list->start_date)) echo $list->start_date->format('Y-m-d H:i A') ?></td>
                                                <td><?php if(!empty($list->end_date))  echo $list->end_date->format('Y-m-d H:i A') ?></td>
                                                <td><?php if ($list->is_featured == 1) {
                                                        echo 'Yes';
                                                    } ?></td>
                                                <td><?php
                                                    if ($list->status == 1) {
                                                        echo $this->Html->link('Active', SITEURL . "pages/projects?st=" . $list->id, ['class' => 'text-success']);
                                                    } else {
                                                        echo $this->Html->link('Inactive', SITEURL . "pages/projects?st=" . $list->id, ['class' => 'text-danger']);
                                                    } ?>
                                                </td>

                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown"><i data-feather="more-vertical"></i></button>
                                                        <div class="dropdown-menu">
                                                            <?php echo $this->Html->Link('<i data-feather="edit-2" class="mr-50"></i> Edit', SITEURL . "pages/manage_project/" . $list->id, ['escape' => false, 'class' => 'dropdown-item']); ?>
                                                            <?php echo $this->Html->Link('<i data-feather="settings" class="mr-50"></i> Featured Sale', SITEURL . "pages/projects?featured=" . $list->id, ['escape' => false, 'class' => 'dropdown-item', 'onclick' => "return confirm('Are you sure you want to make it Featured Sale?')"]); ?>
                                                            <?php echo $this->Html->Link('<i data-feather="trash" class="mr-50"></i> Delete', SITEURL . "pages/projects?del=" . $list->id, ['escape' => false, 'class' => 'dropdown-item', 'onclick' => "return confirm('Are you sure you want to delete?')"]); ?>
                                                            
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-xs-12">
                                    <?php

                                    if (isset($this->Paginator->numbers) && $this->Paginator->numbers > 1) { ?>
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
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>