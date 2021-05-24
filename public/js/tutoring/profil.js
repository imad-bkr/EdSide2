(function () {
    var contactInfo = document.querySelector(".contact-info");
    var editContactInfoButton = document.querySelector(".contact-info-edit");
    var cancelContactInfoButton = document.querySelector(".contact-info-cancel");
    var validateContactInfoButton = document.querySelector(".contact-info-validate");
    var contactInfoBak;

    var userInfo = document.querySelector(".user-info");
    var editUserInfoButton = document.querySelector(".user-info-edit");
    var cancelUserInfoButton = document.querySelector(".user-info-cancel");
    var validateUserInfoButton = document.querySelector(".user-info-validate");
    var userInfoBak;

    editContactInfo = function () {
        contactInfoBak = contactInfo.value;
        contactInfo.readOnly = false;
        editContactInfoButton.classList.add("hidden");
        cancelContactInfoButton.classList.remove("hidden");
        validateContactInfoButton.classList.remove("hidden");
    };

    cancelContactInfo = function () {
        contactInfo.readOnly = true;
        editContactInfoButton.classList.remove("hidden");
        cancelContactInfoButton.classList.add("hidden");
        validateContactInfoButton.classList.add("hidden");
        contactInfo.value = contactInfoBak;
    };

    validateContactInfo = function () {
        contactInfo.readOnly = true;
        editContactInfoButton.classList.remove("hidden");
        cancelContactInfoButton.classList.add("hidden");
        validateContactInfoButton.classList.add("hidden");
        // update db
    };

    editUserInfo = function () {
        userInfoBak = userInfo.value;
        userInfo.readOnly = false;
        editUserInfoButton.classList.add("hidden");
        cancelUserInfoButton.classList.remove("hidden");
        validateUserInfoButton.classList.remove("hidden");
    };

    cancelUserInfo = function () {
        userInfo.readOnly = true;
        editUserInfoButton.classList.remove("hidden");
        cancelUserInfoButton.classList.add("hidden");
        validateUserInfoButton.classList.add("hidden");
        userInfo.value = userInfoBak;
    };

    validateUserInfo = function () {
        userInfo.readOnly = true;
        editUserInfoButton.classList.remove("hidden");
        cancelUserInfoButton.classList.add("hidden");
        validateUserInfoButton.classList.add("hidden");
        // update db
    };

    editContactInfoButton.addEventListener("click", editContactInfo);
    cancelContactInfoButton.addEventListener("click", cancelContactInfo);
    validateContactInfoButton.addEventListener("click", validateContactInfo);

    editUserInfoButton.addEventListener("click", editUserInfo);
    cancelUserInfoButton.addEventListener("click", cancelUserInfo);
    validateUserInfoButton.addEventListener("click", validateUserInfo);
})();
