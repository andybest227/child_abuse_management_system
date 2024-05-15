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
      <div class="container-fluid bg-light px-4 pb-5">
      <div class="mt-2 pb-2 mb-3 border-bottom">
        <span class="fs-5 me-2"><b>Child Abuse</b></span>| <span class="ms-2">List of Child Abuse</span>
      </div>
      <div class="p-2 mb-3 bg-light">
        <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#addAbuseModal" data-bs-whatever="@mdo"><i class="fa fa-circle-plus"></i> Add Abuse</button>
      </div>
    
    <table id="abuses-table" class="small table table-striped table-bordered mb-3" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>S/N</th>
        <th>Date</th>
        <th>Abuse ID</th>
        <th>Type of Abuse</th>
        <th>Abuser Name</th>
        <th>Reporter</th>
        <th>Reported to</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
  <tbody>
  </tbody>
</table>

<!-- ADD ABUSE MODAL -->
<div class="modal fade" id="addAbuseModal" tabindex="-1" aria-labelledby="addAbuseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
        <form id="add-abuse">
          <div class="mb-2">
            <label for="abuse_id" class="col-form-label">Abuse ID:</label>
            <select class="form-control" id="abuse_id" name="abuse_id" required>
              <option value="">-select abuse ID-</option>
            </select>
          </div>
          <div class="mb-2">
            <label for="abuse_type" class="col-form-label">Type of Abuse:</label>
            <select class="form-control" id="abuse_type" name="abuse_type" required>
              <option value="">-select abuse type-</option>
            </select>
          </div>
          <div class="mb-2">
            <label for="abuse" class="col-form-label">Abuse:</label>
            <select class="form-control" id="abuse" name="abuse" required>
              <option value="">-select abuse-</option>
            </select>
          </div>
          <div class="mb-2">
            <label for="abuse_name" class="col-form-label">Abuser's name:</label>
            <input type="text" class="form-control" id="abuse_name" name="abuse_name" required>
          </div>
          <div class="mb-2">
            <label for="abuser_address" class="col-form-label">Abuser Address:</label>
            <textarea class="form-control" id="abuser_address" name="abuser_address" required></textarea>
          </div>
          <div class="mb-2">
            <label for="abuser_number" class="col-form-label">Abuser Phone number:</label>
            <input type="number" maxlength="11" class="form-control" id="abuser_number" name="abuser_number" required>
          </div>
          <div class="mb-2">
            <label for="abuser_email" class="col-form-label">Abuser Email Address:</label>
            <input type="email" class="form-control" id="abuser_email" name="abuser_email" required>
          </div>
          <div class="mb-2">
            <label for="abuser_state" class="col-form-label">Abuser State of Origin:</label>
            <input type="text" class="form-control" id="abuser_state" name="abuser_state" required>
          </div>
          <div class="mb-2">
            <label for="abuser_country" class="col-form-label">Abuser Country of Resident:</label>
            <input type="text" class="form-control" id="abuser_country" name="abuser_country" required>
          </div>
          <div class="mb-2">
            <label for="reporter" class="col-form-label">Reporter:</label>
            <input type="text" class="form-control" id="reporter" name="reporter" required>
          </div>
          <div class="mb-2">
            <label for="reported_to" class="col-form-label">Reported to:</label>
            <input type="text" class="form-control" id="reported_to" name="reported_to" required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline-success"><i class="fa fa-save"></i>Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- END ADD ABUSE MODAL -->

