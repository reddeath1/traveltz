/**
 * Main Traveltz controller
 * @type {{ChangeNaviState,StrictDate,CheckAvailability}}
 */
var Ttz = {};

Ttz.ChangeNaviState = function(o){

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
        date;


    month = (month < 10)? "0"+month : month;
    date = year+'-'+month+'-01';

    el.attr('min',date);
};

Ttz.CheckAvailability =function(el){
    el.disableClick();
    el.on('mousedown',function () {
        alert('I m disabled for further development..');
    })
};



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

})($$,http,Ttz);
