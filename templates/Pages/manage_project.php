<?php
/*https://trentrichardson.com/examples/timepicker/#slider_examples */
echo $this->Html->css(['//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css', 'jquery-ui-timepicker-addon'], ['block' => 'css']);
echo $this->Html->script(['//code.jquery.com/ui/1.13.1/jquery-ui.js', 'jquery-ui-timepicker-addon'], ['block' => 'script']);


$getStatus = getStatus();
$type = getProjectType();
$status = ['TBA' => 'TBA', 'Coming Soon' => 'Coming Soon'];
$appStatus = getAppStatus();
$this->assign('title', 'Manage Projects'); ?>
<style>
    .input-group-text {
        border-radius: 0px;
        cursor: pointer;
    }

    .form-control.datetimepicker {
        border-radius: 0px;
    }
</style>
<?php /* ?>
<link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>app-assets/vendors/css/pickers/pickadate/pickadate.css">
<link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
<link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>app-assets/css/plugins/forms/pickers/form-pickadate.css">
<?php */ ?>

<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0"><?php echo (isset($get_data->title) ? $get_data->title :  "Add New Project") ?> </h2>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-6 col-12  ">
                <div class="form-group breadcrumb-right">
                    <div class="dropdown">
                        <?php if (isset($get_data->id) && !empty($get_data->id)) { ?>
                            <?php echo $this->Html->link('Add New Team', 'javascript:void(0);', ['onclick' => 'addTeam(' . $get_data->id . ')', 'class' => 'btn btn-primary']); ?>
                            <?php echo $this->Html->link('Add New Partner', 'javascript:void(0);', ['onclick' => 'addPartner(' . $get_data->id . ')', 'class' => 'btn btn-primary']); ?>
                            <?php echo $this->Html->link('Add New Social Media Account', 'javascript:void(0);', ['onclick' => 'addMedia(' . $get_data->id . ')', 'class' => 'btn btn-primary']); ?>
                            <?php echo $this->Html->link('Add Token Distributions', 'javascript:void(0);', ['onclick' => 'tokenDistributions(' . $get_data->id . ')', 'class' => 'btn btn-primary']); ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">

            <?php if (isset($get_data->id) && !empty($get_data->id)) { ?>
                <div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"><a class="nav-link <?php echo ($tab == 'home' ? 'active' : null); ?>" href="<?php echo SITEURL . "pages/manage_project/" . $get_data->id; ?>">Product</a></li>
                        <li class="nav-item"><a class="nav-link <?php echo ($tab == 'team' ? 'active' : null); ?>" href="<?php echo SITEURL . "pages/manage_project/" . $get_data->id . "?type=team"; ?>">Team</a></li>
                        <li class="nav-item"><a class="nav-link <?php echo ($tab == 'partner' ? 'active' : null); ?>" href="<?php echo SITEURL . "pages/manage_project/" . $get_data->id . "?type=partner"; ?>">Partner and Investor</a></li>
                        <li class="nav-item"><a class="nav-link <?php echo ($tab == 'media' ? 'active' : null); ?>" href="<?php echo SITEURL . "pages/manage_project/" . $get_data->id . "?type=media"; ?>">Social Media Accounts</a></li>
                        <li class="nav-item"><a class="nav-link <?php echo ($tab == 'applications' ? 'active' : null); ?>" href="<?php echo SITEURL . "pages/manage_project/" . $get_data->id . "?type=applications"; ?>">Applications</a></li>
                        <li class="nav-item"><a class="nav-link <?php echo ($tab == 'token_distributions' ? 'active' : null); ?>" href="<?php echo SITEURL . "pages/manage_project/" . $get_data->id . "?type=token_distributions"; ?>">Token Distributions</a></li>


                    </ul>
                </div>
            <?php } ?>

            <!-- Blog Edit -->
            <div class="blog-edit-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <?php if ($tab == 'home') { ?>
                                <div class="card-body">
                                    <?php
                                    echo $this->Form->create($get_data, ['autocomplete' => 'off', 'id' => 'e_frm', 'class' => 'mt-2', 'data-toggle' => 'validator']);
                                    echo $this->Form->hidden('id');
                                    $file_req = true;
                                    if (isset($get_data->id) && !empty($get_data->id)) {
                                        $file_req = false;
                                    }
                                    $pro_st = true;
                                    if (!in_array($get_data->product_status, ['TBA', 'Coming Soon'])) {
                                        $pro_st = false;
                                    } ?>

                                    <div class="row">
                                        <div class="col-md-2 col-12 form-group mb-2"><?php echo $this->Form->control('title', ['label' => ['escape' => false, 'text' => 'Title <small>(unique project title)</small>'], 'class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-2 col-12 form-group mb-2"><?php echo $this->Form->control('heading', ['class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-2 col-12 form-group mb-2"><?php echo $this->Form->control('website', ['type' => 'url', 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-2 col-12 form-group mb-2"><?php echo $this->Form->control('whitepaper', ['type' => 'url', 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-2 col-12 form-group mb-2"><?php echo $this->Form->control('coin_id', ['type' => 'text', 'label' => ['escape' => false, 'text' => 'Coin ID <small>(unique coin id)</small>'], 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-2 col-12 form-group mb-2"><?php echo $this->Form->control('ticker', ['label' => ['escape' => false, 'text' => 'Tiker <small>(unique tiker name)</small>'], 'class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-2 col-12 form-group mb-2"><?php echo $this->Form->control('slug', ['class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-2 col-12 form-group mb-2"><?php echo $this->Form->control('type', ['options' => $type, 'empty' => 'Select Type', 'class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-2 col-12 form-group mb-2"><?php echo $this->Form->control('blockchain_id', ['options' => $this->Data->getBlockchains('list'), 'empty' => 'Select Blockchain Network', 'class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-2 col-12 form-group mb-2"><?php echo $this->Form->control('status', ['options' => $getStatus, 'class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-2 col-12 form-group mb-2"><?php echo $this->Form->control('total_raise', ['class' => 'form-control amt', 'placeholder' => '00.00', 'required' => false]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-2 col-12 form-group mb-2"><?php echo $this->Form->control('ticket_allocation', ['class' => 'form-control amt', 'placeholder' => '00.00', 'required' => false]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-2 col-12 form-group mb-2"><?php echo $this->Form->control('price_per_token', ['type'=>'text','label' => ['escape' => false, 'text' => 'Sale Price <small>(Price per token)</small>'], 'class' => 'form-control amt', 'placeholder' => '00.00', 'required' => false]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-2 col-12 form-group mb-2"><?php echo $this->Form->control('initial_market_cap', ['class' => 'form-control amt numeral-mask', 'placeholder' => '00.00', 'required' => false]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-2 col-12 form-group mb-2"><?php echo $this->Form->control('initial_token_circulation', ['class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-2 col-12 form-group mb-2"><?php echo $this->Form->control('total_supply', ['class' => 'form-control amt numeral-mask', 'placeholder' => '00.00', 'required' => false]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-2 col-12 form-group mb-2"><?php echo $this->Form->control('product_status', ['options' => ($pro_st === true ? $status : null), 'empty' => 'Select Status', 'class' => 'form-control', 'required' => $pro_st, 'disabled' => ($pro_st === true ? false : true)]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-2 col-12 form-group mb-2"><?php echo $this->Form->control('token_required', ['options' => ['1' => 'Yes', '2' => 'No'], 'empty' => 'Select', 'class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-2 col-12 form-group mb-2"><?php echo $this->Form->control('coin_name', ['label' => ['escape' => false, 'text' => 'Coin Short Name'], 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-2 col-12 form-group mb-2"><?php echo $this->Form->control('coin_price', ['label' => ['escape' => false, 'text' => 'Coin Price in dollar'], 'class' => 'form-control amt numeral-mask', 'placeholder' => '00.00', 'required' => false]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-2 col-12 form-group mb-2"><?php echo $this->Form->control('max_allocation', ['label' => ['escape' => false, 'text' => 'Max Allocation in dollar <small>only if Token Required is No</small>'], 'class' => 'form-control amt numeral-mask', 'placeholder' => '00.00', 'required' => false]); ?><div class="help-block with-errors"></div>
                                        </div>

                                    </div>
                                    <hr><br>
                                    <div class="row">

                                        <div class="col-md-2 col-12 form-group mb-2">
                                            <label for="basic-url" class="form-label">Whitelist Starts In <small>(status will be coming soon)</small></label>
                                            <div class="input-group "><?php echo $this->Form->control('whitelist_starts', ['id' => 'ste_1_date', 'type' => 'text', 'value' => $get_data->whitelist_starts ? $get_data->whitelist_starts->format('Y-m-d H:i') : '', 'label' => false, 'class' => 'form-control datetimepicker', 'required' => false]); ?>
                                                <span class="input-group-text" id="step_1">Clear</span>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="col-md-2 col-12 form-group mb-2">
                                            <label for="basic-url" class="form-label">Whitelist Ends In <small>(status will be coming soon)</small></label>
                                            <div class="input-group "><?php echo $this->Form->control('whitelist_ends', ['id' => 'ste_2_date', 'type' => 'text', 'value' => $get_data->whitelist_ends ? $get_data->whitelist_ends->format('Y-m-d H:i') : '', 'label' => false, 'class' => 'form-control datetimepicker', 'required' => false]); ?>
                                                <span class="input-group-text" id="step_2">Clear</span>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="col-md-2 col-12 form-group mb-2">
                                            <label for="basic-url" class="form-label">Sale Starts In <small>(status will be Whitelist Closed)</small></label>
                                            <div class="input-group "><?php echo $this->Form->control('sale_starts', ['id' => 'ste_3_date', 'type' => 'text', 'value' => $get_data->sale_starts ? $get_data->sale_starts->format('Y-m-d H:i') : '', 'label' => false, 'class' => 'form-control datetimepicker', 'required' => false]); ?>
                                                <span class="input-group-text" id="step_3">Clear</span>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="col-md-2 col-12 form-group mb-2">
                                            <label for="basic-url" class="form-label">Sale Ends In <small>(status will be Live Now)</small></label>
                                            <div class="input-group "><?php echo $this->Form->control('sale_ends', ['id' => 'ste_4_date', 'type' => 'text', 'value' => $get_data->sale_ends ? $get_data->sale_ends->format('Y-m-d H:i') : '', 'label' => false, 'class' => 'form-control datetimepicker', 'required' => false]); ?>
                                                <span class="input-group-text" id="step_4">Clear</span>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-2 col-12 form-group mb-2">
                                            <label for="basic-url" class="form-label">Token Distribution Starts In <small>(status will sold out)</small></label>
                                            <div class="input-group "><?php echo $this->Form->control('token_distribution_starts', ['id' => 'ste_5_date', 'type' => 'text', 'value' => $get_data->token_distribution_starts ? $get_data->token_distribution_starts->format('Y-m-d H:i') : '', 'label' => false, 'class' => 'form-control datetimepicker', 'required' => false]); ?>
                                                <span class="input-group-text" id="step_5">Clear</span>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                    </div>
                                    <hr><br>
                                    <div class="row">
                                        <div class="col-md-6 col-12 form-group mb-2"><?php echo $this->Form->control('meta_title', ['type' => 'text', 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-6 col-12 form-group mb-2"><?php echo $this->Form->control('meta_description', ['type' => 'text', 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-22 col-12 form-group mb-2"><?php echo $this->Form->control('description', ['id' => 'editor', 'type' => 'textarea', 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-22 col-12 form-group mb-2"><?php echo $this->Form->control('tokenomics', ['id' => 'tokenomics', 'type' => 'textarea', 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <hr><br>
                                        <div class="col-4 form-group">
                                            <h4 class="mb-1">Logo <small>(Image size should be 400x400px or 200x200px or 1:1 aspect ratio)</small></h4>
                                            <?php echo $this->Form->file('logo_img', ['label' => 'Logo', 'required' => $file_req]) ?><div class="help-block with-errors"></div>
                                        </div>

                                        <div class="col-4 form-group">
                                            <h4 class="mb-1">Hero Image <small>(image size should be 500×375px or 4:3 aspect ratio)</small></h4>
                                            <?php echo $this->Form->file('hero_img', ['label' => 'Hero Image', 'required' => $file_req]) ?><div class="help-block with-errors"></div>
                                        </div>

                                        <div class="col-4 form-group">
                                            <h4 class="mb-1">Banner Image <small>(image size should be 1080*360 or 1024x768px or 16:9 aspect ratio)</small></h4>
                                            <?php echo $this->Form->file('banner_img', ['label' => 'Banner Image', 'required' => $file_req]) ?><div class="help-block with-errors"></div>
                                        </div>


                                        <div class="col-12 mt-50">
                                            <div id="f_err"></div>
                                        </div>
                                        <div class="col-12 mt-50">
                                            <input type="button" class="btn btn-primary mr-1" value="Save Changes" id="save_frm" />

                                        </div>
                                    </div>
                                    </form>
                                    <!--/ Form -->
                                </div>
                            <?php } elseif ($tab == 'team') { ?>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><?php echo $this->Paginator->sort('position'); ?></th>
                                                <th><?php echo $this->Paginator->sort('img'); ?></th>
                                                <th><?php echo $this->Paginator->sort('title'); ?></th>
                                                <th><?php echo $this->Paginator->sort('heading'); ?></th>
                                                <th><?php echo $this->Paginator->sort('status'); ?></th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($data)) {
                                                foreach ($data as $list) { ?>
                                                    <tr>
                                                        <td><?php echo $list->position; ?></td>
                                                        <td><?php if (!empty($list->img)) {
                                                                echo $this->Html->image(SITEURL . 'cdn/team/' . $list->img, ['alt' => 'logo', 'width' => 100]);
                                                            } ?></td>
                                                        <td><?php echo $list->title; ?></td>
                                                        <td><?php echo $list->heading; ?></td>

                                                        <td><?php
                                                            if ($list->status == 1) {
                                                                echo $this->Html->link('Active', SITEURL . "pages/manage_project/$get_data->id?type=team&st=" . $list->id, ['class' => 'text-success']);
                                                            } else {
                                                                echo $this->Html->link('Inactive', SITEURL . "pages/manage_project/$get_data->id?type=team&st=" . $list->id, ['class' => 'text-danger']);
                                                            } ?>
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown"><i data-feather="more-vertical"></i></button>
                                                                <div class="dropdown-menu">
                                                                    <?php echo $this->Html->link('<i data-feather="edit-2" class="mr-50"></i> Edit', "javascript:void(0);", ['onclick' => "addTeam(" . $get_data->id . "," . $list->id . ")", 'escape' => false, 'class' => 'dropdown-item']); ?>
                                                                    <?php echo $this->Html->link('<i data-feather="trash" class="mr-50"></i> Delete', SITEURL . "pages/manage_project/$get_data->id?type=team&del=" . $list->id, ['escape' => false, 'class' => 'dropdown-item', 'onclick' => "return confirm('Are you sure you want to delete?')"]); ?>
                                                                </div>
                                                            </div>
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
                            <?php } elseif ($tab == 'partner') { ?>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><?php echo $this->Paginator->sort('logo'); ?></th>
                                                <th><?php echo $this->Paginator->sort('title'); ?></th>
                                                <th><?php echo $this->Paginator->sort('url'); ?></th>
                                                <th><?php echo $this->Paginator->sort('status') ?></th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($data)) {
                                                foreach ($data as $list) { ?>
                                                    <tr>
                                                        <td><?php if (!empty($list->logo)) {
                                                                echo $this->Html->image(SITEURL . 'cdn/partners/' . $list->logo, ['alt' => 'logo', 'width' => 100]);
                                                            } ?></td>
                                                        <td><?php echo $list->title; ?></td>
                                                        <td><?php echo $list->url; ?></td>
                                                        <td><?php
                                                            if ($list->status == 1) {
                                                                echo $this->Html->link('Active', SITEURL . "pages/manage_project/$get_data->id?type=partner&st=" . $list->id, ['class' => 'text-success']);
                                                            } else {
                                                                echo $this->Html->link('Inactive', SITEURL . "pages/manage_project/$get_data->id?type=partner&st=" . $list->id, ['class' => 'text-danger']);
                                                            } ?>
                                                        </td>


                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown"><i data-feather="more-vertical"></i></button>
                                                                <div class="dropdown-menu">
                                                                    <?php echo $this->Html->link('<i data-feather="edit-2" class="mr-50"></i> Edit', "javascript:void(0);", ['onclick' => "addPartner(" . $get_data->id . "," . $list->id . ")", 'escape' => false, 'class' => 'dropdown-item']); ?>
                                                                    <?php echo $this->Html->link('<i data-feather="trash" class="mr-50"></i> Delete', SITEURL . "pages/manage_project/$get_data->id?type=partner&del=" . $list->id, ['escape' => false, 'class' => 'dropdown-item', 'onclick' => "return confirm('Are you sure you want to delete?')"]); ?>
                                                                </div>
                                                            </div>
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
                            <?php } elseif ($tab == 'media') { ?>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><?php echo $this->Paginator->sort('type'); ?></th>
                                                <th><?php echo $this->Paginator->sort('heading'); ?></th>
                                                <th><?php echo $this->Paginator->sort('sub_heading'); ?></th>
                                                <th><?php echo $this->Paginator->sort('link') ?></th>
                                                <th><?php echo $this->Paginator->sort('featured'); ?></th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($data)) {
                                                foreach ($data as $list) { ?>
                                                    <tr>
                                                        <td><?php echo $list->type; ?></td>
                                                        <td><?php echo $list->heading; ?></td>
                                                        <td><?php echo $list->sub_heading; ?></td>
                                                        <td><?php echo $list->link; ?></td>
                                                        <td><?php
                                                            if ($list->featured == 1) {
                                                                echo $this->Html->link('Hide', SITEURL . "pages/manage_project/$get_data->id?type=media&st=" . $list->id, ['class' => 'text-danger']);
                                                            } else if ($list->featured == 2) {
                                                                echo $this->Html->link('Show', SITEURL . "pages/manage_project/$get_data->id?type=media&st=" . $list->id, ['class' => 'text-success']);
                                                            } ?>
                                                        </td>
                                                        <td><?php echo $this->Html->link('Delete', SITEURL . "pages/manage_project/$get_data->id?type=media&del=" . $list->id, ['escape' => false, 'class' => 'text-info', 'onclick' => "return confirm('Are you sure you want to delete?')"]); ?></td>
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
                            <?php } elseif ($tab == 'applications') { ?>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><?php echo $this->Paginator->sort('user.first_name', 'Full Name'); ?></th>
                                                <th><?php echo $this->Paginator->sort('user.address', 'Address'); ?></th>
                                                <th><?php echo $this->Paginator->sort('user.kyc_completed', 'KYC Status'); ?></th>
                                                <th><?php echo $this->Paginator->sort('twitter'); ?></th>
                                                <th><?php echo $this->Paginator->sort('telegram') ?></th>
                                                <th><?php echo $this->Paginator->sort('status', 'Application Status') ?></th>
                                                <th><?php echo $this->Paginator->sort('joined_usd', 'Joined $') ?></th>
                                                <th><?php echo $this->Paginator->sort('actual_spad', 'SPAD Staked') ?></th>
                                                <th><?php echo $this->Paginator->sort('available_token') ?></th>
                                                <th><?php echo $this->Paginator->sort('claimed_token') ?></th>
                                                <th><?php echo $this->Paginator->sort('created'); ?></th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($data)) {
                                                foreach ($data as $list) { ?>
                                                    <tr>
                                                        <td><?php echo $list->user->first_name . " " . $list->user->last_name; ?></td>
                                                        <td><?php echo $list->user->kyc_address . " <br>" . $list->user->kyc_city . " " . $list->user->kyc_state . "<br>" . @$list->user->country->name; ?></td>
                                                        <td><?php
                                                            if ($list->user->kyc_completed == 1) {
                                                                echo "In-Review";
                                                            } elseif ($list->user->kyc_completed == 2) {
                                                                echo "Approved";
                                                            } elseif ($list->user->kyc_completed == 3) {
                                                                echo "Rejected";
                                                            } else {
                                                                echo "Not Submitted";
                                                            } ?></td>
                                                        <td><?php echo $list->twitter; ?></td>
                                                        <td><?php echo $list->telegram; ?></td>
                                                        <td><?php echo (isset($appStatus[$list->status]) ?  $appStatus[$list->status] : null); ?></td>
                                                        <td><?php echo number_format($list->joined_usd, 2); ?></td>
                                                        <td><?php echo number_format($list->actual_spad); ?></td>
                                                        <td><?php echo number_format($list->available_token); ?></td>
                                                        <td><?php echo number_format($list->claimed_token); ?></td>
                                                        <td><?php echo $list->created->format('Y-m-d'); ?></td>
                                                        <td><?php echo $this->Html->link(' Delete', SITEURL . "pages/manage_project/" . $get_data->id . "?type=applications&del=" . $list->id, ['escape' => false, 'class' => '', 'onclick' => "return confirm('Are you sure you want to delete?')"]); ?></td>
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
                            <?php } elseif ($tab == 'token_distributions') { ?>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><?php echo $this->Paginator->sort('percentage'); ?></th>
                                                <th><?php echo $this->Paginator->sort('claim_date'); ?></th>
                                                <th>Edit</th>
                                                <th>Delete</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($data)) {
                                                foreach ($data as $list) { ?>
                                                    <tr>
                                                        <td><?php echo $list->percentage; ?></td>
                                                        <td><?php echo (!empty($list->claim_date) ? $list->claim_date->format('Y-m-d H:i A') : null); ?></td>
                                                        <td><?php echo $this->Html->link('Edit', "javascript:void(0);", ['onclick' => "tokenDistributions(" . $get_data->id . "," . $list->id . ")"]); ?></td>
                                                        <td><?php echo $this->Html->link(' Delete', SITEURL . "pages/manage_project/$get_data->id?type=token_distributions&del=" . $list->id, ['escape' => false,  'onclick' => "return confirm('Are you sure you want to delete?')"]); ?></td>
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
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo $this->Html->script(['//cdn.ckeditor.com/4.18.0/full-all/ckeditor.js']);
?>

<script>
    function tokenDistributions(pro_id, row_id) {
        if (row_id == null) {
            row_id = '';
        }
        var d = "<?php echo urlencode(SITEURL . "pages/token_distributions?"); ?>pro_id=" + pro_id + "&id=" + row_id;
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

    function addTeam(pro_id, row_id) {
        if (row_id == null) {
            row_id = '';
        }
        var d = "<?php echo urlencode(SITEURL . "pages/add_team?"); ?>pro_id=" + pro_id + "&team_id=" + row_id;
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

    function addPartner(pro_id, row_id) {
        if (row_id == null) {
            row_id = '';
        }
        var d = "<?php echo urlencode(SITEURL . "pages/add_partner?"); ?>pro_id=" + pro_id + "&partner_id=" + row_id;

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

    function addMedia(pro_id) {
        var d = "<?php echo urlencode(SITEURL . "pages/add_sm_account?"); ?>pro_id=" + pro_id;
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


    $(document).ready(function() {
        $('.datetimepicker').datetimepicker({
            dateFormat: 'yy-mm-dd',
            timeFormat: 'HH:mm',
        });


        $("#step_1").click(function() {
            $("#ste_1_date").val('');
        });
        $("#step_2").click(function() {
            $("#ste_2_date").val('');
        });
        $("#step_3").click(function() {
            $("#ste_3_date").val('');
        });
        $("#step_4").click(function() {
            $("#ste_4_date").val('');
        });
        $("#step_5").click(function() {
            $("#ste_5_date").val('');
        });


        $('.amt').keypress(function(event) {
            return isNumber(event, this)
        });

        $("#e_frm").validator();

        $("#save_frm").click(function() {
            $("#e_frm").ajaxForm({
                target: '#f_err',
                headers: {
                    'X-CSRF-Token': $('[name="_csrfToken"]').val()
                },
                beforeSubmit: function() {
                    $("#save_frm").prop("disabled", true);
                    $("#save_frm").html('Please wait..');
                },
                success: function(response) {
                    $("#save_frm").prop("disabled", false);
                    $("#save_frm").html('Save Changes');
                },
                error: function(response) {
                    $('#f_err').html('<div class="alert alert-danger">Sorry, this is not working at the moment. Please try again later.</div>');
                    $("#save_frm").prop("disabled", false);
                    $("#save_frm").html('Save Changes');
                },
            }).submit();
        });
    });

    (function(window, document, $) {
        'use strict';

        if (document.getElementById("editor") !== null) {

            var $ckfield = CKEDITOR.replace('editor');
            $ckfield.config.height = 300;
            $ckfield.on('change', function() {
                $ckfield.updateElement();
            });
        }


        if (document.getElementById("tokenomics") !== null) {
            var $ckfield1 = CKEDITOR.replace('tokenomics');
            $ckfield1.config.height = 300;
            $ckfield1.on('change', function() {
                $ckfield1.updateElement();
            });
        }




        var select = $('.select2');

        // Basic Select2 select
        select.each(function() {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>');
            $this.select2({
                // the following code is used to disable x-scrollbar when click in select input and
                // take 100% width in responsive also
                dropdownAutoWidth: true,
                width: '100%',
                dropdownParent: $this.parent()
            });
        });

    })(window, document, jQuery);
</script>