<?php 
	
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'child_abuse_database');

class DB_Connections
{ 
    private $db;
	public function __construct()
	{
		$this->connect();
	}

	private function connect()
	{
		try {
			$dbOptions = [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
			];

			$this->db = new PDO(
				'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
				DB_USER,
				DB_PASS,
				$dbOptions
			);
		} catch (PDOException $e) {
			exit('Error: ' . $e->getMessage());
		}
	}

	public function getConnection()
	{
		return $this->db;
}

}


class Models extends DB_Connections
{
    public function __construct()
	{
		// Call the constructor of the parent class
		parent::__construct();
	}

	//Create a new child record
	public function create_child($data)
	{
		$sql_statement = "INSERT INTO children (full_name, address, state, father_name, phone, fathers_address, father_state, created_at) VALUES (:full_name, :address, :state, :father_name, :phone, :fathers_address, :father_state, :created_at)";
		$query = $this->getConnection()->prepare($sql_statement);

		$date = date("Y-m-d");
		
		// Bind parameters
		$query->bindParam(':full_name', $data['full_name'], PDO::PARAM_STR);
		$query->bindParam(':address', $data['contact_address'], PDO::PARAM_STR);
		$query->bindParam(':state', $data['state_origin'], PDO::PARAM_STR);
		$query->bindParam(':father_name', $data['father_name'], PDO::PARAM_STR);
		$query->bindParam(':phone', $data['phone_number'], PDO::PARAM_STR);
		$query->bindParam(':fathers_address', $data['father_address'], PDO::PARAM_STR);
		$query->bindParam(':father_state', $data['father_state'], PDO::PARAM_STR);
		$query->bindParam(':created_at', $date, PDO::PARAM_STR);

		// Execute the query
		if ($query->execute()) {
			/*$insertedId = $this->getConnection()->lastInsertId();
			$sql_statement = $this->getConnection()->prepare("SELECT * FROM children WHERE id = ?");
				$sql_statement->execute([$insertedId]);
				$data = $sql_statement->fetch(PDO::FETCH_ASSOC);*/

				return json_encode(['alert_code' => 'success', 'message' => 'Child add successful']);
			}else{
				return json_encode(['alert_code' => 'error', 'message' => 'An error occurred']);
			}
	}
	//Get all the children
	public function read_all_children($data)
	{
		$sql_statement = "SELECT * FROM children ORDER BY id DESC";
		$query = $this->getConnection()->prepare($sql_statement);
		if ($query->execute()) {
			return json_encode($query->fetchAll(PDO::FETCH_ASSOC));
		}
		else{
			return json_encode([]);
		}
	}

	//count Children
	public function count_children($data){
		$query = $this->getConnection()->prepare("SELECT COUNT(*) AS rowCount FROM children");
		$query->execute();
		$rowCount = $query->fetch(PDO::FETCH_ASSOC)['rowCount'];
		return json_encode(["rowCount" => $rowCount]);
	}

	//Get child by id 
	public function get_child_by_id($data){
		$query = $this->getConnection()->prepare("SELECT * FROM children WHERE id = ?");
		$query->execute([$data['id']]);
		return json_encode($query->fetch(PDO::FETCH_ASSOC));
	}

	//Update child info
	public function update_child_info($data)
	{
		$sql_statement = "UPDATE children SET full_name = ?, address = ?, state  = ?, father_name  = ?, phone  = ?, fathers_address  = ?, father_state  = ? WHERE id = ?";
		$query = $this->getConnection()->prepare($sql_statement);
		if ($query->execute([$data['update_full_name'], $data['update_contact_address'], $data['update_state_origin'], $data['update_father_name'], $data['update_phone_number'], $data['update_father_address'], $data['update_father_state'], $data['child_id']])) 
		{
			return json_encode(['alert_code' => 'success', 'message' => 'Update successful']);	
		}
		return json_encode(['alert_code' => 'error', 'message' => 'Update faild']);
	}

	//Delete a child record
	public function delete_child($data)
	{
		$query = $this->getConnection()->prepare("DELETE FROM children WHERE id = ?");
		if ($query->execute([$data['id']])) {
			return json_encode(['alert_code' => 'success', 'message' =>'Record deleted successfull']);
		}
		return json_encode(['alert_code' => 'error', 'message' =>'Faild to delete record']);
	}

