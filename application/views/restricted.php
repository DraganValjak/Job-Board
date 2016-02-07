<?php
$this->load->view('header');
$this->load->view('top_panel');
$this->load->view('navigation');
?>
        <h1>Nemate pravopristupa ovoj stranici!</h1>
        <a href='<?php echo base_url()."login/login_view"; ?>'>Prijavite se</a>

<?php  $this->load->view('footer');?>
