
$(document).ready(function () {
    // Initialize Firebase
    $("#user-form-validation").validate({
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
            gender: {
                required: false,
            },
            marital_status: {
                required: false
            },
            email: {
                required: true,
                email: true
            },
            phone_number: {
                required: true,
                minlength: 10,
                maxlength: 10,
                digits: true
            },
            emergency_contact_phone_number: {
                required: false,
                minlength: 10,
                maxlength: 10,
                digits: true
            },
            profile_summary: {
                required: false,
                minlength: 20
            },
            date_of_joining: {
                required: false,
                date: true
            },
            user_type: {
                required: true
            },
            department: {
                required: true
            },
            profile_image: {
                required: true,
                extension: "jpg|jpeg|png"
            },
            aadhar_card: {
                required: true,
                extension: "pdf",
                accept: "application/pdf"
            },
            address: {
                required: false
            },
            nationality: {
                required: false
            }
        },
        messages: {
            name: {
                required: "Please enter your full name.",
                minlength: "Your name must consist of at least 3 characters."
            },
            fathers_name: {
                minlength: "Father's name must consist of at least 3 characters."
            },
            dob: {
                date: "Please enter a valid date of birth."
            },
            gender: {
                required: "Please select your gender."
            },
            marital_status: {
                required: "Please select your marital status."
            },
            email: {
                required: "Please enter a valid email address.",
                email: "Please enter a valid email address."
            },
            phone_number: {
                required: "Please enter a valid phone number.",
                minlength: "Phone number must be exactly 10 digits.",
                maxlength: "Phone number must be exactly 10 digits.",
                digits: "Phone number can only contain digits."
            },
            emergency_contact_phone_number: {
                minlength: "Emergency contact phone number must be exactly 10 digits.",
                maxlength: "Emergency contact phone number must be exactly 10 digits.",
                digits: "Emergency contact phone number can only contain digits."
            },
            profile_summary: {
                minlength: "Profile summary must be at least 20 characters long."
            },
            date_of_joining: {
                date: "Please enter a valid date of joining."
            },
            user_type: {
                required: "Please select a user type."
            },
            department: {
                required: "Please select a department."
            },
            profile_image: {
                extension: "Only image files (jpg, jpeg, png) are allowed."
            },
            aadhar_card: {
                required: "Please upload your Aadhar card.",
                extension: "Only PDF files are allowed for Aadhar card.",
                accept: "Please upload a valid PDF file."
            },
            address: {
                required: "Please enter your address."
            },
            nationality: {
                required: "Please enter your nationality."
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
        // Custom validator for PDF files
        submitHandler: function (form) {
            var file = $('#aadhar_card')[0].files[0];
            if (file) {
                var fileExtension = file.name.split('.').pop().toLowerCase();
                var fileMimeType = file.type;

                // Validate MIME type and file extension
                if (fileExtension !== 'pdf' || fileMimeType !== 'application/pdf') {
                    alert('Please upload a valid PDF file for the Aadhar card.');
                    return false; // Prevent form submission
                }
            }
            form.submit();
        }
    });


    $('#csr-form-validation').validate({
        rules: {
            company_name: {
                required: true
            },
            company_type: {
                required: true
            },
            registration_number: {
                required: true
            },
            contact_name: {
                required: true
            },
            contact_email: {
                required: true,
                email: true
            },
            contact_phone: {
                required: false,
                phoneUS: true
            },
            csr_focus_area: {
                required: false
            },
            csr_budget: {
                required: true
            },
            csr_goals: {
                required: false
            },
            donation_method: {
                required: true
            },
            partnership_type: {
                required: true
            },
            csr_report: {
                extension: "pdf"
            }
        },
        messages: {
            company_name: {
                required: "Please enter the company name."
            },
            company_type: {
                required: "Please enter the company type."
            },
            registration_number: {
                required: "Please enter the registration number."
            },
            contact_name: {
                required: "Please enter the primary contact person name."
            },
            contact_email: {
                required: "Please enter the email address.",
                email: "Please enter a valid email address."
            },
            csr_report: {
                extension: "Please upload a valid PDF file for the CSR report."
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('text-danger');
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        },
        submitHandler: function (form) {
            // Custom validator for PDF files
            var file = $('#csr_report')[0].files[0];
            if (file) {
                var fileExtension = file.name.split('.').pop().toLowerCase();
                var fileMimeType = file.type;

                // Validate MIME type and file extension
                if (fileExtension !== 'pdf' || fileMimeType !== 'application/pdf') {
                    alert('Please upload a valid PDF file for the CSR report.');
                    return false; // Prevent form submission
                }
            }
            form.submit();
        }
    });


    // Custom Validator for File Size
    $.validator.addMethod('filesize', function (value, element, param) {
        // Check file size (param is in bytes, 2MB = 2097152 bytes)
        if (element.files && element.files[0]) {
            var fileSize = element.files[0].size; // File size in bytes
            return fileSize <= param; // Compare file size with max size (2MB = 2097152 bytes)
        }
        return true; // Return true if no file is selected
    }, 'File size must be less than 2MB.');

    // jQuery Validation Initialization
    $('#csr-project-registration').validate({
        rules: {
            project_title: {
                required: true,
                maxlength: 255
            },
            csr_company: {
                required: true
            },
            project_description: {
                required: false
            },
            start_date: {
                date: true
            },
            end_date: {
                date: true
            },
            project_location: {
                maxlength: 255
            },
            project_category: {
                required: true
            },
            budget: {
                required: true,
                number: true
            },
            stakeholders: {
                maxlength: 255
            },
            expected_impact: {
                maxlength: 500
            },
            funding_source: {
                maxlength: 255
            },
            'attachments[]': {
                required: false, // Not required
                extension: "jpg|jpeg|png|pdf|doc|docx", // Acceptable extensions
                filesize: 2097152 // Max file size 2MB
            }
        },
        messages: {
            project_title: {
                required: "Please enter the project title.",
                maxlength: "Project title cannot exceed 255 characters."
            },
            csr_company: {
                required: "Please select a CSR company."
            },
            project_description: {
                required: "Please provide a project description."
            },
            start_date: {
                date: "Please enter a valid date."
            },
            end_date: {
                date: "Please enter a valid date."
            },
            project_location: {
                maxlength: "Location cannot exceed 255 characters."
            },
            project_category: {
                required: "Please select a project category."
            },
            budget: {
                required: "Please enter a project budget.",
                number: "Budget must be a number."
            },
            stakeholders: {
                maxlength: "Stakeholders field cannot exceed 255 characters."
            },
            expected_impact: {
                maxlength: "Expected impact description cannot exceed 500 characters."
            },
            funding_source: {
                maxlength: "Funding source cannot exceed 255 characters."
            },
            'attachments[]': {
                extension: "Only jpg, jpeg, png, pdf, doc, and docx files are allowed.",
                filesize: "File size must be less than 2MB."
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('text-danger');
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        },
        submitHandler: function (form) {
            // Get the selected files in attachments[] (if any)
            var files = $('#attachments')[0].files;

            // If there are files selected, validate them
            if (files.length > 0) {
                var isValid = true;

                // Iterate over the files and check validity
                $.each(files, function (index, file) {
                    // Check for file type and size
                    var fileExtension = file.name.split('.').pop().toLowerCase();
                    var fileMimeType = file.type;

                    // Validate the extension and MIME type
                    if ($.inArray(fileExtension, ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx']) === -1) {
                        alert('Please upload a valid file (jpg, jpeg, png, pdf, doc, or docx).');
                        isValid = false;
                        return false; // Stop looping
                    }

                    // Validate the file size (max 2MB)
                    if (file.size > 2097152) {
                        alert("File size must be less than 2MB.");
                        isValid = false;
                        return false; // Stop looping
                    }
                });

                // If all files are valid, submit the form
                if (isValid) {
                    form.submit();
                } else {
                    return false; // Prevent form submission if validation fails
                }
            } else {
                // If no files are selected, submit the form directly
                form.submit();
            }
        }
    });

    $('#project_expense_form').validate({
        rules: {
            project_id: {
                required: true
            },
            expense_title: {
                required: true,
                minlength: 3
            },
            expense_date: {
                required: true,
                date: true
            },
            expense_description: {
                required: true,
                minlength: 10
            },
            expense_category: {
                required: true
            },
            expense_amount: {
                required: true,
                number: true,
                min: 0
            },
            payment_method: {
                required: true
            },
            vendor_name: {
                required: false,
                minlength: 3
            },
            vendor_contact: {
                required: false,
                minlength: 10,
                digits: true
            },
            invoice_number: {
                minlength: 6
            },
            supporting_documents: {
                required: false,
                // Custom validator to check all selected files' extensions
                extension: "jpg|jpeg|png|pdf|doc|docx"
            },
            budget_category: {
                required: true
            },
            risk_toggle: {
                required: true
            },
            allocation_notes: {
                maxlength: 200
            },
            risk_description: {
                maxlength: 300
            }
        },
        // Custom messages for each rule
        messages: {
            project_id: {
                required: "Please select a project."
            },
            expense_title: {
                required: "Expense title is required.",
                minlength: "Expense title must be at least 3 characters long."
            },
            expense_date: {
                required: "Please enter a date for the expense.",
                date: "Please enter a valid date."
            },
            expense_description: {
                required: "Please provide a description for the expense.",
                minlength: "Expense description must be at least 10 characters long."
            },
            expense_category: {
                required: "Please select an expense category."
            },
            expense_amount: {
                required: "Please enter the expense amount.",
                number: "Please enter a valid number.",
                min: "Amount cannot be less than 0."
            },
            payment_method: {
                required: "Please select a payment method."
            },
            vendor_name: {
                required: "Please enter the vendor/recipient's name.",
                minlength: "Vendor name must be at least 3 characters long."
            },
            vendor_contact: {
                required: "Please enter the vendor/recipient's contact number.",
                minlength: "Vendor contact must be at least 10 digits.",
                digits: "Contact number must contain only digits."
            },
            invoice_number: {
                minlength: "Invoice number, if provided, must be at least 6 characters long."
            },
            supporting_documents: {
                extension: "Supported file types are: jpg, jpeg, png, pdf, doc, docx."
            },
            budget_category: {
                required: "Please select a budget category."
            },
            risk_toggle: {
                required: "Please specify whether this expense is related to a risk."
            },
            allocation_notes: {
                maxlength: "Notes cannot exceed 200 characters."
            },
            risk_description: {
                maxlength: "Risk description cannot exceed 300 characters."
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
        submitHandler: function (form) {
            form.submit();
        }
    });

    $('#beneficiary_form').validate({
        rules: {
            beneficiary_name: {
                required: true,
                minlength: 3
            },
            fathers_name: {
                required: false,
                minlength: 3
            },
            date_of_birth: {
                required: false,
                date: true
            },
            gender: {
                required: true,
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
            profile_picture: {
                required: true,
                extension: "jpg|jpeg|png"
            },
            aadhar_card: {
                required: false,
                extension: "pdf"
            },
            status: {
                required: false
            },
            address: {
                required: false,
                minlength: 5
            },
        },
        // Custom messages for each rule
        messages: {
            beneficiary_name: {
                required: "Beneficiary name should not be empty",
                minlength: "Beneficiary name at least 3 characters long"
            },
            fathers_name: {
                required: "Fathers name should not be empty.",
                minlength: "Expense title must be at least 3 characters long."
            },
            date_of_birth: {
                required: "Please enter a date of birth.",
                date: "Please enter a valid date."
            },
            gender: {
                required: "Please select gender.",
            },
            phone_number: {
                required: "Please enter your phone number",
                minlength: "Phone number atleast 10 digits",
                maxlength: "Phone number atmost 10 digits",
                digits: "Invalid phone number"
            },
            email: {
                required: "Enter your email address",
                email: "Enter valid email id"
            },
            profile_picture: {
                required: "Please select your profile picture",
                extension: "Only upload these file format jpg|jpeg|png"
            },
            aadhar_card: {
                required: "Please upload the aadhar card",
                extension: "Please upload valid aadhar card format | pdf"
            },
            status: {
                required: "Please select the status"
            },
            address: {
                required: "Please enter your address",
                minlength: "Address filed must be 5 characters long"
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
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    // Beneficiary Profile Image validation
    $('#beneficiaryProfileImageChange').validate({
        rules: {
            beneficiary_profile_image: {
                required: true,
                extension: "jpg|jpeg|png"
            }
        },
        // Custom messages for each rule
        messages: {
            beneficiary_profile_image: {
                required: "Please select your profile picture",
                extension: "Only upload these file format jpg|jpeg|png"
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
        submitHandler: function (form) {
            form.submit();
        }
    })

    $('#donation_form').validate({
        rules: {
            donor_name: {
                required: true
            },
            fathers_name: {
                required: false,
                minlength: 3
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
            },
            phone_number: {
                required: true,
                minlength: 10,
                maxlength: 10,
                digits: true
            },
            dob: {
                required: false,
            },
            anniversary_date: {
                required: false
            },
            aadhar_number: {
                required: false,
                digits: true
            },
            pan_number: {
                required: false
            },
            purpose: {
                required: false,
            },
            address: {
                required: false
            },
            additional_message: {
                required: false,
                minlength: 10
            }
        },
        messages: {
            donor_name: {
                required: "Please enter the donor's name"
            },
            fathers_name: {
                minlength: "Father's name must be at least 3 characters long"
            },
            email: {
                required: "Please enter an email address",
                email: "Please enter a valid email address"
            },
            amount: {
                required: "Please enter amount",
                digits: "Please enter a valid amount"
            },
            payment_type: {
                required: "Please select payment type",
            },
            mobile_number: {
                required: "Please enter the mobile number",
                minlength: "Mobile number must be exactly 10 digits",
                maxlength: "Mobile number must be exactly 10 digits",
                digits: "Mobile number must contain only digits"
            },
            dob: {
                required: "Please enter the date of birth"
            },
            anniversary_date: {
                required: "Please enter the anniversary date (if applicable)"
            },
            aadhar_number: {
                required: "Please enter aadhar number",
                digits: "Please enter valid adhar number"
            },
            pan_number: {
                required: "Please enter pan number"
            },
            purpose: {
                required: "Please select a purpose",
            },
            address: {
                required: "Please enter the address"
            },
            additional_message: {
                minlength: "Additional message must be at least 10 characters long"
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
        submitHandler: function (form) {
            form.submit();
        }
    });

    $('#administration_expense').validate({
        rules: {
            expense_date: {
                required: true,
            },
            expense_description: {
                required: false,
                minlength: 5,
            },
            expense_category: {
                required: true,
            },
            amount_spent: {
                required: true,
                number: true,
                min: 0.01,
            },
            payment_method: {
                required: true,
            },
            vendor_name: {
                required: false,  // Optional field
                minlength: 3,
            },
            contact_info: {
                required: false, // Optional field
                minlength: 5,
            },
            invoice_number: {
                required: false, // Optional field
                minlength: 3,
            },
            supporting_documents: {
                required: false, // Optional field
                accept: "image/*,application/pdf",  // Can only accept image and pdf file types
            },
        },
        messages: {
            expense_date: {
                required: "Please enter the date of the expense",
            },
            expense_description: {
                required: "Please enter an expense description",
                minlength: "Description should be at least 5 characters long",
            },
            expense_category: {
                required: "Please select an expense category",
            },
            amount_spent: {
                required: "Please enter the amount spent",
                number: "Please enter a valid number",
                min: "Amount must be greater than 0",
            },
            payment_method: {
                required: "Please select a payment method",
            },
            vendor_name: {
                minlength: "Vendor name should be at least 3 characters long",
            },
            contact_info: {
                minlength: "Contact info should be at least 5 characters long",
            },
            invoice_number: {
                minlength: "Invoice number should be at least 3 characters long",
            },
            supporting_documents: {
                accept: "Only image files or PDF are allowed",
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
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

});
