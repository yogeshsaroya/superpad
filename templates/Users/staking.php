<?php
$this->assign('title', 'Staking');
echo $this->element('profile/header', ['title' => 'My Stakes']); ?>
<section class="profile-section section-space">
    <div class="container">
        <div class="row">
        <?php echo $this->element('profile/menu', ['menu_act' => 'staking']); ?>
            <div class="col-lg-9 ps-xl-5">
                <div class="user-panel-title-box">
                    <h3>Account Settings</h3>
                </div><!-- end user-panel-title-box -->
                <div class="profile-setting-panel-wrap">
                            <div class="table-responsive">
                                <table class="table mb-0 table-s2">
                                    <thead class="fs-14">
                                        <tr>
                                            <th scope="col">Total Stakced</th>
                                            <th scope="col">Staked On</th>
                                            <th scope="col">Stake Period <small>(no penality after)</small></th>
                                            <th scope="col">APY</th>
                                            <th scope="col">Rewards to Date</th>
                                            <th scope="col">Ticket Multiplier</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fs-13">
                                    <?php if (!$data->isEmpty()) {
                        foreach ($data as $list) { ?>
                                        <tr>
                                            <th scope="row"><?php echo $list->staked_token;?></th>
                                            <td><?php echo $list->staked_token;?></td>
                                            <td><?php echo $list->staked_token;?></td>
                                            <td><?php echo $list->staked_token;?></td>
                                            <td><?php echo $list->staked_token;?></td>
                                            <td><?php echo $list->staked_token;?></td>
                                            <td><?php echo $list->staked_token;?></td>
                                        </tr>
                                    <?php }}?>   
                                    </tbody>
                                </table>
                            </div><!-- end table-responsive -->
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center mt-5 pagination-s1">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true" class="ni ni-chevron-left"></span>
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true" class="ni ni-chevron-right"></span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <p class="fs-13 mt-2 text-center">Showing 1 to 6 of 30 entries</p>
                        </div>
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end profile-section -->




<?php $this->Html->scriptStart(array('block' => 'scriptBottom')); ?>
$(document).ready(function(){


$("#e_frm").validator();

$( "#reg_sbtn" ).click(function() {
$("#e_frm").ajaxForm({
target: '#f_err',
headers : { 'X-CSRF-Token': $('[name="_csrfToken"]').val() },
beforeSubmit:function(){ console.log('clicked'); $("#reg_sbtn").prop("disabled",true); $("#reg_sbtn").val('Please wait..'); },
success: function(response) { $("#reg_sbtn").prop("disabled",false); $("#reg_sbtn").val('Create an Account'); },
error : function(response) {
$('#f_err').html('<div class="alert alert-danger">Sorry, this is not working at the moment. Please try again later.</div>');
$("#reg_sbtn").prop("disabled",false); $("#reg_sbtn").val('Create an Account');
},
}).submit();
});
});
<?php $this->Html->scriptEnd(); ?>