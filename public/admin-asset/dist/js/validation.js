$(document).ready(function () {
    $(".addVolunteer").validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            fathers_name: {
                required: true,
                minlength: 2
            },
            dob: {
                required: true,
                date: true
            },
            email: {
                required: true,
                email: true
            },
            phone_number: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            address: {
                required: true,
                minlength: 5
            },
            state: {
                required: true
            },
            district: {
                required: true
            },
            pin_code: {
                required: true,
                digits: true,
                minlength: 6,
                maxlength: 6
            },
            amount: {
                required: true,
                digits: true
            },
            profile_image: {
                required: true,
                extension: "jpg|jpeg"
            },
            aadhar: {
                required: true,
                extension: "pdf"
            },
            pan: {
                required: true,
                extension: "pdf"
            },
            team_leader: {
                required: true,
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Your name must be at least 2 characters long"
            },
            fathers_name: {
                required: "Please enter your father's name",
                minlength: "Your father's name must be at least 2 characters long"
            },
            dob: {
                required: "Please enter your date of birth",
                date: "Please enter a valid date"
            },
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address"
            },
            phone_number: {
                required: "Please enter your mobile number",
                digits: "Please enter only digits",
                minlength: "Your mobile number must be 10 digits long",
                maxlength: "Your mobile number must be 10 digits long"
            },
            address: {
                required: "Please enter your address",
                minlength: "Your address must be at least 5 characters long"
            },
            state: {
                required: "Please select your state"
            },
            district: {
                required: "Please select your district"
            },
            pin_code: {
                required: "Please enter your pin code",
                digits: "Please enter only digits",
                minlength: "Your pin code must be 6 digits long",
                maxlength: "Your pin code must be 6 digits long"
            },
            amount: {
                required: "Please enter amount",
                digits: "Please enter a valid amount"
            },
            profile_image: {
                required: "Please upload your photo",
                extension: "Please upload a file in one of the following formats: jpg, jpeg,"
            },
            aadhar: {
                required: "Please upload your Aadhar card",
                extension: "Please upload a file in one of the following formats: pdf"
            },
            pan: {
                required: "Please upload your Pan card",
                extension: "Please upload a file in one of the following formats: pdf"
            },
            team_leader: {
                required: "Please select your team leader",
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('text-danger');
            if (element.prop('type') === 'checkbox') {
                error.insertAfter(element.siblings('label'));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        },
    });



    $("#createUser").validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            fathers_name: {
                minlength: 3
            },
            dob: {
                required: false,
                date: true
            },
            email: {
                required: true,
                email: true
            },
            phone_number: {
                required: false,
                minlength: 10,
                maxlength: 10,
                digits: true
            },
            address: {
                required: false
            },
            profile_image: {
                required: true,
                extension: "jpg|jpeg|png|gif"
            },
            user_type: {
                required: true
            },
            department: {
                required: true
            },
            designation: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Name is required",
                minlength: "Name must be at least 3 characters long"
            },
            fathers_name: {
                minlength: "Father's name must be at least 3 characters long"
            },
            dob: {
                required: "Date of Birth is required",
                date: "Please enter a valid date"
            },
            email: {
                required: "Email is required",
                email: "Please enter a valid email"
            },
            phone_number: {
                required: "Mobile number is required",
                minlength: "Mobile number must be 10 digits",
                maxlength: "Mobile number must be 10 digits",
                digits: "Mobile number must be numeric"
            },
            address: {
                required: "Address is required"
            },
            profile_image: {
                required: "Profile image is required",
                extension: "Please upload a valid image file (jpg, jpeg, png, gif)"
            },
            user_type: {
                required: "Please select a user type"
            },
            department: {
                required: "Please select a department"
            },
            designation: {
                required: "Please select a designation"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('text-danger');
            if (element.prop('type') === 'checkbox') {
                error.insertAfter(element.siblings('label'));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        },
    });


    $("#updateCompanyDetailsForm").validate({
        rules: {
            heading_name: {
                required: false,
                minlength: 3
            },
            footer_name: {
                required: false,
                minlength: 3
            },
            address: {
                required: false,
                minlength: 5
            },
            pan_number: {
                required: false,
                minlength: 10,
                maxlength: 10
            },
            reg_number: {
                required: false,
                minlength: 5
            },
            phone_number: {
                required: false,
                minlength: 10,
                maxlength: 10,
                digits: true
            },
            email: {
                required: false,
                email: true
            },
            website_url: {
                required: false,
                url: true
            },
            footer_link: {
                required: false,
                url: true
            },
            admin_profile_image: {
                required: false,
                accept: "image/jpeg, image/jpg, image/png"
            },
            logo: {
                required: false,
                accept: "image/jpeg, image/jpg, image/png"
            },
            youtube_link: {
                url: true
            },
            instagram_link: {
                url: true
            },
            facebook_link: {
                url: true
            },
            tweeter_link: {
                url: true
            },
            linkdin_link: {
                url: true
            }
        },
        messages: {
            heading_name: {
                minlength: "The company name must be at least 3 characters long."
            },
            footer_name: {
                minlength: "The company title must be at least 3 characters long."
            },
            address: {

                minlength: "The address must be at least 5 characters long."
            },
            pan_number: {
                minlength: "The PAN number must be exactly 10 characters.",
                maxlength: "The PAN number must be exactly 10 characters."
            },
            reg_number: {
                minlength: "The registration number must be at least 5 characters long."
            },
            phone_number: {
                minlength: "The mobile number must be exactly 10 digits.",
                maxlength: "The mobile number must be exactly 10 digits.",
                digits: "Please enter a valid mobile number."
            },
            email: {
                email: "Please enter a valid email ID."
            },
            website_url: {

                url: "Please enter a valid URL."
            },
            footer_link: {
                url: "Please enter a valid URL."
            },
            admin_profile_image: {
                accept: "Only JPEG, JPG, and PNG formats are accepted."
            },
            logo: {
                accept: "Only JPEG, JPG, and PNG formats are accepted."
            },
            youtube_link: {
                url: "Please enter a valid URL."
            },
            instagram_link: {
                url: "Please enter a valid URL."
            },
            facebook_link: {
                url: "Please enter a valid URL."
            },
            tweeter_link: {
                url: "Please enter a valid URL."
            },
            linkdin_link: {
                url: "Please enter a valid URL."
            }
        },
        errorElement: "span",
        errorClass: "text-danger",
        highlight: function (element, errorClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass('is-invalid');
        }
    });



    $("#donationValidationForm").validate({
        rules: {
            donor_name: {
                required: true,
                minlength: 3
            },
            phone_number: {
                required: true,
                minlength: 10,
                maxlength: 10,
                digits: true
            },
            email: {
                required: true,
                email: true
            },
            amount: {
                required: true,
                digits: true
            },
            payment_type: {
                required: true,
            }
        },
        messages: {

            donor_name: {
                required: "Donor name should not be empty",
                minlength: 3
            },
            phone_number: {
                required: "Mobile number should not be empty",
                minlength: "Mobile number minimun length 10 digit",
                maxlength: "Mobile number maximum length 10 digit",
                digits: "Mobile number should be number"
            },
            email: {
                required: "Email id should not be empty",
                email: "Entered email should be valid email id"
            },
            amount: {
                required: "Amount should not be empty",
                digits: "Amount should be number",
            },
            payment_type: {
                required: "Select the payment type"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('text-danger');
            if (element.prop('type') === 'checkbox') {
                error.insertAfter(element.siblings('label'));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        },
    });



    $.validator.addMethod('fileType', function (value, element, param) {
        // Check if a file was selected
        if (element.files.length === 0) {
            return false;
        }
        // Get the file type and check against allowed types
        var fileType = element.files[0].type;
        return $.inArray(fileType, param) !== -1;
    }, 'Invalid file type.');

    $.validator.addMethod('fileSize', function (value, element, param) {
        // Check if a file was selected
        if (element.files.length === 0) {
            return false;
        }
        // Get the file size and check against the maximum size
        var fileSize = element.files[0].size;
        return fileSize <= param;
    }, 'File size exceeds the maximum allowed size.');


    $("#beneficiaryChangePhoto").validate({
        rules: {
            profile_image: {
                required: true,
                fileType: ['image/jpeg', 'image/jpg'], // Allowed file types
                fileSize: 2 * 1024 * 1024 // Maximum size 2MB
            }
        },
        messages: {
            profile_image: {
                required: "Please select a file.",
                fileType: "Only JPEG/JPG files are allowed.",
                fileSize: "File size must be less than 2MB."
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('text-danger');
            if (element.prop('type') === 'checkbox') {
                error.insertAfter(element.siblings('label'));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        }
    });

    $("#memberForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
            },
            fathers_name: {
                minlength: 3,
            },
            mothers_name: {
                minlength: 3,
            },
            dob: {
                date: true,
            },
            address: {
                required: false,
            },
            email: {
                required: true,
                email: true,
            },
            phone_number: {
                required: false,
                digits: true,
                minlength: 10,
                maxlength: 10,
            },
            profile_image: {
                required: true,
                extension: "jpg|jpeg|png",
                filesize: 2048000 // 2MB in bytes
            },
            aadhar_front_image: {
                extension: "jpg|jpeg|png",
                filesize: 2048000, // 2MB in bytes
            },
            aadhar_back_image: {
                extension: "jpg|jpeg|png",
                filesize: 2048000, // 2MB in bytes
            },
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Name must be at least 3 characters long",
            },
            fathers_name: {
                minlength: "Father's name must be at least 3 characters long",
            },
            mothers_name: {
                minlength: "Mother's name must be at least 3 characters long",
            },
            dob: {
                date: "Please enter a valid date of birth",
            },
            address: {
                required: "Please enter your address",
            },
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address",
            },
            phone_number: {
                required: "Please enter your phone number",
                digits: "Please enter only digits",
                minlength: "Phone number must be exactly 10 digits",
                maxlength: "Phone number must be exactly 10 digits",
            },
            profile_image: {
                required: "Please upload a profile image",
                extension: "Only JPG, JPEG, and PNG files are allowed",
                filesize: "File size must not exceed 2MB",
            },
            aadhar_front_image: {
                extension: "Only JPG, JPEG, and PNG files are allowed",
                filesize: "File size must not exceed 2MB",
            },
            aadhar_back_image: {
                extension: "Only JPG, JPEG, and PNG files are allowed",
                filesize: "File size must not exceed 2MB",
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('text-danger');
            if (element.prop('type') === 'checkbox') {
                error.insertAfter(element.siblings('label'));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        }
    });


    $("#quickForm").validate({
        rules: {
            project_title: {
                required: true,
                minlength: 3,
            },
            project_category: {
                required: true,
            },
            project_description: {
                required: true,
                minlength: 10,
            },
            project_starting_date: {
                required: true,
                date: true,
            },
            project_ending_date: {
                required: true,
                date: true,
            },
            csr_company: {
                required: true,
            },
            project_budget: {
                required: true,
                number: true,
                min: 0,
            },
            project_image: {
                extension: "jpg|jpeg|png",
                filesize: 2048000, // 2MB in bytes
            }
        },
        messages: {
            project_title: {
                required: "Please enter the project title",
                minlength: "The project title must be at least 3 characters long",
            },
            project_category: {
                required: "Please select a project category",
            },
            project_description: {
                required: "Please enter the project description",
                minlength: "The project description must be at least 10 characters long",
            },
            project_starting_date: {
                required: "Please select the project starting date",
                date: "Please enter a valid date",
            },
            project_ending_date: {
                required: "Please select the project ending date",
                date: "Please enter a valid date",
            },
            csr_company: {
                required: "Please select a CSR company",
            },
            project_budget: {
                required: "Please enter the project budget",
                number: "Please enter a valid number",
                min: "The project budget cannot be negative",
            },
            project_image: {
                extension: "Only JPG, JPEG, and PNG files are allowed",
                filesize: "File size must not exceed 2MB",
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('text-danger');
            if (element.prop('type') === 'checkbox') {
                error.insertAfter(element.siblings('label'));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        }
    });

    $('#beneficiaryRegistrationForm').validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            fathers_name: {
                required: true,
                maxlength: 255
            },
            dob: {
                required: true,
                date: true,
                maxDate: new Date()  // Ensure date is not in the future
            },
            gender: {
                required: true
            },
            state: {
                required: true
            },
            district: {
                required: true
            },
            address: {
                required: true,
                maxlength: 500
            },
            project_id: {
                required: true
            },
            pin_code: {
                required: true,
                digits: true,
                minlength: 6,
                maxlength: 6
            },
            email: {
                required: true,
                email: true
            },
            phone_number: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            aadhar: {
                required: true,
                extension: "jpg|png|pdf",
                filesize: 2048 * 1024  // 2MB max
            },
            pan: {
                extension: "jpg|png|pdf",
                filesize: 2048 * 1024  // 2MB max (optional)
            }
        },
        messages: {
            // Custom messages (same as before)
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('text-danger');
            if (element.prop('type') === 'checkbox') {
                error.insertAfter(element.siblings('label'));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        },
        submitHandler: function (form) {
            // Form submission when all validations are passed
            form.submit();
        }
    });

    // Prevent the page reload on form submit if validation is not passed
    $('#beneficiaryRegistrationForm').on('submit', function (e) {
        if (!$(this).valid()) {
            e.preventDefault();  // Prevent form submission if validation fails
            return false;         // Stops the form from reloading
        }
    });

});
