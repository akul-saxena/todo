<?php

include '../db_conn.php';

class Add
{
	private $conn;

	public function __construct($conn)
	{
		$this->conn = $conn;
	}

	/**
	 * Adds a new todo.
	 *
	 * @param string $todoText It is the text of the todo which will be added.
	 *
	 * @return string Returns whether operation was success or not
	 */
	public function addTodo($todoText)
	{
		// Insert Query
		$sql = "INSERT INTO todos (todo_text) VALUES ('$todoText')";

		if ($this->conn->query($sql) === true) {
			return "Todo added successfully";
		} else {
			return "Error: " . $sql . "<br>" . $this->conn->error;
		}
	}
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$todoText = $_POST['todo_text'];

	$Add = new Add($conn);
	echo $Add->addTodo($todoText);
}

$conn->close();
