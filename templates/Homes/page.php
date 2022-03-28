<?php $this->assign('title', $data->title); ?>
<style>
    #cu_page td { padding: 0 20px 0 20px;}
    #cu_page ol, #cu_page ul {
    list-style: inside;
    line-height: 40px;
}
</style>
<section class="about-section pt-5 mt-3" id="cu_page">
    <div class="container">

        <div class="hero-content text-center py-0">
            <h1 class="hero-title"> <?php echo $data->title; ?> </h1>
            <br>
        </div>
        <?php echo $data->description; ?>
    </div>
</section>