document.addEventListener("DOMContentLoaded", function (event) {
    const workerBtn = document.getElementById("workerBtn");
    const recruiterBtn = document.getElementById("recruiterBtn");
    const rolesChoice = document.getElementById("rolesChoice");
    const choiceInput = document.getElementById("choiceInput");
    const passwordInput = document.getElementById("passwordInput");
    const eyeBtn = document.getElementById("eyeBtn");
    const eyeIcon = document.getElementById("eyeIcon");

    if (
        !workerBtn ||
        !recruiterBtn ||
        !rolesChoice ||
        !choiceInput ||
        !passwordInput ||
        !eyeBtn ||
        !eyeIcon
    ) {
        console.error("One or more elements are not found in the DOM.");
        return; // Exit if any element is not found
    }

    // Function to update choiceInput inner HTML
    function updateChoiceInput() {
        if (rolesChoice.value === "worker") {
            choiceInput.innerHTML = `
              <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                  <div class="col-12 mb-2">
                      <label for="phone" class="primary-text fw-bold">Phone Number</label>
                  </div>
                  <div class="col-12 mb-2 justify-content-center">
                      <input type="tel" name="phone" required class="input-primary col-12 shadow-sm" placeholder="Enter your Phone Number...">
                  </div>
              </div>
              <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                  <div class="col-12 mb-2">
                      <label for="address" class="primary-text fw-bold">Address</label>
                  </div>
                  <div class="col-12 mb-2 justify-content-center">
                      <input type="text" name="address" required class="input-primary col-12 shadow-sm" placeholder="Enter your Address...">
                  </div>
              </div>
              <div class="col-12 mb-2">
                  <div class="col-12 mb-2">
                      <label for="profile_picture" class="primary-text fw-bold">Profile Picture</label>
                  </div>
                  <div class="col-12 mb-2 justify-content-center">
                      <input required type="file" accept="image/png,image/jpg,image/jpeg" name="profile_picture" class="input-primary col-12 shadow-sm">
                  </div>
              </div>
              <div class="col-12 mb-2">
                  <input type="submit" value="Sign Up" name="SignUpBtn" class="primary-btn col-12">
              </div>
          `;
        } else {
            choiceInput.innerHTML = `
              <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
                  <div class="col-12 mb-2">
                      <label for="company_name" class="primary-text fw-bold">Company Name</label>
                  </div>
                  <div class="col-12 mb-2 justify-content-center">
                      <input type="text" name="company_name" required class="input-primary col-12 shadow-sm" placeholder="Enter your Company Name...">
                  </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
                  <div class="col-12 mb-2">
                      <label for="company_culture" class="primary-text fw-bold">Company Culture</label>
                  </div>
                  <div class="col-12 mb-2 justify-content-center">
                      <textarea class="col-12 input-primary shadow-sm resize-none" row="3" placeholder="Enter your Company Culture..." name="company_culture" required></textarea>
                  </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
                  <div class="col-12 mb-2">
                      <label for="company_description" class="primary-text fw-bold">Company Description</label>
                  </div>
                  <div class="col-12 mb-2 justify-content-center">
                      <textarea class="col-12 input-primary shadow-sm resize-none" row="3" placeholder="Enter your Company Description..." name="company_description" required></textarea>
                  </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
                  <div class="col-12 mb-2">
                      <label for="company_benefits" class="primary-text fw-bold">Company Benefits</label>
                  </div>
                  <div class="col-12 mb-2 justify-content-center">
                      <textarea class="col-12 input-primary shadow-sm resize-none" row="3" placeholder="Enter your Company Benefits..." name="company_benefits" required></textarea>
                  </div>
              </div>
              <div class="col-12 mb-2">
                  <div class="col-12 mb-2">
                      <label for="company_logo" class="primary-text fw-bold">Company Logo</label>
                  </div>
                  <div class="col-12 mb-2 justify-content-center">
                      <input type="file" accept="image/png,image/jpg,image/jpeg" name="company_logo" class="input-primary col-12 shadow-sm">
                  </div>
              </div>
              <div class="col-12 mb-2">
                  <input type="submit" value="Sign Up" name="SignUpBtn" class="primary-btn col-12">
              </div>
          `;
        }
    }

    // Initial role choice (default)
    rolesChoice.value = workerBtn.getAttribute("data-roles");
    updateChoiceInput();

    // Event listeners for buttons
    workerBtn.addEventListener("click", function () {
        rolesChoice.value = workerBtn.getAttribute("data-roles");
        updateChoiceInput();
        workerBtn.classList.add("rolesBtnActive");
        workerBtn.classList.remove("rolesBtn");
        recruiterBtn.classList.remove("rolesBtnActive");
        recruiterBtn.classList.add("rolesBtn");
    });

    recruiterBtn.addEventListener("click", function () {
        rolesChoice.value = recruiterBtn.getAttribute("data-roles");
        updateChoiceInput();
        recruiterBtn.classList.add("rolesBtnActive");
        recruiterBtn.classList.remove("rolesBtn");
        workerBtn.classList.remove("rolesBtnActive");
        workerBtn.classList.add("rolesBtn");
    });

    // Password visibility toggle
    eyeBtn.addEventListener("click", function () {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("bi-eye-fill");
            eyeIcon.classList.add("bi-eye-slash-fill");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("bi-eye-slash-fill");
            eyeIcon.classList.add("bi-eye-fill");
        }
    });
});
