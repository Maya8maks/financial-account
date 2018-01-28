<?php
function getUser($db, $login, $email, $password){
	$user= sql($db, 'SELECT * FROM `users` WHERE `name`=? AND `email` = ? AND `password` = ? ',[$login, $email, $password],  'rows'); 
	return $user;
}
function getCategory($db){
	$categories= sql( $db, 'SELECT * FROM `categories`', [], 'rows'	);
	return $categories;
}
function getAccounts($db){
	$accounts=sql( $db, 'SELECT * FROM `accounts` a
			LEFT JOIN `users_accounts` ua ON ua.account_id=a.id
			LEFT JOIN `users` u ON u.id=ua.user_id
			WHERE u.id='.$_SESSION['user'],
			[],
			'rows'
			);
	return $accounts;
}


function getBalans($db){
	$balans=sql($db,'SELECT SUM(t.price) as balans FROM `transactions` t 
			INNER JOIN users_accounts ua ON ua.account_id = t.account_id
			INNER JOIN users u ON u.id = ua.user_id
			WHERE u.id = '.$_SESSION['user'],
			[],
			'rows'
			);
	return $balans;
}
function getCounts($db, $id){
	$counts=sql($db,'SELECT * FROM `transactions` t 
			WHERE t.price >'.$id.'LIMIT 1',
			[],
			'rows'
			);
	return $counts;
}
function insertAccount($db, $description, $uniq_id){
	$insertAccount=$db->prepare("INSERT INTO `accounts` (`uniq_id`, `description`) VALUES ( ?, ?) ");
	$insertAccount->execute(array($uniq_id, $description));
	
}
function insertUserAccount($db, $id){
	$insert_user_account=$db->prepare("INSERT INTO `users_accounts` (`user_id`, `account_id`) VALUES ( ?, ?) ");
			$insert_user_account->execute(array($_SESSION['user'], $id));
	
}
function insertTransaction( $db, $account_id, $category_id, $sum, $name ) {
	$insertTransaction=$db->prepare("INSERT INTO `transactions` (`account_id`, `category_id`, `price`, `description`, `created_at`) VALUES ( ?, ?, ?, ?, ?) ");
			$insertTransaction->execute(array($account_id, $category_id, $sum, $name, date('Y-m-d H:i:s')));
  }
