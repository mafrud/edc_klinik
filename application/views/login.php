<script type="text/javascript">
        $(window).load(function() { $(".progress progress-lg active").fadeOut("slow"); })
          $(window).load(function(){
            $(".progress-bar-striped").stop().animate({ width: "100%" },2000,function(){
                $(".progress-bar-striped").fadeOut("slow",function(){ $("#loading").remove(); });
            });
        });
        $(window).load(function() {
          $(".login-box").fadeOut();
            $.blockUI({ css: { 
                border: 'none', 
                padding: '15px', 
                backgroundColor: '#000', 
                '-webkit-border-radius': '10px', 
                '-moz-border-radius': '10px', 
                opacity: .5, 
                color: '#fff' 
            } }); 
            setTimeout($.unblockUI, 2000);
            $(".progress progress-lg active").delay(500).fadeOut("slow");
            $(".login-box").fadeIn();
        });
    </script>

<script src="<?=base_url('/assets/jquery.blockUI.js');?>"></script>
<div class="progress progress-lg active" id="loading">
  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="">
    <span class="sr-only">20% Complete</span>
  </div>
</div>


<div class="login-box">
  <div class="login-logo">
    <a href="#">e-Syst <b>EDC</b></a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
    <img class="profile-user-img img-responsive img-circle" src="<?=base_url('assets/dist/img/logo.png');?>" alt="User profile picture">
    <p class="login-box-msg">Sign in to start your session</p>
    <!-- <form method="post" name="form_login" id="form_login"> -->
    <?php echo form_open('login/cek_login'); ?>
      <div class="form-group has-feedback">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <input type="text" name="username" id="username" class="form-control" placeholder="Username Anda">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <!-- <input type="checkbox"> Remember Me -->
            </label>
          </div>
        </div><!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div><!-- /.col -->
      </div>
    </form>
  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
