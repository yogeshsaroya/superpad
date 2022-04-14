<?php
$this->assign('title', 'Staking');
echo $this->element('profile/header', ['title' => 'Staking']); ?>
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
                                            <th scope="col">#</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Issue Date</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fs-13">
                                        <tr>
                                            <th scope="row"><a href="#">4947</a></th>
                                            <td>Patternlicious</td>
                                            <td>10-05-2019</td>
                                            <td>$599.00</td>
                                            <td><img src="images/brand/visa.png" alt=""></td>
                                            <td><span class="badge bg-success">Approved</span></td>
                                            <td><a href="#" class="icon-btn" title="Remore"><em class="ni ni-trash"></em></a></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><a href="#">4904</a></th>
                                            <td>Alex Smith</td>
                                            <td>10-05-2019</td>
                                            <td>$355.00</td>
                                            <td><img src="images/brand/paypal.png" alt=""></td>
                                            <td><span class="badge bg-success">Approved</span></td>
                                            <td><a href="#" class="icon-btn" title="Remore"><em class="ni ni-trash"></em></a></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><a href="#">4829</a></th>
                                            <td>Alex Smith</td>
                                            <td>10-05-2019</td>
                                            <td>$99.00</td>
                                            <td><img src="images/brand/a-express.png" alt=""></td>
                                            <td><span class="badge bg-danger">Declined</span></td>
                                            <td><a href="#" class="icon-btn" title="Remore"><em class="ni ni-trash"></em></a></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><a href="#">4840</a></th>
                                            <td>Patternlicious</td>
                                            <td>10-05-2019</td>
                                            <td>$399.00</td>
                                            <td><img src="images/brand/visa.png" alt=""></td>
                                            <td><span class="badge bg-success">Approved</span></td>
                                            <td><a href="#" class="icon-btn" title="Remore"><em class="ni ni-trash"></em></a></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><a href="#">4844</a></th>
                                            <td>Alex Smith</td>
                                            <td>10-05-2019</td>
                                            <td>$355.00</td>
                                            <td><img src="images/brand/paypal.png" alt=""></td>
                                            <td><span class="badge bg-success">Approved</span></td>
                                            <td><a href="#" class="icon-btn" title="Remore"><em class="ni ni-trash"></em></a></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><a href="#">4847</a></th>
                                            <td>Alex Smith</td>
                                            <td>10-05-2019</td>
                                            <td>$99.00</td>
                                            <td><img src="images/brand/a-express.png" alt=""></td>
                                            <td><span class="badge bg-danger">Declined</span></td>
                                            <td><a href="#" class="icon-btn" title="Remore"><em class="ni ni-trash"></em></a></td>
                                        </tr>
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