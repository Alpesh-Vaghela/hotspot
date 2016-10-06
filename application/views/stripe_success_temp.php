<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="LineFi">
<meta name="author" content="LineFi">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<link rel="shortcut icon" href="/assets/favicon.ico" />
<meta property="og:site_name" content="LineFi" />
<meta content="website" property="og:type" />
<title>Stripe Payment Charged</title>
<link href="/assets/app/css/bootstrap.min.css" rel="stylesheet" />
<link href="/assets/app/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
<link href="/assets/app/css/jquery.maximage.min.css" rel="stylesheet" />
<style type="text/css">
    html { 
  background: url(/assets/fileuploads/8b5c61a30a967119c62deb0527f81be9.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
</style>
</head>

<body>
<?php if($this->session->flashdata('stripsuccess')){ ?>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Payment Charged Successfully</h4>
        </div>
        <div class="modal-body">
          <p><span style="color: green;"><?php echo $this->session->flashdata('stripsuccess'); ?></span> </p>
        </div>
        <div class="modal-footer">
          <a href="/welcome/getlokasyon/3598l5ef" class="btn btn-success">Return</a>
        </div>
      </div>
      
    </div>
  </div>
</div>
<?php } ?> 
<script src="/assets/app/js/jquery.min.js"></script>
<script src="/assets/app/js/bootstrap.min.js"></script>
<script src="/assets/app/js/jquery.plugin.min.js"></script>
<?php if($this->session->flashdata('stripsuccess')){ ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#myModal").modal('show');
    });
</script>
<?php } else { ?> 
<script type="text/javascript">
    window.location = "/welcome/getlokasyon/3598l5ef";
</script>
<?php } ?>
</body>
</html>