toastr.options.timeOut = 3000;

//Handle child registration form submission
$('#add-child').submit(function(e){
	e.preventDefault();
	fd = new FormData(this);
  	fd.append("request_id", "create_child");

	$("#addChildModal").modal("hide");
	PostRequest(fd, function(response){
		if (response.alert_code == "success") {
	      	// Clear form inputs
	      	$("#add-child").trigger("reset");
	      	const data = {'request_id': 'read_all_children'};
	   		loadChildren($("#children-table"), data);
    	}
	});
});

function PostRequest(data, callback, login) {
  let url = login=='login'? "includes/request_validator.php":"../includes/request_validator.php";
  $.ajax({
    type: "POST",
    url: url,
    processData: false,
    contentType: false,
    data: data,
    success: function (response) {
      //console.log(response);
      if (response !== null && response !== undefined) {
        var responseData = JSON.parse(response);
        if (responseData.hasOwnProperty("alert_code")) {
          var alertDetails = {
            code: responseData.alert_code,
            message: responseData.message
          };
          switchAlert(alertDetails);
        }
        callback(responseData);
        if (responseData.hasOwnProperty("url")) {
          setTimeout(function () {
            window.location.href = responseData.url;
          }, 1500);
        }
      } else {
        toastr.warning("No response from server", "Warning");
      }
    }
  });
}

// Get Request
function GetRequest(data, callback) {
  $.ajax({
    type: "POST",
    url: "../includes/request_validator.php",
    data: data,
    success: function (response) {
     //console.log(response);
      var responseData = JSON.parse(response);
      if (responseData.hasOwnProperty("alert_code")) {
        var alertDetails = {
          code: responseData.alert_code,
          message: responseData.message
        };
        switchAlert(alertDetails);
      }
      callback(responseData);
    }
  });
}

//Count children
const countChildren = (data) => {

	GetRequest({'request_id': 'count_children'}, function(response){
		$("#children_count").text(response.rowCount);
	});
}

//View child information
const get_child_info = (id, flag) => {
	let data = {'request_id': 'get_child_by_id','id':id}

	GetRequest(data, function(response){
		if (flag ==1) {
			$('#child_id').val(response.id);
			$('#update_full_name').val(response.full_name);
			$("#update_contact_address").val(response.address);
			$("#update_state_origin").val(response.state);
			$("#update_father_name").val(response.father_name);
			$("#update_phone_number").val(response.phone);
			$("#update_father_address").val(response.fathers_address);
			$('#update_father_state').val(response.father_state);
			$('#updateChildInfoModal').modal('toggle');
			return;
			}
			$("#childDetailLabel").text(response.full_name);
			$("#child_address").text(response.address);
			$('#child_state_origin').text(response.state);
			$('#child_father').text(response.father_name);
			$('#child_phone').text(response.phone);
			$('#child_father_address').text(response.fathers_address);
			$('#child_father_state').text(response.father_state);
			$('#child_date_registered').text(response.created_at);
			$('#childDetailModal').modal('toggle');
	});
}

//Delete child
const deleteChild = (id) => {
	if (confirm("Are you sure you want to delete this Child?")) 
	{
		let data = {'request_id': 'delete_child','id':id}
		GetRequest(data, function(response) {
			if (response.alert_code == "success") 
			{
   				loadChildren($("#children-table"), {'request_id': 'read_all_children'});
    		}
		}); 			
	}
}

//Update child information
$('#update-child').submit(function(e){
	e.preventDefault();
	fd = new FormData(this);
	fd.append('request_id', 'update_child_info');
	$("#updateChildInfoModal").modal("hide");
	PostRequest(fd, function(response){
		if (response.alert_code == "success") {
	      	// Clear form inputs
	      	$("#add-child").trigger("reset");
	   		loadChildren($("#children-table"), {'request_id': 'read_all_children'});
		};
	});
});

//Build children table 
const loadChildren = (targetTable, data) => {
  const tableHead = `
      <thead>
      <tr>
        <th>S/N</th>
        <th>Date</th>
        <th>Names</th>
        <th>Address</th>
        <th>State</th>
        <th>Country</th>
        <th>Action</th>
      </tr>
    </thead>
      <tbody>
      </tbody>
    `;

 	const tablefoot =  `
    <tfoot>
      <tr>
        <th>S/N</th>
        <th>Date</th>
        <th>Names</th>
        <th>Address</th>
        <th>State</th>
        <th>Country</th>
        <th>Action</th>
      </tr>
    </tfoot>
    `;
   GetRequest(data, function (responseData) {
      targetTable.empty();
      targetTable.append(tableHead);
      //targetTable.append(tablefoot);
      let count = 1;
      const tbody = targetTable.find("tbody");

      responseData.forEach((element) => {
        tbody.append(`
          <tr>
            <td>${count}</td>
            <td>${element.created_at}</td>
            <td>${element.full_name}</td>
            <td>${element.address}</td>
            <td>${element.state}</td>
            <td>Nigeria</td>
            <td>
            	<span onclick="get_child_info(${element.id})" class="btn btn-success btn-sm" title="View child information">View</span>
            	<span onclick="get_child_info(${element.id}, ${1})" class="btn btn-primary btn-sm" title="Update child information">Edit</span>
            	<span onclick="deleteChild(${element.id})" class="btn btn-danger btn-sm" title="Delete this child's record">Delete</span>
            </td>
          </tr>
        `);
        count += 1;
      });
      targetTable.DataTable();
    });
};


