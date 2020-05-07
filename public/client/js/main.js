$(document).on('click', '.nav-link', function () {
    console.log($(this).data('url'));
    let content_block = $('#content_block');
    let type_content = $(this).data('url');
    $.ajax({
        cache: false,
        dataType: 'json',
        processData: false,
        contentType: false,
        data: [],
        type: 'GET',
        url: '/' + type_content
    }).done(function (response) {
        let lists = response.data;
        content_block.empty();
        switch (type_content) {
            case 'sections':
                lists.forEach(function (list) {
                    content_block.append(' <div class="col-md-4">\n' +
                        '        <div class="card flex-md-row mb-4 box-shadow h-md-250">\n' +
                        '        <div class="card-body d-flex flex-column align-items-start">\n' +
                        '        <h3 class="mb-0">\n' +
                        '        <a class="text-dark" href="#">'+ list.name +'</a>\n' +
                        '    </h3>\n' +
                        '    </div>\n' +
                        '    </div>\n' +
                        '    </div>');
                    console.log(list);
                });
                break;
            case 'news':
                lists.forEach(function (list) {
                    content_block.append(' <div class="col-md-4">\n' +
                        '        <div class="card flex-md-row mb-4 box-shadow h-md-250">\n' +
                        '        <div class="card-body d-flex flex-column align-items-start">\n' +
                        '        <h3 class="mb-0">\n' +
                        '        <a class="text-dark" href="#">'+ list.title +'</a>\n' +
                        '    </h3>\n' +
                        '    <p class="card-text mb-auto">'+ list.subtitle +'</p>\n' +
                        '    <a class="show_news">Читать подробнее</a>\n' +
                        '    </div>\n' +
                        '    </div>\n' +
                        '    </div>');
                    console.log(list);
                });
                break;
            case 'authors':
                lists.forEach(function (list) {
                    content_block.append(' <div class="col-md-4">\n' +
                        '    <div class="card flex-md-row mb-4 box-shadow h-md-250">\n' +
                        '            <div class="card-body d-flex flex-column align-items-start">\n' +
                        '            <h3 class="mb-0">\n' +
                        '            <a class="text-dark" href="#">'+ list.name +'</a>\n' +
                        '        </h3>\n' +

                        '        <img class="card-img-right flex-auto d-none d-md-block" data-src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/300px-No_image_available.svg.png" alt="Thumbnail [200x250]" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/300px-No_image_available.svg.png" data-holder-rendered="true" style="width: 200px; height: 200px;">\n' +
                        '            </div>\n' +
                        '        </div>');
                    console.log(list);
                });
                break;
            default:
        }

    }).fail(function () {
    });

});