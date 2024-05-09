$(document).ready(function () {
  // Function to load todos when the document is ready
  loadTodos();

  $("#add-todo-btn").click(function () {
    var todoText = $("#todo-input").val();
    if (todoText !== "") {
      addTodoAjax(todoText);
    }
  });

  // Event for deleting a todo
  $(document).on("click", ".delete-todo", function () {
    var todoId = $(this).data("id");
    deleteTodoAjax(todoId);
  });

  // Event for marking a todo as done
  $(document).on("click", ".mark-done", function () {
    var todoId = $(this).data("id");
    updateTodoStatusAjax(todoId);
  });

  // Function to load todos using AJAX
  function loadTodos() {
    $.ajax({
      url: "php/get_todos.php",
      type: "GET",
      success: function (response) {
        $("#todo-list").html(response);
      },
    });
  }

  // Function to add a todo using AJAX
  function addTodoAjax(todoText) {
    $.ajax({
      url: "php/add_todo.php",
      type: "POST",
      data: { todo_text: todoText },
      success: function () {
        $("#todo-input").val("");
        loadTodos();
      },
    });
  }

  // Function to delete a todo using AJAX
  function deleteTodoAjax(todoId) {
    $.ajax({
      url: "php/delete_todo.php",
      type: "POST",
      data: { id: todoId },
      success: function () {
        loadTodos();
      },
    });
  }

  // Function to update the status of a todo using AJAX
  function updateTodoStatusAjax(todoId) {
    $.ajax({
      url: "php/update_todo.php",
      type: "POST",
      data: { id: todoId },
      success: function () {
        loadTodos();
      },
    });
  }

  // Event for editing a todo
  $(document).on("click", ".edit-todo", function () {
    var $todoItem = $(this).closest(".todo-item");
    var $todoText = $todoItem.find(".todo-text");
    var $editInput = $todoItem.find(".edit-input");
    var $editButton = $todoItem.find(".edit-todo");

    $todoText.hide();
    $editInput.show().focus().val($todoText.text());
    $editButton.hide();

    // Show a button to save changes
    var $saveButton = $("<button class='save-todo'>Save</button>");
    $saveButton.insertAfter($editInput);

    // On clicking the save button
    $saveButton.click(function () {
      var newText = $editInput.val();
      $editInput.hide();
      $todoText.text(newText).show();
      $saveButton.remove();
      $editButton.show();

      updateTodoTextAjax($todoItem.data("id"), newText);
    });
  });

  // Function to update the text of a todo using AJAX
  function updateTodoTextAjax(todoId, newText) {
    $.ajax({
      url: "php/update_todo_text.php",
      type: "POST",
      data: { id: todoId, text: newText },
      success: function () {
        loadTodos();
      },
    });
  }
});
