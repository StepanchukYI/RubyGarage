<?php

class sqldb_connection {
	/*
	 * ИНКАПСУЛИРОВАННАЯ ФУНКЦИЯ, ДЛЯ КОДКЛЮЧЕНИЮ В БАЗЕ(ИНКАПСУЛИРОВАННАЯ!!)
	 */
	private static function DB_connect() {
		$dsn      = 'mysql:dbname=rubygarage;host=127.0.0.1';
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
		return $dbh->lastInsertId();

	}
	/*
	 * функция для возвращения всех проектов из базы данных
	 */
	public static function readProject(  ) {

		$dbh = sqldb_connection::DB_connect();
		$sth = $dbh->prepare( "SELECT * FROM Project WHERE status != 'delete'" );
		$sth->execute();
		return $sth->fetchall( PDO::FETCH_ASSOC );

	}
	/*
	 * функция для возвращения всех проектов из базы данных
	 */
	public static function readProjectById( $id ) {

		$dbh = sqldb_connection::DB_connect();
		$sth = $dbh->prepare( "SELECT * FROM Project WHERE id = :id" );
		$sth->execute( array( ':id' => $id ));
		return $sth->fetch( PDO::FETCH_ASSOC );

	}
	/*
	 * Функция для обновления текстов проектов
	 */
	public static function updateProjectName( $id, $projName ) {

		$dbh = sqldb_connection::DB_connect();
		$sth = $dbh->prepare( "UPDATE exercise SET name = :name WHERE id = :id" );
		return $sth->execute( array( ':name' => $projName, ':id' => $id ) );

	}
	/*
     * Функция для удаления проекта
     */
	public static function deleteProject( $id ) {

		$dbh = sqldb_connection::DB_connect();
		$sth = $dbh->prepare( "UPDATE exercise SET status = 'delete' WHERE id = :id" );
		return $sth->execute( array( ':id' => $id ) );

	}


	/////////////////////////////////////////////////////////////// TASK
	/*
     * Функция для создания новой задачи
     */
	public static function createTask( $name, $id ) {

		$dbh = sqldb_connection::DB_connect();
		$sth = $dbh->prepare( "INSERT INTO Task(text, id) VALUE (:name, :id)" );
		$sth->execute( array( ':name' => $name, ':id' => $id ) );
		return $dbh->lastInsertId();

	}
	/*
	 * функция для возвращения всех задачи из базы данных
	 */
	public static function readTask( ) {

		$dbh = sqldb_connection::DB_connect();
		$sth = $dbh->prepare( "SELECT * FROM Task WHERE status!='delete'" );
		$sth->execute();
		return $sth->fetchAll( PDO::FETCH_ASSOC );
	}
	/*
	 * функция для возвращения всех задачи из базы данных
	 */
	public static function readTaskNyId( $id ) {

		$dbh = sqldb_connection::DB_connect();
		$sth = $dbh->prepare( "SELECT * FROM Task WHERE status!='delete' AND id = :id" );
		$sth->execute( array( ':id' => $id ) );
		return $sth->fetch( PDO::FETCH_ASSOC );
	}
	/*
	 * Функция для обновления текста задачи
	 */
	public static function updateTaskText( $id, $taskText ) {

		$dbh = sqldb_connection::DB_connect();
		$sth = $dbh->prepare( "UPDATE Task SET text = :text WHERE id = :id" );
		return $sth->execute( array( ':text' => $taskText, ':id' => $id ) );

	}
	/*
     * Функция для обновления статуса задачи
     */
	public static function updateTaskStatus( $id ) {

		$dbh = sqldb_connection::DB_connect();
		$sth = $dbh->prepare( "UPDATE Task SET status = 'done' WHERE id = :id" );
		return $sth->execute( array( ':id' => $id ) );

	}
	/*
     * Функция для удаления задачи
     */
	public static function deleteTask( $id ) {

		$dbh = sqldb_connection::DB_connect();
		$sth = $dbh->prepare( "UPDATE Task SET status = 'delete' WHERE id = :id" );
		return $sth->execute( array( ':id' => $id ) );

	}

	/////////////////////////////////////////////////////////////// AUTHORIZATION

}