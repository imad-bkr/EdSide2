(function () {
    const main = document.querySelector(".calendar-main");

    //* new group
    const newGroupButton = document.querySelector(".calendar-new-group-button");
    const newGroupBox = document.querySelector(".calendar-new-group");
    const newGroupCancel = document.querySelector(".calendar-new-group-cancel");
    const newGroupConfirm = document.querySelector(".calendar-new-group-confirm");

    newGroupToggle = function () {
        main.classList.toggle("greyout");
        newGroupBox.classList.toggle("hidden");
    };

    newGroupButton.addEventListener("click", newGroupToggle);
    newGroupCancel.addEventListener("click", newGroupToggle);
    newGroupConfirm.addEventListener("click", newGroupToggle);

    //* join group
    const joinGroupButton = document.querySelector(".calendar-join-group-button");
    const joinGroupBox = document.querySelector(".calendar-join-group");
    const joinGroupCancel = document.querySelector(".calendar-join-group-cancel");
    const joinGroupConfirm = document.querySelector(".calendar-join-group-confirm");

    joinGroupToggle = function () {
        main.classList.toggle("greyout");
        joinGroupBox.classList.toggle("hidden");
    };

    joinGroupButton.addEventListener("click", joinGroupToggle);
    joinGroupCancel.addEventListener("click", joinGroupToggle);
    joinGroupConfirm.addEventListener("click", joinGroupToggle);

    //* new event
    const newEventButton = document.querySelector(".calendar-new-event-button");
    const newEventBox = document.querySelector(".calendar-new-event");
    const newEventCancel = document.querySelector(".calendar-new-event-cancel");

    newEventToggle = function () {
        main.classList.toggle("greyout");
        newEventBox.classList.toggle("hidden");
    };

    newEventButton.addEventListener("click", newEventToggle);
    newEventCancel.addEventListener("click", newEventToggle);

    //* edit event
    // const events = document.querySelectorAll(".calendar-event");
    // const editEventBox = document.querySelector(".calendar-edit-event");
    // const editEventCancel = document.querySelector(".calendar-edit-event-cancel");

    // editEventToggle = function () {
    //     main.classList.toggle("greyout");
    //     editEventBox.classList.toggle("hidden");
    // };

    // events.forEach((event) => {
    //     event.addEventListener("click", editEventToggle);
    // });
    // editEventCancel.addEventListener("click", editEventToggle);
})();
