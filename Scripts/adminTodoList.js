document.addEventListener("DOMContentLoaded", loadTasks);

function loadTasks() {
  const tasks = getTasksFromLocalStorage();
  const taskList = document.getElementById("taskList");
  taskList.innerHTML = "";

  tasks.forEach((task, index) => {
    const li = document.createElement("li");
    li.innerHTML = `
            <span class="task-text">${task}</span>
            <div>
              <button class="primary-btn text-nowrap" onclick="editTask(${index})">Edit</button>
              <button class="primary-btn text-nowrap" onclick="deleteTask(${index})">Delete</button>
            </div>
        `;
    taskList.appendChild(li);
  });
}

function addTask() {
  const taskInput = document.getElementById("taskInput");
  const task = taskInput.value.trim();

  if (task) {
    const tasks = getTasksFromLocalStorage();
    tasks.push(task);
    setTasksToLocalStorage(tasks);
    taskInput.value = "";
    loadTasks();
  }
}

function editTask(index) {
  const tasks = getTasksFromLocalStorage();
  const newTask = prompt("Edit your task:", tasks[index]);

  if (newTask !== null) {
    tasks[index] = newTask.trim();
    setTasksToLocalStorage(tasks);
    loadTasks();
  }
}

function deleteTask(index) {
  const tasks = getTasksFromLocalStorage();
  tasks.splice(index, 1);
  setTasksToLocalStorage(tasks);
  loadTasks();
}

function getTasksFromLocalStorage() {
  return JSON.parse(localStorage.getItem("tasks")) || [];
}

function setTasksToLocalStorage(tasks) {
  localStorage.setItem("tasks", JSON.stringify(tasks));
}
