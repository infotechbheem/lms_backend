<script>
    $(document).ready(function() {
        $("#membership-form").validate({
            rules: {
                membership_name: {
                    required: true
                    , minlength: 3
                }
                , plan: {
                    required: true
                }
                , currency: {
                    required: true
                }
                , description: {
                    required: true
                }
                , selling_price: {
                    required: true
                    , number: true
                    , min: 0
                }
                , discount_price: {
                    required: true
                    , number: true
                    , min: 0
                }
                , cover_image: {
                    required: true
                    , extension: "jpg|jpeg|png"
                }
            }
            , messages: {
                membership_name: {
                    required: "Please enter the membership name."
                    , minlength: "Membership name must consist of at least 3 characters."
                }
                , plan: {
                    required: "Please select a plan."
                }
                , currency: {
                    required: "Please select a currency."
                }
                , description: {
                    required: "Please enter a description."
                }
                , selling_price: {
                    required: "Please enter the selling price."
                    , number: "Please enter a valid number."
                    , min: "Selling price cannot be less than 0."
                }
                , discount_price: {
                    required: "Please enter the discount price."
                    , number: "Please enter a valid number."
                    , min: "Discount price cannot be less than 0."
                }
                , cover_image: {
                    required: "Please upload a cover image."
                    , extension: "Please upload a file with .jpg, .jpeg, or .png extension."
                }
            }
            , errorElement: 'span'
            , errorPlacement: function(error, element) {
                error.addClass('text-danger');
                if (element.prop('type') === 'checkbox') {
                    error.insertAfter(element.siblings('label'));
                } else {
                    error.insertAfter(element);
                }
            }
            , highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            }
            , unhighlight: function(element, errorClass, validClass) {
                $(element).addClass('is-valid').removeClass('is-invalid');
            }
            , submitHandler: function(form) {
                form.submit();
            }
        });

        $("#offlineClassForm").validate({
            rules: {
                course_title: {
                    required: true
                    , minlength: 3
                }
                , class_type: {
                    required: true
                }
                , time: {
                    required: true
                }
                , venue: {
                    required: true
                    , minlength: 3
                }
                , cover_image: {
                    required: true
                    , extension: "jpg|jpeg|png"
                }
                , coordinator: {
                    required: true
                    , minlength: 3
                }
                , amount_status: {
                    required: true
                }
                , currency: {
                    required: true
                }
                , discount_price: {
                    required: true
                    , number: true
                    , min: 0
                }
                , descriptions: {
                    required: true
                    , minlength: 10
                }
            }
            , messages: {
                course_title: {
                    required: "Please enter the course title."
                    , minlength: "Course title must consist of at least 3 characters."
                }
                , class_type: {
                    required: "Please select a class type."
                }
                , time: {
                    required: "Please select a time."
                }
                , venue: {
                    required: "Please enter the venue."
                    , minlength: "Venue must consist of at least 3 characters."
                }
                , cover_image: {
                    required: "Please upload a cover image."
                    , extension: "Please upload a file with .jpg, .jpeg, or .png extension."
                }
                , coordinator: {
                    required: "Please enter the coordinator name."
                    , minlength: "Coordinator name must consist of at least 3 characters."
                }
                , amount_status: {
                    required: "Please select the amount status."
                }
                , currency: {
                    required: "Please select a currency."
                }
                , discount_price: {
                    required: "Please enter the discount price."
                    , number: "Please enter a valid number."
                    , min: "Discount price cannot be less than 0."
                }
                , descriptions: {
                    required: "Please enter a description."
                    , minlength: "Description must consist of at least 10 characters."
                }
            }
            , errorElement: 'span'
            , errorPlacement: function(error, element) {
                error.addClass('text-danger');
                if (element.prop('type') === 'checkbox') {
                    error.insertAfter(element.siblings('label'));
                } else {
                    error.insertAfter(element);
                }
            }
            , highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            }
            , unhighlight: function(element, errorClass, validClass) {
                $(element).addClass('is-valid').removeClass('is-invalid');
            }
            , submitHandler: function(form) {
                form.submit();
            }
        });

    });

</script>
