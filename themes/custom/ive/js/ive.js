 /** alert('hello')**/
 /**
(function($, Drupal, drupalSettings){
    $(document).ready(function(){
        
      $("a[href^='http']").attr('target','_blank');  
    });
})(jQuery, Drupal, drupalSettings);
**/


/**  slideToggle('') permet d'acceler la vitessed'appariton de de disparution le contenu des blocks

(function($, Drupal, drupalSettings) {
    $(document).ready(function(){
      $("a[href^='http']").attr('target','_blank').addClass('icone'); 
      // block collapse
      $(".sidebar .block h2").click(function() {
        $(this).siblings('.content').slideToggle('fast');
      });
    });
})(jQuery, Drupal, drupalSettings);
**/

(function($, Drupal, drupalSettings){
    // externalLink
    Drupal.behaviors.externalLink = {
        attach: function(context, settings){
            $("a[href^='http']", context).attr('target', '_blank').addClass('icone');
        }
    }

// blockCollapsable
Drupal.behaviors.blockCollapsable = {
        attach: function(context, settings){
            $(".sidebar .block h2",context).click(function() {
                $(this).siblings('.content').slideToggle('fast');
        });
        
    }
}
}) (jQuery, Drupal, drupalSettings);