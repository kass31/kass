<h1>CodeIgniter Sign In With Google Account</h1>
<div class="wrapper">
    <div class="info-box">
        <p class="image"><img src="<?php echo @$userData['picture_url']; ?>" width="300" height="220"/></p>
        <p><b>Google ID: </b><?php echo @$userData['oauth_uid']; ?></p>
        <p><b>Nama: </b><?php echo @$userData['Nama Depan'].' '.@$userData['last_name']; ?></p>
        <p><b>Email: </b><?php echo @$userData['email']; ?></p>
        <p><b>Kelamain: </b><?php echo @$userData['kelamin']; ?></p>
        <p><b>Lokasi: </b><?php echo @$userData['lokasi']; ?></p>
        <p><b>Nama Lengkap: </b><?php echo $this->session->userdata('nama_lengkap'); ?></p>
        <p><b>Status: </b><?php echo $this->session->userdata('status'); ?></p>
        <p><b>Google Link: </b><a href="<?php echo @$userData['profile_url']; ?>" target="_blank"><?php echo @$userData['profile_url']; ?></a></p>
        <p><b>Logout from <a href="<?php echo base_url().'user_authentication/logout'; ?>">Google</a></b></p>
    </div>
</div> 