<?php $this->assign('title', 'Application List');
$appStatus = getAppStatus();
?>
<style>
    .ps--project-show__logo img {
        height: 5rem;
        width: 5rem;
        border-radius: 100%;
        margin-right: 20px;
    }
</style>
<div class="hero-wrap sub-header">
    <div class="container">
        <div class="hero-content text-center py-0">
            <h1 class="hero-title">Applications</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-s1 justify-content-center mt-3 mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo SITEURL; ?>dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Applications</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section class="activity-section section-space-b">
    <div class="container">

        <div class="gap-2x"></div>

        <div class="table-responsive">
            <table class="table mb-0 table-s1 fs-13 bg-gray">
                <thead>
                    <tr>
                        <th scope="col">Logo</th>
                        <th scope="col">IDO Name</th>
                        <th scope="col">IDO Price</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!$data->isEmpty()) {
                        foreach ($data as $list) { ?>
                            <tr>
                                <th scope="row" class="fw-regular ps--project-show__logo"><img src="<?php echo SITEURL . "cdn/project_logo/" . $list->project->logo; ?>" class="st_img hero_img" alt="<?php echo $list->project->title; ?>"></th>
                                <td><?php echo $list->project->title; ?></td>
                                <td><?php echo ($list->project->price_per_token > 0 ?  $this->Number->currency($list->project->price_per_token, 'USD') : 'TBA'); ?></td>
                                <td><?php if (isset($appStatus[$list->status])) {
                                        if ($list->status == 4) {
                                            echo $this->Html->link('Check Allocation', '/allocation', ['class' => 'text-success']);
                                        } else {
                                            echo $appStatus[$list->status];
                                        }
                                    } ?></td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="5">
                                <div class="alert alert-danger d-flex mb-4" role="alert">
                                    <p class="fs-14">You have not applied for any IDO yet.</p>
                                </div>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</section>