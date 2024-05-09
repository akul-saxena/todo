<?php

include '../db_conn.php';

class Get
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /**
     * Gets all todos.
     *
     * @return array Returns an array of todos.
     */
    public function getTodos()
    {
        // Select Query
        $sql = "SELECT * FROM todos";
        $result = $this->conn->query($sql);
        $todos = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $todos[] = $row;
            }
        }

        return $todos;
    }
}

$Get = new Get($conn);
$todos = $Get->getTodos();

if (!empty($todos)) {
    //If a todo item is present, print the card with item and edit, delete and mark done buttons
    foreach ($todos as $todo) {
        $todoId = $todo["id"];
        $todoText = $todo["todo_text"];
        $status = $todo["status"];
        echo "<div class='todo-item " . ($status == 'done' ? 'done' : '') . "' data-id='$todoId'>
                <p class='todo-text'>$todoText </p>
                  <input type='text' class='edit-input' value='$todoText''>
                  <div>
                  <button class='mark-done' data-id='$todoId'>Mark Done</button>
                  <button class='edit-todo'>Edit Todo</button>
                  <button class='delete-todo' data-id='$todoId'>Delete</button>
                  </div>
            </div>";
    }
} else {
    echo "Add an Item!";
}

$conn->close();
