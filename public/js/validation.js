$(document).ready(function () {
    // Custom Method for Past Date Check
    $.validator.addMethod("minDateToday", function (value, element) {
        if (!value) return true;
        var curDate = new Date();
        var inputDate = new Date(value);
        curDate.setHours(0, 0, 0, 0); // Normalize today to midnight
        return inputDate >= curDate;
    }, "Date cannot be in the past.");

    // Project Form Validation
    if ($("#projectForm").length > 0) {
        $("#projectForm").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 255
                },
                start_date: {
                    required: true,
                    date: true,
                    minDateToday: true
                },
                end_date: {
                    date: true
                }
            },
            messages: {
                name: {
                    required: "Please enter a project name",
                },
                start_date: {
                    required: "Please select a start date"
                }
            },
            errorElement: 'span',
            errorClass: 'text-danger small'
        });
    }

    // Task Form Validation
    if ($("#taskForm").length > 0) {
        $("#taskForm").validate({
            rules: {
                title: {
                    required: true,
                    maxlength: 255
                },
                project_id: "required",
                status: "required",
                due_date: {
                    date: true,
                    minDateToday: true
                },
                attachment: {
                    extension: "jpg|jpeg|png|pdf",
                    maxsize: 2000000, // 2MB
                    accept: false // Disable built-in accept rule to avoid mimetype errors
                }
            },
            messages: {
                title: "Please enter a task title",
                project_id: "Please select a project",
                status: "Please select a status",
                attachment: {
                    extension: "Allowed files: jpg, jpeg, png, pdf",
                    maxsize: "File size must be less than 2MB"
                }
            },
            errorElement: 'span',
            errorClass: 'text-danger small'
        });
    }
    // Login Form Validation
    if ($("#loginForm").length > 0) {
        $("#loginForm").validate({
            rules: {
                email: { required: true, email: true },
                password: { required: true }
            },
            messages: {
                email: { required: "Please enter your email", email: "Please enter a valid email address" },
                password: { required: "Please enter your password" }
            },
            errorElement: 'span',
            errorClass: 'text-danger small',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    }

    // Register Form Validation
    if ($("#registerForm").length > 0) {
        $("#registerForm").validate({
            rules: {
                name: "required",
                email: { required: true, email: true },
                password: { required: true, minlength: 8 },
                password_confirmation: { required: true, equalTo: "#password" }
            },
            messages: {
                name: "Please enter your name",
                email: { required: "Please enter your email", email: "Please enter a valid email address" },
                password: { required: "Please enter a password", minlength: "Password must be at least 8 characters" },
                password_confirmation: { required: "Please confirm your password", equalTo: "Passwords do not match" }
            },
            errorElement: 'span',
            errorClass: 'text-danger small',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    }
    // Delete Confirmation
    $(document).on('submit', '.delete-form', function (e) {
        e.preventDefault();
        var form = this;
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
