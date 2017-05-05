<?php include ROOT . '/views/layout/header.php'; ?>  

        <div id = "center">
            <h3>Добавить сотрудника</h3>
            <?php if(true == $payment AND true == $worker):?>
            <p style ="color:#00ff00;">Сотрудник добавлен!</p>
            <?php endif;?>
            <form name="f1" method="post" action="#" enctype="multipart/form-data">
                <p><label>Имя </label>     <input name="name" required value="" /></p>
                <p><label>Фамилия </label> <input name="surname" required value="" /></p>
                <p><label>Профессия</label></p>
                <p><select name="profession_id" size="1">
                        <option selected="selected" value="1">бухгалтер</option>
                        <option value="2">курьер</option>
                        <option value="3">менеджер</option>
                    </select></p>
                <p><label>Выберите месяц для добавления зарплаты</label></p>
                <p><select name="month" size="1">
                        <option selected="selected" value="1">январь</option>
                        <option value="2">февраль</option>
                        <option value="3">март</option>
                        <option value="4">апрель</option>
                        <option value="5">май</option>
                        <option value="6">июнь</option>
                        <option value="7">июль</option>
                        <option value="8">август</option>
                        <option value="9">сентябрь</option>
                        <option value="10">октябрь</option>
                        <option value="11">ноябрь</option>
                        <option value="12">декабрь</option>
                    </select></p>
                <p><label>Зарплата</label></p>
                <p><input name="wage" required value="" /></p>
                <p><label for="usr">Фото сотрудника:</label></p>
                <p><img id="img-preview" src="http://itask.zzz.com.ua/upload/images/no-image.jpg" /></p>
                <p><input type="file" name="image" multiple accept="image/*" placeholder="" id="img" value=""></input></p>
                <p><input type="submit" name="submit" value="Добавить" /></p>
            </form>
        </div>        
    </div>     
<script>
                     	$('#img').change(function() {       
				var input = $(this)[0];
				if (input.files && input.files[0]) {
					if (input.files[0].type.match('image.*')) {
						var reader = new FileReader();
						reader.onload = function(e) {
							$('#img-preview').attr('src', e.target.result);
						}
						reader.readAsDataURL(input.files[0]);
					} else {
						console.log('ошибка, не изображение');
					}
				} else {
					console.log('хьюстон у нас проблема');
				}
			});
			
			$('#reset-img-preview').click(function() {
				$('#img').val('');
				$('#img-preview').attr('src', 'default-preview.jpg');
			});
			
			$('#form').bind('reset', function() {
				$('#img-preview').attr('src', 'default-preview.jpg');
			});
			
</script>
</body>
</html>