<!-- VIEW ABUSE MODAL -->
<div class="modal fade" id="childAbuseModal" tabindex="-1" aria-labelledby="childAbuseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Abuse Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <table class="table table-striped">
        <tr>
          <th>Abuse ID:</th><td id="_abuse_id"></td>
        </tr>
        <tr>
          <th>Abuse Type:</th><td id="_abuse_type"></td>
        </tr>
        <tr>
          <th>Abuse:</th><td id="_abuse"></td>
        </tr>
        <tr>
          <th>Abuser' Name:</th><td id="_abuser"></td>
        </tr>
        <tr>
          <th>Abuser Address:</th><td id="_abuser_address"></td>
        </tr>
        <tr>
          <th>Abuser Phone:</th><td id="_abuser_phone"></td>
        </tr>
        <tr>
          <th>Abuser Email</th><td id="_abuser_email"></td>
        </tr>
        <tr>
          <th>Abuser State</th><td id="_abuser_state"></td>
        </tr>
        <tr>
          <th>Abuser Country</th><td id="_abuser_country"></td>
        </tr>
        <tr>
          <th>Reporter</th><td id="_reporter"></td>
        </tr>
        <tr>
          <th>Reported to</th><td id="_reported_to"></td>
        </tr>
        <tr>
          <th>Status</th>
          <td>
            <div class="form-switch d-flex justify-content-between">
              <label style="margin-left: -2.5rem;" class="form-check-label" for="_status_input" id="_status">
              </label>
                <input class="form-check-input" type="checkbox" role="switch" id="_status_input"/>
              </div>
          </td>
        </tr>
        <tr>
          <th>Date Recorded</th><td id="_created_at"></td>
        </tr>
      </table>
        
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
  <!-- END OF VIEW ABUSE MODAL -->


<!-- UPDATE ABUSE INFO MODAL -->
<div class="modal fade" id="updateAbuseInfoModal" tabindex="-1" aria-labelledby="updateAbuseInfoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateChildInfoModalLabel">Update Abuse Info</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="update-abuse">
          <input type="text" name="id" id="_id" class="d-none"/>
          <div class="mb-2">
            <label for="_abuse_id" class="col-form-label">Abuse ID:</label>
            <select class="form-control" id="__abuse_id" name="abuse_id" required>
              <option value="">-select abuse ID-</option>
            </select>
          </div>
          <div class="mb-2">
            <label for="_abuse_type" class="col-form-label">Type of Abuse:</label>
            <select class="form-control" id="__abuse_type" name="abuse_type" required>
              <option value="">-select abuse type-</option>
            </select>
          </div>
          <div class="mb-2">
            <label for="__abuse" class="col-form-label">Abuse:</label>
            <select class="form-control" id="__abuse" name="abuse" required>
              <option value="">-select abuse-</option>
            </select>
          </div>
          <div class="mb-2">
            <label for="__abuser_name" class="col-form-label">Abuser's name:</label>
            <input type="text" class="form-control" id="__abuser_name" name="abuse_name" required>
          </div>
          <div class="mb-2">
            <label for="__abuser_address" class="col-form-label">Abuser Address:</label>
            <textarea class="form-control" id="__abuser_address" name="abuser_address" required></textarea>
          </div>
          <div class="mb-2">
            <label for="__abuser_number" class="col-form-label">Abuser Phone number:</label>
            <input type="number" maxlength="11" class="form-control" id="__abuser_number" name="abuser_number" required>
          </div>
          <div class="mb-2">
            <label for="__abuser_email" class="col-form-label">Abuser Email Address:</label>
            <input type="email" class="form-control" id="__abuser_email" name="abuser_email" required>
          </div>
          <div class="mb-2">
            <label for="__abuser_state" class="col-form-label">Abuser State of Origin:</label>
            <input type="text" class="form-control" id="__abuser_state" name="abuser_state" required>
          </div>
          <div class="mb-2">
            <label for="__abuser_country" class="col-form-label">Abuser Country of Resident:</label>
            <input type="text" class="form-control" id="__abuser_country" name="abuser_country" required>
          </div>
          <div class="mb-2">
            <label for="__reporter" class="col-form-label">Reporter:</label>
            <input type="text" class="form-control" id="__reporter" name="reporter" required>
          </div>
          <div class="mb-2">
            <label for="_reported_to" class="col-form-label">Reported to:</label>
            <input type="text" class="form-control" id="__reported_to" name="reported_to" required>
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
  loadAbusesTypes();
  const data = {'request_id': 'get_abuse_records'};
        loadAbuses($("#abuses-table"), data);
</script>