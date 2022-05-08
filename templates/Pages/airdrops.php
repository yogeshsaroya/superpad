<?php $this->assign('title', 'AirDrops'); ?>
<div class="app-content content ">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">AirDrops</h2>

                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-6 col-12  ">
                <div class="form-group breadcrumb-right">
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
                                        <th>
                                            <div class="custom-control custom-checkbox selectAll">
                                                <input type="checkbox" class="custom-control-input" id="selectAllCheck" />
                                                <label class="custom-control-label font-weight-bolder pl-25" for="selectAllCheck"></label>
                                            </div>

                                        </th>
                                        <th><?php echo $this->Paginator->sort('twitter'); ?></th>
                                        <th><?php echo $this->Paginator->sort('telegram'); ?></th>
                                        <th><?php echo $this->Paginator->sort('wallet_address', 'BSC Wallet Address'); ?></th>
                                        <th><?php echo $this->Paginator->sort('created'); ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if (!empty($data)) {
                                        foreach ($data as $list) { ?>
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input list_box" value="<?php echo $list->id; ?>" id="customCheck_<?php echo $list->id; ?>" />
                                                        <label class="custom-control-label" for="customCheck_<?php echo $list->id; ?>"></label>
                                                    </div>
                                                </td>
                                                <td><?php echo $list->twitter; ?></td>
                                                <td><?php echo $list->telegram; ?></td>
                                                <td><?php echo $list->wallet_address; ?></td>
                                                <td><?php echo $list->created->format('Y-m-d H:i:s'); ?></td>

                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th colspan="5">
                                            <input type="button" value="Delete" class="" id="del_item" />

                                        </th>

                                    </tr>
                                </tfoot>

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

<?php
echo $this->Form->create($data, ['autocomplete' => 'off', 'id' => 'e_frm']);
echo $this->Form->end();
?>

<script>
    $('#del_item').on('click', function() {
        var array = [];
        $(".list_box:checked").each(function() { array.push($(this).val()); });
        if( array.length > 0 ){
            var frm = $("#e_frm").serializeArray();
            frm.push({name: "ids", value: array});
            $("#del_item").remove();
            $.ajax({
            type: 'POST',
            url: '<?php echo SITEURL; ?>pages/airdrops',
            data: frm,
            success: function(data) { $("#cover").html(data); },
            error: function(comment) { $("#cover").html(comment); }
        });
        }
    });

    $('#selectAllCheck').on('click', function() {
        $('.list_box').prop('checked', $(this).prop("checked"));
    });

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