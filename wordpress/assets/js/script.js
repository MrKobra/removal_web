$(document).ready(function(){
    var offsetMenuBtn = $('.main-header-btn-container').offset().top;
    // Локализация datepicker
    $.datepicker.regional['ru'] = {
        closeText: 'Закрыть',
        prevText: 'Предыдущий',
        nextText: 'Следующий',
        currentText: 'Сегодня',
        monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
        monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
        dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
        dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
        dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
        weekHeader: 'Не',
        dateFormat: 'dd.mm.yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''

    };
    $.datepicker.setDefaults($.datepicker.regional['ru']);
    // Кнопка datepicker
    $('.contact-form #date-picker').datepicker();
    // Стилизация select
    $('.contact-form select').styler();
    if($('#shipping_country').length != 0) {
        $('#shipping_country').select2({
            language: {
                noResults: function (params) {
                    return "Нет результатов";
                }
            }
        });
    }
    // Слайдер акции
    $('.stocks-slider').slick({
        autoplay: true,
        autoplaySpeed: 2000,
    });
    // Слайдер с авто
    $('.our-car-slider').slick({
        slidesToShow: 3,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 1201,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });
    // Слайдер отзывов
    $('.reviews-slider').slick({
        slidesToShow: 2,
        responsive: [
            {
                breakpoint: 993,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    })
    // Слайдер на странице товара
    $('.single-product-commend-slider .items-container').slick({
        slidesToShow: 4,
        responsive: [
            {
                breakpoint: 1201,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 993,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 577,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    })
    // Попап
    $('.request').magnificPopup();
    $('.request').on('click', function(){
        if($(this).data('marks')) {
            $('#request input[name=marks]').val($(this).data('marks'));
        }
    })
    // Подсказки
    $('.advantages-card a').mouseover(function(){
        var href = $(this).attr('href');
        if($(this).parents('.advantages-card').index() % 4 == 3) {
            $(this).parents('.advantages-card').find('.advantages-card-hinit').addClass('reverse');
        }
        $(this).parents('.advantages-card').find(href).show();
    })
    $('.advantages-card a').mouseleave(function(){
        $('.advantages-card-hinit').hide();
    })
    $('.advantages-card a').on('click', function(e) {
        e.preventDefault();
    })
    // мобильное меню
    $(window).on('load resize', function() {
        if($(window).width() <= 768) {
            $('.main-header-btn').on('click', function(){

                if($(this).hasClass('active')) {
                    $(this).removeClass('active');
                    $(this).addClass('inactive');
                    if($(window).scrollTop() < offsetMenuBtn) {
                        $(this).parents('.main-header-btn-container').removeClass('fix')
                    }
                } else {
                    $(this).removeClass('inactive');
                    $(this).addClass('active');
                    $(this).parents('.main-header-btn-container').addClass('fix')
                }
                $('.main-header-nav').toggleClass('active');
            })
            $(function() {
                var menuBtn = $('.main-header-btn-container');
                if($(window).scrollTop() >= offsetMenuBtn) {
                    menuBtn.addClass('fix')
                    $('.main-header-content').css('margin-bottom', $('.main-header-btn-container').outerHeight());
                } else {
                    menuBtn.removeClass('fix')
                    $('.main-header-content').css('margin-bottom', 0);
                }
                $(window).scroll(function(){
                    if($(window).scrollTop() >= offsetMenuBtn) {
                        menuBtn.addClass('fix');
                        $('.main-header-content').css('margin-bottom', $('.main-header-btn-container').outerHeight());
                    } else {
                        if(!($('.main-header-nav').hasClass('active'))) {
                            menuBtn.removeClass('fix');
                            $('.main-header-content').css('margin-bottom', 0);
                        }
                    }
                })
            })
        } else {
            $('.main-header-content').css('margin-bottom', 0);
        }
    })
    $('.menu-item-has-children a').not('.sub-menu a').on('click', function(e){
        if($(window).width() <= 768) {
            e.preventDefault();
            $(this).parent().find('.sub-menu').slideToggle(500);
        }
    })
    // Адаптив таблиц
    $('.tariffs-page-price table').each(function(){
        $(this).find('tbody tr').each(function(){
            $(this).find('td').each(function(){
                var index = $(this).index();
                var label;
                $(this).parents('table').find('thead th').each(function(){
                    if($(this).index() == index) {
                        label = $(this).text();
                    }
                })
                $(this).attr('aria-label', label);
            })
        })
    })

    // Слайдер в карточке товаров
    $('.single-item-slider-big').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.single-item-slider-small',
    });
    $('.single-item-slider-small').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.single-item-slider-big',
        focusOnSelect: true,
        arrows: false,
        responsive: [
            {
                breakpoint: 1201,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 993,
                settings: {
                    slidesToShow: 5,
                }
            },
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 481,
                settings: {
                    slidesToShow: 2,
                }
            }
        ]
    });
    // Стилизация количества
    $('.quantity input').styler();
    $('.catalog-sort select').styler();

    // Обновление стоимости
    function update_price(quantity, id, result) {
        $.ajax({
            method: 'POST',
            url: myajax.url,
            dataType: 'json',
            data: {
                action: 'update_price',
                nonce_code: myajax.nonce,
                quantity: quantity,
                id: id
            },
            success: function (data) {
                if(data) {
                    result.text(data);
                }
            },
        })
    }
    if($('.single-item').length != 0) {
        update_price($('.single-item-var .quantity input').val(), $('.single-item-var .addToCart button').val(), $('.single-item-price .price'));
    }
    $('.single-item-var .quantity input').on('change keyup', function(){
        update_price($(this).val(), $('.single-item-var .addToCart button').val(), $('.single-item-price .price'));
    })

    // Автообновление корзины
    $(document).on('change keyup', '.woocommerce-cart-form .quantity input', function(){
        update_price($(this).val(), $(this).parents('.cart_item').find('.product-remove a').data('product_id'), $(this).parents('.cart_item').find('.product-subtotal span'));
        update_total();
    })
    $('.woocommerce-cart-form .cart_item').each(function(){
        update_price($(this).find('.quantity input').val(), $(this).find('.product-remove a').data('product_id'), $(this).find('.product-subtotal span'));
    })

    // Обновление итоговой стоимости
    function update_total() {
        if($('.woocommerce-cart-form .cart_item').length != 0) {
            var str = '';
            $('.cart_item').each(function(){
                var id = $(this).find('.product-remove a').data('product_id');
                var quantity = $(this).find('.product-quantity input').val();
                str += id + '=' + quantity + ',';
            })
            str = str.slice(0, -1);
            $.ajax({
                method: 'POST',
                url: myajax.url,
                dataType: 'json',
                data: {
                    action: 'update_total',
                    nonce_code: myajax.nonce,
                    items: str
                },
                success: function (data) {
                    if (data) {
                        $('.cart-total .total span').text(data);
                    }
                },
            })
        }
    }
    update_total();

    // Способ доставки
    function setDelivery() {
        if($('input[name=ship_type]').length != 0) {
            $('.delivery-type').removeClass('active');
            $('.shipping-block').hide();
            var cur = $('input[name=ship_type]:checked').val();
            if(cur == 'delivery') {
                $('#ship-to-different-address-checkbox').prop('checked', 'checked');
            } else {
                $('#ship-to-different-address-checkbox').prop('checked', false);
            }
            $('#'+cur).show();
            $('input[name=ship_type]:checked').parents('.delivery-type').addClass('active');
            $('#billing_delivery option[value='+cur+']').prop('selected', 'selected');
            $.ajax({
                method: 'POST',
                url: myajax.url,
                async: false,
                dataType: 'json',
                data: {
                    action: 'set_delivery_cost',
                    nonce_code: myajax.nonce,
                    delivery: cur,
                },
            })
        }
    }
    setDelivery();
    $('input[name=ship_type]').on('change', function(){
        setDelivery();
        window.location.href = window.location.href;
    })
    $('.delivery-type').on('click', function(){
        $(this).find('input').prop('checked', 'checked');
        setDelivery();
        window.location.href = window.location.href;
    })

    // Подсказки в инпут
    function notice_input(input) {
        if(input.val().length != 0) {
            input.parents('p').addClass('active');
        } else {
            input.parents('p').removeClass('active');
        }
    }
    $('.shipping_address input, .shipping_address textarea, .woocommerce-billing-fields input').on('keyup change', function() {
        notice_input($(this));
    })
    $('.shipping_address input, .shipping_address textarea, .woocommerce-billing-fields input').each(function(){
        notice_input($(this));
    })

    // Изменение активного элемента способа оплаты
    function setPayment() {
        $('#payment li').removeClass('active');
        $('#payment input:checked').parents('li').addClass('active');
    }
    $(document).on('change', '#payment input', function(){
        setPayment();
    })
    $(document).on('click', '#payment li', function(){
        $(this).find('input').prop('checked', 'checked');
        setPayment();
    })

    // Изменение типа поля
    if($('#additional_removal_removal').length != 0) {
        $('#additional_removal_removal').attr('type', 'checkbox');
    }
     if($('#additional_agreement_agree').length != 0) {
        $('#additional_agreement_agree').attr('type', 'checkbox');
     }
    function billingAgreementChange() {
        if($('#additional_agreement_agree').prop('checked')) {
            $('#additional_agreement_agree').parent().find('label').addClass('active');
        } else {
            $('#additional_agreement_agree').parent().find('label').removeClass('active');
        }
        if($('#additional_removal_removal').prop('checked')) {
            $('#additional_removal_removal').parent().find('label').addClass('active');
        } else {
            $('#additional_removal_removal').parent().find('label').removeClass('active');
        }
        if($('#mailpoet_woocommerce_checkout_optin').prop('checked')) {
            $('#mailpoet_woocommerce_checkout_optin').parent().addClass('active');
        } else {
            $('#mailpoet_woocommerce_checkout_optin').parent().removeClass('active');
        }
    }
    billingAgreementChange();
    $('#additional_agreement_agree, #mailpoet_woocommerce_checkout_optin, #additional_removal_removal').on('change', function(){
        billingAgreementChange();
    })

    // Добавлениие информации к чекбоксу переезда
    if($('#additional_removal_field').length != 0) {
        $('#additional_removal_field').find('label.radio').append('<p>Оставьте заявку и получите <span>скидку -10%</span> на переезд под ключ</p><p>Наш менеджер свяжется с вами для расчета стоимости и предложит самые выгодные условия</p>');
    }

    // Выбор магазин
    function setShop(){
        if($('input[name=shipping_shop_title]').length != 0) {
            $('.shipping_shop-card label').removeClass('active');
            $('input[name=shipping_shop_title]:checked').parent().addClass('active');
            var value = $('input[name=shipping_shop_title]:checked').val();
            $('input[name=billing_shop]').val(value);
        }
    }
    setShop();
    $('input[name=shipping_shop_title]').on('change', function(){
        setShop();
    })

    // Кнопка оформить заказ
    $('.fake_btn').on('click', function(e){
        e.preventDefault();
        $('.order_btn').trigger('click');
    })

    // Ползунок
    function range_slider(selector, min_range, max_range) {
        if(selector.length != 0) {
            var min = selector.data('min');
            var max = selector.data('max');
           selector.slider({
                animate: "slow",
                range: true,
                min: min,
                max: max,
                values: [min_range.val(), max_range.val()],
                slide: function(event, ui) {
                    min_range.val(ui.values[0]);
                    max_range.val(ui.values[1]);
                }
            })
        }
        min_range.on('keyup', function(){
            $('#price-slider').slider('values', [min_range.val(), max_range.val()]);
        })
        max_range.on('keyup', function(){
            $('#price-slider').slider('values', [min_range.val(), max_range.val()]);
        })
    }
    range_slider($('#price-slider'), $('input[name=min_price]'), $('input[name=max_price]'));
    range_slider($('#length-slider'), $('input[name=min_length]'), $('input[name=max_length]'));
    range_slider($('#width-slider'), $('input[name=min_width]'), $('input[name=max_width]'));
    range_slider($('#height-slider'), $('input[name=min_height]'), $('input[name=max_height]'));
    $('.catalog-sidebar-slider input').styler();

    // Ввод только цифр
    $('.catalog-sidebar-slider input').keydown(function (event){
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 ||
            (event.keyCode == 65 && event.ctrlKey === true) ||
            (event.keyCode >= 35 && event.keyCode <= 39)) {
            return;
        } else {
            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }
        }
    })

    // Показать блоки
    $('.catalog-sidebar-checkbox .catalog-sidebar-header').on('click', function(){
        $(this).parent().toggleClass('active');
        $(this).parent().find('.catalog-sidebar-body').slideToggle(500);
    })

    // Скрыть пункты
    function hideSidebarCheckbox() {
        $('.catalog-sidebar-checkbox').each(function(){
            var count = $(this).find('.catalog-sidebar-row').length;
            if(count > 7) {
                var i = 0;
                $(this).find('.catalog-sidebar-row').each(function(){
                    i++;
                    if(i > 7) {
                        $(this).hide();
                    }
                    if(i == count && $(this).parent().find('.show-full-filter').length == 0) {
                        $(this).after('<a href="#" class="show-full-filter show">Показать еще ('+(count - 7)+')</a>');
                    }
                })
            }
        })
    }
    hideSidebarCheckbox();

    // Показать пункты
    $('.show-full-filter').on('click', function(e){
        e.preventDefault();
        if($(this).hasClass('show')) {
            $(this).removeClass('show');
            $(this).addClass('hide');
            $(this).parent().find('.catalog-sidebar-row').show();
            $(this).text('Скрыть');
        } else {
            $(this).removeClass('hide');
            $(this).addClass('show');
            hideSidebarCheckbox();
        }
    })

    // Checkbox
    $('.catalog-sidebar-row input[type=checkbox]').each(function(){
        if($(this).prop('checked')) {
            $(this).parent().addClass('checked')
        } else {
            $(this).parent().removeClass('checked')
        }
    })
    $('.catalog-sidebar-row input[type=checkbox]').on('change', function(){
        if($(this).prop('checked')) {
            $(this).parent().addClass('checked')
        } else {
            $(this).parent().removeClass('checked')
        }
    })

    // Фильтр
    function filter_range(range, max_range, min_range) {
        var result = '';
        var i = 0;
        range.find('option').each(function(){
            if(Number($(this).text()) <= max_range.val() && Number($(this).text()) >= min_range.val()) {
                if(i == 0) {
                    result = $(this).val();
                } else {
                    result = result + ',' + $(this).val();
                }
                i++;
            }
        })
        return result;
    }
    function filter_input(block) {
        var values = '';
        var name = '';
        var flag = false;
        var i = 0;
        block.find('input').each(function(){
            if($(this).prop('checked')) {
                if(i == 0) {
                    values = $(this).val();
                } else {
                    values = values + ',' + $(this).val();
                }
                i++;
                name = $(this).attr('name');
                flag = true;
            }
        })
        if(flag) {
            return name + '=' + values;
        } else {
            return '';
        }
    }
    $('.filter_btn').on('click', function(e){
        e.preventDefault();
        // Фильтр цены
        var max_price = $('input[name=max_price]').val();
        var min_price = $('input[name=min_price]').val();
        var length = filter_range($('#length_range'), $('input[name=max_length]'), $('input[name=min_length]'));
        var width = filter_range($('#width_range'), $('input[name=max_width]'), $('input[name=min_width]'));
        var height = filter_range($('#height_range'), $('input[name=max_height]'), $('input[name=min_height]'));
        var url = window.location.protocol + '//' + window.location.hostname + window.location.pathname;
        var search = window.location.search;
        var i = 0;
        url = url + '?';
        if(search.length != 0) {
            search = search.split('&');
            $.each(search, function(index, value) {
                var item = value.split('=');
                if(item[0] == 'count' || item[0] == '?count') {
                    i++;
                    if(i == 1) {
                        url = url + 'count=' + item[1];
                    } else {
                        url = url + '&count=' + item[1];
                    }
                } else if(item[0] == 'sort' && item[0] != '?sort'){
                    i++;
                    if(i == 1) {
                        url = url + 'sort=' + item[1];
                    } else {
                        url = url + '&sort=' + item[1];
                    }
                }
            })
        }
        if (i == 0) {
            url = url + 'min_price='+min_price+'&max_price='+max_price;
        } else {
            url = url + '&min_price='+min_price+'&max_price='+max_price;
        }
        url = url + '&length=' + length + '&width=' + width + '&height' + height;
        $('.catalog-sidebar-block').each(function(){
            var value = filter_input($(this));
            if(value.length != 0) {
                url = url + '&' + value;
            }
        })
        window.location.href = url;
    })

    // Сброс фильтра
    $('.reset_btn').on('click', function(e) {
        e.preventDefault();
        var url = window.location.protocol + '//' + window.location.hostname + window.location.pathname;
        var search = window.location.search;
        if(search.length != 0) {
            search = search.split('&');
            $.each(search, function(index, value) {
                var item = value.split('=');
                if(item[0] == 'count' || item[0] == '?count') {
                    url = url + '?count=' + item[1];
                }
            })
        }
        window.location.href = url;
    })

    // Сортировка
    $('select[name=catalog-sort]').on('change', function(){
        var sort = $('select[name=catalog-sort]').val();
        var url = window.location.protocol + '//' + window.location.hostname + window.location.pathname;
        var search = window.location.search;
        var i = 0;
        var flag = true;
        if(search.length != 0) {
            search = search.split('&');
            $.each(search, function(index, value) {
                var item = value.split('=');
                if(item[0] == 'sort' || item[0] == '?sort') {
                    i++;
                    if(sort != 'none') {
                        if(i == 1) {
                            url = url + '?sort=' + sort;
                        } else {
                            url = url + '&sort=' + sort;
                        }
                    }
                    flag = false;
                } else {
                    i++;
                    url = url + value;
                }
            })
            if(flag && sort != 'none') {
                url = url + '&sort=' + sort;
            }
        } else if(sort != 'none') {
            url = url + '?sort=' + sort;
        }
        window.location.href = url;
    })

    // Количество выводимых постов
    $('#items-count').on('change', function(){
        var count = $(this).val();
        var url = window.location.protocol + '//' + window.location.hostname + window.location.pathname;
        var search = window.location.search;
        if(search.length == 0) {
            url = url + '?count='+count;
        } else {
            search = search.split('&');
            var flag = true;
            $.each(search, function(index, value) {
                var item = value.split('=');
                if(item[0] == 'count') {
                    url = url + '&count=' + count;
                    flag = false;
                } else if(item[0] == '?count') {
                    url = url + '?count=' + count;
                    flag = false;
                } else if(item[0] != 'page' && item[0] != '?page'){
                    url = url + value;
                }
            })
            if(flag) {
                url = url + '&count=' + count;
            }
        }
        window.location.href = url;
    })

    // Показать фильтр
    $('.mobile-filter-btn').on('click', function(){
        if($('.mobile-filter-btn').hasClass('active')) {
            $('.mobile-filter-btn').removeClass('active');
        } else {
            $('.mobile-filter-btn').addClass('active');
        }
        if($(this).hasClass('active')) {
            $('body').css('overflow', 'hidden');
        } else {
            $('body').css('overflow', 'auto');
        }
        $('.catalog-sidebar').slideToggle(500);
    })
    $(window).resize(function (){
        main_home_slide_height();
    })

    // Высота слайда
    function main_home_slide_height() {
        if($('.main-home').length != 0) {
            $('.main-home').css('height', 'auto');
            var height = $('.main-home').outerHeight();
            $('.main-home').each(function(){
                if($(this).outerHeight > height) {
                    height = $('.main-home').outerHeight();
                }
            })
            $('.main-home').css('height', height);
        }
    }
    main_home_slide_height();

    // Слайдер на главной
    $('.main-home-slider').slick({
        arrows: false,
        dots: true,
        infinite: false,
        autoplay: true,
        autoplaySpeed: 2000,
    })

    // Время для звонка в форме
    if($('select[name=call_date]').length != 0) {
        $('select[name=call_date] option:eq(0)').detach();
        var date = new Date();
        var hour = date.getHours();
        while(hour < 20) {
            hour++;
            $('select[name=call_date]').append('<option value="Сегодня, в '+hour+':00">Сегодня, в '+hour+':00</option>')
        }
        hour = 8;
        while(hour < 20) {
            hour++;
            $('select[name=call_date]').append('<option value="Завтра, в '+hour+':00">Завтра, в '+hour+':00</option>')
        }
    }
    $('select[name=call_date]').styler();

    $('.loader').hide();
})