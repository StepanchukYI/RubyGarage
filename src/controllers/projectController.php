<?php
require_once '../classes/logging.php';
require_once '../classes/Project.php';
extract( $_REQUEST );
$project = new Project();

switch ( @$command ) {
	case 'create':
		$response = $project->create( @$text );
		break;
	case 'read':
		$response = $project->read();
		break;
	case 'update_text':
		$response = $project->updateText( @$id, @$text );
		break;
	case 'delete':
		$response = $project->delete( @$id );
		break;
	default:
		$response = "failed command";
		break;
}

logging::log( @$id . " " . @$text . " " , json_encode($response) , @$command );
echo json_encode($response);
