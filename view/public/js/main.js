/**
 * Main Traveltz controller
 * @type {{ChangeNaviState,getAvailabilityResults,StrictDate,CheckAvailability}}
 */
var Ttz = {},filt = '';

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

Ttz.getAvailabilityResults = function(filter) {

    if ($$('#date-picker').isNotEmpty() &&
        $$('#from').isNotEmpty() &&
        $$('#to').isNotEmpty() &&
        ($$('#from').value() !== $$('#to').value())) {

        var from = $$('#from').value().toLowerCase(),
            to = $$('#to').value().toLowerCase(),
            d = $$('#date-picker').value(),
            sort = '',
            filt = '';

        if (typeof filter !== 'undefined') {
            filt = (typeof filter.filter !== 'undefined'
                && filter.filter !== null) ? filter.filter.substr(0, filter.filter.length - 1) : filt;
            sort = (typeof filter.sort !== 'undefined' && !$$().empty(filter.sort)) ? filter.sort : sort;
        }

    $$().http.response({
        meth: 'post',
        url: this.URi(),
        query: 'action=getAVResults&d=' + d + '&from=' + from + '&to=' + to + '&sort=' + sort + '&filter=' + filt,
        success: function () {
            if ($$().http.state(this))
                var r = $$().http.data(this);

            if(typeof r !== 'undefined')
            {
                console.log(r);
            }
        }
    })

    }else if($$('#from').value() === $$('#to').value()){
        alert("Sorry there is no bus going that route");
    }else{
        alert("All fields are required!");
    }
} ;

Ttz.URi = function () {

    return ($$().addr().path[1] === 'traveltz') ? $$().addr().url+''+$$().addr().path[1]+'/' : $$().addr().url;

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


    /**
     * Use the slider
     * @slider  from Esliders family
     */
    $().slide({
        type:'B',
        e:'.banner',
        images:['hero.jpg','img.jpg','hero1.jpg']});


    /**
     * @get_availability_result This used in the second view of
     * check availability fired.
     */
    _T.getAvailabilityResults();

    /**
     * @sort get sort value
     */
    $('.sorts').on('change',function(){
           var  v = this.value.toLowerCase();


        _T.getAvailabilityResults({sort:v,filter:filt});
    });

    /**
     * @filter get filter options value
     */
    $().each('.checks',function(item,index){

        item.addEventListener('change',function(){

            var v = item.value.toUpperCase();
            if(item.type=='checkbox' && item.checked==true)

                filt += v+',';

            else
                filt = filt.replace(v,'');

            _T.getAvailabilityResults({filter:filt,sort:$('.sorts').value().toLowerCase()});
        });
    });

    /**
     * @filter get both filtered options value
     */
    $('.both').on('change',function(){
        if(this.type=='checkbox' && this.checked==true)
            $().each('.checks',function(item,index){
                
                var v = item.value.toUpperCase();
                item.checked = true;
                filt += v+',';
            });

        _T.getAvailabilityResults({filter:filt,sort:$('.sorts').value().toLowerCase()});

    });

    /**
     * @search Listen for change state of the search vaule
     */
    if(typeof $('#from').element !== null)
        $('#from').on('change',function () {
           _T.getAvailabilityResults();
        });

    /**
     * @search Listen for change state of the search vaule
     */
    if(typeof $('#to').element !== null)
        $('#to').on('change',function () {
           _T.getAvailabilityResults();
        });

    /**
     * @search Listen for change state of the search vaule
     */
    if(typeof $('#date-picker').element !== null)
        $('#date-picker').on('change',function () {
           _T.getAvailabilityResults();
        });


})($$,http,Ttz);
