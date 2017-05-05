<?php include ROOT . '/views/layout/header.php'; ?>    

                <div id="center-left">
                    <table class="simple-little-table" cellspacing='0'>
			<tr>
                            <th>Фото</th>
			    <th>Имя <br> Фамилия</th>
                            <th>Профессия</th>
                            <th>Зарплата</th>
                            <th>Добавить Зарплату</th>
			</tr>
			<?php foreach ($workers as $worker) : ?>
                            <tr>
                                <td>
                                    <a rel="simplebox" href="<?php echo Ancillary::getImage($worker->workerId); ?>">
                                    <img width="200" height="200" src="<?php echo Ancillary::getImage($worker->workerId); ?>" /></a>
                                </td>
                                <td>
                                    <?php echo $worker->name; ?><br><?php echo $worker->surname; ?>
                                </td>
                                <td>       
                                    <?php if (!empty($worker->profession)): ?>
                                        <?php echo $worker->profession->name_p; ?>
                                    <?php endif; ?>
                                </td>    
                                <td>       
                                    <?php if (!empty($worker->payment)): ?>
                                        <?php if(isset($_SESSION['curency'])):?>
                                            <?php switch ($_SESSION['curency']):
                                                    case 'usd': echo (int)($worker->payment->wage / $usd_curs); break; 
                                                    case 'rub': echo $worker->payment->wage / 1; break;?>                                                          
                                            <?php endswitch;?>
                                        <?php else: echo $worker->payment->wage; ?>                              
                                        <?php endif; ?> 
                                    <?php endif; ?>
                                </td> 
                                <td>
                                    <a href="/payment/<?php echo $worker->workerId;?>">Добавить недостающую зарплату</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
		</div>
		<div id="center-right">
                    <div id="dol">
                        <h3>рубли/доллары</h3>
                        <?php echo $curency; ?>
                    </div>
                    <div id="calendar">
                        <h3>Календарь</h3>
                        <?php echo $calendar;?>
                    </div>
                    <div id="premium">
                        <h3>Выдать премию</h3>
                        <form name="f1" method="post" action="#">
                            <p><label>Профессия</label></p>
                            <p><select name="profession_id" size="1">
                                    <option selected="selected" value="1">бухгалтер</option>
                                    <option value="2">курьер</option>
                                    <option value="3">менеджер</option>
                               </select></p>                               
                            <p><input name="wage"  value="" /></p>
                            <p><input type="submit" name="submit2" value="Выдать премию" /></p>
                        </form>
                    </div>
                    <div id="add-worker">
                        <p><a href="/worker/add">Добавить работника</a></p>
                    </div>
		</div>           
            <div class="clear"></div>
    </div>  
<script type="text/javascript">
(function(){
	var boxes=[],els,i,l;
	if(document.querySelectorAll){
		els=document.querySelectorAll('a[rel=simplebox]');	

		Box.getStyles('simplebox_css','/js/simplebox.css');
		Box.getScripts('simplebox_js','/js/simplebox.js',function(){
				simplebox.init();
				for(i=0,l=els.length;i<l;++i)
					simplebox.start(els[i]);
				simplebox.start('a[rel=simplebox_group]');			
				});
	}
	

})();
</script>
</body>
</html>