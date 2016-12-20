import { Squads } from '../../api/squad.js';

import './role_selection.html';

/* Created */
Template.partSquad.onCreated(function squadOnCreated() {
    Meteor.subscribe('userData');
    Meteor.subscribe('squads');
});

/* On rendered */
Template.partRoleSelection.onRendered(function() {
    setRoleGallerySettings();
});

/* Events */
Template.partRoleSelection.events({
    // Select Role
    'click .role-p-s'(event) {
        Meteor.call('squad.role.select_role', this.index);
    }
});

/* Helper */
Template.partRoleSelection.helpers({
    // Returns user data
    squad() {
        return Squads.findOne({
            _id: Meteor.user().squadId
        });
    }
});


/**
 * Don't ask, please
 */
function setRoleGallerySettings() {
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
        //webkitFilter: "url('#blur')"
        //filter: "url('#blur')" //invis in FF
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
            currentImage = _currentImage;
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
