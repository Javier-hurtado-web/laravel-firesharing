import $ from "jquery";

class RegistrationForm {
    constructor() {
        console.log("Здарова!");
        this.registrationForm = $(".register-form");
        this.events();
    }

    events() {
        this.registrationForm.submit(this.handleFormSubmission.bind(this));
    }

    handleFormSubmission(event) {
        let self = this;
        event.preventDefault();
        this.clearErrors();

        let formData = this.grabFormData();

        $.ajax({
            type: "POST",
            url: "/register",
            data: formData,
            dataType: "json",
            encode: true
        })
            .done(function (data) {
                console.log(data);
            })
            .fail(function(data) {
                self.handleValidationErrors(data.responseJSON.errors);
            });
    }

    grabFormData() {
        return {
            "username": $("input[name=username]").val(),
            "email": $("input[name=email]").val(),
            "password": $("input[name=password]").val(),
            "password_confirmation": $("input[name=password_confirmation]").val(),
            "_token": $("input[name=_token]").val()
        }
    }

    handleValidationErrors(errors) {
        let errorNames = Object.keys(errors);

        errorNames.forEach( (errorName) => {
            $(`input[name=${errorName}]`).addClass("is-invalid").after( () => {
                if ( !$(`input[name=${errorName}]+div.invalid-feedback`).length ) {
                    return `<div class="invalid-feedback">${errors[errorName]}</div>`;
                }
            });
        });
    }

    clearErrors() {
        $(".invalid-feedback").remove();
        $(".register-form input").removeClass("is-invalid");
    }
}

export default RegistrationForm;



