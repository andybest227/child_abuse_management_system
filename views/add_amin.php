<?php 
  include '../common/header.php';
 ?>

<body>
    <div class="main-wrapper">
    <?php include('../common/topbar.php');?>

  <div class="content-container">
    <div class="content-wrapper">
    <?php 
      include "../common/sidenav.php"
    ?>
    <div class="main-page">
      <div class="container-fluid bg-light px-4 pb-5 pt-3">
      <div class="mt-2 pb-2 mb-3 border-bottom">
        <span class="fs-5 me-2"><b>Add Administrator</b></span>| <span class="ms-2">Add admin or modrator</span>
      </div>    
      <div class="form-control mt-2 p-3">
          <form id="add-admin-form">
            <div class="input-group mb-3">
              <span class="input-group-text fl">Full Name:</span>
              <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text fl">Email Address:</span>
              <input type="email" id="email" name="email" required class="form-control">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text fl">Phone Number:</span>
              <input type="number" id="phone_number" name="phone_number" required class="form-control">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text fl">Contact address:</span>
              <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text fl">State:</span>
              <input type="text" class="form-control" id="state_origin" name="state_origin" required>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text fl">Country:</span>
              <input type="text" class="form-control" id="country" name="country" required>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text fl">Password:</span>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text fl">Comfirm Passward:</span>
              <input type="password" class="form-control" id="comfirm_password" name="comfirm_password" required>
            </div>
            <button type="submit" class="btn btn-outline-success form-control"><i class="fa fa-save"></i> Submit</button>
          </form>
      </div>
</div>
</div>
</div>
</div>
<?php 
  include "../common/footer.php"
 ?>
 <script type="text/javascript">
  /*loadAbusesTypes();
  const data = {'request_id': 'get_abuse_records'};
        loadAbuses($("#abuses-table"), data);*/
</script>