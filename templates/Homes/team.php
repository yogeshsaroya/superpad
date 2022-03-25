
<style>

/* PROFIL */
.blog .carousel-indicators {
	left: 0;
	top: auto;
    bottom: -40px;

}

/* The colour of the indicators */
.blog .carousel-indicators li {
    background: #a3a3a3;
    border-radius: 50%;
    width: 8px;
    height: 8px;
    margin-bottom:10px;
    
}

.blog .carousel-indicators .active {
background: #707070;
margin-bottom:10px;
}

.our-team-section {
  position: relative;
  padding-top: 40px;
  padding-bottom: 40px;
}
.our-team-section:before {
  position: absolute;
  top: -0;
  left: 0;
  content: " ";
  background: url(img/service-section-bottom.png);
  background-size: 100% 100px;
  width: 100%;
  height: 100px;
  float: left;
  z-index: 99;
}
.our-team {
  padding: 0 0 40px;
  background: #f9f9f9;
  text-align: center;
  overflow: hidden;
  position: relative;
  border-bottom: 5px solid #00325a;
}
.our-team:hover {
  border-bottom: 5px solid #2f2f2f;
}

.our-team .pic {
  display: inline-block;
  width: 130px;
  height: 130px;
  margin-bottom: 50px;
  z-index: 1;
  position: relative;
}
.our-team .pic:before {
  content: "";
  width: 100%;
  height: 100%;
  border-radius: 50%;
  background: #00325a;
  position: absolute;
  bottom: 135%;
  right: 0;
  left: 0;
  opacity: 1;
  transform: scale(3);
  transition: all 0.3s linear 0s;
}
.our-team:hover .pic:before {
  height: 100%;
  background: #2f2f2f;
}
.our-team .pic:after {
  content: "";
  width: 100%;
  height: 100%;
  border-radius: 50%;
  background: #ffffff00;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 1;
  transition: all 0.3s linear 0s;
}
.our-team:hover .pic:after {
  background: #145889;
}
.our-team .pic img {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  transform: scale(1);
  transition: all 0.9s ease 0s;
  box-shadow: 0 0 0 14px #f7f5ec;
  transform: scale(0.7);
  position: relative;
  z-index: 2;
}
.our-team:hover .pic img {
  box-shadow: 0 0 0 14px #f7f5ec;
  transform: scale(0.7);
}
.our-team .team-content {
  margin-bottom: 30px;
}
.our-team .title {
  font-size: 22px;
  font-weight: 700;
  color: #4e5052;
  letter-spacing: 1px;
  text-transform: capitalize;
  margin-bottom: 5px;
}
.our-team .post {
  display: block;
  font-size: 15px;
  color: #4e5052;
  text-transform: capitalize;
}
.our-team .social {
  width: 100%;
  padding-top: 10px;
  margin: 0;
  background: #2f2f2f;
  position: absolute;
  bottom: -100px;
  left: 0;
  transition: all 0.5s ease 0s;
}
.our-team:hover .social {
  bottom: 0;
}
.our-team .social li {
  display: inline-block;
}
.our-team .social li a {
  display: block;
  padding-top: 6px;
  font-size: 15px;
  color: #fff;
  transition: all 0.3s ease 0s;
}
.our-team .social li a:hover {
  color: #145889;
  background: #f7f5ec;
}
@media only screen and (max-width: 990px) {
  .our-team {
    margin-bottom: 10px;
  }
}


</style>
<div class="hero-wrap hero-wrap-2 section-space">
    <div class="container">

    <div class="row blog">
        <h1 class="center mx-auto text-center py-4">Our Team Members</h1>
       
	   <div class="col-md-12">
            <div id="blogCarousel" class="carousel slide" data-ride="carousel">

                <ol class="invisible carousel-indicators">
                    <li data-target="#blogCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#blogCarousel" data-slide-to="1"></li>
                </ol>

                <!-- Carousel items -->
                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="our-team">
                                    <div class="pic">
                                        <img src="https://i.ibb.co/L8Pj1mg/o6EuTCT6.jpg">
                                    </div>
                                    <div class="team-content">
                                        <h3 class="title">Dana Robins</h3>
                                        <span class="post">Marketing Consultant</span>
                                    </div>
                                    <ul class="social">
                                        <li>
                                            <a href="#" class="fa fa-envelope"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="our-team">
                                    <div class="pic">
                                        <img src="https://i.ibb.co/L8Pj1mg/o6EuTCT6.jpg">
                                    </div>
                                    <div class="team-content">
                                        <h3 class="title">John Doe</h3>
                                        <span class="post">Marketing Consultant</span>
                                    </div>
                                    <ul class="social">
                                        <li>
                                            <a href="#" class="fa fa-envelope"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="our-team">
                                    <div class="pic">
                                        <img src="https://i.ibb.co/L8Pj1mg/o6EuTCT6.jpg">
                                    </div>
                                    <div class="team-content">
                                        <h3 class="title">Markus Baas</h3>
                                        <span class="post">Financial Expert</span>
                                    </div>
                                    <ul class="social">
                                        <li>
                                            <a href="#" class="fa fa-envelope"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="our-team">
                                    <div class="pic">
                                        <img src="https://i.ibb.co/L8Pj1mg/o6EuTCT6.jpg">
                                    </div>
                                    <div class="team-content">
                                        <h3 class="title">Sophia Lee</h3>
                                        <span class="post">Customer Support</span>
                                    </div>
                                    <ul class="social">
                                        <li>
                                            <a href="#" class="fa fa-envelope"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--.row-->
                    </div>
                    <!--.item-->

                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="our-team">
                                    <div class="pic">
                                        <img src="https://i.ibb.co/L8Pj1mg/o6EuTCT6.jpg">
                                    </div>
                                    <div class="team-content">
                                        <h3 class="title">Ted Robbins</h3>
                                        <span class="post">Law Expert</span>
                                    </div>
                                    <ul class="social">
                                        <li>
                                            <a href="#" class="fa fa-envelope"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="our-team">
                                    <div class="pic">
                                        <img src="https://i.ibb.co/L8Pj1mg/o6EuTCT6.jpg">
                                    </div>
                                    <div class="team-content">
                                        <h3 class="title">Noel Flantier</h3>
                                        <span class="post">Marketing Consultant</span>
                                    </div>
                                    <ul class="social">
                                        <li>
                                            <a href="#" class="fa fa-envelope"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="our-team">
                                    <div class="pic">
                                        <img src="https://i.ibb.co/L8Pj1mg/o6EuTCT6.jpg">
                                    </div>
                                    <div class="team-content">
                                        <h3 class="title">Ernesto Appia</h3>
                                        <span class="post">Team Leader</span>
                                    </div>
                                    <ul class="social">
                                        <li>
                                            <a href="#" class="fa fa-envelope"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="our-team">
                                    <div class="pic">
                                        <img src="https://i.ibb.co/L8Pj1mg/o6EuTCT6.jpg">
                                    </div>
                                    <div class="team-content">
                                        <h3 class="title">Rosita Jimenez</h3>
                                        <span class="post">Marketing Consultant</span>
                                    </div>
                                    <ul class="social">
                                        <li>
                                            <a href="#" class="fa fa-envelope"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--.row-->
                    </div>
                    <!--.item-->

                </div>
                <!--.carousel-inner-->
            </div>
            <!--.Carousel-->

        </div>
    </div>
</div>
</div>

<div class="hero-wrap hero-wrap-2 section-space">
    <div class="container">
    </div>
</div>