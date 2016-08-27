import { ReactiveDict } from 'meteor/reactive-dict';
import { Meteor } from 'meteor/meteor';
import { hideMatchFilters } from './menu_bar.js';

import './match_filters.html';


/* On created */
Template.partMatchFilters.onCreated(function() {
    this.state = new ReactiveDict();
});

/* Helper */
Template.partMatchFilters.helpers({
    lobbyEntryAnimated() {
        const instance = Template.instance();
        if (instance.state.get('gamemodeSelected') && instance.state.get('teamsizeSelected')) {
            return 'animated pulse';
        } else {
            return '';
        }
    },

    queueReady() {
        const instance = Template.instance();
        if (instance.state.get('gamemodeSelected') && instance.state.get('teamsizeSelected') && instance.state.get('entrySelected')) {
            return 'animated pulse queue-ready';
        } else {
            return 'queue-not-ready';
        }
    }
});

/* Events */
Template.partMatchFilters.events({
    // Hide/Show Modes
    'click .sidebar-lobby-mode'(event) {
        $('.queue-filters').removeClass('sidebar-entry-visible');
        $('#entries').addClass('ico-hidden');
        setTimeout(function () {
            $('#modes').removeClass('ico-hidden')
        }, 150);
    },

    // Hide/Show Entries
    'click .sidebar-lobby-entry'(event, instance) {
        $('.sidebar-lobby-entry').removeClass('animated pulse');

        // Check if game modes selected
        if (instance.state.get('gamemodeSelected') && instance.state.get('teamsizeSelected')) {
            $('.queue-filters').addClass('sidebar-entry-visible');
            $('#modes').addClass('ico-hidden');
            setTimeout(function () {
                $('#entries').removeClass('ico-hidden')
            }, 150);
        } else {
            // Show Error if insufficient Mode selection
            $('.sidebar-entry-error').removeClass('error-hidden');
            setTimeout(function () {
                $('.sidebar-entry-error').addClass('error-hidden')
            }, 1200);
        }
    },

    // Gamemode selection
    'click .game-mode-box'(event, instance) {
        const box = $(event.target);
        if (box.hasClass('active')) {
            box.removeClass('active');
        } else {
            box.addClass('active');
        }

        // Set reactive var
        instance.state.set('gamemodeSelected', $('.sidebar-lobby-mode-filters .game-mode-box').hasClass('active'));
        instance.state.set('teamsizeSelected', $('.game-mode-players .game-mode-box').hasClass('active'));
        instance.state.set('entrySelected', $('.sidebar-lobby-entry-filters .game-mode-box').hasClass('active'));
    },

    // Start matchmaking
    'click .sidebar-queue-start'(event, instance) {
        // If everything selected
        if (instance.state.get('gamemodeSelected') && instance.state.get('teamsizeSelected') && instance.state.get('entrySelected')) {
            Meteor.call('squad.start_matchmaking', function(error, result) {
                if (!error) {
                    hideMatchFilters();
                }
            });
        }
    }
});


/**
 Games Lobby Function (Don't ask me what the fuck that is
 **/

