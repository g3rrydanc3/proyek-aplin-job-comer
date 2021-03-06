<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once(__DIR__ . "/../header.php");
	if(strlen($_SESSION["current"]) == 0 || !is_numeric($_SESSION["role"])){
		header("location:http://" . getFolderUrl() . "error.php");
	}
	
	$db->where ("id", $_SESSION["current"]);
	$user = $db->getOne ("user");

	$db->where ("id", $user["role"]);
	$queryRole = $db->getOne ("role");
	$queryRole = $queryRole["name"];
	
	$db->where("user_id_from", $_SESSION["current"]);
	$db->orderBy ("sent_stamp","desc");
	$message = $db->get("message");
?>
<div class="wrapper">
	<div class="container">
		<h1>My Profile</h1>
		<div class="row profile">
			<div class="col-sm-3">
				<div class="profile-sidebar">
					<?php require_once("profile/mysidebar.php");?>
				</div>
			</div>
			<div class="col-sm-9">
				<div class="profile-content">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h2>Message</h2>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>To</th>
											<th>Date</th>
											<th>Subject</th>
										</tr>
									</thead>
									<tbody>
										<?php
											if(empty($message)){
												echo "<tr><td colspan=4 class='text-muted text-center'>Stil empty.</td></tr>";
											}
											else{
												foreach($message as $key => $data){
													$db->where("id", $data['user_id_to']);
													$username = $db->getOne("user")["username"];
													echo "<tr>";
													echo "<td><a href='message_view.php?sent=yes&id=" . $data['id'] . "'>". $username ."</a></td>";
													echo "<td><a href='message_view.php?sent=yes&id=" . $data['id'] . "'>". $data['sent_stamp'] ."</a></td>";
													echo "<td><a href='message_view.php?sent=yes&id=" . $data['id'] . "'>". $data['subject'] ."</a></td>";
													echo "</tr>";
												}
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	require_once(__DIR__ . "/../footer.php");
?>