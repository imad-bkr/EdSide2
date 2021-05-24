(function () {
    var newGroupButton = document.querySelector(".calendar-new-group-button");
    var newGroupBox = document.querySelector(".calendar-new-group");
    var newGroupCancel = document.querySelector(".calendar-new-group-cancel");
    var newGroupConfirm = document.querySelector(".calendar-new-group-confirm");
    
    var joinGroupButton = document.querySelector(".calendar-join-group-button");
    var joinGroupBox = document.querySelector(".calendar-join-group");
    var joinGroupCancel = document.querySelector(".calendar-join-group-cancel");
    var joinGroupConfirm = document.querySelector(".calendar-join-group-confirm");

    newGroupToggle = function () {
        document.querySelector(".calendar-main").classList.toggle("greyout");
        newGroupBox.classList.toggle("hidden");
    };

    joinGroupToggle = function () {
        document.querySelector(".calendar-main").classList.toggle("greyout");
        joinGroupBox.classList.toggle("hidden");
    };

    newGroupButton.addEventListener("click", newGroupToggle);
    newGroupCancel.addEventListener("click", newGroupToggle);
    newGroupConfirm.addEventListener("click", newGroupToggle);

    joinGroupButton.addEventListener("click", joinGroupToggle);
    joinGroupCancel.addEventListener("click", joinGroupToggle);
    joinGroupConfirm.addEventListener("click", joinGroupToggle);
})();
