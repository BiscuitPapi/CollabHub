<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/autocomplete.css" rel="stylesheet" />
    </style>
</head>

<body>





    <!-- Your additional content for adding badges -->
    <div class="tab-pane" id="findMember">
        <div class="row">
            <div class="col-md-12">
                <h5 class="mb-3"></h5>
                <div class="form-group">
                    <div class="row justify-content-center">
                        <!-- Center aligning the row -->
                        <div class="autocomplete" style="width:300px;">
                            <input id="myInput" type="text" name="myCountry" placeholder="Input skill required">
                        </div>
                        <button onclick="addSkills()" class="btn btn-primary" style="color: white;">Add
                        </button>
                    </div>
                </div>
                <br>

                <!-- Suggestions dropdown container -->
                <div class="form-group" id="suggestions-container"></div>

                <center>
                    <button onclick="getFinalArray()" class="btn btn-success">Search</button>
                </center>
            </div>
        </div>
    </div>










    <script src="assets/js/searchAPI.js"></script>

</body>

</html>