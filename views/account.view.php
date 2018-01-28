<div class="header clearfix">
	<div class='name pull-left'>
		<?php

		echo $_SESSION['user_name'];
		?>
	</div>
	<div class='balans pull-right'>Мій поточний баланс:
		<?=
		$data['balans'][0]['balans'];
		?> грн

	</div>
</div>
<h2>Мої рахунки</h2>
<ul class="accounts">
	<?php
	foreach ($data['account'] as $key => $account) {
		?>
		<li><?=$account['uniq_id'] .' ' . $account['description']?></li>
		<?php
	}
	?>
</ul>
<h2>Мої транзакції</h2>
<table style="border-collapse: collapse; margin: 30px 20px">
	<tr style="border-collapse: collapse;">
		<td style="border: solid 1px black; padding: 10px; background-color: #FAEBD7">назва операції</td>
		<td class="arrow_relative" style="border: solid 1px black; padding: 10px; background-color: #FAEBD7">рахунок
		<a href="/account?method=up" class="arrow arrow_up"><span class="glyphicon glyphicon-arrow-up"></span></a>
			<a href="/account?method=down" class="arrow arrow_down"><span class="glyphicon glyphicon-arrow-down"></span></a>
		</td>
		<td style="border: solid 1px black; padding: 10px; background-color: #FAEBD7">категорія</td>
		<td style="border: solid 1px black; padding: 10px; background-color: #FAEBD7">сума</td>
		<td style="border: solid 1px black; padding: 10px; background-color: #FAEBD7">дата</td>
	</tr>
	<?php
	
	foreach ($data['transactions'] as $key => $transaction) {
		?>
		<tr style="border-collapse: collapse">
			<td style="border: solid 1px black; padding: 10px">
				<?=$transaction['description'] ?>
			</td>

			<td style="border: solid 1px black; padding: 10px">
				<?=$transaction['accounts_name'] . $transaction['uniq_id']    ?>

			</td> 
			<td style="border: solid 1px black; padding: 10px">
				<?=$transaction['category_name']?>
			</td>
			<td style="border: solid 1px black; padding: 10px">
				<?=$transaction['price']?>
			</td>
			<td style="border: solid 1px black; padding: 10px">
				<?=$transaction['created_at'] ?>
			</td>
		</tr>
		<?php
	}
	?>
</table>
<div class="forms clearfix">
	<form  method="POST" class="create_account pull-left">
		<input type="text" name="form[description]" placeholder="Новий рахунок" ="">
		<button type="submit" class="button  btn-primary">Додати рахунок</button>
	</form>

	<form method="POST" class="transaction pull-right">
		<input type="text" name="trans[name]" placeholder="Назва транзакції" ="">
		<select name="trans[accounts]" id="">
			<?php
			foreach ($data['account'] as $key => $account) {

				?><option value="<?=$account['account_id']?>"><?=$account['description']?></option>
				<?php
			}
			?>
		</select>
		<select name="trans[categories]" id="">
			<?php
			foreach ($data['category'] as $key => $category) {
				?><option value="<?=$category['id']?>"><?=$category['name']?></option>
				<?php
			}
			?>

		</select>
		<input type="text" name="trans[sum]" placeholder="Сума транзакції" ="">
		<button type="submit" class="button  btn-primary">Додати транзакцію</button>
	</form> 
</div>