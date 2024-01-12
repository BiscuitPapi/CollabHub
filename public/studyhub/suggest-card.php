<div class="tab-pane" id="sug">
    <!-- Start of Suggestion -->
    <div class="card profile-card-2" id="suggestionContent" style="min-height: 300px;">
        <div class="card-body">

            <h5 class="mb-3">Search Members</h5>
            <div class="col-12">

                <div class="form-group">
                    <div class="row justify-content-center mx-auto">
                        <div class="row">
                            <div class="col">
                                <!-- Center aligning the row -->
                                <div class="autocomplete" style="width: 300px;">
                                    <input id="myInput" type="text" name="myCountry" placeholder="Input skill required"
                                        style="width: 100%; color: black;">
                                </div>
                                <div class="text-center mt-2">
                                    <button onclick="addSkills()" class="btn btn-primary"
                                        style="color: white;">Add</button>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row mt-2"> <!-- Use margin-top (mt-2) for spacing -->

                        </div>
                    </div>
                </div>

                <div class="" id="badgeContainer">
                </div>


                <br>

                <!-- Suggestions dropdown container -->
                <div class="form-group" id="suggestions-container"></div>

                <center>
                    <button onclick="getFinalArray()" class="btn btn-success">Search</button>
                </center>

                <div class="custom-modal" id="myCustomModal">
                    <div class="modal-content">
                        <center>
                            <div class="loader"></div>
                        </center>

                        <p id="loadingMessage">Searching for potential members...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Suggestion -->
    <!-- Start of Suggestion -->
    <div class="card profile-card-2" id="suggestionContent" style="min-height: 300px;">
        <div class="card-body">
            <h5 class="mb-3">Suggested Members</h5>
            <div class="card"> <!-- Moved the ID here -->
                <div class="card-body" id="userDetails">
                    Not searching is made yet.
                </div>
            </div>
            <div class="table-responsive">
                <table id="suggestionTable" class="table table-hover table-striped">
                    <tbody>
                        <!-- Table content will be inserted here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End of Suggestion -->
</div>

<div class="row-2">
    
</div>