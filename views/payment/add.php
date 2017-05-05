<?php include ROOT . '/views/layout/header.php'; ?>  

          <div id = "center">
              <h3>Добавить недостающую зарплату работнику</h3>
              <?php if(true == $payment): ?>
              <p style ="color:#00ff00;">Заработная плата добавлена!</p>
              <?php endif; ?>
              <form name="f1" method="post" action="#">
                  <p><label>Месяц</label> 
                     <select name="month" size="1">
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
                    </select>
                    <input name="wage" required value="" />
                  </p>
                  <p><input type="submit" name="submit" value="Добавить" /></p>
              </form>
          </div>        
      </div>     
</body>
</html>

