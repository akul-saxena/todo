<?php
include 'db_conn.php';

class Delete
{
  private $conn;

  public function __construct($conn)
  {
    $this->conn = $conn;
  }

  /**
   * Deletes an existing todo.
   *
   * @param int $todoId The ID of the todo which we want to deleted.
   *
   * @return string Returns whether operation was success or not
   */
  public function deleteTodo($todoId)
  {
    // Delete query
    $sql = "DELETE FROM todos WHERE id='$todoId'";

    if ($this->conn->query($sql) === TRUE) {
      return "Todo deleted successfully";
    } else {
      return "Error: " . $sql . "<br>" . $this->conn->error;
    }
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $todoId = $_POST['id'];

  $Delete = new Delete($conn);
  echo $Delete->deleteTodo($todoId);
}

$conn->close();
