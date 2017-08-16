<?php

class sqldb_connection {
	/*
	 * ИНКАПСУЛИРОВАННАЯ ФУНКЦИЯ, ДЛЯ КОДКЛЮЧЕНИЮ В БАЗЕ(ИНКАПСУЛИРОВАННАЯ!!)
	 */
	private static function DB_connect() {
		$dsn      = 'mysql:dbname=test;host=127.0.0.1';
		$user     = 'root';
		$password = '';

		try {
			$dbh = new PDO( $dsn, $user, $password );

			return $dbh;
		} catch ( PDOException $e ) {
			return 'Connection failed: ' . $e->getMessage();
		}
	}

	/////////////////////////////////////////////////////////////// PROJECT
	/*
	 * Функция для создания нового проекта
	 */
	public static function createProject( $projName ) {

		$dbh = sqldb_connection::DB_connect();
		$sth = $dbh->prepare( "INSERT INTO Project(name) VALUE (:name)" );
		$sth->execute( array( ':name' => $projName ) );
		return $sth->fetch( PDO::FETCH_ASSOC );

	}
	/*
	 * функция для возвращения всех проектов из базы данных
	 */
	public static function readProject( $projName ) {

		$dbh = sqldb_connection::DB_connect();
		$sth = $dbh->prepare( "SELECT * FROM Project" );
		$sth->execute( array( ':name' => $projName ) );
		return $sth->fetch( PDO::FETCH_ASSOC );

	}
	/*
	 * Функция для обновления текстов проектов
	 */
	public static function updateProjectName( $id, $projName ) {

		$dbh = sqldb_connection::DB_connect();
		$sth = $dbh->prepare( "UPDATE exercise SET name = :name WHERE id = :id" );
		$sth->execute( array( ':name' => $projName, ':id' => $id ) );
		return $sth->fetch( PDO::FETCH_ASSOC );

	}
	/*
     * Функция для удаления проекта
     */
	public static function deleteProject( $id ) {

		$dbh = sqldb_connection::DB_connect();
		$sth = $dbh->prepare( "UPDATE exercise SET status = 'delete' WHERE id = :id" );
		$sth->execute( array( ':id' => $id ) );
		return $sth->fetch( PDO::FETCH_ASSOC );

	}

	/////////////////////////////////////////////////////////////// TASK
	/*
     * Функция для создания новой задачи
     */
	public static function createTask( $projName ) {

		$dbh = sqldb_connection::DB_connect();
		$sth = $dbh->prepare( "INSERT INTO Task(name) VALUE (:name)" );
		$sth->execute( array( ':name' => $projName ) );
		return $sth->fetch( PDO::FETCH_ASSOC );

	}
	/*
	 * функция для возвращения всех задачи из базы данных
	 */
	public static function readTask( $projName ) {

		$dbh = sqldb_connection::DB_connect();
		$sth = $dbh->prepare( "SELECT * FROM Task WHERE status!='delete'" );
		$sth->execute( array( ':name' => $projName ) );
		return $sth->fetch( PDO::FETCH_ASSOC );

	}
	/*
	 * Функция для обновления текста задачи
	 */
	public static function updateTaskText( $id, $taskText ) {

		$dbh = sqldb_connection::DB_connect();
		$sth = $dbh->prepare( "UPDATE Task SET text = :text WHERE id = :id" );
		$sth->execute( array( ':text' => $taskText, ':id' => $id ) );
		return $sth->fetch( PDO::FETCH_ASSOC );

	}
	/*
     * Функция для обновления статуса задачи
     */
	public static function updateTaskStatus( $id ) {

		$dbh = sqldb_connection::DB_connect();
		$sth = $dbh->prepare( "UPDATE Task SET status = 'done' WHERE id = :id" );
		$sth->execute( array( ':id' => $id ) );
		return $sth->fetch( PDO::FETCH_ASSOC );

	}
	/*
     * Функция для удаления задачи
     */
	public static function deleteTask( $id ) {

		$dbh = sqldb_connection::DB_connect();
		$sth = $dbh->prepare( "UPDATE Task SET status = 'delete' WHERE id = :id" );
		$sth->execute( array( ':id' => $id ) );
		return $sth->fetch( PDO::FETCH_ASSOC );

	}

	/////////////////////////////////////////////////////////////// AUTHORIZATION

}