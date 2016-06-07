jQuery(document).ready(function () {
    $(".chat-scroll").animate({
        scrollTop: $('.chat-scroll').prop("scrollHeight")
    }, 0);

    /* Simulate Chat
    setTimeout(function () {
        GamesChat_createPost('TotalBiscuit', 'plebbplebplebpleb')
    }, 3400)
    setTimeout(function () {
        GamesChat_createChatPreview('TotalBiscuit', 'I must have lost my ability to can.')
        GamesChat_createPost('TotalBiscuit', 'I must have lost my ability to can.')
    }, 8400)
    setTimeout(function () {
        GamesChat_createChatPreview('Benis', 'memes')
         GamesChat_createPost('Benis', 'memes')
    }, 5400) */
});




/* Horizontal scroll for chat groups */
function GamesChat_scrollHorizontally(e) {
    e = window.event || e;
    var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
    document.getElementById('chat-hrz').scrollLeft -= (delta * 60);
    e.preventDefault();
}
if (document.getElementById('chat-hrz').addEventListener) {
    // IE9, Chrome, Safari, Opera
    document.getElementById('chat-hrz').addEventListener("mousewheel", GamesChat_scrollHorizontally, false);
    // Firefox
    document.getElementById('chat-hrz').addEventListener("DOMMouseScroll", GamesChat_scrollHorizontally, false);
} else {
    // IE 6/7/8
    document.getElementById('chat-hrz').attachEvent("onmousewheel", GamesChat_scrollHorizontally);
}

/* Chat group selection */
function GamesChat_subMenuChatHide() {
    if ($('.chat-groups').hasClass('chat-groups-hidden')) {
        $('.chat-groups').removeClass('chat-groups-hidden');
    } else {
        $('.chat-groups').addClass('chat-groups-hidden');
        $('.pm-friend-input').focus();
    }
}

function GamesChat_subMenuSquadHide() {
    if ($('.squad').hasClass('squad-hidden')) {
        $('.squad').removeClass('squad-hidden');
        $('.squad-ava-self-inf').css('opacity', '1');
    } else {
        $('.squad').addClass('squad-hidden');
        $('.squad-inv-input').focus();
        $('.squad-ava-self-inf').css('opacity', '0');
    }
}


/* Create Chat Group to top */
function GamesChat_createChatGroup() {

    $('.chat-group-active').removeClass('chat-group-active');

    var userStatus = "Main Menu";
    var groupNameVal = $('.pm-friend-input').val();

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

}


/* Check errors, then create group */
$(".pm-friend-input").keypress(function (e) {
    var groupName = $('.pm-friend-input').val()
    if (e.which == 13) {
        /* log existing names */
        var existingNames = [];
        $('#chat-hrz > .chat-group > .chat-group-td > .chat-group-title').each(function () {
            existingNames.push($(this).text());
        });
        /* check for errors */
        if (groupName == 'Benis') { // name in use
            $('#chat-group-error').removeClass('error-hidden');
            setTimeout(function () {
                $('#chat-group-error').addClass('error-hidden');
            }, 1200);
        } else {
            if ($.inArray(groupName, existingNames) == -1) { // name duplicate error
                GamesChat_createChatGroup();
            } else {
                var sameNameGroup = $("span:contains('" + groupName + "')")
                $('.chat-group-active').removeClass('chat-group-active');
                sameNameGroup.parents(".chat-group").addClass('chat-group-active');
                $('#chat-hrz').animate({
                    'scrollLeft': sameNameGroup
                }, 800);
                $('.chat-groups').removeClass('chat-groups-hidden');
            }
        }
    }
});


/* Create Chat Post */
function GamesChat_createPost(username, inputVal, userid) {
    var ownPost = false;

    // Set default
    userid = typeof userid !== 'undefined' ? userid : sid;

    if (typeof username === 'undefined') {
        username = $('.squad-self-name').text();
        ownPost = true;
    }
    if (typeof inputVal === 'undefined') {
        inputVal = $('.chat-input-text').val();
    }

    // Create chat preview
    GamesChat_createChatPreview(username, inputVal);

    var date = new Date();
    var date = date.toISOString();

    if (inputVal != '') {
        var container = $("<div>");
        container.addClass("sidebar-chat-post");

        var chatAvaWr = $("<div>");
        chatAvaWr.addClass("chat-ava");
        container.append(chatAvaWr);

        var avaImg = $("<img>");
        avaImg.attr("src", "bootstrap/img/avatars/" + userid + "_small.png");
        avaImg.addClass("chat-ava-img");
        chatAvaWr.append(avaImg);

        var chatPostContainer = $("<div>")
        chatPostContainer.addClass("chat-post-content");
        container.append(chatPostContainer);

        var chatInfo = $("<div>");
        chatInfo.addClass("chat-info");
        chatPostContainer.append(chatInfo);

        var usernameContainer = $("<a>");
        usernameContainer.text(username);
        usernameContainer.attr("href", "#")
        usernameContainer.addClass("sidebar-chat-username");
        chatInfo.append(usernameContainer);

        var postDate = $("<span>");
        postDate.addClass("sidebar-chat-date");
        postDate.attr("data-livestamp", date)
        chatInfo.append(postDate);

        var chatPost = $("<div>");
        chatPost.addClass("sidebar-chat-message");
        chatPost.text(inputVal);
        chatPostContainer.append(chatPost);

        var wrapper = container;
        $('.chat-scroll').append(wrapper);
         setTimeout(function () {
        wrapper.css('opacity', '1');
               }, 1);
        $(".chat-scroll").animate({
            scrollTop: $('.chat-scroll').prop("scrollHeight")
        }, 400);

        // Send to server
        if (ownPost) {
            SocketClient_send('CHAT_SEND_MESSAGE', ['ALL', LZString.compressToUTF16(inputVal)]);
        }
    }
}

