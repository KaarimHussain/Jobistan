const ctx = document.getElementById("myChart");
document.addEventListener("DOMContentLoaded", function () {
  fetch("./adminGetDataChart.php")
    .then((response) => response.json())
    .then((adminData) => {
      displayCharData(adminData);
    });
});
function displayCharData(adminData) {
  new Chart(ctx, {
    type: "pie",
    data: {
      labels: ["Users", "Company", "Job Listing"],
      datasets: [
        {
          label: "Total",
          data: [adminData.users, adminData.company, adminData.jobs],
          borderWidth: 1,
          backgroundColor: ["#2f6589", "#0075c4", "#008ae6"],
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
}