/*ABUSE MODULE SCRIPTS*/
//load abuse, types and id
const loadAbusesTypes = () => {
    GetRequest({'request_id': 'get_abuse_types'}, function(response){
    	if (response == null) {
    		return;
    	}
        response.forEach((element) => {
            $('#abuse_id').append($('<option>', {
                value: element.abuse_id,
                text: element.abuse_id
            }));
            $('#abuse_type').append($('<option>', {
                value: element.abuse_name,
                text: element.abuse_name
            }));

            //for abuse update
            $('#__abuse_id').append($('<option>', {
                value: element.abuse_id,
                text: element.abuse_id
              }));
            $('#__abuse_type').append($('<option>', {
                value: element.abuse_name,
                text: element.abuse_name

              }));
        });
    });
    loadAbusesNames();
}

//load names
const loadAbusesNames = () => {
    GetRequest({'request_id': 'get_abuse_names'}, function(response){
        response.forEach((element) => {
            $('#abuse').append($('<option>', {
                value: element.abuse_name,
                text: element.abuse_name
            }));
            $('#__abuse').append($('<option>', {
                value: element.abuse_name,
                text: element.abuse_name
              }));
        });
    });
}

//Add abuse record
$('#add-abuse').submit(function(e){
	e.preventDefault();
	let data = new FormData(this);
	$('#addAbuseModal').modal("toggle");
	data.append("request_id", "create_abuse");
	PostRequest(data, function(response){
		if (response.alert_code == "success") {
	      	// Clear form inputs
	      	$("#add-abuse").trigger("reset");
	      	const data = {'request_id': 'get_abuse_records'};
	   		loadAbuses($("#abuses-table"), data);
    	}
	});
});

//Load abuses
const loadAbuses = (targetTable, data) =>{
  const flag = data.flag;
  targetTable.empty();
	const tableHead = `
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
	        ${flag != 1?`<th>Action</th>`:``}
	      </tr>
	    </thead>
	    <tbody>
      	</tbody>
	`;
	GetRequest(data, function(responseData){
    let resolved_cases = 0;
    let pending_cases = 0;
    
		targetTable.empty();
      	targetTable.append(tableHead);
     
      	let count = 1;
      	const tbody = targetTable.find("tbody");

      responseData.forEach((element) => {
  
       if (element.status==='Resolved') {
          resolved_cases +=1;
        }else{
          pending_cases +=1;
        }
        
        if (flag == 2 && element.status=='Resolved') {
          return;
        }
        tbody.append(`
          <tr>
            <td>${count}</td>
            <td>${element.created_at}</td>
            <td>${element.abuse_id}</td>
            <td>${element.abuse_type}</td>
            <td>${element.abuser}</td>
            <td>${element.reporter}</td>
            <td>${element.reported_to}</td>
            <td>${element.status}</td>
            ${flag!=1 ?
              `<td>
                  <span onclick="get_abuse_info(${element.id})" class="btn btn-success btn-sm" title="View abuse information">View</span>
                  ${flag !=2 ?
                    `<span onclick="get_abuse_info(${element.id}, ${1})" class="btn btn-primary btn-sm" title="Update abuse information">Edit</span>
                  <span onclick="deleteAbuse(${element.id})" class="btn btn-danger btn-sm" title="Delete this record">Delete</span>`:``
                }
                </td>`: ``
            }
            
          </tr>
        `);
        count += 1;
      });
        if (data.flag===1) {
          $('#pending_cases').text(pending_cases);
          $('#resolved_cases').text(resolved_cases);
        }  
      targetTable.DataTable();
	});
}

