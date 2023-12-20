function validateForm() {
    const commentInput = document.getElementById("input_3");
  
      if (commentInput.value === "") {
      alert("Please write your comments.");
      return false; // Cancel form submission
    }
    return true; // Allow form submission
  }
  
  function showModal(responseText) {
    var modal = document.getElementById('myCustomModal');
    modal.style.display = 'block';
  
    // Set a timeout to hide the modal after 5 seconds
    setTimeout(function () {
      modal.style.display = 'none';
      alert("Thank you for your review!\n" + "You've given a rating of " + responseText + " stars based on your feedback.");
    }, 5000); // 5000 milliseconds = 5 seconds
  
    
  }
  
  function submitReview() {
    if (validateForm()) {
      var values = document.getElementById("input_1").value;
  
      // Split the values using the "&" separator
      var separatedValues = values.split("&");
  
      // Extract values into two variables
      var reviewee = separatedValues[0];
      var feedback_ID = separatedValues[1];
      var comment = document.getElementById("input_3").value;
  
      // Create an object with the data to be sent
      var data = {
        reviewee: reviewee,
        feedback_ID: feedback_ID,
        comment: comment
      };
  
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "assets/php/process_addReview.php", true);
      xhr.setRequestHeader("Content-Type", "application/json"); // Set the content type to JSON
  
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                showModal(xhr.responseText); // Remove the extra parenthesis here
                window.location.href = "peerReview.php";
            } else {
                console.error("Error:" + xhr.statusText);
                alert("Error submitting the review. Please try again.");
            }
        }
    };
  
      // Convert the data object to a JSON string
      var jsonData = JSON.stringify(data);
  
      // Send the JSON data in the request
      xhr.send(jsonData);

      
    }
  
   
    
  }
  