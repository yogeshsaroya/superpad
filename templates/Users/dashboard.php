<?php 
$this->assign('title', 'Dashboard');
echo $this->element('profile/header',['bg_color' => 'bg-gray' ]); ?>
<section class="profile-section section-space">
    <div class="container">
        <div class="row">
        <?php echo $this->element('profile/menu',['bg_color' => 'bg-gray' ]); ?>            
            <div class="col-lg-9 ps-xl-5">
                <div class="user-panel-title-box">
                    <h3>Account Settings</h3>
                </div><!-- end user-panel-title-box -->
                <div class="profile-setting-panel-wrap">
                    
                            <div class="profile-setting-panel">
                                <h5 class="mb-4">Edit Profile</h5>
                                <div class="row mt-4">
                                    <div class="col-lg-6 mb-3">
                                        <label for="displayName" class="form-label">Dispaly Name</label>
                                        <input type="text" id="displayName" class="form-control form-control-s1" value="Kamran Ahmed">
                                    </div><!-- end col -->
                                    <div class="col-lg-6 mb-3">
                                        <label for="displayUserName" class="form-label">Username</label>
                                        <input type="text" id="displayUserName" class="form-control form-control-s1" value="kamran_ahmed">
                                    </div><!-- end col -->
                                </div><!-- end row -->
                                <div class="mb-3">
                                    <label for="emailAddress" class="form-label">Email</label>
                                    <input type="email" id="emailAddress" class="form-control form-control-s1" value="kamran@gmail.com">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="facebookLink" class="form-label">Facebook Link</label>
                                        <input type="text" id="facebookLink" class="form-control form-control-s1" value="https://facebook.com/">
                                    </div><!-- end col -->
                                    <div class="col-lg-6 mb-3">
                                        <label for="twitterLink" class="form-label">Twiiter Link</label>
                                        <input type="text" id="twitterLink" class="form-control form-control-s1" value="https://twitter.com/">
                                    </div><!-- end col -->
                                    <div class="col-lg-6 mb-3">
                                        <label for="instagramLink" class="form-label">Instagram Link</label>
                                        <input type="text" id="instagramLink" class="form-control form-control-s1" value="https://facebook.com/">
                                    </div><!-- end col -->
                                    <div class="col-lg-6 mb-3">
                                        <label for="webLink" class="form-label">Web Link</label>
                                        <input type="text" id="webLink" class="form-control form-control-s1" value="https://kamran.bd.com/">
                                    </div><!-- end col -->
                                </div><!-- end row -->
                                <button class="btn btn-dark mt-3" type="button">Update Profile</button>
                    </div><!-- end tab-content -->
                </div><!-- end profile-setting-panel-wrap-->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end profile-section -->