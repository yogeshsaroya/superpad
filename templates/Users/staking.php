<?php $this->assign('title', 'My Staking');
echo $this->Html->css(['magnific-popup'], ['block' => 'css']);
echo $this->Html->script(['jquery.magnific-popup.min'], ['block' => 'scriptBottom']);
$appStatus = getAppStatus();
?>
<style>
    .ps--project-show__logo img {
        height: 5rem;
        width: 5rem;
        border-radius: 100%;
        margin-right: 20px;
    }
    .container_page {
    padding: 0 100px 0 100px;
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
    <div class="container_page">

        <div class="gap-2x"></div>

        <div class="table-responsive1" id="no-more-tables">
            <table class="table mb-0 table-s1 fs-13 bg-gray">
                <thead>
                    <tr>
                        <th scope="col">Stakced <small>(a)</small> </th>
                        <th scope="col">Rewarded <small>(b)</small></th>
                        <th scope="col">Unstaked <small>(c)</small></th>
                        <th scope="col">Penalty <small>(d)</small></th>
                        <th scope="col">Available Stake <br><small>(a+b)-(c+d)</small></th>
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
                            $reward = ($list->staked_token * $ob->percentage/100)/365 * $ob->days; ?>
                            <tr>
                                <td data-title="Stakced"><?php echo number_format($list->staked_token);?></td>
                                <td data-title="Rewarded"><?php echo number_format($list->reward_token);?></td>
                                <td data-title="Unstaked"><?php echo number_format($list->unstaked_token);?></td>
                                <td data-title="Penalty"><?php echo number_format($list->penalty);?></td>
                                <td data-title="Available Stake"><?php echo number_format($list->balance);?></td>

                                <td data-title="Staked On"><?php echo $list->stake_date->format("Y-m-d H:i A"); ?></td>
                                <td class="text-center" data-title="Stake Period"><?php echo ( $ob->days < 365 ? $ob->days." days" : ($ob->days/365)." year<small>(s)</small> " ); ?><br>
                                    <?php echo date("M d, Y H:i A", strtotime("+".$ob->days." days", strtotime($list->stake_date->format("Y-m-d H:i:s")))); ?> 
                                </td>
                                <td class="text-center" data-title="APY"><?php echo $ob->percentage;?>%</td>
                                <td class="text-center" data-title="Rewards to Date"><?php echo number_format(round($reward)); ?></td>
                                <td class="text-center" data-title="Ticket Multiplier"><?php echo (isset($ob->tier->ticket_multiplier) ? $ob->tier->ticket_multiplier."x" : 'N.A');?></td>
                                <td data-title="Action"> 
                                    <?php if( (int)$list->balance > 0){?>
                                    <input type="button" class="btn btn-dark" value="unStake" onclick="unStake(<?php echo $list->id;?>);"/> 
                                    <?php }?>
                                </td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="11">
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


<?php $this->Html->scriptStart(array('block' => 'scriptBottom')); ?>
function unStake(id) {
        var d = "<?php echo urlencode(SITEURL . "users/un_stake/");?>"+id;
        $.ajax({
            type: 'POST',
            url: '<?php echo SITEURL; ?>homes/open_pop/1',
            data: {url:d},
            success: function(data) {
                $("#cover").html(data);
            },
            error: function(comment) {
                $("#cover").html(comment);
            }
        });
}
<?php $this->Html->scriptEnd(); ?>