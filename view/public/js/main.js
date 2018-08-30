/**
 * Main Traveltz controller
 * @type {{ChangeNaviState,StrictDate,CheckAvailability}}
 */
var Ttz = {};

Ttz.ChangeNaviState = function(){

    $$(document).on('scroll',function(){
        if ($$(this).Scroller.Top() > 86){
            $$("#banner").addClass("shrink");
        }else{
            $$("#banner").removeClass("shrink");
        }
    });
};

Ttz.StrictDate = function (el) {
    var now = new Date(),
        month = now.getMonth()+1,
        year = now.getFullYear(),
        today = now.getDate(),
        date;


    month = (month < 10)? "0"+month : month;
    today = (today < 10) ? "0"+today : today;
    
    date = year+'-'+month+'-'+today;

    el.attr('min',date);

    el.element.addEventListener('keyup',function () {
         this.focus();
        this.value = '';
    });
};

Ttz.CheckAvailability =function(el){
    el.disableClick();
    el.on('mousedown',function () {
        ($$('#date-picker').isNotEmpty() &&
            $$('#from').isNotEmpty() &&
            $$('#to').isNotEmpty() &&
            ($$('#from').value() !== $$('#to').value())) ?

        $$('form').submit() :

            ($$('#from').value() === $$('#to').value()) ?
                alert("Sorry there is no bus going that route") :
                alert("All fields are required!");
    })
};


/**
 * This is a brain of this software
 */
(function($,http,_T){

    /**
     * change navigation menu states
     */
    _T.ChangeNaviState();

    /**
     * date picker management
     */

    _T.StrictDate($('#date-picker'));

    /**
     * Check availability state
     */
    _T.CheckAvailability($('.btn-banner'));

    $().slide({
        type:'B',
        e:'.banner',
        images:['hero.jpg','img.jpg','hero1.jpg']});

})($$,http,Ttz);
