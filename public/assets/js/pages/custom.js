$.validator.addMethod(
    "regex",
    function (value, element, pattern) {
        return this.optional(element) || pattern.test(value);
    },
    "Invalid format.",
);

$.validator.addMethod(
    "noSpecialChars",
    function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9 ]+$/.test(value);
    },
    "Special characters are not allowed.",
);

$.validator.addMethod(
    "validEmail",
    function (value, element) {
        var regex =
            /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    },
    "Please enter a valid email address",
);

$.validator.addMethod(
    "strongPassword",
    function (value, element) {
        return (
            this.optional(element) ||
            (/[A-Z]/.test(value) &&
                /[a-z]/.test(value) &&
                /\d/.test(value) &&
                /[!@#$%^&*(),.?":{}|<>]/.test(value) &&
                value.length >= 8)
        );
    },
    "Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.",
);

// js Validation for Blog Form
$("#blogForm").validate({
    ignore: [],
    rules: {
        title: {
            required: true,
            minlength: 5,
            maxlength: 50,
            noSpecialChars: true,
        },
        slug: {
            required: true,
            minlength: 5,
            maxlength: 255,
        },
        category_id: {
            required: true,
        },
        content: {
            required: true,
            maxlength: 3000,
        },
    },
    messages: {
        title: {
            required: "Blog title is required.",
            minlength: "Title must be at least 5 characters.",
            maxlength: "Title must not exceed 50 characters.",
        },
        slug: {
            required: "Slug is required.",
            minlength: "Slug must be at least 5 characters.",
            maxlength: "Slug must not exceed 255 characters.",
        },
        category_id: {
            required: "Please select a category.",
        },
        content: {
            required: "Content is required.",
            maxlength: "Content must not exceed 3000 characters.",
        },
    },
    errorClass: "text-danger",
    errorElement: "small",
});

// js Validation for Rejection Reason Form
$("#rejectBlogForm").validate({
    rules: {
        rejection_reason: {
            required: true,
            minlength: 10,
            maxlength: 150,
            noSpecialChars: true,
        },
    },
    messages: {
        rejection_reason: {
            required: "Please provide a reason for rejection.",
            minlength:
                "The rejection reason must be at least 10 characters long.",
            maxlength: "The rejection reason must not exceed 150 characters.",
        },
    },
    errorClass: "text-danger",
    errorElement: "small",
});

// js Validation for Unpublish Reason Form

$("#unpublishBlogForm").validate({
    rules: {
        rejection_reason: {
            required: true,
            minlength: 10,
            maxlength: 150,
            noSpecialChars: true,
        },
    },
    messages: {
        rejection_reason: {
            required: "Please provide a reason for unpublishing.",
            minlength:
                "The unpublish reason must be at least 10 characters long.",
            maxlength: "The unpublish reason must not exceed 150 characters.",
        },
    },
    errorClass: "text-danger",
    errorElement: "small",
});

// js Validation for Create Category Form

$("#createCategoryForm").validate({
    rules: {
        title: {
            required: true,
            minlength: 5,
            maxlength: 50,
            noSpecialChars: true,
        },
        status: {
            required: true,
        },
        description: {
            maxlength: 255,
        },
    },
    messages: {
        title: {
            required: "Category name is required.",
            minlength: "Category name must be at least 5 characters.",
            maxlength: "Category name must not exceed 50 characters.",
        },
        status: {
            required: "Please select a status.",
        },
        description: {
            maxlength: "Description must not exceed 255 characters.",
        },
    },
    errorClass: "text-danger",
    errorElement: "small",
});

// js Validation for update profile form

$("#updateProfileForm").validate({
    rules: {
        firstname: {
            required: true,
            minlength: 2,
            maxlength: 20,
            noSpecialChars: true,
        },
        lastname: {
            required: true,
            minlength: 2,
            maxlength: 20,
            noSpecialChars: true,
        },
        email: {
            required: true,
            validEmail: true,
        },
        bio: {
            required: true,
            maxlength: 150,
        },
    },
    messages: {
        firstname: {
            required: "Firstname is required.",
            minlength: "Firstname must be at least 2 characters.",
            maxlength: "Firstname must not exceed 50 characters.",
            regex: "Only letters, numbers, spaces, and hyphens are allowed.",
        },
        lastname: {
            required: "Lastname is required.",
            minlength: "Lastname must be at least 2 characters.",
            maxlength: "Lastname must not exceed 50 characters.",
            regex: "Only letters, numbers, spaces, and hyphens are allowed.",
        },
        email: {
            required: "Email is required",
        },
        description: {
            maxlength: "Description must not exceed 255 characters.",
        },
    },
    errorClass: "text-danger",
    errorElement: "small",
});

$("#siteSettingForm").validate({
    rules: {
        sitename: {
            required: true,
            minlength: 3,
            maxlength: 8,
            noSpecialChars: true,
        },
        supportemail: {
            required: true,
            validEmail: true,
        },
        contactnumber: {
            required: true,
            minlength: 10,
            maxlength: 10,
        },
    },
    messages: {
        sitename: {
            required: "Sitename is required.",
            minlength: "Sitename must be at least 3 characters.",
            maxlength: "Sitename must not exceed 8 characters.",
        },
        supportemail: {
            required: "Email is required",
        },
        contactnumber: {
            required: "Contact number is required",
        },
    },
    errorClass: "text-danger",
    errorElement: "small",
});

$("#updatePasswordForm").validate({
    rules: {
        currentpassword: {
            required: true,
            minlength: 8,
            maxlength: 20,
            strongPassword: true,
        },
        newpassword: {
            required: true,
            minlength: 8,
            maxlength: 20,
            strongPassword: true,
        },
        confirmpassword: {
            required: true,
            equalTo: "#newpassword",
        },
    },
    messages: {
        currentpassword: {
            required: "Current password is required.",
            minlength: "Current password must be at least 6 characters.",
            maxlength: "Current password must not exceed 20 characters.",
        },
        newpassword: {
            required: "New password is required.",
            minlength: "New password must be at least 8 characters.",
            maxlength: "New password must not exceed 20 characters.",
        },
        confirmpassword: {
            required: "Please confirm your new password.",
            equalTo: "Confirm password does not match the new password.",
        },
    },
    errorClass: "text-danger",
    errorElement: "small",
});

// js Validation for Create Tag Form

$("#createTagForm").validate({
    rules: {
        title: {
            required: true,
            minlength: 3,
            maxlength: 20,
            noSpecialChars: true,
        },
        description: {
            required: true,
            maxlength: 150,
        },
    },
    messages: {
        title: {
            required: "Tag name is required.",
            minlength: "Tag name must be at least 3 characters.",
            maxlength: "Tag name must not exceed 20 characters.",
        },
        description: {
            required: "Description is required.",
            maxlength: "Description must not exceed 150 characters.",
        },
    },
    errorClass: "text-danger",
    errorElement: "small",
});

toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: "toast-top-center",
    timeOut: "3000",
};
