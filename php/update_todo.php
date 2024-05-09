<?php
include 'db_conn.php';

class UpdateTodoStatus
{
  private $conn;

  public function __construct($conn)
  {
    $this->conn = $conn;
  }

  /**
   * Toggles the status of a todo between 'todo' and 'done'.
   *
   * @param int $todoId The ID of the todo to be updated.
   *
   * @return string Returns a whether operation was success or not.
   */
  public function toggleTodoStatus($todoId)
  {
    // Fetch the current status of the todo item
    $sql = "SELECT status FROM todos WHERE id='$todoId'";
    $result = $this->conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $status = $row['status'];

      // Toggle the status between 'todo' and 'done'
      $newStatus = ($status == 'done') ? 'todo' : 'done';

      // Update Query
      $updateSql = "UPDATE todos SET status='$newStatus' WHERE id='$todoId'";

      if ($this->conn->query($updateSql) === TRUE) {
        return "Todo status updated successfully";
      } else {
        return "Error: " . $updateSql . "<br>" . $this->conn->error;
      }
    } else {
      return "Todo not found";
    }
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $todoId = $_POST['id'];

  $UpdateTodoStatus = new UpdateTodoStatus($conn);
  echo $UpdateTodoStatus->toggleTodoStatus($todoId);
}

$conn->close();
