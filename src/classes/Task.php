<?php

class Task {

	function create($text, $id){
		$errorArr = array();//создание массива ошибок.

		if ($id == "") array_push($errorArr, "Error id");  // проверка на пустые поля.
		if ($text == "" || strlen($text) < 1)array_push($errorArr, "Incorrect task name");


		if (count($errorArr) == 0) {
			$tmp_array = sqldb_connection::createTask($text, $id);
			return $tmp_array;
		}
		else {
			return $errorArr;
		}
	}

	function read($text){
		$errorArr = array();//создание массива ошибок.

		if ($text == "" || strlen($text) < 1){
			array_push($errorArr, "Incorrect project name");
		}

		if (count($errorArr) == 0) {
			$tmp_array = sqldb_connection::readTask($text);
			return $tmp_array;
		}
		else {
			return $errorArr;
		}
	}

	function updateText($id, $text){
		$errorArr = array();//создание массива ошибок.

		if ($id == ""){
			array_push($errorArr, "Incorrect project Id");
		}
		if ($text == "" || strlen($text) < 1){
			array_push($errorArr, "Incorrect task text");
		}

		if (count($errorArr) == 0) {
			if ( count( $errorArr ) == 0 ) {
				$tmp_db_row = sqldb_connection::updateTaskText( $id, $text );

				if ( $tmp_db_row == true ) {
					$tmp_db_row = sqldb_connection::readTaskNyId( $id );
				} else {
					$tmp_db_row = "Update error";
				}

				return $tmp_db_row;
			} else {
				return $errorArr;
			}
		}
	}

	function updateStatus($id){
		$errorArr = array();//создание массива ошибок.

		if ($id == ""){
			array_push($errorArr, "Incorrect project Id");
		}

		if (count($errorArr) == 0) {
			$tmp_array = sqldb_connection::updateTaskStatus($id);

			if($tmp_array == true){
				$tmp_array = sqldb_connection::readProjectById($id);
			} else {
				$tmp_array = array( 'error' => "Nothing to show" );
			}
			return $tmp_array;
		}
		else {
			return $errorArr[0];
		}
	}

	function delete($id){
		$errorArr = array();//создание массива ошибок.

		if ($id == ""){
			array_push($errorArr, "Incorrect project Id");
		}

		if (count($errorArr) == 0) {
			$tmp_array = sqldb_connection::deleteTask($id);
			return $tmp_array;
		}
		else {
			return $errorArr;
		}
	}

}