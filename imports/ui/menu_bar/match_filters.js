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
