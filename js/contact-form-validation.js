
$(document).ready(function () {

    /**
    * Return true if the field value matches the given format RegExp
    *
    * @example $.validator.methods.pattern("AR1004",element,/^AR\d{4}$/)
    * @result true
    *
    * @example $.validator.methods.pattern("BR1004",element,/^AR\d{4}$/)
    * @result false
    *
    * @name $.validator.methods.pattern
    * @type Boolean
    * @cat Plugins/Validate/Methods
    */
    $.validator.addMethod( "pattern", function( value, element, param ) {
        if ( this.optional( element ) ) {
            return true;
        }
        if ( typeof param === "string" ) {
            param = new RegExp( "^(?:" + param + ")$" );
        }
        return param.test( value );
        
    }, "Invalid format." );
    // Sourced from https://github.com/jquery-validation/jquery-validation/blob/master/src/additional/pattern.js


    $("form[name='contact-form']").validate({

        rules: {
            name: "required",
            contact_details: {
                required: true,
                // Regex pattern matching for email or Australian number
                pattern: "^(?:([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\\.([a-zA-Z])+([a-zA-Z])+)|(?:((\\+61|0)?\\s?[2|3|4|7|8])?\\d{2}\\s?\\d{2}\\s?\\d\\s?\\d{3})$",
                // pattern: "^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\\.([a-zA-Z])+([a-zA-Z])+$",
            },
            message: "required"
        },

        messages: {
            name: "Please enter your name.",
            contact_details: "Please enter a valid email or Australian phone number.",
            message: "Please leave a message."
        },

        submitHandler: function(form) {
            form.submit();
        }
    })
});