	//Get abuse types
	public function get_abuse_types($data)
	{
		$query = $this->getConnection()->prepare("SELECT * FROM abuse_types");
		if ($query->execute()) {
			return json_encode($query->fetchAll(PDO::FETCH_ASSOC));
		}else{
			return json_encode([]);
		}
	}

	//Get abuse names
	public function get_abuse_names($data)
	{
		$query = $this->getConnection()->prepare("SELECT * FROM abuse_names");
		if ($query->execute()) {
			return json_encode($query->fetchAll(PDO::FETCH_ASSOC));
		}else{
			return json_encode([]);
		}
	}

	//Create abuse record
	public function create_abuse($data)
	{
		$query = $this->getConnection()->prepare("INSERT INTO abuses_records(abuse_id, abuse_type, abuse, abuser,	abuser_address,	abuser_phone, abuser_email,	abuser_state, abuser_country,	reporter,	reported_to, created_at) VALUES(?,	?,	?,	?,	?,	?,	?,	?, ?,	?,	?, ?)");
		//$date = date("Y-m-d");
		if ($query->execute([$data['abuse_id'], $data['abuse_type'],$data['abuse'],$data['abuse_name'],$data['abuser_address'],$data['abuser_number'],$data['abuser_email'],$data['abuser_state'],$data['abuser_country'],$data['reporter'],$data['reported_to'],date("Y-m-d")])) {
			return json_encode(['alert_code' => 'success', 'message' => 'Record added successfully.']);
			}
		return json_encode(['alert_code'=>'error', 'message'=>'An error occurred.']);
	}

	//get_abuse_records
	public function get_abuse_records($data)
	{
		$query = $this->getConnection()->prepare("SELECT * FROM abuses_records ORDER BY id DESC");
		if ($query->execute()) {
			return json_encode($query->fetchAll(PDO::FETCH_ASSOC));
		}
			return json_encode([]);
	}

	//Get a particular abuse record
	public function get_abuse_by_id($data)
	{
		$query = $this->getConnection()->prepare("SELECT * FROM abuses_records WHERE id = ?");
		if ($query->execute([$data['id']])) {
			return json_encode($query->fetch(PDO::FETCH_ASSOC));
		}
	}

	//Update abuse info
	public function update_abuse_info($data)
	{
		$query = $this->getConnection()->prepare("UPDATE abuses_records SET abuse_id = ?, abuse_type = ?, abuse = ?, abuser	= ?, abuser_address = ?, abuser_phone = ?, abuser_email = ?, abuser_state = ?, abuser_country = ?, reporter = ?, reported_to = ? WHERE id = ?");

		if ($query->execute([$data['abuse_id'],$data['abuse_type'],$data['abuse'],$data['abuse_name'],$data['abuser_address'],$data['abuser_number'],$data['abuser_email'],$data['abuser_state'],$data['abuser_country'],$data['reporter'],$data['reported_to'],$data['id']])) {
			return json_encode(['alert_code'=>'success', 'message'=>'Abuse updated successfully.']);
		}
		return json_encode(['alert_code'=>'error', 'message'=>'An error occurred.']);
	}

	//Delete abuse record
	public function delete_abuse($data){
		$query = $this->getConnection()->prepare("DELETE FROM abuses_records WHERE id = ?");
		if ($query->execute([$data['id']])) {
			return json_encode(['alert_code' => 'success', 'message'=>'Record deleted successfully.']);
		}
		return json_encode(['alert_code' => 'error', 'message'=>'An error occurred.']);
	}

	//Count abuses
	public function count_abuses($data){
		$query = $this->getConnection()->prepare("SELECT COUNT(*) AS rowCount FROM abuses_records");
		$query->execute();
		$rowCount = $query->fetch(PDO::FETCH_ASSOC)['rowCount'];
		return json_encode(["rowCount" => $rowCount]);
	}

	//Toggle status
	public function toggle_status($data)
	{
		$status = $data['status'] == 'Resolved'? 'Pending':'Resolved';
		$query = $this->getConnection()->prepare("UPDATE abuses_records SET status = ? WHERE id = ?");
		if ($query->execute([$status, $data['id']])) {
			return json_encode(['alert_code'=>'success', 'message'=>'Status updated successfully.', 'status'=>$status]);
		}
		return json_encode(['alert_code'=>'error', 'message'=>'An error occurred.']);
	}

