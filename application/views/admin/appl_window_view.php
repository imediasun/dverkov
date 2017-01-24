<div id="appl_window">

<div id="close_window" class="del_prod_btn"></div>  
	<div id="add_photo"> 
		<br>
		<h6>Выберите 
		<?=$count_images;
		if($count_images==1){
		echo "фотографию";
		}
		else if($count_images>1 && $count_images<5){
		echo "фотографии";
		}
		else if($count_images>4){
		echo "фотографий";
		}
		?>
		(не более 2М) 
		<?=$image_width?>х<?=$image_height?>px - 
		<?if($image_type=='logo'){
		echo "логотип данного производителя";
		}
		else if($image_type=='door'){
		echo "фотографии выбранной двери";
		}
		else if($image_type=='material' or $image_type=='material_edit'){
		echo "фотографии материала";
		}
		?>
		 </h6>
		<label>Фотография*<span>&nbsp;&nbsp;&nbsp;       Чтобы добавить картинку, нажми обзор или просто перетащи в желтую область ниже &dArr;<hr></span></label>
		<br>
		<input type="file" name="my-pic[]" id="file-field3" class="image" multiple="multiple"/>
		<a id="cancel-all3">Отменить все</a>
		<div id="img-container3">
		<ul id="img-list3"></ul>
		</div>
		<div id="leftpanel">
			<div id="actions">
				<input type="hidden" name="prod_id" value="<?=$image_index?>" >
				<input type="hidden" name="count_images" value="<?=$count_images?>">
				<input type="hidden" name="msg" value="<?=$msg?>">
				<input type="hidden" name="lwidth" value="<?=$image_width?>">
				<input type="hidden" name="lheight" value="<?=$image_height?>">
				<input type="hidden" name="lproducers" value="<?=$upload_dir?>">
				<input type="hidden" name="ltype" value="<?=$image_type?>">
				<span id="info-count">Изображений не выбрано</span><br/>
				Общий размер:<span id="info-size">0</span> Кб<br/><br/>
			</div>
			<div id="console3"></div>
			<div class="apply_btn"></div>
		</div>
	</div>
</div>	

<script>
$('#close_window').click(function(){
$('#window').css('display','none');
$('#appl_window').css('display','none');
}) 
$('.prod_btn').click(function(){
var oper='<?echo $image_index;?>';
var obj =$('#bar_block').find('div');
var name_prod = $('input[name=name_prod]').val()
var type_ar=[];
$.each(obj, function(key,value) {
type_ar.push(value.children[2].value);
})
var inf='';
var ses='';
ses='<?if(isset($_SESSION['logo'])){echo $_SESSION['logo'];}?>';

if(ses!==''){
if(type_ar.length<1){
inf+='\n\r Не выбран ни один тип дверей ';
}
if(!name_prod){
inf+='\n\r Не определено название производителя';
}
if(inf!==''){
alert(inf)
}
else{
 $.ajax({
          type: 'POST',
		  dataType:'json',
          url: '/functions_ajax/save_producer/',
		  data:{oper:oper,name_prod:name_prod,type_ar:type_ar},
          success: function(data){
		  alert('Информация о производителе обновлена в базе данных')
		  location.reload();
          },
          error:  function(xhr, str){
          alert('Возникла ошибка: ' + xhr.responseCode);
        }
        }); 
}
}
else{
alert('Вы не добавили логотип')
}
})

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
        limit: <?echo $count_images?>,
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
        }).html('<img height="15" width="15" alt="X" src="/img/deleteIcon.png">').appendTo(/* title */li);

        // Если браузер поддерживает выбор файлов (иначе передается специальный параметр fake,
        // обозночающий, что переданный параметр на самом деле лишь имитация настоящего File)
        if(!file.fake) {

            // Отсеиваем не картинки
            var imageType = /video.*/;
			var imageType2 = /image.*/;
            if (!file.type.match(imageType) && !file.type.match(imageType2)) {
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
                } else{
                    if(!this.cancelled) {
                    log('<span style="color:red;">Файл `'+this.file.name+'`: ошибка при загрузке. Код: '+errorCode+'</span>');
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
	var upload_dir=$('input[name=lproducers]').val()
	var msg=$('input[name=msg]').val()
	var ltype=$('input[name=ltype]').val()
	acParams['limit']= $('input[name=count_images]').val();
	acParams['url']= '/functions_images/?prod_id='+prod_id+'&lwidth='+lwidth+'&lheight='+lheight+'&upload_dir='+upload_dir+'&ltype='+ltype+'';
 	acParams['onAllComplete'] = function(var1){
	
		    log('<span style="color: blue;">*** Все загрузки завершены! ***</span>');
            imgCount = 0;
            imgSize = 0;
            updateInfo();
			
			var ar=JSON.parse(var1);
			
			if(ar.dir){
			$('#img_block').append('<img width="100%" src="'+ar.dir+'/'+ar.file+'">')
			$('#close_window').click();
			}
			else if(ar.get){
			$('#close_window').click();
			location.href = self.location+'/?width='+ar.width+'&height='+ar.height;
			}
			else if(ar.coll){
			$('#close_window').click();
			location.href = self.location;
			}
			else{
			location.reload();
			}
	} 
	fileInput.damnUploader('setParam',acParams)
    fileInput.damnUploader('startUpload')
	
});


    // Обработка события нажатия на кнопку "Отменить все"
    $("#cancel-all3").click(function(){
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

function print_r(arr, level) {
    var print_red_text = "";
    if(!level) level = 0;
    var level_padding = "";
    for(var j=0; j<level+1; j++) level_padding += "    ";
    if(typeof(arr) == 'object') {
        for(var item in arr) {
            var value = arr[item];
            if(typeof(value) == 'object') {
                print_red_text += level_padding + "'" + item + "' :\n";
                print_red_text += print_r(value,level+1);
		} 
            else 
                print_red_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
        }
    } 
    else  print_red_text = "===>"+arr+"<===("+typeof(arr)+")";
    return print_red_text;
}
</script>