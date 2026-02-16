$(document).ready(function () {
    let tabItems = $('.programsBlock .mainDirectionsSearchTabItem');
    let programsList = $('.programsBlockList');

    function renderResults(data) {
        if (!data.results || data.results.length === 0) {
            programsList.html('<div class="no-results">Ничего не найдено</div>');
            return;
        }

        let html = '';

        $.each(data.results, function (index, area) {
            html += '<div class="programsBlockItem">';
            html += '<div class="programsBlockItemTitle">';
            html += '<h2>' + area.title + '</h2>';
            html += '<a href="' + area.permalink + '" class="link border">';
            html += '<span>Подробнее о программе</span>';
            html += '<span>';
            html += '<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">';
            html += '<circle cx="15" cy="15" r="15" fill="#FF644D"></circle>';
            html += '<path d="M10 20L20 10M20 10H10M20 10V20" stroke="white" stroke-width="2" stroke-linecap="round"></path>';
            html += '</svg>';
            html += '</span>';
            html += '</a>';
            html += '</div>';

            let tableClass = 'programsBlockItem_programsTable';
            if (area.is_even) {
                tableClass += ' tableKey_even';
            }

            html += '<div class="' + tableClass + '">';
            html += '<div class="programsBlockItem_programsTableHeader">';
            html += '<div class="col-1">Уровень образования</div>';
            html += '<div class="col-2">';
            html += '<div>Направление подготовки</div>';
            html += '<div>Наименование образовательной программы</div>';
            html += '</div>';
            html += '</div>';

            $.each(area.programs, function (progIndex, program) {
                html += '<div class="programsBlockItem_programItem">';
                html += '<div class="programsBlockItem_programEduLevel">';
                html += '<h3>' + program.level_edu + '</h3>';
                html += '<p>' + program.duration + '</p>';
                html += '</div>';
                html += '<div class="programsBlockItem_direction">';
                html += '<div class="programsBlockItem_directionItem">';
                html += '<div class="programsBlockItem_directionItemTitle">' + program.direction_title + '</div>';
                html += '<div class="programsBlockItem_directionItemContent">' + program.direction_content + '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
            });

            html += '</div>';
            html += '</div>';
        });

        programsList.html(html);
    }

    function performSearch() {
        let activeTab = tabItems.filter('.active').text();
        $.ajax({
            url: search_programs_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'search_programs',
                nonce: search_programs_ajax.nonce,
                active_tab: activeTab
            },
            beforeSend: function () {
                programsList.addClass('loading');
                $('.programsBlockList').css('opacity', '0.6');
            },
            success: function (response) {
                if (response.success) {
                    renderResults(response.data);
                } else {
                    console.error('Ошибка поиска:', response.data);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX ошибка:', error);
                programsList.html('<div class="no-results">Произошла ошибка при поиске</div>');
            },
            complete: function () {
                programsList.removeClass('loading');
                $('.programsBlockList').css('opacity', '1');
            }
        });
    }

    tabItems.on('click', function () {
        tabItems.removeClass('active');
        $(this).addClass('active');
        performSearch();
        $('.search-suggestions').hide();
        $('html, body').animate({
            scrollTop: $('.programsBlockList').offset().top - 20
        }, 800);
    });
});