<?php $this->assign('title', 'My Staking');
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
            <h1 class="hero-title">My Staking</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-s1 justify-content-center mt-3 mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo SITEURL;?>dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Staking</li>
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
                        <th scope="col">Total Stakced</th>
                        <th scope="col">Staked On</th>
                        <th scope="col">Stake Period <small>(no penality after)</small></th>
                        <th scope="col">APY</th>
                        <th scope="col">Rewards to Date</th>
                        <th scope="col">Ticket Multiplier</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!$data->isEmpty()) {
                        foreach ($data as $list) { 
                            $ob = json_decode($list->stake_info);
                            
                            $reward = ($list->staked_token * $ob->percentage/100)/365 * $ob->days;
                            ?>
                            <tr>
                                <th scope="row"><?php echo number_format($list->staked_token);?></th>
                                <td><?php echo $list->stake_date->format("Y-m-d H:i A"); ?></td>
                                <td class="text-center"><?php echo ( $ob->days < 365 ? $ob->days." days" : ($ob->days/365)." year<small>(s)</small> " ); ?><br>
                                    <?php echo date("M d, Y H:i A", strtotime("+".$ob->days." days", strtotime($list->stake_date->format("Y-m-d H:i:s")))); ?> 
                                </td>
                                <td class="text-center"><?php echo $ob->percentage;?>%</td>
                                <td class="text-center"><?php echo number_format(round($reward)); ?></td>
                                <td class="text-center"><?php echo (isset($ob->tier->ticket_multiplier) ? $ob->tier->ticket_multiplier."x" : 'N.A');?></td>
                                <td> <input type="button" class="btn btn-dark" value="unStake"/> </td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="7">
                                <div class="alert alert-danger d-flex mb-4" role="alert">
                                    <p class="fs-14">You have not staked yet.</p>
                                </div>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</section>