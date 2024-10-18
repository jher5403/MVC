<?php 
$this->view('includes/header');
$this->view('includes/login.modal');
$this->view('includes/register.modal');
?>

<div class='container' id="main-body">
    <h1>Home | <?=$this->displayType?> </h1>
    <div class="row" id="blog-row"></div>
</div>

<?php $this->view('includes/footer') ?>

