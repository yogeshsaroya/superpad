<?php $this->assign('title', 'Manage Subscribers'); ?>
<style>
    .pagination {
        display: inline-block;
        padding-left: 0;
        margin: 20px 0;
        border-radius: 4px
    }

    .pagination>li {
        display: inline
    }

    .pagination>li>a,
    .pagination>li>span {
        position: relative;
        float: left;
        padding: 6px 12px;
        line-height: 1.42857143;
        text-decoration: none;
        color: #337ab7;
        background-color: #fff;
        border: 1px solid #ddd;
        margin-left: -1px
    }

    .pagination>li:first-child>a,
    .pagination>li:first-child>span {
        margin-left: 0;
        border-bottom-left-radius: 4px;
        border-top-left-radius: 4px
    }

    .pagination>li:last-child>a,
    .pagination>li:last-child>span {
        border-bottom-right-radius: 4px;
        border-top-right-radius: 4px
    }

    .pagination>li>a:hover,
    .pagination>li>span:hover,
    .pagination>li>a:focus,
    .pagination>li>span:focus {
        z-index: 2;
        color: #23527c;
        background-color: #eee;
        border-color: #ddd
    }

    .pagination>.active>a,
    .pagination>.active>span,
    .pagination>.active>a:hover,
    .pagination>.active>span:hover,
    .pagination>.active>a:focus,
    .pagination>.active>span:focus {
        z-index: 3;
        color: #fff;
        background-color: #337ab7;
        border-color: #337ab7;
        cursor: default
    }

    .pagination>.disabled>span,
    .pagination>.disabled>span:hover,
    .pagination>.disabled>span:focus,
    .pagination>.disabled>a,
    .pagination>.disabled>a:hover,
    .pagination>.disabled>a:focus {
        color: #777;
        background-color: #fff;
        border-color: #ddd;
        cursor: not-allowed
    }

    .pagination-lg>li>a,
    .pagination-lg>li>span {
        padding: 10px 16px;
        font-size: 18px;
        line-height: 1.3333333
    }

    .pagination-lg>li:first-child>a,
    .pagination-lg>li:first-child>span {
        border-bottom-left-radius: 6px;
        border-top-left-radius: 6px
    }

    .pagination-lg>li:last-child>a,
    .pagination-lg>li:last-child>span {
        border-bottom-right-radius: 6px;
        border-top-right-radius: 6px
    }

    .pagination-sm>li>a,
    .pagination-sm>li>span {
        padding: 5px 10px;
        font-size: 12px;
        line-height: 1.5
    }

    .pagination-sm>li:first-child>a,
    .pagination-sm>li:first-child>span {
        border-bottom-left-radius: 3px;
        border-top-left-radius: 3px
    }

    .pagination-sm>li:last-child>a,
    .pagination-sm>li:last-child>span {
        border-bottom-right-radius: 3px;
        border-top-right-radius: 3px
    }

    .pager {
        padding-left: 0;
        margin: 20px 0;
        list-style: none;
        text-align: center
    }

    .pager li {
        display: inline
    }

    .pager li>a,
    .pager li>span {
        display: inline-block;
        padding: 5px 14px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 15px
    }

    .pager li>a:hover,
    .pager li>a:focus {
        text-decoration: none;
        background-color: #eee
    }

    .pager .next>a,
    .pager .next>span {
        float: right
    }

    .pager .previous>a,
    .pager .previous>span {
        float: left
    }

    .pager .disabled>a,
    .pager .disabled>a:hover,
    .pager .disabled>a:focus,
    .pager .disabled>span {
        color: #777;
        background-color: #fff;
        cursor: not-allowed
    }

    .label {
        display: inline;
        padding: .2em .6em .3em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25em
    }

    a.label:hover,
    a.label:focus {
        color: #fff;
        text-decoration: none;
        cursor: pointer
    }

    .
</style>
<div class="app-content content ">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Manage Subscribers</h2>

                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
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
                                        <th><?php echo $this->Paginator->sort('email'); ?></th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($data)) {
                                        foreach ($data as $list) { ?>
                                            <tr>
                                                <td><?php echo $list->name; ?></td>
                                                <td><?php echo $list->email; ?></td>
                                                <td><?php
                                                    echo $this->Html->link('Delete', SITEURL . "pages/subscribers?del=" . $list->id, ['escape' => false, 'class' => 'text-danger', 'onclick' => "return confirm('Are you sure you want to delete?')"]);

                                                    ?>
                                                </td>


                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>


                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <?php

                            echo $this->Paginator->counter(
                                'Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total, starting on record {{start}}, ending on {{end}}'
                            );

                            if (isset($paging['Newsletters']['count']) && $paging['Newsletters']['count'] > 1) {
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
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>