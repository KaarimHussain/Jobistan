const button = document.getElementById("myButton");
// const responseDiv = document.getElementById("response");

button.addEventListener("click", function () {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../savePost.php"); // Replace with the actual path to your PHP script

  xhr.onload = function () {
    if (xhr.status === 200) {
      responseDiv.textContent = xhr.responseText;
    } else {
      responseDiv.textContent = "Error: " + xhr.statusText;
    }
  };

  xhr.send();
});
