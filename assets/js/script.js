$(document).ready(function () {
    sal({
        threshold: 0.2,
        once: true,
    });
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 50) {
            $('header').addClass('scrolled');
        } else {
            $('header').removeClass('scrolled');
        }
    });

    const mainCertsBlockSlider = new Swiper('.mainCertsBlockSlider', {
        slidesPerView: 3,
        centeredSlides: true,
        initialSlide: 1,
        effect: 'coverflow',
        coverflowEffect: {
            rotate: 0,
            stretch: -80,
            depth: 200,
            modifier: 1,
            slideShadows: false,
        },
        pagination: {
            el: '.mainCertsBlock .swiper-pagination',
            clickable: true,
        }
    });

    if (window.innerWidth < 700) {
        const reviewsSwiper = new Swiper('.mainCertsBlockSliderMobile', {
            loop: true,
            spaceBetween: 10,
            slidesPerView: 1.2,
            initialSlide: 1,
            pagination: {
                el: '.mainCertsBlock .swiper-pagination',
                clickable: true,
            }
        });
    }

    if (window.innerWidth > 500) {
        const mainPartnersBlock = new Swiper('.block-mainPartnersBlock', {
            slidesPerView: 3.5,
            spaceBetween: 20,
            loop: true,
            centeredSlides: true,
            autoplay: {
                delay: 0,
                disableOnInteraction: false,
            },
            speed: 4000,
        });
    }

    if (window.innerWidth > 500) {
        const reviewsSwiper = new Swiper('.mainReviews-reviews-swiper', {
            loop: true,
            spaceBetween: 20,
            slidesPerView: 2.5,
            navigation: {
                nextEl: '.btn-rigth',
                prevEl: '.btn-left',
            },
            breakpoints: {

                768: {
                    slidesPerView: 2.2,
                },

                1200: {
                    slidesPerView: 2.5,
                }
            }
        });
    }

    const $questions = $('.faqBlock .question');

    $questions.on('click', function () {
        const $this = $(this);
        const isActive = $this.hasClass('active');
        $questions.removeClass('active').each(function () {
            const $btnImg = $(this).find('button img');
            if ($btnImg.length) {
                $btnImg.attr('src', '/clients/proeducation/wp-content/themes/custom_theme/assets/img/Button (1).svg');
            }
            $(this).find('.faq-answer').hide();
        });
        if (!isActive) {
            $this.addClass('active');
            const $activeBtnImg = $this.find('button img');
            if ($activeBtnImg.length) {
                $activeBtnImg.attr('src', '/clients/proeducation/wp-content/themes/custom_theme/assets/img/Button.svg');
            }
            $(this).find('.faq-answer').show();
        }
    });

    Fancybox.bind("[data-fancybox]", {
        Thumbs: {
            type: "modern",
        },
        Toolbar: {
            display: {
                left: ["infobar"],
                middle: [
                    "zoomIn",
                    "zoomOut"
                ],
                right: ["slideshow", "thumbs", "close"],
            },
        },
    });

    $('.mainBannerFormTabItem').click(function () {
        const showBlock = $(this).data('show');
        $('.mainBannerFormTabItem').removeClass('active');
        $(this).addClass('active');
        $('.collegeInfo, .bachelorInfo, .masterInfo').removeClass('active fadeIn');
        $('.' + showBlock).addClass('active fadeIn');
    });

    let searchTimeout;
    let searchInput = $(`
        .mainDirectionsSearchContainer input[name="search"], 
        .mainBannerFormContentSearch input[name="search"]
        `);
    let suggestionsContainer = $('<div class="search-suggestions"></div>');
    searchInput.parent().append(suggestionsContainer);
    function renderSuggestions(data) {
        if (!data.results || data.results.length === 0) {
            suggestionsContainer.empty().hide();
            return;
        }

        let html = '<ul class="suggestions-list">';
        let suggestionsCount = 0;
        let maxSuggestions = 99;

        $.each(data.results, function (areaIndex, area) {
            if (suggestionsCount < maxSuggestions && area.permalink) {
                html += '<li class="suggestion-item suggestion-area">';
                html += '<a href="' + area.permalink + '" class="suggestion-link">';
                html += '<div class="suggestion-content">';
                html += '<span class="suggestion-title">' + area.title + '</span>';
                html += '<span class="suggestion-type">Направление подготовки</span>';
                html += '</div>';
                html += '</a>';
                html += '</li>';
                suggestionsCount++;
            }

            $.each(area.programs, function (progIndex, program) {
                if (suggestionsCount < maxSuggestions) {
                    let programLink = program.permalink || area.permalink;
                    let programTitle = program.direction_title || program.direction_content || 'Программа';

                    html += '<li class="suggestion-item suggestion-program">';
                    html += '<a href="' + programLink + '" class="suggestion-link">';
                    html += '<div class="suggestion-content">';
                    html += '<span class="suggestion-title">' + programTitle + '</span>';
                    html += '<span class="suggestion-area">' + area.title + '</span>';
                    html += '<span class="suggestion-edu-level">' + (program.level_edu || '') + '</span>';
                    html += '</div>';
                    html += '</a>';
                    html += '</li>';
                    suggestionsCount++;
                }
            });
        });

        html += '</ul>';

        if (suggestionsCount > 0) {
            suggestionsContainer.html(html).show();
        } else {
            suggestionsContainer.empty().hide();
        }
    }
    function getSuggestions() {
        let searchQuery = searchInput.val();
        $.ajax({
            url: search_programs_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'search_programs',
                nonce: search_programs_ajax.nonce,
                search_query: searchQuery
            },
            success: function (response) {
                if (response.success) {
                    renderSuggestions(response.data);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX ошибка при получении подсказок:', error);
                suggestionsContainer.empty().hide();
            }
        });
    }
    searchInput.on('input', function () {
        let searchQuery = $(this).val();

        clearTimeout(searchTimeout);

        if (searchQuery.length >= 3) {
            searchTimeout = setTimeout(function () {
                getSuggestions();
            }, 500);
        } else {
            suggestionsContainer.empty().hide();
        }
    });

    $(document).on('click', '.suggestion-link', function (e) {
        e.stopPropagation();
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('.mainDirectionsSearchContainer').length) {
            suggestionsContainer.empty().hide();
        }
    });

    $('.mainDirectionsBlock .mainDirectionsGridItem').each(function () {
        var $item = $(this);
        var levels = [];
        $item.find('.mainDirectionsGridItemEdu:first .mainDirectionsGridItemInfoItem span:last-child').each(function () {
            var text = $(this).text().trim();
            if (text === 'Колледж' || text === 'Бакалавриат' || text === 'Магистратура') {
                levels.push(text);
            }
        });
        if (levels.length > 0) {
            $item.attr('data-levels', levels.join(','));
        }
    });
    $('.mainDirectionsBlock .mainDirectionsSearchTabItem').on('click', function () {
        $('.mainDirectionsGrid').prepend(`<div class="loadingContainer"></div>`);
        $('.mainDirectionsGrid').addClass('loading');

        $('.mainDirectionsSearchTabItem').removeClass('active');
        $(this).addClass('active');
        var selectedType = $(this).data('type');
        var typeMapping = {
            1: 'Колледж',
            2: 'Бакалавриат',
            3: 'Магистратура'
        };
        if (selectedType == 0) {
            $('.mainDirectionsGridItem').show();
            $('.mainDirectionsGridColumn').show();
        } else {
            var selectedLevel = typeMapping[selectedType];
            $('.mainDirectionsGridItem').hide();
            $('.mainDirectionsGridItem').each(function () {
                var $item = $(this);
                var levels = $item.attr('data-levels') || '';

                if (levels.indexOf(selectedLevel) !== -1) {
                    $item.show();
                }
            });
            $('.mainDirectionsGridColumn').each(function () {
                var $column = $(this);
                var hasVisibleItems = $column.find('.mainDirectionsGridItem:visible').length > 0;
                $column.toggle(hasVisibleItems);
            });
        }

        setTimeout(function () {
            $('.loadingContainer').remove();
            $('.mainDirectionsGrid').removeClass('loading');
            $('html, body').animate({
                scrollTop: $('.mainDirectionsGrid').offset().top - 20
            }, 800);
        }, 800);
    });
    function showPopup(classPopup) {
        $('.' + classPopup).fadeIn();
        $('body').css({ 'overflow': 'hidden' });
    }
    function showAnimate(classEl, display = 'block') {
        $('.' + classEl).css({
            'display': display,
            'opacity': 0,
            'transform': 'translateY(-10px)'
        })
            .animate({
                opacity: 1
            }, 200)
            .css('transform', 'translateY(0)');
    };
    function hideAnimate(classEl) {
        $('.' + classEl).animate({
            opacity: 0
        }, 200, function () {
            $(this).css({
                'display': 'none',
                'transform': 'translateY(-10px)'
            });
        });
    };
    $('body').on('click', '.closePopup', function () {
        $(this).closest('.popupContainer').fadeOut();
        $('body').removeAttr('style');
    });
    $('body').on('click', '.btnMainRequest, .btnRequestHeader', function (e) {
        e.stopPropagation();
        showPopup('requestFormPopup');
    });
    $('body').on('click', '.customSelectContainer .customSelect', function (e) {
        e.stopPropagation();
        if ($('.customSelectList').is(':visible')) {
            hideAnimate('customSelectList');
        } else {
            showAnimate('customSelectList', 'flex');
        }
    });
    $('body').on('click', function (e) {
        if ($(e.target).closest('.popupContainer .popup').length === 0 && $('.popupContainer').is(':visible')) {
            $('.popupContainer').fadeOut();
            $('body').removeAttr('style');
        }

        if ($(e.target).closest('.customSelectContainer').length === 0 && $('.customSelectList').is(':visible')) {
            hideAnimate('customSelectList');
        }
    });
    $('.formTabsItem').click(function () {
        $('.formTabsItem').removeClass('active');
        $(this).addClass('active');
    });
    $('.customSelectListItem').click(function () {
        $('.customSelectListItem').removeClass('active');
        $(this).addClass('active');
        $('.customSelectContainer .customSelect .optionSelected').text($(this).text());
        hideAnimate('customSelectList');
    });

    $('.popupForm_submitBtn').click(function () {
        $('.inputError').remove();

        const name = $('.popupContainer .popupForm input[name="name"]');
        const phone = $('.popupContainer .popupForm input[name="phone"]');
        const email = $('.popupContainer .popupForm input[name="email"]');

        let hasErrors = false;

        if (name.val().trim() == '') {
            name.parent().append(`<div class="inputError">Заполните имя</div>`);
            hasErrors = true;
        }

        if (phone.val().trim() == '' || phone.val().length < 11) {
            phone.parent().append(`<div class="inputError">Заполните номер телефона</div>`);
            hasErrors = true;
        }

        const emailValue = email.val().trim();
        if (emailValue == '' || !isValidEmail(emailValue)) {
            email.parent().append(`<div class="inputError">Заполните корректно электронную почту</div>`);
            hasErrors = true;
        }

        if (!hasErrors) {
            sendPopupForm();
        }
    });

    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function sendPopupForm() {
        $('.popupForm_submitBtn').prev().append(`<div class="notifMsg success">Ваша заявку отправлена, мы скоро с вами свяжемся!</div>`);
        setTimeout(function () {
            $('.popupContainer').fadeOut();
            $('body').removeAttr('style');
            $('.notifMsg').remove();
        }, 1000);
    };

    $('.requestBlockForm_btn').click(function () {
        $('.inputError').remove();

        const name = $('.requestBlockForm .formInputContainer input[name="name"]');
        const phone = $('.requestBlockForm .formInputContainer input[name="phone"]');

        let hasErrors = false;

        if (name.val().trim() == '') {
            name.parent().append(`<div class="inputError">Заполните имя</div>`);
            hasErrors = true;
        }

        if (phone.val().trim() == '' || phone.val().length < 11) {
            phone.parent().append(`<div class="inputError">Заполните номер телефона</div>`);
            hasErrors = true;
        }

        if (!hasErrors) {
            sendRequestForm();
        }
    });

    function sendRequestForm() {
        $('.requestBlockForm_btn').prev().append(`<div class="notifMsg success">Ваша заявку отправлена, мы скоро с вами свяжемся!</div>`);
        setTimeout(function () {
            $('.notifMsg').remove();
        }, 1000);
    };

    $('.headerBurgerIcon').click(function(){
        showPopup('headerBurgerMenu');
    });

    $('.headerBurgerMenu_close').click(function(){
        $(this).closest('.headerBurgerMenu').fadeOut();
        $('body').removeAttr('style');
    });
});