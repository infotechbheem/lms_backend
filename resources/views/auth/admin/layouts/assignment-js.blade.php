    <script src="{{ asset('admin-asset/plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#hidden-section").hide();
            $(".controller-icon a[title='Add question']").on("click", function(e) {
                e.preventDefault();

                const newSection = $("#hidden-section")
                    .clone()
                    .removeAttr("id")
                    .addClass("assigment-title-decription")
                    .show();


                $(".assigment-title-decription-new-section").append(newSection);
            });
            $(document).on("click", ".delete-section", function(e) {
                e.preventDefault();
                $(this).closest(".new-section").remove();
            });



            $(".form-select").on("click", function(e) {
                e.stopPropagation(); // Prevents closing when clicking inside the dropdown
                $(this).toggleClass("expanded");
            });

            // Close dropdown when clicking outside
            $(document).on("click", function() {
                $(".form-select").removeClass("expanded");
            });

            $(document).on("click", function(e) {
                const modal = $("#categoryModal");
                if (modal.hasClass("show") && !$(e.target).closest(".modal-dialog").length) {
                    modal.modal("hide");
                }
            });
            $("#categoryModal .modal-dialog").on("click", function(e) {
                e.stopPropagation();
            });


            // Add Regular Option
            $(document).on("click", ".multiple-chopice-option-add p", function(e) {
                e.preventDefault();

                const newOption = `
                    <div class="assigment-title multiple-chopice-option">
                    <i class="fa-regular fa-circle"></i>
                    <input type="text" name="new-assignment-description" placeholder="New Option" required>
                    <span class="delete-option"><i class="fa-solid fa-xmark"></i></span>
                    </div>
                     `;

                $(this).closest(".new-section").find(".multiple-chopice-option").last().after(newOption);
            });

            // Add "Other" Option
            $(document).on("click", ".multiple-chopice-option-add .add-other", function(e) {
                e.preventDefault();

                const otherOption = `
                <div class="assigment-title multiple-chopice-option">
                   <i class="fa-regular fa-circle"></i>
                  <input type="text" name="new-assignment-description" value="Other..." readonly>
                 <span class="delete-option"><i class="fa-solid fa-xmark"></i></span>
                 </div>
                   `;

                $(this).closest(".new-section").find(".multiple-chopice-option").last().after(otherOption);
            });

            // Delete Option
            $(document).on("click", ".delete-option", function(e) {
                e.preventDefault();
                $(this).closest(".multiple-chopice-option").remove();
            });
        });

        //toggle
        document.getElementById('toggle-btn').addEventListener('change', function() {
            if (this.checked) {
                console.log('Toggle is ON');
            } else {
                console.log('Toggle is OFF');
            }
        });

        // choose multiple choice 

        $('.list-group-item').on('click', function() {
            const selectedText = $(this).text().trim();

            console.log(selectedText);

            if (selectedText === 'Short answer') {
                $("#hidden-section").hide();
                $('#shortAnswer-section').show();
                $('.multiple-chopice-option, .multiple-chopice-option-add').hide();
            } else if (selectedText === 'Multiple choice') {
                $('#shortAnswer-section').hide();
                $('.multiple-chopice-option, .multiple-chopice-option-add').css('display', 'flex');
            }
        });

    </script>
    {{-- <script src="{{ asset('admin-asset/plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initially hide the hidden section

            $("#hidden-section").hide();

            // Controller icon click event
            $(".controller-icon a[title='Add question']").on("click", function(e) {
                e.preventDefault();

                const newSection = $("#hidden-section")
                    .clone()
                    .removeAttr("id")
                    .addClass("assigment-title-decription")
                    .show();

                $(".assigment-title-decription-new-section").append(newSection);
            });

            // Delete section event
            $(document).on("click", ".delete-section", function(e) {
                e.preventDefault();
                $(this).closest(".new-section").remove();
            });

            // Handle form-select dropdown clicks
            $(".form-select").on("click", function(e) {
                e.stopPropagation(); // Prevent closing dropdown on internal clicks
                $(this).toggleClass("expanded");
            });

            // Close dropdown when clicking outside
            $(document).on("click", function() {
                $(".form-select").removeClass("expanded");
            });

            // Handle modal close when clicking outside modal dialog
            $(document).on("click", function(e) {
                const modal = $("#categoryModal");
                if (modal.hasClass("show") && !$(e.target).closest(".modal-dialog").length) {
                    modal.modal("hide");
                }
            });
            $("#categoryModal .modal-dialog").on("click", function(e) {
                e.stopPropagation();
            });

            // Add Regular Option click event
            $(document).on("click", ".multiple-chopice-option-add p", function(e) {
                e.preventDefault();

                const newOption = `
                <div class="assigment-title multiple-chopice-option">
                    <i class="fa-regular fa-circle"></i>
                    <input type="text" name="new-assignment-description" placeholder="New Option" required>
                    <span class="delete-option"><i class="fa-solid fa-xmark"></i></span>
                </div>
            `;

                $(this).closest(".new-section").find(".multiple-chopice-option").last().after(newOption);
            });

            // Add "Other" Option click event
            $(document).on("click", ".multiple-chopice-option-add .add-other", function(e) {
                e.preventDefault();

                const otherOption = `
                <div class="assigment-title multiple-chopice-option">
                    <i class="fa-regular fa-circle"></i>
                    <input type="text" name="new-assignment-description" value="Other..." readonly>
                    <span class="delete-option"><i class="fa-solid fa-xmark"></i></span>
                </div>
            `;

                $(this).closest(".new-section").find(".multiple-chopice-option").last().after(otherOption);
            });

            // Delete option event
            $(document).on("click", ".delete-option", function(e) {
                e.preventDefault();
                $(this).closest(".multiple-chopice-option").remove();
            });

            // Toggle event
            document.getElementById('toggle-btn').addEventListener('change', function() {
                if (this.checked) {
                    console.log('Toggle is ON');
                } else {
                    console.log('Toggle is OFF');
                }
            });

            // Choose multiple choice event
            $('.list-group-item').on('click', function() {
                const selectedText = $(this).text().trim();

                console.log(selectedText);

                if (selectedText === 'Short answer') {
                    // Show Short Answer Section and hide multiple choice options

                    $("#shortAnswer-section").show();
                    $('.multiple-chopice-option, .multiple-chopice-option-add').hide();

                } else if (selectedText === 'Multiple choice') {
                    // Ensure Short Answer Section is hidden
                    $('#shortAnswer-section').hide();
                    // Show multiple choice options
                    $('.multiple-chopice-option, .multiple-chopice-option-add').css('display', 'flex');
                }
            });

        });

    </script> --}}
