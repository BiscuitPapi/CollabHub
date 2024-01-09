var profileCropper;
var bannerCropper;

$("#chooseProfileFileButton").click(function () {
  $("#profile_picture").click();
});

$("#chooseBannerFileButton").click(function () {
  $("#banner_picture").click();
});

$("#profile_picture").change(function () {
  var input = this;
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      if (profileCropper) {
        profileCropper.replace(e.target.result);
      } else {
        profileCropper = new Cropper(
          document.getElementById("profileCroppedCanvas"),
          {
            aspectRatio: 1,
            viewMode: 2,
          }
        );

        profileCropper.replace(e.target.result);
      }
      showModal();
    };
    reader.readAsDataURL(input.files[0]);
  }
});

$("#banner_picture").change(function () {
  var input = this;
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      if (bannerCropper) {
        bannerCropper.replace(e.target.result);
      } else {
        bannerCropper = new Cropper(
          document.getElementById("bannerCroppedCanvas"),
          {
            aspectRatio: 16 / 9, // Set your desired aspect ratio for the banner image
            viewMode: 2,
          }
        );

        bannerCropper.replace(e.target.result);
      }
      $("#bannerCropModal").modal("show");
    };
    reader.readAsDataURL(input.files[0]);
  }
});

$("#confirmProfileCrop").click(function () {
  if (profileCropper) {
    var canvas = profileCropper.getCroppedCanvas({ width: 110, height: 110 });
    if (canvas) {
      canvas.toBlob(function (blob) {
        var formData = new FormData();
        formData.append("profile_picture", blob);
        $.ajax({
          url: "assets/php/process_editProfilePicture.php",
          method: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            if (response.imageData) {
              alert("Your profile picture is updated!");

              var newImageData = response.imageData;

              // Find the <img> element with the id 'smallProfilePicture_1' and 'smallProfilePicture_2'
              var imgElement = document.getElementById("smallProfilePicture_1");
              var imgElement_2 = document.getElementById(
                "smallProfilePicture_2"
              );

              // Update the 'src' attribute of the <img> element with the new image data
              imgElement.src = "data:image/jpeg;base64," + newImageData;
              imgElement_2.src = "data:image/jpeg;base64," + newImageData;

              $("#profileCropModal").modal("hide");
            } else {
              alert("Image data is empty or null. Failed to update image.");
            }
          },
        });
      });
    }
  }
});

$("#confirmBannerCrop").click(function () {
  if (bannerCropper) {
    var canvas = bannerCropper.getCroppedCanvas({ width: 800, height: 500 }); // Set your desired dimensions for the banner image
    if (canvas) {
      canvas.toBlob(function (blob) {
        var formData = new FormData();
        formData.append("banner_picture", blob);
        $.ajax({
          url: "assets/php/process_editBanner.php",
          method: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            alert("Your banner picture is updated!");
            $("#bannerCropModal").modal("hide");
          },
        });
      });
    }
  }
});

$("#profileCropModal, #bannerCropModal").on("hidden.bs.modal", function () {
  $("#profile_picture, #banner_picture").val("");
  if (profileCropper) {
    profileCropper.destroy();
  }
  if (bannerCropper) {
    bannerCropper.destroy();
  }
});