	//Create a new admin

	public function add_admin($data) {
	    $hash_password = password_hash($data['password'], PASSWORD_DEFAULT);
	    $sql_statement = "INSERT INTO admin (full_name, email, phone_number, address, state_origin, country, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
	    $query = $this->getConnection()->prepare($sql_statement);

	    try {
	        $query->execute([
	            $data['full_name'],
	            $data['email'],
	            $data['phone_number'],
	            $data['address'],
	            $data['state_origin'],
	            $data['country'],
	            $hash_password
	        ]);
	        return json_encode(['alert_code' => 'success', 'message' => 'Admin created successfully.']);
	    } catch (PDOException $e) {
	        $error_message = ($e->getCode() == 23000) 
	            ? 'The email address already exists.' 
	            : 'An error occurred: ' . $e->getMessage();
	        return json_encode(['alert_code' => 'error', 'message' => $error_message]);
	    }
	}


	//Login 
	public function login_request($data)
	{

		$userData = $this->getUserData($data['email']);

		//If user nor admin exist 
		if ($userData === 0) {
			return json_encode(['alert_code' => 'error', 'message' => 'Invalid username or password']);
		}

		if (password_verify($data['password'], $userData['password'])) {
			session_start();
			$_SESSION['id'] = $userData['id'];
			$_SESSION['email'] = $userData['email'];
			$_SESSION['full_name'] = $userData['full_name'];
			$_SESSION['phone_number'] = $userData['phone_number'];
			$_SESSION['address'] = $userData['address'];
			$_SESSION['state_origin'] = $userData['state_origin'];
			$_SESSION['country'] = $userData['country'];
			$_SESSION['password'] = $userData['password'];

			return json_encode(['url' => 'views/dashboard.php', 'alert_code' => 'success', 'message' => 'Login successful']);
		} 
		return json_encode(['alert_code' => 'error', 'message' => 'Invalid username or password']);
	}

	private function getUserData($email)
	{
		$sql = $this->getConnection()->prepare("SELECT * FROM admin WHERE email = ?");
		if ($sql->execute([$email]) && $sql->rowCount()>0) {
			return $sql->fetch(PDO::FETCH_ASSOC); 
		}
		return 0;
	}

	//logout_request
	public function logout_request($data)
	{
		session_start();
		session_unset();
		session_destroy();
		return json_encode(['alert_code'=>'success', 'message'=>'Logout successfully','url' => '../']);
	}

	//load admin data
	public function load_admin_data($data)
	{
		session_start();
		$query = $this->getConnection()->prepare("SELECT * FROM admin WHERE id = ?");
		if ($query->execute([$_SESSION['id']])) {
			return json_encode($query->fetch(PDO::FETCH_ASSOC));
		}
		return json_encode(['alert_code'=>'error', 'message'=>'An error occurred.']);
	}

	//Update Admin info
	public function update_admin($data) 
	{
	    session_start();
	    if (!empty($data['current_password']) && !password_verify($data['current_password'], $_SESSION['password'])) {
	        return json_encode(['alert_code' => 'error', 'message' => 'Authentication failed!']);
	    }

	    // Determine if we need to update the password
	    $update_password = !empty($data['new_password']);

	    $sql_statement = "UPDATE admin SET full_name = ?, phone_number = ?, address = ?, state_origin = ?, country = ?" . 
	                     ($update_password ? ", password = ?" : "") . 
	                     " WHERE id = ?";

	    $params = [
	        $data['full_name'],
	        $data['phone_number'],
	        $data['address'],
	        $data['state_origin'],
	        $data['country']
	    ];

	    if ($update_password) {
	        $hash_password = password_hash($data['new_password'], PASSWORD_DEFAULT);
	        $params[] = $hash_password;
	    }

    	$params[] = $data['id'];
	    try {
	        $query = $this->getConnection()->prepare($sql_statement);
	        if ($query->execute($params)) {
	            return json_encode(['alert_code' => 'success', 'message' => 'Record updated successfully.']);
	        }
	    } catch (PDOException $e) {
	        return json_encode(['alert_code' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
	    }

	    return json_encode(['alert_code' => 'error', 'message' => 'An unknown error occurred.']);
	}

}
?>