<?php
require_once '../classes/Task.php';
extract($_REQUEST);

$task = new Task();

switch ($command) {
	case "create":
		$projectName = $_REQUEST['projName'];

		if ($projectName != "" ) {
			$response = create($projectName);
		} else {
			$response ="null field";
		}
		break;

	case "read":
		$projectName = $_REQUEST['projName'];

		if ($projectName != "" ) {
			$response = read($projectName);
		} else {
			$response ="null field";
		}
		break;

	case "updateText":
		$projectId = $_REQUEST['id'];
		$taskText = $_REQUEST['taskText'];

		if ($projectId != "" && $taskText != "") {
			$response = updateText($projectId,$taskText);
		} else {
			$response ="null field";
		}
		break;

	case "updateStatus":
		$projectId = $_REQUEST['id'];

		if ($projectId != "") {
			$response = updateStatus($projectId);
		} else {
			$response ="null field";
		}
		break;

	case "delete":
		$projectId = $_REQUEST['id'];

		if ($projectId != "") {
			$response = delete($projectId);
		} else {
			$response ="null field";
		}
		break;

	default:
		$response = "failed command";
		break;
}

echo json_encode($response);