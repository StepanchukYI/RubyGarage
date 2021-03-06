<?php
require_once 'sql.php';

class Project {

	function create($text){

		if($text != "" || strlen($text) > 3){
			$tmp_db_row = sqldb_connection::createProject($text);
			if($tmp_db_row != "false"){
				return  array( 'success' => "Project was created",
								'id' => $tmp_db_row);
			}
			else {
				return  array( 'error' => "Project was`t created" );
			}
		} else {
			return  array( 'error' => "Failed name" );
		}
	}

	function read(){
		$responce = sqldb_connection::readProject();

		if($responce){
			return $responce;
		} else {
			return array( 'error' => "Nothing to show" );
		}
	}

	function updateText( $id, $text ){
		$errorArr = array();    //создание массива ошибок.

		if ($id == "") array_push($errorArr, "Error id");  // проверка на пустые поля.
		if ($text == "") array_push($errorArr, "Enter text");  // проверка на пустые поля.

		if (count($errorArr) == 0) {
			$tmp_db_row = sqldb_connection::updateProjectName($id, $text);

			if($tmp_db_row == true){
				$tmp_db_row = sqldb_connection::readProjectById($id);
			} else {
				$tmp_db_row = array( 'error' => "Nothing to show" );
			}
			return $tmp_db_row;
		} else {
			return $errorArr[0];
		}
	}

	function delete( $id ){

		$errorArr = array();    //создание массива ошибок.

		if ($id == "") array_push($errorArr, "Error exercise id");  // проверка на пустые поля.

		if (count($errorArr) == 0) {
			$tmp_db_row = sqldb_connection::deleteProject($id);
			return $tmp_db_row;
		} else {
			return $errorArr[0];
		}
	}

}