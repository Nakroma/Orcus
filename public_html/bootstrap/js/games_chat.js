/* Horizontal scroll for chat groups */
function scrollHorizontally(e) {
    e = window.event || e;
    var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
    document.getElementById('chat-hrz').scrollLeft -= (delta * 60);
    e.preventDefault();
}
if (document.getElementById('chat-hrz').addEventListener) {
    // IE9, Chrome, Safari, Opera
    document.getElementById('chat-hrz').addEventListener("mousewheel", scrollHorizontally, false);
    // Firefox
    document.getElementById('chat-hrz').addEventListener("DOMMouseScroll", scrollHorizontally, false);
} else {
    // IE 6/7/8
    document.getElementById('chat-hrz').attachEvent("onmousewheel", scrollHorizontally);
}

/* Chat group selection */
function subMenuChatHide() {
    if ($('.chat-groups').hasClass('chat-groups-hidden')) {
        $('.chat-groups').removeClass('chat-groups-hidden');
    } else {
        $('.chat-groups').addClass('chat-groups-hidden');
    }
}


/* Create Chat Group to top */
function createChatGroup() {

    $('.chat-group-active').removeClass('chat-group-active');

    var userStatus = "Main Menu";
    var groupNameVal = $('.pm-friend-input').val()

    var container = $("<div>");
    container.addClass("chat-group chat-group-active");

    var tdContainer = $("<div>");
    tdContainer.addClass("chat-group-td");
    container.append(tdContainer);

    var groupName = $("<span>");
    groupName.text(groupNameVal);
    groupName.addClass("chat-group-title");
    tdContainer.append(groupName);

    var lineBreak = $("<br>");
    tdContainer.append(lineBreak);

    var groupDesc = $("<span>");
    groupDesc.text(userStatus);
    groupDesc.addClass("chat-group-desc");
    tdContainer.append(groupDesc);

    var newMsg = $("<div>");
    newMsg.text("0");
    newMsg.addClass("chat-new-msgs msgs-invis");
    container.append(newMsg);

    var wrapper = container;
    $('#chat-hrz').append(wrapper);
    $('.chat-groups').removeClass('chat-groups-hidden');
    $("#chat-hrz").animate({
        scrollLeft: $('#chat-hrz').prop("scrollWidth")
    }, 400);

};


/* Check errors, then create group */
$(".pm-friend-input").keypress(function (e) {
    var groupName = $('.pm-friend-input').val()
    if (e.which == 13) {
        /* log existing names */
        var existingNames = [];
        $('#chat-hrz > .chat-group > .chat-group-td > .chat-group-title').each(function () {
            existingNames.push($(this).text());
            console.log(existingNames)
        });
        /* check for errors */
        if (groupName == 'Benis') { // name in use
            $('#chat-group-error').removeClass('error-hidden');
            setTimeout(function () {
                $('#chat-group-error').addClass('error-hidden');
            }, 1200);
        } else {
            if ($.inArray(groupName, existingNames) == -1) { // name duplicate error
                createChatGroup();
            } else {
                var sameNameGroup = $("span:contains('" + groupName + "')")
                $('.chat-group-active').removeClass('chat-group-active');
                sameNameGroup.parents(".chat-group").addClass('chat-group-active');
                $('#chat-hrz').animate({'scrollLeft': sameNameGroup}, 800);
                $('.chat-groups').removeClass('chat-groups-hidden');
            }
        }
    };
});



$('.chat-menu-ico-wrapper').click(subMenuChatHide);
$('#chat-hrz').on("click", ".chat-group", function () {
    if ($(this).hasClass('chat-group-active')) {} else {
        $('.chat-group-active').removeClass('chat-group-active');
        $(this).addClass('chat-group-active');
    }
});
