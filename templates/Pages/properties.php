<?php $this->assign('title', 'Manage Properties');
$property_type = getPropertyType();
$Locations = getLocations();
?>
<div class="app-content content ">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Properties</h2>

                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrumb-right">
                    <div class="dropdown">
                        <?php echo $this->Html->link('Add New Property For Sell','/pages/manage_property/sell',['class'=>'btn btn-primary mr-1 waves-effect waves-float waves-light']);?>
                        <?php echo $this->Html->link('Add New Property For Rent','/pages/manage_property/rent',['class'=>'btn btn-primary mr-1 waves-effect waves-float waves-light']);?>
                        
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
                                        <th><?php echo $this->Paginator->sort('type', 'Type') ?></th>
                                        <th><?php echo $this->Paginator->sort('title', 'Title') ?></th>
                                        <th><?php echo $this->Paginator->sort('is_featured', 'Featured') ?></th>
                                        <th><?php echo $this->Paginator->sort('location', 'Location') ?></th>
                                        <th><?php echo $this->Paginator->sort('furnishing', 'Furnishing') ?></th>
                                        <th><?php echo $this->Paginator->sort('property_type', 'Property Type') ?></th>
                                        <th><?php echo $this->Paginator->sort('address', 'Address') ?></th>
                                        <th><?php echo $this->Paginator->sort('area', 'Area') ?></th>
                                        <th><?php echo $this->Paginator->sort('bedrooms', 'Bedrooms') ?></th>
                                        <th><?php echo $this->Paginator->sort('price', 'Price') ?></th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($data)) {
                                        foreach ($data as $list) { ?>
                                            <tr>
                                                <td><?php echo @$property_type[$list->type]; ?></td>
                                                <td><?php echo $this->Html->Link($list->title,SITEURL."property/".$list->url, ['target' => '_blank']); ?></td>
                                                <td><?php echo ($list->is_featured === 1 ? 'Yes':''); ?></td>
                                                <td><?php echo $list->location; ?></td>
                                                <td><?php echo $list->furnishing; ?></td>
                                                <td><?php echo $list->property_type; ?></td>
                                                <td><?php echo $list->address; ?></td>
                                                <td><?php echo $list->area; ?></td>
                                                <td><?php echo $list->bedrooms; ?></td>
                                                <td><?php echo $list->price; ?></td>
                                                
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown"><i data-feather="more-vertical"></i></button>
                                                        <div class="dropdown-menu">
                                                            <?php echo $this->Html->Link('<i data-feather="edit-2" class="mr-50"></i> Edit',SITEURL . "pages/manage_property/".($list->type == 1 ? 'sell':'rent')."/".$list->id,['escape' => false,'class'=>'dropdown-item']); ?>
                                                            <?php echo $this->Html->Link('<i data-feather="trash" class="mr-50"></i> Delete',SITEURL . "pages/properties?del=".$list->id,['escape' => false,'class'=>'dropdown-item', 'onclick' => "return confirm('Are you sure you want to delete this blog post?')"]); ?>
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

if(isset($this->Paginator->numbers) && $this->Paginator->numbers > 1){?>            
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
<?php }?>
</div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>