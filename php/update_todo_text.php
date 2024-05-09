<?php

include '../db_conn.php';

class UpdateTodoText
{
	private $conn;

	public function __construct($conn)
	{
		$this->conn = $conn;
	}

	/**
	 * Updates the text of an existing todo.
	 *
	 * @param int $todoId The ID of the todo to be updated.
	 * @param string $newText The new text for the todo.
	 *
	 * @return string Returns whether operation was succesful or not.
	 */
	public function updateTodoText($todoId, $newText)
	{
		// Update query
		$sql = "UPDATE todos SET todo_text='$newText' WHERE id='$todoId'";

		if ($this->conn->query($sql) === true) {
			return "Todo text updated successfully";
		} else {
			return "Error: " . $sql . "<br>" . $this->conn->error;
		}
	}
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$todoId = $_POST['id'];
	$newText = $_POST['text'];

	$UpdateTodoText = new UpdateTodoText($conn);
	echo $UpdateTodoText->updateTodoText($todoId, $newText);
}

$conn->close();
