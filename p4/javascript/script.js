$(document).ready(function() {

    
    //LOCAL STORAGE
    function updateLocalStorage() {
        var htmlContents = document.documentElement.innerHTML;
        localStorage.setItem('myList', JSON.stringify(htmlContents));
    }
    
   
    if(localStorage.getItem('myList') != null) {
        
    
       var myList = JSON.parse(localStorage.getItem('myList'));
        document.getElementById("html").innerHTML = myList; 
        
        $(document).find('li').each(function() {
           if($(this).hasClass('completed')) {
               $(this).appendTo('.list');
               $(this).find('.checkbox').prop('checked', 'true');
               $(this).removeClass('selected');
             
           }
        });
        
    }
    
    
    
    //SETUP VARIABLES
    var $list; 
    var $newItem;
    var $newItemButton;
    var $input;
    $list = $('ul');
    $newItem = $('#newItem');
    $newItemButton = $('#newItemButton');
    $input = $('#input');
    
    
    
    
    //FUNCTIONS
    function addItem() {
       var text =  $input.val();
        
       $list.prepend('<li class="ui-state-default">' + '<input type="checkbox" class="checkbox"><span>' + text + '</span><button type="button" class="btn btn-danger deleteBtn">X</button>' + '<button type="button" class="btn btn-default editBtn">Edit</button>' + '</li>');
       $input.val('');
       updateLocalStorage();
       return;
    }
    
    
    //ADD NEW ITEM
    $newItemButton.on('click', function() {
        if($input.val() != '')
        {
            addItem();
        }
    });
    
    $(document).keyup(function(e) {
       if(e.which == 13 && $('#input').is(':focus') && $input.val() != '') {
           addItem();
       } 
    });
    
    
    //EDIT AN ITEM
    $list.on('click', '.editBtn', function() {
        if(!$(this).closest('li').hasClass('edit')) {
           $(this).closest('li').addClass('edit'); 
            var oldText = $(this).siblings('span').text();
            $(this).siblings('span').remove();
            $(this).closest('li').append('<span><input type="text" name="input"  id="newInput"></span>');
            $(this).closest('li').find('input').prop('value', oldText);
            $(this).text('Save');
        }
        else if($(this).closest('li').hasClass('edit')) {
            var newText = $('#newInput').val();
            $(this).siblings('span').remove();
            $(this).closest('li').append('<span>' + newText + '</span');
            $(this).text('Edit');
            $(this).closest('li').removeClass('edit');
            $(this).closest('li').removeClass('selected');
            updateLocalStorage();
        }
            
    });
    
    //REMOVE AN ITEM
    $list.on('click', '.deleteBtn', function() {
       $(this).closest('li').fadeOut('fast', function() {
           $(this).closest('li').remove();
           updateLocalStorage();
       });
    });
    
    
    
    
    //ONHOVER EVENTS
    $list.on('mouseenter', 'li', function() {
       $(this).addClass('selected');
    }); 
    
    $list.on('mouseleave', 'li', function() {
       $(this).removeClass('selected');
    });
    
    
    //CHECKS IF COMPLETED
    $list.on('click', '.checkbox', function() {
       $(this).closest('li').toggleClass('completed');
       $(this).closest('li').fadeOut('fast', function() {
       $(this).closest('li').appendTo('.list').fadeIn('slow');

       });

       
        updateLocalStorage();
    });
    
    
    
 
   //MAKE LIST ITEMS SORTABLE BY CLICK AND DRAG
  $( "#sortable" ).sortable();
  $( "#sortable" ).disableSelection(); 
    
    setInterval(function() {
                updateLocalStorage();
            }, 3000);

});