<!DOCTYPE html>
<html>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        
    </style>    
</head>
<body>
    <form id="bannerForm" enctype="multipart/form-data" action="process_editPicture.php" method="post">
        <input type="file" name="banner_picture" id="banner_picture" style="display: none">
        <button type="button" id="chooseFileButton" class="btn btn-primary">Choose File</button>
        <input type="button" id="cropAndUpload" class="btn btn-success" value="Crop and Upload" style="display: none">
    </form>
    <div id="message"></div>

    <!-- Crop Modal -->
    <div class="modal fade" id="cropModal" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cropModalLabel">Crop Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center d-flex justify-content-center align-items-center">
                    <canvas id="croppedCanvas" width="500" height="500"></canvas>
                </div>


                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmCrop">Confirm Crop</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var cropper;

        $('#chooseFileButton').click(function() {
            $('#banner_picture').click();
        });

        $('#banner_picture').change(function() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    if (cropper) {
                        cropper.replace(e.target.result);
                    } else {
                        cropper = new Cropper(document.getElementById('croppedCanvas'), {
                            aspectRatio: 1,
                            viewMode: 2,
                        });
                        cropper.replace(e.target.result);
                    }
                    $('#cropModal').modal('show');
                };
                reader.readAsDataURL(input.files[0]);
            }
        });

        $('#confirmCrop').click(function() {
            if (cropper) {
                var canvas = cropper.getCroppedCanvas({ width: 110, height: 110 });
                if (canvas) {
                    canvas.toBlob(function(blob) {
                        var formData = new FormData();
                        formData.append('banner_picture', blob);
                        $.ajax({
                            url: 'process_editPicture.php',
                            method: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                $('#message').html(response);
                                $('#cropModal').modal('hide');
                            }
                        });
                    });
                }
            }
        });

        $('#cropModal').on('hidden.bs.modal', function () {
            $('#banner_picture').val('');
            if (cropper) {
                cropper.destroy();
            }
        });
    </script>
</body>
</html>
