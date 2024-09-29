function togglePassword() {
    var icon = document.getElementById('icon-eye');
    var password = document.getElementById('password');
    if(icon.className == "fa fa-eye") {
        password.type = "text";
        icon.className = "fa fa-eye-slash";
    } else {
        password.type = "password";
        icon.className = "fa fa-eye";
    }
}

function showViewProfile() {
    var user_profile_options = document.getElementById('view-profile-option');
    var user_profile_icon = document.getElementById('user-profile-icon');
    user_profile_options.style.display = 'flex';
    user_profile_icon.style.padding = '0px';
}

function hideViewProfile() {
    var user_profile_options = document.getElementById('view-profile-option');
    var user_profile_icon = document.getElementById('user-profile-icon');
    user_profile_options.style.display = 'none';
    user_profile_icon.style.padding = '5px';
}

function showMore() {
    var more_options_container = document.getElementById('more-options');
    if (more_options_container.style.display === 'none') {
        more_options_container.style.display = 'flex';
    } else {
        more_options_container.style.display = 'none';
    }
}