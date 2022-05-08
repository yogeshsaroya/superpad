<?php $this->assign('title', 'Manage Stakes'); ?>
<div class="app-content content ">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Manage Stakes</h2>

                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-6 col-12">
                <div class="form-group breadcrumb-right">
                    <div class="dropdown">
                        <?php echo $this->Html->link('Add New Stake Condition', 'javascript:void(0);', ['onclick' => 'stake()', 'class' => 'btn btn-primary']); ?>
                        <?php echo $this->Html->link('Add New UnStake Condition', 'javascript:void(0);', ['onclick' => 'unstake()', 'class' => 'btn btn-primary']); ?>
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
                                        <th>#Stake</th>
                                        <th><?php echo $this->Paginator->sort('days'); ?></th>
                                        <th><?php echo $this->Paginator->sort('percentage'); ?></th>
                                        <th>Actions</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($data)) {
                                        foreach ($data as $list) { ?>
                                            <tr>
                                                <td><?php echo ($list->type == 1 ? 'Stake' : 'UnStake');?></td>
                                                <td><?php echo (isset($list->un_stake->days) ? "Stake #".$list->un_stake->days : null);?></td>
                                                <td><?php if($list->type == 1){ echo "Stake #".$list->days; }
                                                elseif($list->type == 2){ echo "unStake #".$list->days; } ?></td>
                                                <td><?php echo $list->percentage;?>%</td>
                                                <td><?php echo $this->Html->link(' Edit ', SITEURL . "pages/".($list->type == 1 ? 'add_stake': 'add_unstake')."/" . $list->id, ['class' => 'magnificAjax']); ?></td>
                                                <td><?php echo $this->Html->link(' Delete ', SITEURL . "pages/stakes/?del=" . $list->id, ['onclick' => "return confirm('Are you sure you want to delete?')"]); ?></td>
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

<script>
    function stake(id) {
        if (id == null) {
            id = '';
        }
        var d = "<?php echo urlencode(SITEURL . "pages/add_stake/"); ?>" + id;
        $.ajax({
            type: 'POST',
            url: '<?php echo SITEURL; ?>pages/open_pop/',
            data: {
                url: d
            },
            success: function(data) {
                $("#cover").html(data);
            },
            error: function(comment) {
                $("#cover").html(comment);
            }
        });
    }
    function unstake(id) {
        if (id == null) {
            id = '';
        }
        var d = "<?php echo urlencode(SITEURL . "pages/add_unstake/"); ?>" + id;
        $.ajax({
            type: 'POST',
            url: '<?php echo SITEURL; ?>pages/open_pop/',
            data: {
                url: d
            },
            success: function(data) {
                $("#cover").html(data);
            },
            error: function(comment) {
                $("#cover").html(comment);
            }
        });
    }
</script>