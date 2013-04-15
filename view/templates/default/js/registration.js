$('document').ready(function(){
	$("#registrationForm").validate({
    messages: {
        'r[username]': {
            remote: "User with this username already exists."
        },
        'r[email]': {
            remote: "User with this e-mail already registered."
        }
    },
    /*success: function(label) {
        label.attr("title", "Ok");
        label.text("").addClass("success");
    },*/
    rules: {
        'r[email]': {
            required: true,
            email: true,
                remote: {
                url: "{'auth/action:emailAvailable/ajax:1/'|glink}",
                type: "post",
                dataFilter: function(data) {
                    return JSON.parse(data).parts.isAvailable === true;
                }
            }
        },
        'r[username]': {
            required: true,
            rangelength: [4, 64],
            remote: {
                url: "{'auth/action:usernameAvailable/ajax:1/'|glink}}",
                type: "post",
                dataFilter: function(data) {
                    //console.log(JSON.parse(data));
                    return JSON.parse(data).parts.isAvailable === true;
                }
            }
        },
        'r[password]': { required: true, minlength: 5 },
        'r[rpassword]': { required: true, equalTo: "#reg-password" },
        'r[gender]' : { required: true }
    }
    });
});