function GamesLobby_Roles() {
    var
        $gallery = $(".roles-wrapper"),
        $galleryPictures = $(".role-wrapper-helper"),
        $galleryPicture = $(".role-p-s"),
        lastPos = {
            x: 0
        },
        galleryPos = {
            x: 0
        },
        GalPos = 0,
        currentImage = 1,
        imageWidth = $($galleryPicture).width() * 1.0,
        imageSpacing = 0,
        imageTotalWidth = imageWidth + imageSpacing,
        speedLog = [],
        speedLogLimit = 5,
        minBlur = 2,
        maxBlur = 200,
        blurMultiplier = 0.25,
        lastBlur = 0,
        dragging = false,
        lastDragPos = {
            x: 0
        },
        dragPos = {
            x: 0
        },
        totalDist = 0,
        distThreshold = 10,
        distLog = [],
        distLogLimit = 10,
        momentumTween = null;



    /* $(window).resize(function () {
     var NewVariable;
     NewVariable = $($gallery.width() * 1.00;
     updateOldVar(NewVariable);
     });
     function updateOldVar(a) {
     imageWidth = a;
     imageTotalWidth = imageWidth + imageSpacing;
     updateGalleryPos();
     setGalleryPos(currentImage);
     } */



    function setBlur(v) {
        if (v < minBlur) v = 0;
        if (v > maxBlur) v = maxBlur;
        if (v != lastBlur) {
            $("#blur").get(0).firstElementChild.setAttribute("stdDeviation", v + ",0");
        }
        lastBlur = v;
    }

    $galleryPictures.css({
        webkitFilter: "url('#blur')",
        // filter: "url('#blur')", //invis in FF
    });
    $galleryPicture.each(function (i) {
        var cur = $(this);
        cur.click(function () {
            if (Math.abs(totalDist) < distThreshold)
                setGalleryPos(i);
        });
        $(".pagination-size-incr").eq(i).click(function () {
            GalPos = i;
            setGalleryPos(i);
        })
    });

    function setGalleryPos(v, anim) {
        if (typeof anim == "undefined") anim = true;
        stopMomentum();
        TweenMax.to(galleryPos, anim ? 1.4 : 0, {
            x: -v * imageTotalWidth,
            ease: Quint.easeOut,
            onUpdate: updateGalleryPos,
            onComplete: updateGalleryPos
        });
    }

    function updateGalleryPos() {
        TweenMax.set($galleryPictures, {
            x: galleryPos.x + 0,
            force3D: true,
            lazy: true
        });
        var speed = lastPos.x - galleryPos.x;
        var blur = Math.abs(Math.round(speed * blurMultiplier));
        setBlur(blur);
        lastPos.x = galleryPos.x;

        var _currentImage = Math.round(-galleryPos.x / imageTotalWidth);
        if (_currentImage != currentImage) {
            currentImage = _currentImag
            $(".pagination-active").removeClass('pagination-active');
            $(".slide-pagination-circle").eq(currentImage).addClass('pagination-active')
        }

    }
    $gallery.mousedown(function (event) {
        event.preventDefault();
        dragging = true;
        dragPos.x = event.pageX;
        lastDragPos.x = dragPos.x;
        totalDist = 0;
        distLog = [];

        stopMomentum();

        updateGalleryPosLoop();
    });
    $(document).mousemove(function (event) {
        if (dragging) {
            dragPos.x = event.pageX;
        }
    });

    function updateGalleryPosLoop() {
        if (dragging) {
            $('.roles-drag-note').addClass('invis');
            updateGalleryPos();
            var dist = dragPos.x - lastDragPos.x;
            lastDragPos.x = dragPos.x;
            totalDist += dist;
            distLog.push(dist);
            while (distLog.length > distLogLimit) {
                distLog.splice(0, 1);
            };
            galleryPos.x += dist;
            requestAnimationFrame(updateGalleryPosLoop)
        }
    }
    $(document).mouseup(function (event) {
        if (dragging) {
            dragging = false;
            var releaseSpeed = 0;
            for (var i = 0; i < distLog.length; i++) {
                releaseSpeed += distLog[i];
            };
            releaseSpeed /= distLog.length;

            var targetX = galleryPos.x + (releaseSpeed * 20);
            targetX = Math.round(targetX / imageTotalWidth) * imageTotalWidth;
            var targetImage = -targetX / imageTotalWidth;
            var excess = 0;
            if (targetImage < 0) {
                excess = targetImage;
                targetImage = 0;
            } else if (targetImage >= $galleryPicture.length) {
                excess = targetImage - ($galleryPicture.length - 1);
                targetImage = $galleryPicture.length - 1;
            }
            if (excess != 0) {
                targetX = -targetImage * imageTotalWidth;
            }
            momentumTween = TweenMax.to(galleryPos, 1 - (Math.abs(excess) / 20), {
                x: targetX,
                ease: Quint.easeOut,
                onUpdate: updateGalleryPos,
                onComplete: updateGalleryPos
            });

            if (Math.abs(totalDist) >= distThreshold) {
                event.preventDefault();
                event.stopPropagation();
            }
        }
    });

    function stopMomentum() {
        if (momentumTween != null) {
            momentumTween.kill();
            momentumTween = null;
            updateGalleryPos();
        }
    }

    setGalleryPos(1, false);
}