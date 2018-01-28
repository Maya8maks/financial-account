<?php
if($action=='account'){

	if(isset($_SESSION['user'])){
		$categories= getCategory($db);
		$accounts=getAccounts($db);
		$balans=getBalans($db);
		$id=3;
		$count=getCounts($db, $id);
		var_dump($count);
		exit();

		$transactions=sql($db,"SELECT * , c.name as category_name, a.description as accounts_name, a.uniq_id as uniq_id, t.created_at, 
			t.description as description
			FROM `transactions` t 
			INNER JOIN accounts a ON a.id=t.account_id
			INNER JOIN categories c ON c.id=t.category_id
			INNER JOIN users_accounts ua ON ua.account_id = t.account_id
			INNER JOIN users u ON u.id = ua.user_id
			WHERE u.id = {$_SESSION['user']} ORDER BY t.created_at ASC",
			[],
			'rows'
			);
		
		if(!empty($_POST['form'])){
			$description=	$_POST['form']['description'];
			$uniq_id=uniqid();
			if($description!=''){
			insertAccount($db, $description, $uniq_id);
			$id =$db->lastInsertId();
			insertUserAccount($db, $id);
		}
	}
		if(!empty($_POST['trans'])){
			$name =	$_POST['trans']['name'];
			$account_id = $_POST['trans']['accounts'];
			$category_id =	$_POST['trans']['categories'];
			$sum=$_POST['trans']['sum'];
			if($name!='' && $account_id!='' && $category_id!=''&& $sum!=''){
			insertTransaction( $db, $account_id, $category_id, $sum, $name );
		}
		}
		$method = $_GET['method'] ?? null;
		if($action=='account' && $method=='up'){
			$transactions=sql($db,"SELECT * , c.name as category_name, a.description as accounts_name, a.uniq_id as uniq_id, t.description as description
				FROM `transactions` t 
				INNER JOIN accounts a ON a.id=t.account_id
				INNER JOIN categories c ON c.id=t.category_id
				INNER JOIN users_accounts ua ON ua.account_id = t.account_id
				INNER JOIN users u ON u.id = ua.user_id
				WHERE u.id = {$_SESSION['user']} ORDER BY a.description ASC",
				[],
				'rows'
				);
		}
			if($action=='account' && $method=='down'){
			$transactions=sql($db,"SELECT * , c.name as category_name, a.description as accounts_name, a.uniq_id as uniq_id, t.description as description
				FROM `transactions` t 
				INNER JOIN accounts a ON a.id=t.account_id
				INNER JOIN categories c ON c.id=t.category_id
				INNER JOIN users_accounts ua ON ua.account_id = t.account_id
				INNER JOIN users u ON u.id = ua.user_id
				WHERE u.id ={$_SESSION['user']} ORDER BY a.description DESC",
				[],
				'rows'
				);
		}
	
		view('account',['category'=>$categories, 'account'=>$accounts, 'balans' =>$balans, 'transactions'=>$transactions]);
}
}