/* Chat preview */
function GamesChat_createChatPreview(username, inputVal) {
    if (inputVal != '') {
        var container = $("<div>");
        container.addClass("sidebar-chat-post").css('opacity', '0');

        var chatPostContainer = $("<div>")
        chatPostContainer.addClass("chat-post-content");
        container.append(chatPostContainer);

        var chatInfo = $("<div>");
        chatInfo.addClass("chat-info");
        chatPostContainer.append(chatInfo);

        var usernameContainer = $("<a>");
        usernameContainer.text(username);
        usernameContainer.addClass("sidebar-chat-username");
        chatInfo.append(usernameContainer);

        var chatPost = $("<div>");
        chatPost.addClass("sidebar-chat-message");
        chatPost.text(inputVal);
        chatPostContainer.append(chatPost);

        var wrapper = container;
        $('.chat-scroll-preview').append(wrapper);
        setTimeout(function () {
            $('.sidebar-chat-post').css('opacity', '1');
        }, 1);
        $(".chat-scroll-preview").animate({
            scrollTop: $('.chat-scroll-preview').prop("scrollHeight")
        }, 400);
        setTimeout(function () {
            $('.chat-scroll-preview').find('.sidebar-chat-post').css('opacity', '0');
        }, 9000);
    }
}



function GamesChat_showSquadMemberDetails() {
    /*var imageSrc = "bootstrap/img/ava_default.png";
    var squadMemberName = 'AX.Aeon.피';
    var squadMemberRole = 'Support';
    $('.squad-ava-img-self-swap').attr('src', imageSrc);
    $('.squad-ava-swap-helper').css('opacity', '1');
    $('.squad-self-name-alt').text(squadMemberName).css('opacity', '1');
    $('.squad-self-role-alt').text(squadMemberRole).css('opacity', '1');
    $('.squad-self-name').css('opacity', '0');
    $('.squad-self-role').css('opacity', '0');*/
}

function GamesChat_hideSquadMemberDetails() {
    /*
    $('.squad-ava-swap-helper').css('opacity', '0');
    $('.squad-self-name-alt').css('opacity', '0');
    $('.squad-self-role-alt').css('opacity', '0');
       $('.squad-self-name').css('opacity', '1');
    $('.squad-self-role').css('opacity', '1');
    */
}

$(".chat-input-text").keypress(function (e) {
    if (e.which == 13) {
        GamesChat_createPost();
        $(".chat-input-text").val(''); //not getting called due to socket error in .html
    }
});

$(".send-ico").click(function () {
    GamesChat_createPost();
    $(".chat-input-text").val(''); //not getting called due to socket error in .html
});

$('.chat-menu-ico-wrapper').click(GamesChat_subMenuChatHide);

$('#chat-hrz').on("click", ".chat-group", function () {
    var nameSelf = $('.squad-self-name').text();
    var nameOther = $('.chat-group-active > .chat-post-content > .chat-info > .sidebar-chat-username').text();
    if ($(this).hasClass('chat-group-active')) {} else {
        $('.chat-group-active').removeClass('chat-group-active');
        $(this).addClass('chat-group-active');
        $(".chat-scroll").load("feeds.php #")
    }
});

$('.squad-menu-ico-wr').click(GamesChat_subMenuSquadHide);
$('.squad-ava').click(GamesChat_subMenuSquadHide);

// Invites a user into a squad
var GamesChat_GVAR_requested = false;
$('.squad-sub-options .leave-squad .leave-squad-ico').on('click', function () {
    GamesChat_Invite_User();
});
$(".squad-inv-input").keypress(function (e) {
    if (e.which == 13) { //always return error
        GamesChat_Invite_User();
    }
});

function GamesChat_Reset_Invite_Input() {
    GamesChat_GVAR_requested = false;
}

function GamesChat_Invite_User() {
    // The GVAR protects from spamming the button
    if (!GamesChat_GVAR_requested) {
        GamesChat_GVAR_requested = true;

        // Send input to server
        var name = $('.squad-sub-options .squad-invite .squad-inv-input').val();
        SocketClient_send('SQUAD_INVITE_USER', name);
    }
}

$(document).on({
    mouseenter: function () {
        GamesChat_showSquadMemberDetails()
    },
    mouseleave: function () {
        GamesChat_hideSquadMemberDetails()
    }
}, '.squad-slot-taken');
