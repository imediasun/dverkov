
$(document).ready(function() {


    // Консоль
    var $console = $("#console3");

    // Инфа о выбранных файлах
    var countInfo = $("#info-count");
    var sizeInfo = $("#info-size");

    // ul-список, содержащий миниатюрки выбранных файлов
    var imgList = $('#img-list3');

    // Контейнер, куда можно помещать файлы методом drag and drop
    var dropBox = $('#img-container3');

    // Счетчик всех выбранных файлов и их размера
    var imgCount = 0;
    var imgSize = 0;


    // Стандарный input для файлов
    var fileInput = $('#file-field3');

    // Тестовый canvas
   /*  var canvas = document.getElementById('canvas');
    var ctx = canvas.getContext("2d");
    ctx.fillStyle = "rgb(128,128,128)";
    ctx.fillRect (0, 0, 150, 150);
    ctx.fillStyle = "rgb(200,0,0)";
    ctx.fillRect (10, 10, 55, 50);
    ctx.fillStyle = "rgba(0, 0, 200, 0.5)";
    ctx.fillRect (30, 30, 55, 50); */


    ////////////////////////////////////////////////////////////////////////////
    // Подключаем и настраиваем плагин загрузки

    fileInput.damnUploader({
        // куда отправлять
       url: '/functions_images?get=1', 
        // имитация имени поля с файлом (будет ключом в $_FILES, если используется PHP)
        fieldName:  'my-pic',
        // дополнительно: элемент, на который можно перетащить файлы (либо объект jQuery, либо селектор)
        dropBox: dropBox,
		// максимальное кол-во выбранных файлов (если не указано - без ограничений)
        limit: 1,
        // когда максимальное кол-во достигнуто (вызывается при каждой попытке добавить еще файлы)
        onLimitExceeded: function() {
            log('Допустимое кол-во файлов уже выбрано');
        },
        // ручная обработка события выбора файла (в случае, если выбрано несколько, будет вызвано для каждого)
        // если обработчик возвращает true, файлы добавляются в очередь автоматически
        onSelect: function(file) {
            addFileToQueue(file);
            return false;
        },
        // когда все загружены
        onAllComplete: function() {
            log('<span style="color: blue;">*** Все загрузки завершены! ***</span>');
            imgCount = 0;
            imgSize = 0;
            updateInfo();
			
        }
    });



    ////////////////////////////////////////////////////////////////////////////
    // Вспомогательные функции

    // Вывод в консоль
    function log(str) {
        $('<p/>').html(str).prependTo($console);
    }

    // Вывод инфы о выбранных
    function updateInfo() {
        countInfo.text( (imgCount == 0) ? 'Изображений не выбрано' : ('Изображений выбрано: '+imgCount));
        sizeInfo.text( (imgSize == 0) ? '-' : Math.round(imgSize / 1024));
    }

    // Обновление progress bar'а
    function updateProgress(bar, value) {
        var width = bar.width();
        var bgrValue = -width + (value * (width / 100));
        bar.attr('rel', value).css('background-position', bgrValue+'px center').text(value+'%');
    }

    // преобразование формата dataURI в Blob-данные
    function dataURItoBlob(dataURI) {
        var BlobBuilder = (window.MSBlobBuilder || window.MozBlobBuilder || window.WebKitBlobBuilder || window.BlobBuilder);
        if (!BlobBuilder) {
            return false;
        }
        // convert base64 to raw binary data held in a string
        // doesn't handle URLEncoded DataURIs
        var pieces = dataURI.split(',');
        var byteString = (pieces[0].indexOf('base64') >= 0) ? atob(pieces[1]) : unescape(pieces[1]);
        // separate out the mime component
        var mimeString = pieces[0].split(':')[1].split(';')[0];
        // write the bytes of the string to an ArrayBuffer
        var ab = new ArrayBuffer(byteString.length);
        var ia = new Uint8Array(ab);
        for (var i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }
        // write the ArrayBuffer to a blob, and you're done
        var bb = new BlobBuilder();
        bb.append(ab);
        return bb.getBlob(mimeString);
    }



    // Отображение выбраных файлов, создание миниатюр и ручное добавление в очередь загрузки.
    function addFileToQueue(file) {

        // Создаем элемент li и помещаем в него название, миниатюру и progress bar
        var li = $('<li/>').appendTo(imgList);
        /* var title = $('<div/>').text(file.name+' ').appendTo(li); */
        var cancelButton = $('<a/>').attr({
            href: '#cancel',
            title: 'отменить'
        }).html('<img height="15" width="15" alt="X" src="/img/Very-Basic-Cancel-icon.png">').appendTo(/* title */li);

        // Если браузер поддерживает выбор файлов (иначе передается специальный параметр fake,
        // обозночающий, что переданный параметр на самом деле лишь имитация настоящего File)
        if(!file.fake) {

            // Отсеиваем не картинки
            var imageType = /image.*/;
            if (!file.type.match(imageType)) {
                log('Файл отсеян: `'+file.name+'` (тип '+file.type+')');
                return true;
            }

            // Добавляем картинку и прогрессбар в текущий элемент списка
            var div = $('<div/>').addClass('photo_frame').attr('rel', '0').appendTo(li);
			var img = $('<img/>').appendTo(li);
           /* var pBar = $('<div/>').addClass('progress').attr('rel', '0').text('0%').appendTo(li); */

            // Создаем объект FileReader и по завершении чтения файла, отображаем миниатюру и обновляем
            // инфу обо всех файлах (только в браузерах, подерживающих FileReader)
            if($.support.fileReading) {
                var reader = new FileReader();
                reader.onload = (function(aImg) {
                    return function(e) {
					
                        aImg.attr('src', e.target.result);
                        
						aImg.attr('height', 100);
                    };
                })(img);
                reader.readAsDataURL(file);
            }

            log('Картинка добавлена: `'+file.name + '` (' +Math.round(file.size / 1024) + ' Кб)');
            imgSize += file.size;
        } else {
            log('Файл добавлен: '+file.name);
        }

        imgCount++;
        updateInfo();

        // Создаем объект загрузки
        var uploadItem = {
            file: file,
           /*  onProgress: function(percents) {
                updateProgress(pBar, percents);
            }, */
            onComplete: function(successfully, data, errorCode) {
                if(successfully) {
                    log('Файл `'+this.file.name+'` загружен, полученные данные:<br/>*****<br/>'+data+'<br/>*****');
                } else {
                    if(!this.cancelled) {
                        log('<span style="color: red;">Файл `'+this.file.name+'`: ошибка при загрузке. Код: '+errorCode+'</span>');
                    }
                }
            }
        };

        // ... и помещаем его в очередь
        var queueId = fileInput.damnUploader('addItem', uploadItem);

        // обработчик нажатия ссылки "отмена"
        cancelButton.click(function() {
            fileInput.damnUploader('cancel', queueId);
            li.remove();
            imgCount--;
            imgSize -= file.fake ? 0 : file.size;
            updateInfo();
            log(file.name+' удален из очереди');
            return false;
        });

        return uploadItem;
    }




    ////////////////////////////////////////////////////////////////////////////
    // Обработчики событий


    // Обработка событий drag and drop при перетаскивании файлов на элемент dropBox
    dropBox.bind({
        dragenter: function() {
            $(this).addClass('highlighted');
            return false;
        },
        dragover: function() {
            return false;
        },
        dragleave: function() {
            $(this).removeClass('highlighted');
        return false;
        }
    });


    // Обаботка события нажатия на кнопку "Загрузить все".
    // стартуем все загрузки
    $(".apply_btn").click(function() {
	var acParams = new Array();
	
	var prod_id=$('input[name=prod_id]').val()
	var lwidth=$('input[name=lwidth]').val()
	var lheight=$('input[name=lheight]').val()
	var lproducers=$('input[name=lproducers]').val()
	var ltype=$('input[name=ltype]').val()
	var logo=$('input[name=add_logo]').val()
	if(typeof prod_id!=='undefined') {
	acParams['url']= '/functions_images/'+prod_id+'/'+lwidth+'/'+lheight+'/'+ltype;
	acParams['onAllComplete'] = function() {
            log('<span style="color: blue;">*** Все загрузки завершены! ***</span>');
            imgCount = 0;
            imgSize = 0;
            updateInfo();
			alert('Логотип изменен')
			location.reload();
    }
	}
	else{
	acParams['url']= '/functions_images';
		acParams['onAllComplete'] = function(var1) {
		var ar=JSON.parse(var1)
		
		    log('<span style="color: blue;">*** Все загрузки завершены! ***</span>');
            imgCount = 0;
            imgSize = 0;
            updateInfo();
			alert('Логотип добавлен')
			$('#img_block').append('<img src="'+ar.dir+'/'+ar.file+'">')
			
			
    } 
	}
	
	fileInput.damnUploader('setParam',acParams)
    fileInput.damnUploader('startUpload')
    });


    // Обработка события нажатия на кнопку "Отменить все"
    $("#cancel-all3").click(function() {
        fileInput.damnUploader('cancelAll');
        imgCount = 0;
        imgSize = 0;
        updateInfo();
        log('*** Все загрузки отменены ***');
        imgList.empty();
    });


    // Обработка нажатия на тестовую канву
/*     $(canvas).click(function() {
        var blobData;
        if (canvas.toBlob) {
            // ожидается, что вскоре браузерами будет поддерживаться метод toBlob() для объектов Canvas
            blobData = canvas.toBlob();
        } else {
            // ... а пока - конвертируем вручную из dataURI
            blobData = dataURItoBlob(canvas.toDataURL('image/png'));
        }
        if (blobData === false) {
            log("Ваш браузер не поддерживает BlobBuilder");
            return ;
        }
        addFileToQueue(blobData)
    }); */




    ////////////////////////////////////////////////////////////////////////////
    // Проверка поддержки File API, FormData и FileReader

    if(!$.support.fileSelecting) {
        log('Ваш браузер не поддерживает выбор файлов (загрузка будет осуществлена обычной отправкой формы)');
        $("#dropBox-label").text('если бы ты использовал хороший браузер, файлы можно было бы перетаскивать прямо в область ниже!');
    } else {
        if(!$.support.fileReading) {
            log('* Ваш браузер не умеет читать содержимое файлов (миниатюрки не будут показаны)');
        }
        if(!$.support.uploadControl) {
            log('* Ваш браузер не умеет следить за процессом загрузки (progressbar не работает)');
        }
        if(!$.support.fileSending) {
            log('* Ваш браузер не поддерживает объект FormData (отправка с ручной формировкой запроса)');
        }
        log('Выбор файлов поддерживается');
    }
    log('*** Проверка поддержки ***');


});