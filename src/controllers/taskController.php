<?php

require_once '../classes/logging.php';
require_once '../classes/Task.php';

extract($_REQUEST);

$task = new Task();

switch (@$command) {
	case "create":
		$response = $task->create( @$text, @$id );
		break;

	case "read":
		$response = $task->read();
		break;

	case "updateText":
			$response = $task->updateText(@$id,@$text);
		break;

	case "updateStatus":
			$response = $task->updateStatus(@$id);
		break;

	case "delete":
			$response = $task->delete($id);
		break;

	default:
		$response = "failed command";
		break;
}

logging::log( @$id . " " . @$text . " " , json_encode($response) , @$command );
echo json_encode($response);