//View abuse information
const get_abuse_info = (id, flag) =>{
  let data = {'request_id': 'get_abuse_by_id','id':id}
  GetRequest(data, function(response){
      if (flag==1) {
        $(`#__abuse_id option[value='${response.abuse_id}']`).prop('selected', true);
        $(`#__abuse_type option[value='${response.abuse_type}']`).prop('selected', true);
        $(`#__abuse option[value='${response.abuse}']`).prop('selected', true);
        $('#__abuser_name').val(response.abuser);
        $('#_id').val(response.id);
        $('#__abuser_address').val(response.abuser_address);
        $('#__abuser_number').val(response.abuser_phone);
        $('#__abuser_email').val(response.abuser_email);
        $('#__abuser_state').val(response.abuser_state);
        $('#__abuser_country').val(response.abuser_country);
        $('#__reporter').val(response.reporter);
        $('#__reported_to').val(response.reported_to);
        $('#updateAbuseInfoModal').modal('toggle');
          return;
      }
      $('#_abuse_id').text(response.abuse_id); 
      $("#_abuse_type").text(response.abuse_type);
      $("#_abuse").text(response.abuse);
      $('#_abuser').text(response.abuser);
      $('#_abuser_address').text(response.abuser_address);
      $('#_abuser_phone').text(response.abuser_phone);
      $('#_abuser_email').text(response.abuser_email);
      $('#_abuser_state').text(response.abuser_state);
      $('#_abuser_country').text(response.abuser_country);
      $('#_reporter').text(response.reporter);
      $('#_reported_to').text(response.reported_to);
      $('#_status').text(response.status);
      $('#_created_at').text(response.created_at);
      $('#_status_input').val(response.id);

      if ($('#_status').text()==='Resolved') {
        $('#_status_input').attr('checked', 'true');
      }
      $('#childAbuseModal').modal('toggle');
  });
}

//Submit update form
$('#update-abuse').submit(function(e){
  e.preventDefault();
  let data = new FormData(this);
  $('#updateAbuseInfoModal').modal('toggle');
  data.append('request_id', 'update_abuse_info');
  PostRequest(data, function(response){
    if (response.alert_code == "success") {
        loadAbuses($("#abuses-table"), {'request_id': 'get_abuse_records'});
    };
  });
});

//Delete abuse
const deleteAbuse = (id) =>{
  if (confirm("Are you sure you want to delete this record?")) {
    let data = {'request_id': 'delete_abuse','id':id}
      GetRequest(data, function(response){
      if (response.alert_code == "success") {
        loadAbuses($("#abuses-table"), {'request_id': 'get_abuse_records'});
      }
    });
  }
}

//Count abuses
const countAbuses = (data) => {
  GetRequest({'request_id': 'count_abuses'}, function(response){
    $("#abuse_count").text(response.rowCount);
  });
}

$('#_status_input').click(function(e){
  let data = {'request_id': 'toggle_status', 'id':$(this).val(), 'status':$('#_status').text()}
  GetRequest(data, function(response){
    if (response.alert_code=='success') {
      $('#_status').text(response.status);
    }
  });
});
/*END OF ABUSE MODULE SCRIPTS*/


/*ADMIN MODULE SCRIPTS*/
//create admin
$('#add-admin-form').submit(function(e){
  e.preventDefault();
  let data = new FormData(this);
  data.append('request_id', 'add_admin');
  if (data.get('password') != data.get('comfirm_password')) {
    toastr.error('Password does not match', 'Password Error');
    return;
  }
  PostRequest(data, function(response){
    if (response.alert_code=='success') {
      $('#add-admin-form').trigger('reset');
    }
  });
});

//Handle login form
$("#login-form").submit(function (e) {
  e.preventDefault();
  let data = new FormData(this);
  data.append("request_id", "login_request");
  PostRequest(data, function (responseData) {
    //Do something if possible
  },'login');
});

//Handle logout
$("#logout").on("click", function (e) {
  e.preventDefault();
  let data = new FormData();
  data.append("request_id", "logout_request");
  PostRequest(data, function (responseData) {});
});
const loadAdminData = () =>{
   let data = new FormData();
    GetRequest({"request_id": "load_admin_data"}, function(response){
      $('#id').val(response.id);
      $('#full_name').val(response.full_name);
      $('#phone_number').val(response.phone_number);
      $('#address').val(response.address);
      $('#state_origin').val(response.state_origin);
      $('#country').val(response.country);
    });
}

//Update admin 
$('#update-admin-form').submit(function(e){
    e.preventDefault();
    let data = new FormData(this);
    var current_password = data.get('current_password');
    var new_password = data.get('new_password');

    if (current_password!='' && new_password=='') {
      toastr.warning('New password required', 'Password Error');
      return;
    }
    if (current_password=='' && new_password!='') {
      toastr.warning('Current password required', 'Password Error');
      return;
    }
    data.append('request_id', 'update_admin');
    PostRequest(data, function(response){
      if (response.alert_code=='success') {
        $('#current_password').val('');
        $('#new_password').val('');
      }
    });
  });
/*END OF ADMIN SCRIPTS*/

//d4mbhi1gtu3c8p db_name

// Handle alert type
function switchAlert(response) {
  switch (response.code) {
    case "success":
      toastr.success(response.message, "Success");
      break;
    case "warning":
      toastr.warning(response.message, "Warning");
      break;
    case "error":
      toastr.error(response.message, "Error");
      break;

    default:
      break;
  }
}
