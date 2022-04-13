<?php $this->assign('title', 'Manage Tires');
$YesOrNo = YesOrNo(); ?>
<div class="app-content content ">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Manage Tires</h2>

                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrumb-right">
                    <div class="dropdown">
                        <?php echo $this->Html->link('Add New Tire', 'javascript:void(0);', ['onclick' => 'addTire()', 'class' => 'btn btn-primary mr-1 waves-effect waves-float waves-light']); ?>
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
                                        <th><?php echo $this->Paginator->sort('position', '#'); ?></th>
                                        <th><?php echo $this->Paginator->sort('title'); ?></th>
                                        <th><?php echo $this->Paginator->sort('spad'); ?></th>
                                        <th><?php echo $this->Paginator->sort('ticket_multiplier'); ?></th>
                                        <th><?php echo $this->Paginator->sort('cooldown') ?></th>
                                        <th><?php echo $this->Paginator->sort('social_task') ?></th>
                                        <th><?php echo $this->Paginator->sort('max_ticket_allocation') ?></th>
                                        <th><?php echo $this->Paginator->sort('guaranteed_allocation') ?></th>
                                        <th><?php echo $this->Paginator->sort('winning_chances') ?></th>
                                        <th>Actions</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($data)) {
                                        foreach ($data as $list) { ?>
                                            <tr>
                                                <td><?php echo $list->position; ?></td>
                                                <td><?php echo $list->title; ?></td>
                                                <td><?php echo $list->spad; ?></td>
                                                <td><?php echo $list->ticket_multiplier; ?></td>
                                                <td><?php echo $list->cooldown; ?></td>
                                                <td><?php echo $list->social_task; ?></td>
                                                <td><?php echo $list->max_ticket_allocation; ?></td>
                                                <td><?php echo $list->guaranteed_allocation; ?></td>
                                                <td><?php echo $list->winning_chances; ?></td>
                                                <td><?php echo $this->Html->link(' Edit ', SITEURL . "pages/add_tire/" . $list->id, ['class' => 'magnificAjax']); ?></td>
                                                <td><?php echo $this->Html->link(' Delete ', SITEURL . "pages/tiers/?del=" . $list->id, ['onclick' => "return confirm('Are you sure you want to delete?')"]); ?></td>
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
    function addTire(id) {
        if (id == null) {
            id = '';
        }
        var d = "<?php echo urlencode(SITEURL . "pages/add_tire/"); ?>" + id;
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