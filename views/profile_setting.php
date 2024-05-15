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
        <span class="fs-5 me-2"><b>Update Administrator</b></span>| <span class="ms-2">Update admin or modrator information</span>
      </div>    
      <div class="form-control mt-2 p-3">
          <form id="update-admin-form">
            <input type="text" name="id" id="id" class="d-none">
            <div class="input-group mb-3">
              <span class="input-group-text fl">Full Name:</span>
              <input type="text" class="form-control" id="full_name" name="full_name" required>
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
            <span class="h6 text-danger mb-2">Fill the information below only if you wish to change your password</span>
            <div class="input-group mb-3">
              <span class="input-group-text fl">Current Password:</span>
              <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Optional">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text fl">New Passward:</span>
              <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Optional">
            </div>
            <button type="submit" class="btn btn-outline-success form-control"><i class="fa fa-refresh"></i> Update</button>
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
    loadAdminData();
</script>