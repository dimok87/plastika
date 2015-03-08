var $collectionNewsImageHolder;
var $addNewsImageLink = $('<a href="#">Добавить фото</a>');
var $newLinkNewsImageLi = $('<div></div>').append($addNewsImageLink);
var $collectionNewsVideoHolder;
var $addNewsVideoLink = $('<a href="#">Добавить видео</a>');
var $newLinkNewsVideoLi = $('<div></div>').append($addNewsVideoLink);

var $collectionDocumentHolder;
var $addDocumentLink = $('<a href="#">Добавить грамоту</a>');
var $newLinkDocumentLi = $('<div></div>').append($addDocumentLink);

function addItemForm($collectionHolder, $newLinkLi) {
   var prototype = $collectionHolder.data('prototype');
   var index = $collectionHolder.data('index');
   var newForm = prototype.replace(/__name__/g, index);
   $collectionHolder.data('index', index + 1);
   var $newFormLi = $('<div></div>').append(newForm).append($('<a class="remove-item" href="#">Удалить</a>'));
   $newLinkLi.before($newFormLi);
   $('.remove-item').on('click', function(e) {
      e.preventDefault();
      $(this).parent().remove();
   });
}

$(document).ready(function () {
      $collectionNewsImageHolder = $('div.images');    
      if ($collectionNewsImageHolder.length) {
         $collectionNewsImageHolder.append($newLinkNewsImageLi);
         $collectionNewsImageHolder.data('index', $collectionNewsImageHolder.find(':input').length);
         $addNewsImageLink.on('click', function(e) {
             e.preventDefault();
             addItemForm($collectionNewsImageHolder, $newLinkNewsImageLi);
         });
      }
      $collectionNewsVideoHolder = $('div.video');    
      if ($collectionNewsVideoHolder.length) {
         $collectionNewsVideoHolder.append($newLinkNewsVideoLi);
         $collectionNewsVideoHolder.data('index', $collectionNewsVideoHolder.find(':input').length);
         $addNewsVideoLink.on('click', function(e) {
             e.preventDefault();
             addItemForm($collectionNewsVideoHolder, $newLinkNewsVideoLi);
         });
      }
      $collectionDocumentHolder = $('div.documents');    
      if ($collectionDocumentHolder.length) {
         $collectionDocumentHolder.append($newLinkDocumentLi);
         $collectionDocumentHolder.data('index', $collectionDocumentHolder.find(':input').length);
         $addDocumentLink.on('click', function(e) {
             e.preventDefault();
             addItemForm($collectionDocumentHolder, $newLinkDocumentLi);
         });
      }
      // delegate calls to data-toggle="lightbox"
      $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
         event.preventDefault();
         return $(this).ekkoLightbox({
            left_arrow_class : '.play-prev',
            right_arrow_class : '.play-next'
         });
      });
      
      $('.toggle-timetable').click(function(event) {
         event.preventDefault();
         $('.timetable-container').toggle('slow', function() {
            $('.offices li').removeClass('active')
            if ($(this).is(':visible')) {
               $('.offices li:first a').click();
            } 
         });
         
         
      });
      
      if ($('#fullpage').length) {
         $('#fullpage').fullpage({
            css3: true,
            verticalCentered: false,
            navigation: true,
            slidesNavigation: true,
            navigationTooltips: ['Главная', 'Pole dance', 'Hip-hop и Go-go', 'Растяжка', 'Стрип-пластика', 'Йога', 'Шейпинг', 'Бачата и сальса', 'Акробатика', 'Детские направления', 'Постановка свадебного танца'],
            afterLoad: function(anchorLink, index){
               if(index != '1'){
                  $('#fp-nav').show();
               } else {
                  $('#fp-nav').hide();
                  $('#header').show();
               }

               if(index == '11'){
                  $('#footer').show();
               }

               var item = $('#fp-nav li:eq(' + (index -1) + ')');
               var tooltip = item.data('tooltip');
               $('<div class="fp-tooltip right active">' + tooltip + '</div>').hide().appendTo(item).fadeIn(200);  
           },
           onLeave: function(index, nextIndex, direction){
               if(nextIndex != '1'){
                  $('#header').hide();
               } else {
                  $('#fp-nav').hide();
               }

               if(nextIndex != '11'){
                  $('#footer').hide();
               }
               $('#fp-nav li:eq(' + (index -1) + ')').find('.fp-tooltip').fadeOut().remove();
           }
         });
         $('.index #footer').hide();
         $('#fp-nav').hide();
         //setInterval(function() {
         //   $.fn.fullpage.moveSlideRight();
         //}, 10000);
         $('.fp-slidesNav').wrap('<div class="container"></div>');
         $('#fp-nav').wrap('<div class="container"></div>');
      }
});