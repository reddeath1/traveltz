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

    if(el.element !== null){
        el.attr('min',date);

        el.element.addEventListener('keyup',function () {
            this.focus();
            this.value = '';
        });
    }
};

Ttz.CheckAvailability = function(el){
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

    if ((!$$('#date-picker').isNull()) && $$('#date-picker').isNotEmpty() &&
        $$('#from').isNotEmpty() &&
        $$('#to').isNotEmpty() &&
        ($$('#from').value() !== $$('#to').value())) {

        var from = $$('#from').value().toLowerCase(),
            to = $$('#to').value().toLowerCase(),
            d = $$('#date-picker').value(),
            sort = '',
            filt = '',
            holder = $$('.result');

        if (typeof filter !== 'undefined') {
            filt = (typeof filter.filter !== 'undefined'
                && filter.filter !== null) ? filter.filter.substr(0, filter.filter.length - 1) : filt;
            sort = (typeof filter.sort !== 'undefined' && !$$().empty(filter.sort)) ? filter.sort : sort;
        }else{
            if($$('.both').element !== null && $$('.both').element.checked === true){
                filt = '';
                $$().each('.checks', function (item, index) {

                    var v = item.value.toUpperCase();
                    item.checked = true;
                    filt += v + ',';
                });

            }

            if($$('.sorts').element !== null && $$('.sorts').isNotEmpty()){
                sort = $$('.sorts').element.value.toLowerCase();
            }

            /**
             * @filter get filter options value
             */
            $$().each('.checks',function(item,index){
                if(item !== null){
                    var v = item.value.toUpperCase();
                    if(item.type=='checkbox' && item.checked==true)

                        filt += v+',';

                    else
                        filt = filt.replace(v,'');
                }
            });

            filt = filt.substr(0, filt.length - 1)
        }

    $$().http.response({
        meth: 'post',
        url: this.URi(),
        query: 'action=get_av_results&d=' + d + '&from=' + from + '&to=' + to + '&sort=' + sort + '&filter=' + filt,
        success: function () {
            if ($$().http.state(this))
                var r = $$().http.data(this);

            if (typeof r !== 'undefined') {

                (typeof r.data !== 'undefined')
                    ?
                    holder.html(r.data)
                   :
                    holder.html("<div style='text-align: center;width: 100%;float: left;color: white;'>" + r.message + "</div>");
            }
        }
    })

    }else if(
        (!$$('#date-picker').isNull()) && $$('#from').isNotEmpty()
        && $$('#to').isNotEmpty()
        && $$('#from').value() === $$('#to').value()){
        alert("Sorry there is no bus going that route");
    }
} ;


Ttz.swapVAlue = function(){

  if(!$$('.swap').isNull()){
      $$('.swap').on('click',function(){
          var to = $$('#to').value(),
              from = $$('#from').value();

          $$('#from').value(to);
          $$('#to').value(from);

          Ttz.getAvailabilityResults();
      });
  }
};

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

    _T.swapVAlue();

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

    if($('.sorts').element !== null){

        $('.sorts').on('change',function(){
            var  v = this.value.toLowerCase();


            _T.getAvailabilityResults({sort:v,filter:filt});
        });
    }

    /**
     * @filter get filter options value
     */
    $().each('.checks',function(item,index){


        item.addEventListener('change',function(){

            var v = item.value.toUpperCase();
            if(item.type=='checkbox' && item.checked==true)

                filt += v+',';

            else
                filt = filt.replace(','+v,'');

            _T.getAvailabilityResults({filter:filt,sort:$('.sorts').value().toLowerCase()});
        });


    });

    if($('.both').element !== null){
        /**
         * @filter get both filtered options value
         */
        $('.both').on('change',function(){
            if(this.type==='checkbox' && this.checked===true) {
                filt = '';
                $().each('.checks', function (item, index) {

                    var v = item.value.toUpperCase();
                    item.checked = true;
                    filt += v + ',';
                });

                _T.getAvailabilityResults({filter: filt, sort: $('.sorts').value().toLowerCase()});

            }else {
                $().each('.checks', function (item, index) {
                    item.checked = false;
                    filt = '';
                });
            }
        });
    }

    /**
     * @search Listen for change state of the search vaule
     */
    if($('#from').element !== null)
        $('#from').on('change',function () {
            if(this.value !== ''){
                _T.getAvailabilityResults();
            }
        });

    /**
     * @search Listen for change state of the search vaule
     */
    if($('#to').element !== null)
        $('#to').on('change',function () {
            if(this.value !== ''){
                _T.getAvailabilityResults();
            }
        });

    /**
     * @search Listen for change state of the search vaule
     */
    if($('#date-picker').element !== null)
        $('#date-picker').on('change',function () {
            if(this.value !== ''){
                _T.getAvailabilityResults();
            }
        });

    if(!$('.collapse-btn').isNull()){
        $('.elapsed').countDown();
    }


    if(!$('.seats').isNull()){
        var last = document.getElementsByClassName('bus-seat').length -1;
        var li = $(document.getElementsByClassName('bus-seat')[last].children[0]);
        li.element.addEventListener('click',function()
        {
            alert("Driver seat!");
        });
        li.src(_T.URi()+'view/public/images/icons/seat-unavailable.png');
        li.attr('title','Unavailable');

        $('.bus-seat').each('.bus-seat',function(item,index){
            if(last !== index){
                var scount = 0;
                var c = document.getElementsByClassName('bus-seat')[index].children[0];
                $(item).on('click',function(){

                    var data = $(this).attr('seat-data'),
                    d = $().toArray(data,','),
                    price = d[0],
                    sno = d[1],
                    sid = d[2],
                        seat=  $('.seat-no').text(),
                    pr = $('.price').text();

                    if($(c).src() !== _T.URi()+'view/public/images/icons/seat-selected.png'){
                        $(c).src(_T.URi()+'view/public/images/icons/seat-selected.png');
                        $(this).addClass('selected');
                        if(seat !== ''){
                            seat += ','+sno;
                            price = pr+' + '+price;

                        }else{
                            seat = sno;
                            price =  price;

                        }

                    }else{
                        $(this).removeClass('selected');
                        $(c).src(_T.URi()+'view/public/images/icons/seat-available.png');

                        if(seat !== ''){
                            seat = seat.replace(','+sno,'');
                            price = price.replace('+'+price,'');

                        }

                    }

                    var l = $().length('.selected');

                    $('.selected-seat').html("("+l+")");
                    $('.seat-no').text(seat);
                    $('.price').text(price);

                    var pc = $().toArray($('.price').text(),' + '),prr = 0;

                    for (var i =0; i <= pc.length;i++){
                       if(typeof pc[i] !== 'undefined'){
                           prr += parseInt(pc[i]);
                       }
                    }

                    $('.total-price').text(prr);

                    setTimeout(function(){
                        if($('.seat-no').text() === '(0)'){
                            $('.total-price').text(' ');
                        }
                    },100);


                });
            }
        });


    }

})($$,http,Ttz);
