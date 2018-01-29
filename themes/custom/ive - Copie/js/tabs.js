(function($, Drupal, drupalSettings){
    // externalLink
    Drupal.behaviors.tabs = {
        attach: function(context, settings){
             $( "#tabs" , context).tabs();
        }
    }
}) (jQuery, Drupal, drupalSettings);