const starRating = document.querySelector(".star-rating");
const stars = starRating.getElementsByClassName("fa-star");
const inputField = document.getElementById("input_2");
let rating = 0;

function setRating(ratingValue) {
  rating = ratingValue;
  for (let i = 0; i < stars.length; i++) {
    if (i < ratingValue) {
      stars[i].classList.add("checked");
    } else {
      stars[i].classList.remove("checked");
    }
  }
  inputField.value = ratingValue;
}

function resetRating() {
  setRating(rating);
}

Array.from(stars).forEach((star, index) => {
  star.addEventListener("click", () => {
    setRating(index + 1);
  });

  star.addEventListener("mouseover", () => {
    for (let i = 0; i <= index; i++) {
      stars[i].classList.add("checked");
    }
  });

  star.addEventListener("mouseout", () => {
    resetRating();
  });
});

starRating.addEventListener("mouseout", () => {
  resetRating();
});

function validateForm() {
  const starsInput = document.getElementById("input_2");
  const starsValue = parseInt(starsInput.value);
  const commentInput = document.getElementById("input_3");

  if (starsValue === 0) {
    alert("Please select a star rating.");
    return false; // Cancel form submission
  } else if (commentInput.value === "") {
    alert("Please write your comments.");
    return false; // Cancel form submission
  }

  return true; // Allow form submission
}

function submitReview() {
  if (validateForm()) {
    var values = document.getElementById("input_1").value;

    // Split the values using the "&" separator
    var separatedValues = values.split("&");

    // Extract values into two variables
    var reviewee = separatedValues[0];
    var feedback_ID = separatedValues[1];
    var stars = document.getElementById("input_2").value;
    var comment = document.getElementById("input_3").value;

    // Create an object with the data to be sent
    var data = {
      reviewee: reviewee,
      feedback_ID: feedback_ID,
      stars: stars,
      comment: comment,
    };

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "assets/php/process_addReview.php", true);
    xhr.setRequestHeader("Content-Type", "application/json"); // Set the content type to JSON

    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          console.log(xhr.responseText);
          alert("You have successfully submitted a review!");
          //window.location.href = "login.php";
        } else {
          console.error("Error:" + xhr.statusText);
          alert("Error  submitting the review. Please, try again.");
        }
      }
    };

    // Convert the data object to a JSON string
    var jsonData = JSON.stringify(data);

    // Send the JSON data in the request
    xhr.send(jsonData);
  }
}
