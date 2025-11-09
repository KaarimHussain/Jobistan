document.addEventListener("DOMContentLoaded", function () {
  // Current Password Toggle
  const currentPasswordInput = document.getElementById("currentPasswordInput");
  const currentEyeBtn = document.getElementById("currentEyeBtn");
  const currentEyeIcon = document.getElementById("currentEyeIcon");

  currentEyeBtn.addEventListener("click", function () {
    if (currentPasswordInput.type === "password") {
      currentPasswordInput.type = "text";
      currentEyeIcon.classList.remove("bi-eye-fill");
      currentEyeIcon.classList.add("bi-eye-slash-fill");
    } else {
      currentPasswordInput.type = "password";
      currentEyeIcon.classList.remove("bi-eye-slash-fill");
      currentEyeIcon.classList.add("bi-eye-fill");
    }
  });

  // New Password Toggle
  const newPasswordInput = document.getElementById("newPasswordInput");
  const newEyeBtn = document.getElementById("newEyeBtn");
  const newEyeIcon = document.getElementById("newEyeIcon");

  newEyeBtn.addEventListener("click", function () {
    if (newPasswordInput.type === "password") {
      newPasswordInput.type = "text";
      newEyeIcon.classList.remove("bi-eye-fill");
      newEyeIcon.classList.add("bi-eye-slash-fill");
    } else {
      newPasswordInput.type = "password";
      newEyeIcon.classList.remove("bi-eye-slash-fill");
      newEyeIcon.classList.add("bi-eye-fill");
    }
  });
});
