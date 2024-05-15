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
      <div class="container-fluid bg-light px-4">
      <div class="mt-2 pb-2 mb-3 border-bottom">
        <span class="fs-5 me-2"><b>Children</b></span>| <span class="ms-2">List of Children</span>
      </div>
      <div class="p-2 mb-3 bg-light">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addChildModal" data-bs-whatever="@mdo"><i class="fa fa-user-plus"></i> Add Child</button>
      </div> 
    
    <table id="children-table" class="small table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>S/N</th>
        <th>Date</th>
        <th>Names</th>
        <th>State</th>
        <th>Country</th>
        <th>Action</th>
      </tr>
    </thead>
  <tbody>
  </tbody>
</table>

<!-- ADD CHILD MODAL -->
<div class="modal fade" id="addChildModal" tabindex="-1" aria-labelledby="addChildModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Child</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
        <form id="add-child">
          <div class="mb-2">
            <label for="full_name" class="col-form-label">Full name:</label>
            <input type="text" class="form-control" id="full_name" required name="full_name">
          </div>
          <div class="mb-2">
            <label for="contact_address" class="col-form-label">Address:</label>
            <textarea class="form-control" id="contact_address" required name="contact_address"></textarea>
          </div>
          <div class="mb-2">
            <label for="state_origin" class="col-form-label">State of Origin:</label>
            <input type="text" class="form-control" id="state_origin" name="state_origin" required>
          </div>
          <div class="mb-2">
            <label for="father_name" class="col-form-label">Father's name:</label>
            <input type="text" class="form-control" id="father_name" name="father_name" required>
          </div>
          <div class="mb-2">
            <label for="phone_number" class="col-form-label">Father's Phone number:</label>
            <input type="number" maxlength="11" class="form-control" id="phone_number" name="phone_number" required>
          </div>
          <div class="mb-2">
            <label for="father_address" class="col-form-label">Father's Contact Address:</label>
            <textarea class="form-control" id="father_address" name="father_address" required></textarea>
          </div>
          <div class="mb-2">
            <label for="udate_father_state" class="col-form-label">Father's state of Origin:</label>
            <input type="text" class="form-control" id="udate_father_state" name="udate_father_state" required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline-success"><i class="fa fa-save"></i>Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- END ADD CHILD MODAL -->


  <!-- VIEW CHILD MODAL -->
<div class="modal fade" id="childDetailModal" tabindex="-1" aria-labelledby="childDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="childDetailLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <table class="table table-striped">
        <tr>
          <th>Address:</th><td id="child_address"></td>
        </tr>
        <tr>
          <th>State of Origin:</th><td id="child_state_origin"></td>
        </tr>
        <tr>
          <th>Father's Name:</th><td id="child_father"></td>
        </tr>
        <tr>
          <th>Phone Number:</th><td id="child_phone"></td>
        </tr>
        <tr>
          <th>Father's Address:</th><td id="child_father_address"></td>
        </tr>
        <tr>
          <th>Father's State:</th><td id="child_father_state"></td>
        </tr>
        <tr>
          <th>Date Registered</th><td id="child_date_registered"></td>
        </tr>
      </table>
        
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
  <!-- END OF VIEW CHILD MODAL -->


<!-- UPDATE CHILD INFO MODAL -->
<div class="modal fade" id="updateChildInfoModal" tabindex="-1" aria-labelledby="updateChildInfoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateChildInfoModalLabel">Update Childre Info</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="update-child">
          <input type="number" name="child_id" id="child_id" class="d-none">
          <div class="mb-2">
            <label for="update_full_name" class="col-form-label">Full name:</label>
            <input type="text" class="form-control" id="update_full_name" required name="update_full_name">
          </div>
          <div class="mb-2">
            <label for="update_contact_address" class="col-form-label">Address:</label>
            <textarea class="form-control" id="update_contact_address" required name="update_contact_address"></textarea>
          </div>
          <div class="mb-2">
            <label for="update_state_origin" class="col-form-label">State of Origin:</label>
            <input type="text" class="form-control" id="update_state_origin" name="update_state_origin" required>
          </div>
          <div class="mb-2">
            <label for="update_father_name" class="col-form-label">Father's name:</label>
            <input type="text" class="form-control" id="update_father_name" name="update_father_name" required>
          </div>
          <div class="mb-2">
            <label for="update_phone_number" class="col-form-label">Father's Phone number:</label>
            <input type="number" maxlength="11" class="form-control" id="update_phone_number" name="update_phone_number" required>
          </div>
          <div class="mb-2">
            <label for="update_father_address" class="col-form-label">Father's Contact Address:</label>
            <textarea class="form-control" id="update_father_address" name="update_father_address" required></textarea>
          </div>
          <div class="mb-2">
            <label for="update_father_state" class="col-form-label">Father's state of Origin:</label>
            <input type="text" class="form-control" id="update_father_state" name="update_father_state" required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline-success"><i class="fa fa-refresh"></i>Update</button>
      </div>
      </form>
    </div>
  </div>
</div>
  <!-- END OF UPDATE CHILD INFO MODAL -->

</div>
</div>
</div>
</div>
<?php 
  include "../common/footer.php"
 ?>
 <script type="text/javascript">
  const data = {'request_id': 'read_all_children', 'where':'*'};
   loadChildren($("#children-table"), data);
</script>