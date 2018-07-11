<?php
require 'lib/libs/Slim/Slim.php';
require 'lib/libs/RedBean/rb.php';
require 'lib/libs/classes/constant.php';
require 'lib/libs/classes/SystemUtils.php';
require 'lib/libs/classes/enconding.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim( array('mode' => 'production', 'templates.path' => 'views', 'debug' => true, 'routes.case_sensitive' => false));
date_default_timezone_set('Africa/Kigali');
try {
	R::setup(DB_SERVER, DB_USER, DB_PASS);
	R::setAutoResolve(true);
	R::freeze(true);
} catch (Exception $e) {
	echo $e -> getMessage() . ' .. ' . $e -> getTraceAsString();
}
session_start();
// init access headers
$app -> response() -> header('Access-Control-Allow-Origin: *');

$app -> response() -> header('Access-Control-Allow-Methods: GET, POST, DELETE');

$app -> response() -> header("Access-Control-Allow-Headers: X-Requested-With");

$app -> response() -> header("Access-Control-Allow-Headers: Content-Type");

//START OF ROUTERS TO RENDER PAGES
$app -> get('/', function() use ($app) {
	if (isset($_SESSION['username'])) {
		$app -> redirect('/admin/member');
	} else {
		$app -> render('login.html');
	}
});
$app -> get('/login', function() use ($app) {
	if (isset($_SESSION['username'])) {
		$app -> redirect('/admin/member');
	} else {
		$app -> render('login.html');
	}
});
$app -> get('/home', function() use ($app) {
	if (isset($_SESSION['member'])) {
		$app -> render('landing.html',array("username" => $_SESSION['member']));
	} else {
		$app -> render('login.html');
	}
});
$app -> get('/admin/member', function() use ($app) {
	if (isset($_SESSION['username'])) {
		$app -> render('membertools.html', array("username" => $_SESSION['username'], "companydate" => SystemUtils::getYearFromDate('2006-01-01 00:00:00')));
	} else {
		$app -> redirect('/login');
	}
});
$app -> get('/admin/communication', function() use ($app) {
	if (isset($_SESSION['username'])) {
		$app -> render('communication.html', array("username" => $_SESSION['username']));
	} else {
		$app -> redirect('/login');
	}
});
$app -> get('/admin/finance', function() use ($app) {
	if (isset($_SESSION['username'])) {
		$app -> render('finance.html', array("username" => $_SESSION['username']));
	} else {
		$app -> redirect('/login');
	}
});
$app -> get('/admin/news', function() use ($app) {
	if (isset($_SESSION['username'])) {
		$app -> render('news.html', array("username" => $_SESSION['username']));
	} else {
		$app -> redirect('/login');
	}
});
$app->get('/members/list/export', function () use ($app) {
    $app->response()->header('Content-Type', 'application/json');
    $app->response()->setBody(json_encode(exportSpreadSheet(), true));
});


//END OF ROUTERS TO RENDER PAGES------------------------------------

//router of post
$app -> post('/register/admin', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(adminsregister($app), true));
});
$app -> post('/registration/member', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(memberRegistration($app), true));
});
$app -> post('/add/member', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(addNewMember($app), true));
});
$app -> post('/add/news', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(addNews($app), true));
});
$app -> post('/add/interset', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(addInterset($app), true));
});
$app -> post('/edit/member', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(editNewMember($app), true));
});
$app -> post('/add/admin/coop', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(addNewAdminCoop($app), true));
});
$app -> post('/login/credentials', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(loginAdmin($app), true));
});
$app -> post('/login/credentials/worker', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(loginWorker($app), true));
});

$app -> post('/register/workers', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(add_workers($app), true));
});
$app -> post('/add/network', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(add_network($app), true));
});
$app -> post('/add/expense', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(addNewExpense($app), true));
});
$app -> post('/add/month/budget', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(addBudget($app), true));
});
$app -> post('/change/income/name', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(updateTheIncomeName($app), true));
});
$app -> post('/chat/message', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(chatting($app), true));
});

$app -> post('/add/marketplace', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(addMarketPlace($app), true));
});

$app -> post('/add/income/child', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(addChildToIncome($app), true));
});

$app -> post('/edit/workers', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(edit_workers($app), true));
});
$app -> post('/admin/image/:email', function($email) use ($app) {
	$app->response()->status(200);
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(uploadImage($email), true));
});
$app -> post('/update/admin/status', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(updateAdminStatus($app), true));
});
$app -> post('/update/member/status', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(updateMemberStatus($app), true));
});
$app -> post('/member/contribution/update', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(updateMemberMonthContribution($app), true));
});
$app -> post('/member/loan/update', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(updateMemberMonthLoan($app), true));
});
$app -> post('/member/send/request', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(memberSentReq($app), true));
});
$app -> post('/add/root/income/name', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(addRootIincome($app), true));
});

//router of delete
$app -> delete('/logout', function() use ($app) {
	try {
		unset($_SESSION['username']);
		session_destroy();
		$app -> deleteCookie('user');
		return true;
	} catch (Exception $e) {
		echo ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return false;
	$app -> render('login.html');

});

// router of getting
$app -> get('/tables/count/contribution', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(selectAllTables(), true));
});
$app -> get('/annualy/finance/:year', function($year) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(getannualyFinance($year), true));
});
$app -> get('/monthly/budget/list/:year/:month', function($year,$month) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(RetrieveBudgetInMonthCorresponded($year,$month), true));
});
$app -> get('/workers/list', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(RetrieveWorkers(), true));
});
$app -> get('/members/list', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(RetrieveMembers(), true));
});
$app -> get('/workers/list/statistics', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(RetrieveWorkersStatistics(), true));
});
$app -> get('/admins/list', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(RetrieveAdmins(), true));
});

$app -> get('/list/networks', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(RetrieveNetworks(), true));
});
$app -> get('/list/news', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(RetrieveNews(), true));
});
$app -> get('/list/networks/:email', function($email) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(RetrieveNetworksByEmail($email), true));
});
$app -> get('/admins/cooperative/list', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(RetrieveAdminsCooperative(), true));
});
$app -> get('/list/message/:id', function($id) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(RetrieveMessageofNetwork($id), true));
});
$app->get('/update/admin/privilege/:userid/:priv', function ($userid, $priv) use ($app) {
    $app->response()->header('Content-Type', 'application/json');
    $app->response()->setBody(json_encode(updateAdminPrivilege($userid, $priv), true));
});
$app -> get('/member/statistics', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(retrieveStatisticsdetail(), true));
});
$app -> get('/user/login/info', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(Retrieveuserlogininfo(), true));
});
$app -> get('/member/login/info', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(RetrieveMemberlogininfo(), true));
});
$app -> get('/set/month/:year/:month/:amount/:deadline', function($year,$month,$amount,$deadline) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(createTableMonthContribution($year,$month,$amount,$deadline), true));
});
$app -> get('/set/month/yearly/:year/:amount', function($year,$amount) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(createTableMonthContributionyearly($year,$amount), true));
});

$app -> get('/member/request/:member_id/:request_id', function($member_id,$request_id) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(selectSingleRequest($member_id,$request_id), true));
});
$app -> get('/assumed/interest/:req_id/:s_dte/:r_amount/:prposed_date/:interest', function($req_id,$s_dte,$r_amount,$prposed_date,$interest) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(assumedInterestAfterSelectDat($req_id,$s_dte,$r_amount,$prposed_date,$interest), true));
});
$app -> get('/member/request/:member_id', function($member_id) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(selectRequestById($member_id), true));
});

$app -> get('/member/history/:memberId', function($memberId) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(contrHistory($memberId), true));
});
$app -> get('/member/historyall/:memberId', function($memberId) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(contrHistoryAll($memberId), true));
});

$app -> get('/active/network/:id', function($id) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(activeNetwork($id), true));
});
$app -> get('/desactive/network/:id', function($id) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(desactiveNetwork($id), true));
});
$app -> get('/disaprouve/request/:id/:res', function($id,$res) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(disaprove($id,$res), true));
});
$app -> get('/reaprove/request/:id', function($id) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(reaprove($id), true));
});
$app -> get('/single/budget/remain/:id', function($id) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(getsingleRemain($id), true));
});
$app -> get('/aprove/request/:id/:capital/:amount/:deadline_admin/:interest', function($id,$capital,$amount,$deadline_admin,$interest) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(aprove($id,$capital,$amount,$deadline_admin,$interest), true));
});
$app -> get('/suspend/request/:id/:res/:dat', function($id,$res,$dat) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(suspend($id,$res,$dat), true));
});
$app -> get('/members/list/contribution/:year/:month', function($year,$month) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(RetrieveMembersInMonthCorresponded($year,$month), true));
});
$app -> get('/members/request/detail', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(RetrieveMembersRequestsDetail(), true));
});
$app -> get('/members/request/list', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(RetrieveMembersRequestsList(), true));
});
$app -> get('/root/income/name', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(RetrieveIncomeList(), true));
});
$app -> get('/root/income/name/having/children', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(RetrieveIncomeListForTabsHavingChildren(), true));
});
$app -> get('/members/approve/detail', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(RetrieveMembersapproveDetail(), true));
});
$app -> get('/members/spended/detail', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(RetrieveMembersspendedDetail(), true));
});
$app -> get('/members/disapprove/detail', function() use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(RetrieveMembersdisapproveDetail(), true));
});
$app -> get('/all/sub/income/:mypop_name', function($pop_income_name) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(popIncomeDetails($pop_income_name), true));
});
$app -> get('/all/sub/income/having/children/:mypop_name', function($pop_income_name) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(subincomeHavingChildren($pop_income_name), true));
});
$app -> get('/increment/budget/:id/:new_budget', function($id,$new_budget) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(incrementBudget($id,$new_budget), true));
});
$app -> get('/decrement/budget/:id/:new_budget', function($id,$new_budget) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(decrementBudget($id,$new_budget), true));
});
$app -> get('/subincome/status/:status/:id/:table_name', function($status,$id,$table_name) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(editSubincomeStatus($status,$id,$table_name), true));
});
$app -> get('/edit/income/name/:id/:table_name', function($id,$table_name) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(editIncomeName($id,$table_name), true));
});
$app -> get('/edit/all/subincome/:table_name/:id/:name/:respo/:phone/:payment/:loc/:descr', function($table_name,$id,$name,$respo,$phone,$payment,$loc,$descr) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(editAllSubincomeDetails($table_name,$id,$name,$respo,$phone,$payment,$loc,$descr), true));
});


$app->get('/criminal/list/export', function () use ($app) {
    $app->response()->header('Content-Type', 'application/json');
    $app->response()->setBody(json_encode(exportSpreadSheet(), true));
});
$app->post('/admin/import/registration', function () use($app) {
    try {
        $app->response()->status(200);
        $app->response()->header('Content-Type', 'application/json');
        $app->response()->setBody(json_encode(importFromExcelSheets('registration'), true));
    } catch (Exception $e) {
        echo 'user', $e->getMessage() . ' trace ' . $e->getTraceAsString();
        $App->response()->setBody(json_encode(array('status' => 'failed', 'data' => 'error caught ' . $e->getMessage() . ' ... trace ' . $e->getTraceAsString()), true));
    }
});
// delete worker
$app -> delete('/delete/worker/:id', function($id) use ($app) {
	$app -> response() -> header('Content-Type', 'application/json');
	$app -> response() -> setBody(json_encode(deleteworker($id), true));
});

$app -> run();

function loginAdmin($app) {
	try {
		$responseData = array('status' => 'failed', 'data' => 'Sorry login failed. Check your credentials or your status.');
		$message = json_decode(Encoding::toUTF8($app -> request -> getBody()), true);
		$Personel = R::findOne("admins", "(email=? || username=?) AND password=? AND status=?", array($message['usr'], $message['usr'], md5($message['pswd']), '1'));
		if ($Personel) {
			$Personel -> lastlogin = date("Y-m-d H:i:s");
			R::store($Personel);
			$user = $Personel -> getProperties();
			unset($Personel);
			$privelige = R::getRow("SELECT id,privilege,profile FROM admins WHERE email=?", array($user['email']));
			$_SESSION['username'] = $user['email'];
			$_SESSION['id'] = $privelige['id'];			
			$_SESSION['authorize'] = $privelige['privilege'];
			$_SESSION['profile'] = $privelige['profile'];
			setcookie("user", $user['email'], time() + (86400 * 30), "/");
			//setcookie("authorize", $privelige['privilege'], time() + (86400 * 30), "/");
			$responseData['status'] = 'success';
			$responseData['data'] = '/admin/member';
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function loginWorker($app) {
	try {
		$responseData = array('status' => 'failed', 'data' => 'Sorry! Check your credentials or wait for your activation.');
		$message = json_decode(Encoding::toUTF8($app -> request -> getBody()), true);
		$Personel = R::findOne("members", "(email=? || username=?) AND password=? AND status=?", array($message['usr'], $message['usr'],md5($message['pswd']), '1'));
		if ($Personel) {
			$Personel -> lastlogin = date("Y-m-d H:i:s");
			R::store($Personel);
			$user = $Personel -> getProperties();
			unset($Personel);
			$_SESSION['member'] = $user['email'];	
			$_SESSION['id'] = $user['id'];		
			$_SESSION['profile'] = $user['profile'];
			setcookie("user", $user['email'], time() + (86400 * 30), "/");
			$responseData['status'] = 'success';
			$responseData['data'] = '/home';
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function adminsregister($app) {
	$responseData = array('status' => 'failed', 'data' => 'Unable to add a new admin', 'id' => '0');
	try {
		$reg_admin = json_decode(Encoding::toUTF8($app -> request -> getBody()), true);
		if (!isset($reg_admin['fname']) || empty($reg_admin['fname']) || strlen($reg_admin['fname']) < 2) {
			$responseData['data'] = 'this first name ' . $reg_admin['fname'] . ' is empty or under 2 characters';
			return $responseData;
		}
		if (!isset($reg_admin['lname']) || empty($reg_admin['lname']) || strlen($reg_admin['lname']) < 2) {
			$responseData['data'] = 'this last name ' . $reg_admin['lname'] . ' is empty or under 2 characters';
			return $responseData;
		}
		if (!isset($reg_admin['fname']) || empty($reg_admin['fname']) || strlen($reg_admin['fname']) < 2) {
			$responseData['data'] = 'the ' . $reg_admin['fname'] . ' is empty or under 2 characters';
			return $responseData;
		}
		if (!isset($reg_admin['email']) || empty($reg_admin['email']) || !filter_var($reg_admin['email'], FILTER_VALIDATE_EMAIL)) {
			$responseData['data'] = 'the email ' . $reg_admin['email'] . ' is wrong';
			return $responseData;
		}
		if (!isset($reg_admin['phone']) || empty($reg_admin['phone']) || strlen($reg_admin['phone']) < 10) {
			$responseData['data'] = 'the phone number ' . $reg_admin['phone'] . ' is wrong';
			return $responseData;
		}
		$user = R::findOne("admins", "email=?", array($reg_admin['email']));
		if ($user) {
			$responseData['data'] = 'Dear ' . $reg_admin['lname'] . ' this ' . $reg_admin['email'] . ' already exists';
			return $responseData;
		}
		$admin = R::dispense('admins');
		$admin -> fname = strtolower(trim($reg_admin['fname']));
		$admin -> lname = trim($reg_admin['lname']);
		$admin -> idnumber = $reg_admin['idnumber'];
		$admin -> status = '0';
		$admin -> email = trim($reg_admin['email']);
		$admin -> sex = trim($reg_admin['sex']);
		$admin -> profile = '../images/user.png';
		$admin -> phone = trim($reg_admin['phone']);
		$admin -> regdate = date("Y-m-d H:i:s");
		$admin -> username = $reg_admin['usernme'];
		$admin -> password = md5($reg_admin['pass']);
		$admin -> privilege = '1';
		$id = R::store($admin);
		if ($id >= 1) {
			$responseData['data'] = 'Dear ' . $reg_admin['lname'] . ' Your account has been setted,Admin will activate you.';
			$responseData['status'] = 'success';
			$responseData['id'] = $id;
		} else {
			$responseData['data'] = 'Some problem occur try again.';
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function memberRegistration($app) {
	$responseData = array('status' => 'failed', 'data' => ' Sorry! Unable for registration by now', 'id' => '0');
	try {
		$reg_member = json_decode(Encoding::toUTF8($app -> request -> getBody()), true);
		if (!isset($reg_member['fname']) || empty($reg_member['fname']) || strlen($reg_member['fname']) < 2) {
			$responseData['data'] = 'this first name ' . $reg_member['fname'] . ' is empty or under 2 characters';
			return $responseData;
		}
		if (!isset($reg_member['lname']) || empty($reg_member['lname']) || strlen($reg_member['lname']) < 2) {
			$responseData['data'] = 'this last name ' . $reg_member['lname'] . ' is empty or under 2 characters';
			return $responseData;
		}
		if (!isset($reg_member['fname']) || empty($reg_member['fname']) || strlen($reg_member['fname']) < 2) {
			$responseData['data'] = 'the ' . $reg_member['fname'] . ' is empty or under 2 characters';
			return $responseData;
		}
		if (!isset($reg_member['email']) || empty($reg_member['email']) || !filter_var($reg_member['email'], FILTER_VALIDATE_EMAIL)) {
			$responseData['data'] = 'the email ' . $reg_admin['email'] . ' is wrong';
			return $responseData;
		}
		if (!isset($reg_member['phone']) || empty($reg_member['phone']) || strlen($reg_member['phone']) < 10) {
			$responseData['data'] = 'the phone number ' . $reg_member['phone'] . ' is wrong';
			return $responseData;
		}
		$user = R::findOne("members", "email=?", array($reg_member['email']));
		if ($user) {
			$responseData['data'] = 'Dear ' . $reg_member['lname'] . ' this ' . $reg_member['email'] . ' already exists';
			return $responseData;
		}
		$memberReg = R::dispense('members');
		$memberReg -> fname = strtolower(trim($reg_member['fname']));
		$memberReg -> lname = trim($reg_member['lname']);
		$memberReg -> email = trim($reg_member['email']);
		$memberReg -> contact = trim($reg_member['phone']);
		$memberReg -> sex = trim($reg_member['sex']);
		$memberReg -> nationalid = $reg_member['id_card'];
		$memberReg -> status = '0';
		$memberReg -> addedby = 12345;
		$memberReg -> nationalid = $reg_member['id_card'];
		$memberReg -> addedon = date("Y-m-d H:i:s");
		$memberReg -> username = $reg_member['usernme'];
		$memberReg -> password = md5($reg_member['pass']);
		$id = R::store($memberReg);
		if ($id >= 1) {
			$responseData['data'] = 'Dear ' . $reg_member['lname'] . ' Your account has been setted,Admin will activate you.';
			$responseData['status'] = 'success';
			$responseData['id'] = $id;
		} else {
			$responseData['data'] = 'Some problem occur try again.';
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function addNewMember($app) {
	$responseData = array('status' => 'failed', 'data' => 'Unable to add a new member');
	try {
		$add_member = json_decode(Encoding::toUTF8($app -> request -> getBody()), true);
		if (!isset($add_member['fname']) || empty($add_member['fname']) || strlen($add_member['fname']) <= 2) {
			$responseData['data'] = 'this first name ' . $add_member['fname'] . ' is empty or under 3 characters';
			return $responseData;
		}
		if (!isset($add_member['lname']) || empty($add_member['lname']) || strlen($add_member['lname']) <= 2) {
			$responseData['data'] = 'this last name ' . $add_member['lname'] . ' is empty or under 3 characters';
			return $responseData;
		}
		if (!isset($add_member['email']) || empty($add_member['email']) || !filter_var($add_member['email'], FILTER_VALIDATE_EMAIL)) {
			$responseData['data'] = 'the email ' . $add_member['email'] . ' is wrong';
			return $responseData;
		}
		if (!isset($add_member['phone']) || empty($add_member['phone']) || strlen($add_member['phone']) < 10) {
			$responseData['data'] = 'the phone number ' . $add_member['phone'] . ' is wrong';
			return $responseData;
		}
		else{
			$add_member['phone'] = SystemUtils::formatPhoneNumber($add_member['phone']);
		}

		$member = R::findOne("members", "contact=?", array($add_member['phone']));
		if ($member) {
			$responseData['data'] = 'Dear ' . $add_member['lname'] . ' this ' . $add_member['phone'] . ' already exists';
			return $responseData;
		}
		$member = R::dispense('members');
		$member -> fname = ucwords(trim($add_member['fname']));
		$member -> lname = ucwords((trim($add_member['lname'])));
		$member -> sex = trim($add_member['sex']);
		$member -> birthday = trim($add_member['birthday']);
		$member -> contact = $add_member['phone'];		
		$member -> email = trim($add_member['email']);
		$member -> postaddress = ucfirst(trim($add_member['location']));
		$member -> nationalid = trim($add_member['ID']);
		$member -> admittedyear = $add_member['admitted_year'];
		$member -> addedby = $_SESSION['id'];
		$member -> addedon = date("Y-m-d H:i:s");
		$member -> status = '1';	
		$member -> username = $add_member['usernme'];
		$member -> password = md5($add_member['pass']);
		$id = R::store($member);
		if ($id >= 1) {
			$responseData['data'] = ' '.$add_member['fname'].' '. $add_member['lname'] . ' has been successfully added';
			$responseData['status'] = 'success';
		} else {
			$responseData['data'] = 'Some problem occur try again.';
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function addNews($app) {
	$responseData = array('status' => 'failed', 'data' => 'Unable to add a new member');
	try {
		$add_news= json_decode(Encoding::toUTF8($app -> request -> getBody()), true);
         $news = R::dispense('news');
		$news -> title = trim($add_news['title']);
		$news -> description = trim($add_news['desc']);
		$news -> publisheddate = date("Y-m-d H:i:s");
		$news -> author = $_SESSION['username'];	
		$id = R::store($news);
		if ($id >= 1) {
			$responseData['data'] = 'News has been successfully added';
			$responseData['status'] = 'success';
		} else {
			$responseData['data'] = 'Some problem occur try again.';
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function addInterset($app) {
	$responseData = array('status' => 'failed', 'data' => 'Unable to set interset');
	try {
		$add_interest= json_decode(Encoding::toUTF8($app -> request -> getBody()), true);
         $inter = R::dispense('interest');
		$inter -> interest = trim($add_interest['interset']);
		$inter -> adddate = date("Y-m-d H:i:s");
		$inter -> adminid = $_SESSION['id'];	
		$id = R::store($inter);
		if ($id >= 1) {
			$responseData['data'] = $add_interest['interset'];
			$responseData['status'] = 'success';
		} else {
			$responseData['data'] = 'Some problem occur try again.';
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function RetrieveMembers() {
	$responseData = array('status' => 'failed', 'data' => "we couldn't retrieve any member");
	try {
		$responseData['data'] = R::getAll("SELECT *, LPAD(id,5,0) AS id_modified,DATE_FORMAT(admittedyear,'%b %D %Y') AS admitted_year,case `status` WHEN '0' THEN 'Inactive' WHEN '1' THEN 'Active' end AS status_name FROM members ORDER BY id ASC");
		 $_SESSION['members_to_put_into_created_table']=$responseData['data'];		
		if (sizeof($responseData['data']) >= 1) {			
			$responseData['status'] = 'success';
		} else {
			$responseData['data'] = 'There are no members at this time.';
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}


function RetrieveMembersInMonthCorresponded($year,$month) {
	$responseData = array('status' => 'failed', 'data' => "we couldn't retrieve any member","sum_total"=>0,"sum_remaining"=>0,"sum_payed"=>0,"member_payed"=>0,"member_not_payed"=>0);
	try {
     $contributiontCount = R::getAll("SELECT table_name from information_schema.tables where table_schema = 'asid_coperative' AND table_name like '%contribution%'");
	  $mytables =array();
	  for($i=0;sizeof($contributiontCount)>$i;$i++){
	  	array_push($mytables,$contributiontCount[$i]['table_name']);
	  }
    $mytable = "contribution". $year ."".$month;

    if(in_array($mytable, $mytables)){	
        R::dispense($mytable);
		$responseData['data'] = R::getAll("SELECT DATE_FORMAT(deadline,'%b %D %Y') AS deadline,remaining,amount,total,month,year,contributorid,DATE_FORMAT(payeddate,'%b %D %Y') AS payeddate,
		(SELECT fname FROM members WHERE id=contributorid)AS firstname,
		(SELECT lname FROM members WHERE id=contributorid)AS lastname,
		(SELECT sex FROM members WHERE id=contributorid)AS sex,
		case `month` WHEN '01' THEN 'January' WHEN '02' THEN 'February' WHEN '03' THEN 'March' WHEN '04' THEN 'April' WHEN '05' THEN 'May'
		WHEN '06' THEN 'June' WHEN '07' THEN 'July' WHEN '08' THEN 'August' WHEN '09' THEN 'September' WHEN '10' THEN 'October'
		WHEN '11' THEN 'November' WHEN '12' THEN 'December' end AS month_name
		FROM contribution". $year ."".$month." ORDER BY id DESC");
		$responseData['sum_total'] = R::getAll("SELECT SUM(total) AS sum_total FROM contribution". $year ."".$month);
		$responseData['sum_remaining'] = R::getAll("SELECT SUM(remaining)AS sum_remaining FROM contribution". $year ."".$month);
		$responseData['sum_payed'] = R::getAll("SELECT SUM(amount)AS sum_payed FROM contribution". $year ."".$month);
	
		for ($i = 0; sizeof($responseData['data']) > $i; $i++) {
			$responseData['data'][$i]['history'] = contrHistoryAll($responseData['data'][$i]['contributorid']);	
					if($responseData['data'][$i]['remaining'] == $responseData['data'][$i]['total'] && $responseData['data'][$i]['amount'] == 0){
			     	$responseData['data'][$i]['status'] = '0';
					}else if($responseData['data'][$i]['remaining'] == 0){
						$responseData['data'][$i]['status'] = '2';
					}else{
						$responseData['data'][$i]['status'] = '1';
					}		
          }
			if (sizeof($responseData['data']) >= 1) {			
				$responseData['status'] = 'success';
			} else {
				$responseData['data'] = array();
			}

	}else{
		$responseData['data'] = 'There is no setted contribution for this period.';
	}
		return $responseData;
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
} 

function updateCapital($amount){
	  $add_capital = R::dispense('capital');
			$new_capital = intval(R::getCell("SELECT capitalamount FROM capital ORDER BY id DESC LIMIT 1"))+$amount;
            $add_capital -> capitalamount = $new_capital;
		    $add_capital -> amout = $amount;
			 $add_capital -> adminid = $_SESSION['id'];
			 $add_capital -> adddate = date("Y-m-d H:i:s");		
		    $idcapital = R::store($add_capital);
			return $idcapital;
}

function updateMemberMonthContribution($app) {
	$responseData = array('status' => 'failed', 'data' => "Sorry, This Contribution could not be updated by now");
	try {
		$member = json_decode(Encoding::toUTF8($app -> request -> getBody()), true);
		$member_to_update_contr = R::findOne("contribution".$member['year'].$member['month'], "contributorid=?", array($member['member_id']));		
		if ($member_to_update_contr) {
			if($member['amount']>$member_to_update_contr['remaining']){
				$responseData['data'] = 'The amount is greater than the remaining!';	
				return $responseData;
			}
			$amount_serial =0;	
			$new_amount =$member['amount'];		
			if(!empty($member_to_update_contr['serializationdata'])){
			$myserial = unserialize($member_to_update_contr['serializationdata']);
			foreach ($myserial as $serial) {
				$arrayofserial=(explode(",",$serial));
				$amount_serial+=$arrayofserial[1];
              }
			}else{
				$myserial = array();				
			}
			array_push($myserial,$_SESSION['username'].",".$new_amount.",".date("Y-m-d H:i:s"));
			$myserial = serialize($myserial);
			$member_to_update_contr -> serializationdata = $myserial;
			$member_to_update_contr -> amount = $new_amount+$amount_serial;
			$member_to_update_contr -> remaining = $member_to_update_contr['total']-($new_amount+$amount_serial);
			$member_to_update_contr -> payeddate = date("Y-m-d H:i:s");
			$id = R::store($member_to_update_contr);            
             $capital_id = updateCapital($new_amount);
          if ($id = 1 &&  $capital_id = 1) {
				$responseData['status'] = 'success';
				$responseData['data'] = ' The contribution is well updated!';	
			} else {
				$responseData['data'] = 'Some problem occur try again.';
			}
		} else {
			$responseData;
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
} 

function editNewMember($app) {
	$responseData = array('status' => 'failed', 'data' => 'Unable to edit this Member' . PHP_EOL);
	try {
		$member = json_decode(Encoding::toUTF8($app -> request -> getBody()), true);
		$edit_member = R::findOne("members", "id=?", array($member['id']));
		if ($edit_member) {			
			$edit_member -> fname = ucwords(trim($member['f_name']));
			$edit_member -> lname = ucwords(trim($member['l_name']));
			$edit_member -> email = $member['email'];
			$edit_member -> contact = $member['phone'];
			$edit_member -> sex = $member['sex'];
			$edit_member -> birthday = $member['birthday'];
			$edit_member -> nationalid = $member['idcard'];
			$edit_member -> postaddress = $member['location'];
			$edit_member -> admittedyear = $member['admitted_year'];
			$edit_member -> username = $member['username'];
			$edit_member -> password = $member['passwd'];
			$id = R::store($edit_member);
			if ($id >= 1) {
				$responseData['data'] = ' The member ' . $member['f_name'] . ' is well updated!';
				$responseData['status'] = 'success';
			} else {
				$responseData['data'] = 'Some problem occur try again.';
			}
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function activeNetwork($id){
	$responseData = array('status' => 'failed', 'data' => 'Unable to updated status' . PHP_EOL);
	try {
		$edit_request = R::findOne("network", "id=?", array($id));
		if ($edit_request) {	
			$edit_request -> status = '1';
			$id = R::store($edit_request);
			if ($id >= 1) {
				$responseData['data'] = ' Network  is activated know!';
				$responseData['status'] = 'success';
			} else {
				$responseData['data'] = 'Some problem occur try again.';
			}
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function desactiveNetwork($id){
	$responseData = array('status' => 'failed', 'data' => 'Unable to updated status' . PHP_EOL);
	try {
		$edit_request = R::findOne("network", "id=?", array($id));
		if ($edit_request) {	
			$edit_request -> status = '0';
			$id = R::store($edit_request);
			if ($id >= 1) {
				$responseData['data'] = ' Network  is desactivated know!';
				$responseData['status'] = 'success';
			} else {
				$responseData['data'] = 'Some problem occur try again.';
			}
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function suspend($id,$res,$dat){
	$responseData = array('status' => 'failed', 'data' => 'Unable to updated status' . PHP_EOL);
	try {
		$edit_request = R::findOne("membersrequest", "id=?", array($id));
		if ($edit_request) {	
			$edit_request -> status = 's';
			$edit_request -> comment = $res;
			$edit_request -> dealine = $dat;
			$id = R::store($edit_request);
			if ($id >= 1) {
				$responseData['data'] = ' Request  is well changed status!';
				$responseData['status'] = 'success';
			} else {
				$responseData['data'] = 'Some problem occur try again.';
			}
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function disaprove($id,$reason){
	$responseData = array('status' => 'failed', 'data' => 'Unable to updated status' . PHP_EOL);
	try {
		$edit_request = R::findOne("membersrequest", "id=?", array($id));
		if ($edit_request) {	
			$edit_request -> status = 'd';
			$edit_request -> comment = $reason;
			$id = R::store($edit_request);
			if ($id >= 1) {
				$responseData['data'] = ' Request  is well changed status!';
				$responseData['status'] = 'success';
			} else {
				$responseData['data'] = 'Some problem occur try again.';
			}
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}
function reaprove($id){
	$responseData = array('status' => 'failed', 'data' => 'Unable to updated status' . PHP_EOL);
	try {
		$edit_request = R::findOne("membersrequest", "id=?", array($id));
		if ($edit_request) {	
			$edit_request -> status = 'r';
			$id = R::store($edit_request);
			if ($id >= 1) {
				$responseData['data'] = ' Request  is well changed status!';
				$responseData['status'] = 'success';
			} else {
				$responseData['data'] = 'Some problem occur try again.';
			}
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function getsingleRemain($id){
	$responseData = array('status' => 'failed', 'data' => 'Unable to retrieve remaining' . PHP_EOL);
	try {
		$get_request = R::getRow("SELECT budgetremaining FROM budget WHERE id=?",array($id));

			if (sizeof($get_request) >= 1) {
				$responseData['data'] = $get_request['budgetremaining'];
				$responseData['status'] = 'success';
			} else {
				$responseData['data'] = 'Some problem occur try again.';
			}
	
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function decrementBudget($id,$new_budget){	
		$responseData = array('status' => 'failed', 'data' => 'Sorry, Unable to update the specified budget','new_budg_total'=>0);
	try{
       $edit_budget = R::findOne("budget","id=?", array($id));

		if($new_budget >  $edit_budget['budgetamount']){
				$responseData['data'] = 'Sorry, You can\'t decreament on budget because this amount is greater than the total budget';
				return $responseData;
			}
		if($new_budget>$edit_budget['budgetremaining'] ){
				$responseData['data'] = 'Sorry, You can\'t decreament on budget because this amount is greater than the total expense amount';
				return $responseData;
			}
		
		$updated_budget = $edit_budget['budgetamount']-$new_budget;
		$updated_budget_remain = $edit_budget['budgetremaining']-$new_budget;
		$capital_id = updateCapital($new_budget);				
		$edit_budget -> budgetamount = $updated_budget;		
		$edit_budget -> budgetremaining = $updated_budget_remain;

		$id = R::store($edit_budget);
		if ($id >= 1 && $capital_id >=1) {
			$responseData['data'] = 'Budget is well updated';
			$responseData['new_budg_total'] = $updated_budget;
			$responseData['status'] = 'success';
		} else {
			$responseData['data'] = 'Some problem occur try again.';
		}
		 
	    return $responseData;
	}catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}
function incrementBudget($id,$new_budget){	
		$responseData = array('status' => 'failed', 'data' => 'Sorry, Unable to find sub income','new_budg_total'=>0);
	try{
       $edit_budget = R::findOne("budget","id=?", array($id));

		if($new_budget >  getCapital()){
				$responseData['data'] = 'Sorry, there are no enough money in our account. Try another amount less than the previous.';
				return $responseData;
			}
		$updated_budget = $edit_budget['budgetamount']+$new_budget;	
		$updated_budget_remain = $edit_budget['budgetremaining']+$new_budget;
		$capital_id = updateCapital(-$new_budget);		
		$edit_budget -> budgetamount = $updated_budget;	
		$edit_budget -> budgetremaining = $updated_budget_remain;	

		$id = R::store($edit_budget);
		if ($id >= 1 && $capital_id >=1) {
			$responseData['status'] = 'success';
			$responseData['data'] = 'Budget is well updated';
			$responseData['new_budg_total'] = $updated_budget;
			
		} else {
			$responseData['data'] = 'Some problem occur try again.';
		}
		 
	    return $responseData;
	}catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function updateTheIncomeName($app){
	$responseData = array('status' => 'failed', 'data' => 'Can not update now.Try again' . PHP_EOL);
	try {
		$result = json_decode(Encoding::toUTF8($app -> request -> getBody()), true);
		$get_request = R::getRow("SELECT * FROM incomes WHERE id=?", "id=?",array($result['inc_id']));
				
			if ($get_request) {			
				$edit_request -> name = $result['inc_name'];
				$id = R::store($edit_request);
			
				if ($id >= 1) {
				$responseData['data'] = 'welldone ';
				$responseData['status'] = 'success';
			} else {
				$responseData['data'] = 'Some problem occur try again.';
			}
			}	
			
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}


function aprove($id,$capital,$amount,$deadline_admin,$interest){
	$responseData = array('status' => 'failed', 'data' => 'Unable to updated status' . PHP_EOL);
	try {		
		$edit_request = R::findOne("membersrequest", "id=?", array($id));
		if ($edit_request) {
			if($amount>$capital){
				$responseData['data'] = "Sorry,Not enough money in our account.";
				return $responseData;
			}			
			$submissionDate = time(); 
			$Deadline = strtotime($deadline_admin);
			$datediff = $Deadline - $submissionDate;
			$interest_duration = floor($datediff / (60 * 60 * 24));
			$interest_calculated = (($amount*$interest)/(100*30))*$interest_duration;			
			$total_to_pay_back = ($amount+$interest_calculated);							
			$capital_id = updateCapital(-$amount);
			
			// $to_pay_each_month_serial =0;
			// if(!empty($edit_request['serializeddata'])){
			// $myserial = unserialize($edit_request['serializeddata']);
			// foreach ($myserial as $serial) {
				// $arrayofserial=(explode(",",$serial));
				// $to_pay_each_month_serial+=$arrayofserial[1];
              // }
			// }else{
				// $myserial = array();
			// }
			// array_push($myserial,$_SESSION['username'].",".$to_pay_each_month.",".date("Y-m-d H:i:s"));
			// $myserial = serialize($myserial);
			
			
			$edit_request -> status = 'a';
			$edit_request -> interest_percent = $interest;
			$edit_request -> submissiondate = date("Y-m-d H:i:s");
			$edit_request -> dealine = $deadline_admin;
			$edit_request -> interest = $interest_calculated;  
			$edit_request -> totaltopayback = $total_to_pay_back;
			$edit_request -> remaining = $total_to_pay_back;  
			
			$id = R::store($edit_request);
			if ($id >= 1 && $capital_id >= 1) {
				$responseData['data'] = ' Request  is well approved please make sure to payBack before '.$deadline_admin;
				$responseData['status'] = 'success';
			} else {
				$responseData['data'] = 'Some problem occur try again.';
			}
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}


function updateMemberMonthLoan($app) {
	$responseData = array('status' => 'failed', 'data' => "Sorry, This Loan could not be updated by now");
	try {
		$loan_member = json_decode(Encoding::toUTF8($app -> request -> getBody()), true);
		$loan_to_update = R::findOne("membersrequest", "id=?", array($loan_member['loan_id']));		
		if ($loan_to_update) {
			if($loan_member['loan_settlement']>$loan_to_update['totaltopayback']){
				$responseData['data'] = 'The submitted settlement is greater than the setted one!';	
				return $responseData;
			}
			$settlement_serial =0;	
			$new_settlement =$loan_member['loan_settlement'];		
			if(!empty($loan_to_update['serializeddata'])){
			$myserial = unserialize($loan_to_update['serializeddata']);
			foreach ($myserial as $serial) {
				$arrayofserial=(explode(",",$serial));
				$settlement_serial+=$arrayofserial[1];
              }
			}else{
				$myserial = array();				
			}			
			array_push($myserial,$_SESSION['username'].",".$new_settlement.",".date("Y-m-d H:i:s"));
			$myserial = serialize($myserial);
			$loan_to_update -> serializeddata = $myserial;
			$loan_to_update -> totalpayednow = $new_settlement+$settlement_serial;
			$loan_to_update -> remaining = $loan_to_update['totaltopayback']-($new_settlement+$settlement_serial);			
			$id = R::store($loan_to_update);            
             $capital_id = updateCapital($new_settlement);
          if ($id = 1 &&  $capital_id = 1) {
				$responseData['status'] = 'success';
				$responseData['data'] = ' The loan settlement is well updated!';	
			} else {
				$responseData['data'] = 'Some problem occur try again.';
			}
		} else {
			$responseData;
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
} 


function addRootIincome($app){
	$responseData = array('status' => 'failed', 'data' => 'Unable to add Income' . PHP_EOL);	
	try {
		$income = json_decode(Encoding::toUTF8($app -> request -> getBody()), true);
		$inc = R::dispense('incomes');
		$inc -> name = trim($income['income_name']);
		$inc -> numberof = 0;		
		$inc -> addedon = date("Y-m-d H:i:s");
		$inc -> addedby = $_SESSION['id'];
		R::exec("CREATE TABLE IF NOT EXISTS `" .$income['income_name']. "` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `name` varchar(25) NOT NULL,
		  `responsable` varchar(25) NOT NULL,
		  `phone` varchar(25) NOT NULL,
		  `type` int(11) NOT NULL,
		  `payment` int(11) NOT NULL,
		  `location` varchar(25) NOT NULL,
		  `description` text NOT NULL,
		  `status` int(11) NOT NULL,
		  `serialdata` longtext NOT NULL,
		  `addon` DATETIME NOT NULL,
		   `addby` int(11) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
			$id = R::store($inc);
		if ($id >= 1) {
			$responseData['data'] = ' The Income is successfully added!';
			$responseData['status'] = 'success';
		} else {
			$responseData['data'] = 'Some problem, occur try again.';
		}
	
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function addChildToIncome($app){
	$responseData = array('status' => 'failed', 'data' => 'Unable to add a new sub-income', 'counted'=>0 . PHP_EOL);
	try {
		$child_income = json_decode(Encoding::toUTF8($app -> request -> getBody()), true);	
		$single_income_child = R::findOne($child_income['income_master'], "name=?", array($child_income['income_name']));
		if ($single_income_child) {
			$responseData['data'] = ' This sub-income with name: "' . $child_income['income_name'] . '" already exists';
			return $responseData;
		}
		$add_child = R::dispense($child_income['income_master']);
		$add_child -> name = $child_income['income_name'];
		$add_child -> responsable = $child_income['income_responsible'];
		$add_child -> phone = $child_income['income_responsible_phone'];
		$add_child -> type = $child_income['income_type']; 
		$add_child -> location = $child_income['income_location'];
		$add_child -> description = $child_income['income_description'];
		$add_child -> payment = $child_income['income_payment'];
		$add_child -> status = 0;
		$add_child -> addon = date("Y-m-d H:i:s");
		$add_child -> addby = $_SESSION['id'];

		$id = R::store($add_child);		
			$number = R::getRow("SELECT count(id)AS numberofff FROM ".$child_income['income_master']);			
			$inc = R::findOne("incomes","name=?", array($child_income['income_master']));					
			if($inc){
				$inc -> numberof = intval($number['numberofff']);
				$id_updatenumber = R::store($inc);
			}
			
		if ($id >= 1 && $id_updatenumber>=1) {
	
			$responseData['data'] = ' The sub income is successfully added!';
			$responseData['status'] = 'success';
		} else {
			$responseData['data'] = 'Some problem occur try again.';
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function editSubincomeStatus($status,$id,$table_name){
	$responseData = array('status' => 'failed', 'data' => 'Unable to updated status' . PHP_EOL);
	try {
		$edit_request = R::findOne($table_name, "id=?", array($id));
		if ($edit_request) {
			if (intval($status) == 0) {
				$edit_request -> status = 1;
			} else {
				$edit_request -> status = 0;
			}
			$id = R::store($edit_request);
			if ($id >= 1) {
				$responseData['data'] = ' The Status is well updated!';
				$responseData['status'] = 'success';
			} else {
				$responseData['data'] = 'Some problem occur try again.';
			}
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}


function editAllSubincomeDetails($table_name,$id,$name,$respo,$phone,$payment,$loc,$descr){
	$responseData = array('status' => 'failed', 'data' => 'Unable to updated ' . PHP_EOL);
	try {
		$edit_request = R::findOne($table_name, "id=?", array($id));
		if ($edit_request) {						
				$edit_request -> name = $name;
				$edit_request -> responsable = $respo;
				$edit_request -> phone = $phone;
				$edit_request -> payment = $payment;
				$edit_request -> location = $loc;
				$edit_request -> description = $descr;
				
			$id = R::store($edit_request);
			
			if ($id >= 1) {
				$responseData['data'] = ' The income name is well updated!';
				$responseData['status'] = 'success';
			} else {
				$responseData['data'] = 'Some problem occur try again.';
			}
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function editTableSubincomeName($name_of_table,$new_name_of_table){
	$new_name_of_table = "RENAME TABLE `" . $name_of_table . "` TO `" . $new_name_of_table . "`" ;
	return $new_name_of_table;
}

function addNewAdminCoop($app) {
	$responseData = array('status' => 'failed', 'data' => 'Unable to add a new administrator' . PHP_EOL);
	try {
		$admin_coop = json_decode(Encoding::toUTF8($app -> request -> getBody()), true);

		$user = R::findOne("admins", "email=?", array($admin_coop['email']));
		if ($user) {
			$responseData['data'] = ' The admin with such national id: "' . $admin_coop['id_card'] . '" already exists';
			return $responseData;
		}
		$add_admin = R::dispense('admins');
		$add_admin -> fname = $admin_coop['fname'];
		$add_admin -> lname = $admin_coop['lname'];
		$add_admin -> username = $admin_coop['username'];
		$add_admin -> password = md5($admin_coop['pswd']); 
		$add_admin -> idnumber = $admin_coop['idnumber'];
		$add_admin -> email = $admin_coop['email'];
		$add_admin -> phone = $admin_coop['phone'];
		$add_admin -> sex = $admin_coop['sex'];
		$add_admin -> regdate = date("Y-m-d H:i:s");
		$add_admin -> status = '0';
		$add_admin -> idnumber = $admin_coop['birthday'];
		$add_admin -> privilege = '1';
		$add_admin -> address = $admin_coop['address'];
		$add_admin -> position = $admin_coop['position'];

		$id = R::store($add_admin);
		if ($id >= 1) {
			$responseData['data'] = ' The administrator ' . $admin_coop['fname'] . ' is successfully added!';
			$responseData['status'] = 'success';
		} else {
			$responseData['data'] = 'Some problem occur try again.';
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function RetrieveMessageofNetwork($id) {
	$messsages = array('status' => 'failed', 'data' => "we couldn't retrieve any message");
	try {
		$messsages['data'] = R::getAll("SELECT * FROM messages WHERE network_id=?",array($id));
		for ($i = 0; sizeof($messsages['data']) > $i; $i++) {
			if ($messsages['data'][$i]['messagedate'] != null) {
				$messsages['data'][$i]['messagedate'] = SystemUtils::nicetime($messsages['data'][$i]['messagedate']);
			}
			if(R::findOne("admins", "email=?", array($messsages['data'][$i]['author']))==true){
				$messsages['data'][$i]['names']=selectfname($messsages['data'][$i]['author'],'admins').' '.selectlname($messsages['data'][$i]['author'],'admins');
			     $messsages['data'][$i]['profiles']= selectprofile($messsages['data'][$i]['author'],'admins');
			}else{
				$messsages['data'][$i]['names']=selectfname($messsages['data'][$i]['author'],'members').' '.selectlname($messsages['data'][$i]['author'],'members');
			$messsages['data'][$i]['profiles']= selectprofile($messsages['data'][$i]['author'],'members');
			}
		}
		if (sizeof($messsages['data']) >= 1) {
			$messsages['status'] = 'success';
		} else {
			$messsages['data'] = array();
		}
	} catch (Exception $e) {
		$messsages['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $messsages;
}

function RetrieveAdminsCooperative(){
		$admins = array('status' => 'failed', 'data' => "we couldn't retrieve messages");
	try {
		$admins['data'] = R::getAll("SELECT LPAD(id,5,0) AS id_modified,id,fname,lname,phone,email,case `status` WHEN '0' THEN 'Inactive' WHEN '1' THEN 'Active' end AS status_name,status,case `privilege` WHEN '1' THEN 'Manager' WHEN '2' THEN 'Admin' end AS privilege_name,privilege,DATE_FORMAT(regdate,'%b %D %Y  at %h:%i %p') AS registrationDate,lastlogin FROM admins ORDER BY id ASC");
		for ($i = 0; sizeof($admins['data']) > $i; $i++) {
			if ($admins['data'][$i]['lastlogin'] == null) {
				$admins['data'][$i]['last_login'] = "Never";
			}
			if ($admins['data'][$i]['lastlogin'] != null) {
				$admins['data'][$i]['last_login'] = SystemUtils::nicetime($admins['data'][$i]['lastlogin']);
			}
		}
		if (sizeof($admins['data']) >= 1) {
			$admins['status'] = 'success';
		} else {
			$admins['data'] = 'There are no registered administrator at this time.';
		}
	} catch (Exception $e) {
		$admins['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $admins;
}

function RetrieveNetworks() {
	$networks = array('status' => 'failed', 'data' => "we couldn't retrieve networks");
	try {
		$networks['data'] = R::getAll("SELECT *,DATE_FORMAT(creationdate,'%b %D %Y') AS creationdate,(SELECT fname FROM admins WHERE id=creator) AS creatorfname,(SELECT lname FROM admins WHERE id=creator) AS creatorlname FROM network");
		for ($i = 0; sizeof($networks['data']) > $i; $i++) {
			$networks['data'][$i]['serialdata']= unserialize($networks['data'][$i]['serialdata']);
			$networks['data'][$i]['count'] =sizeof($networks['data'][$i]['serialdata']);
			for($y = 0; sizeof($networks['data'][$i]['serialdata'])> $y;$y++){
	            $networks['data'][$i]['names'][$y] = selectfname($networks['data'][$i]['serialdata'][$y],'members').' '.selectlname($networks['data'][$i]['serialdata'][$y],'members');
	            $networks['data'][$i]['profiles'][$y] = selectprofile($networks['data'][$i]['serialdata'][$y],'members');
			}	  
		}
		if (sizeof($networks['data']) >= 1) {
			$networks['status'] = 'success';
		} else {
			$networks['data'] = array();
		}
	} catch (Exception $e) {
		$networks['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $networks;
}

function RetrieveNews() {
	$networks = array('status' => 'failed', 'data' => "we couldn't retrieve news");
	try {
		$networks['data'] = R::getRow("SELECT *,DATE_FORMAT(publisheddate,'%b %D %Y') AS publisheddate FROM news");
		if (sizeof($networks['data']) >= 1) {
			$networks['status'] = 'success';
		} else {
			$networks['data'] = array();
		}
	} catch (Exception $e) {
		$networks['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $networks;
}

function RetrieveNetworksByEmail($email) {
	$net['data'] = array();
	try {
		$networks['data'] = R::getAll("SELECT *,DATE_FORMAT(creationdate,'%b %D %Y') AS creationdate FROM network");
		for ($i = 0; sizeof($networks['data']) > $i; $i++) {
			$allemails = unserialize($networks['data'][$i]['serialdata']);			
			if(array_search($email,$allemails)){				
				array_push($net['data'],$networks['data'][$i]);			
				for($x = 0; sizeof($net['data']) > $x; $x++){
			$emailsafter = 	unserialize($net['data'][$x]['serialdata']);    
			for($z = 0; sizeof($emailsafter)> $z;$z++){
	            $net['data'][$x]['names'][$z] = selectfname($emailsafter[$z],'members').' '.selectlname($emailsafter[$z],'members');
	            $net['data'][$x]['profiles'][$z] = selectprofile($emailsafter[$z],'members');
			    }
		      }
			} 
        }
		if (sizeof($net['data']) >= 1) {
			$net['status'] = 'success';
		} else {
			$net['data'] = array();
		}
	} catch (Exception $e) {
		$net['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $net;
}

function selectfname($email,$table){
	return R::getCell("SELECT fname FROM ".$table." WHERE email=?",array($email));
}

function selectlname($email,$table){
	return R::getCell("SELECT lname FROM ".$table." WHERE email=?",array($email));
}

function selectprofile($email,$table){
	return R::getCell("SELECT profile FROM ".$table." WHERE email=?",array($email));
}

function getCapital(){		
	if(R::count("capital")>=1){
		$CopCapital= R::getCell("SELECT capitalamount FROM capital ORDER BY id DESC LIMIT 1");
	}else{
		$CopCapital = 0;
	}
	return $CopCapital;
}
function getInterset(){		
	if(R::count("interest")>=1){
		$requestInterset= R::getCell("SELECT interest FROM interest ORDER BY id DESC LIMIT 1");
	}else{
		$requestInterset = 0;
	}
	return $requestInterset;
}

function selectAllTables(){
	$responseData = array('status' => 'failed', 'startingDate' => 'Not available','amountTotalCop' => 0,'DurationCop' => 'Not available','cooperativeCapital'=>0,'cooperativeRequestInterset'=>0);
	try{
       $contributiontCount = R::getAll("SELECT table_name from information_schema.tables where table_schema = 'asid_coperative' AND table_name like '%contribution%'");
	  $sumTotalContribution = 0;
	  $mytables =array();
	  for($i=0;sizeof($contributiontCount)>$i;$i++){
	  	array_push($mytables,$contributiontCount[$i]['table_name']);
	  }
	    for($y=0;sizeof($mytables)>$y;$y++){
	    	$totals[$y] = R::getCell("SELECT SUM(amount)AS totalTable FROM ".$mytables[$y]);
	  	$sumTotalContribution+=$totals[$y];
	  }
	  if(sizeof($mytables)>1){
	  	$responseData['status']='success';
	    $responseData['amountTotalCop']= $sumTotalContribution;
	  }
	  
	    $source = COP_START_DATE;
        $date = new DateTime($source);
		$responseData['startingDate']= $date->format('F d,Y');
		$responseData['DurationCop']=SystemUtils::nicetime(COP_START_DATE);
		$responseData['cooperativeCapital']=getCapital();
		$responseData['cooperativeRequestInterset']=getInterset();
	   return $responseData;
	}
	catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function addNewExpense($app){
	$responseData = array('status' => 'failed', 'data' => "Sorry, This Expense could not be added by now");
	try {
		$expense = json_decode(Encoding::toUTF8($app -> request -> getBody()), true);
		$budget_to_update = R::findOne("budget", "budgetname=? AND budgetyear=? AND budgetmonth=?", array($expense['budg_name'],$expense['budg_year'],$expense['budg_month']));		
		if ($budget_to_update) {
			$expense_serial =0;	
			$new_expense =$expense['exp_amount'];		
			if(!empty($budget_to_update['serializeddata'])){
			$myserial = unserialize($budget_to_update['serializeddata']);
			foreach ($myserial as $serial) {
				$arrayofserial=(explode(",",$serial));
				$expense_serial+=$arrayofserial[1];
              }
			}else{
				$myserial = array();
			}
			array_push($myserial,$_SESSION['username'].",".$new_expense.",".$expense['exp_descr'].",".date("Y-m-d H:i:s"));
			$myserial = serialize($myserial);
			$budget_to_update -> serializeddata = $myserial;
			$budget_to_update -> budgetexpense = $new_expense+$expense_serial;
			$budget_to_update -> budgetremaining = $budget_to_update['budgetamount']-($new_expense+$expense_serial);
			$budget_to_update -> addedon = date("Y-m-d H:i:s");
			$id = R::store($budget_to_update);

			if ($id = 1) {
				$responseData['status'] = 'success';
				$responseData['data'] = ' The expense is well added!';	
			} else {
				$responseData['data'] = 'Some problem occur try again.';
			}
		} else {
			$responseData;
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function addBudget($app){
	$responseData = array('status' => 'failed', 'data' => 'Unable to add the Budget' . PHP_EOL);
	try {
		$budget = json_decode(Encoding::toUTF8($app -> request -> getBody()), true);
		$budg = R::findOne("budget", "budgetname=? AND budgetyear=? AND budgetmonth=? ", array($budget['budget_name'],$budget['budget_year'],$budget['budget_name']));
		if ($budg) {
			$responseData['data'] = 'This Budget Name already exists!';
			return $responseData;
		}
			if($budget['budget_amount']>$budget['capital']){
				$responseData['data'] = "Sorry,Not enough money in our account.";
				return $responseData;
			}
		$capital_id = updateCapital(-$budget['budget_amount']);		
		$add_budget = R::dispense('budget');
		$add_budget -> budgetname = trim($budget['budget_name']);
		$add_budget -> budgetmonth = $budget['budget_month'];
		$add_budget -> budgetyear = $budget['budget_year'];
		$add_budget -> budgetamount = $budget['budget_amount'];
		$add_budget -> budgetremaining = $budget['budget_amount'];
		$add_budget -> addedby = $_SESSION['id'];
		$add_budget -> addedon = date("Y-m-d H:i:s");

		$id = R::store($add_budget);
		if ($id >= 1 && $capital_id >=1) {
			$responseData['data'] = 'Budget well setted';
			$responseData['status'] = 'success';
		} else {
			$responseData['data'] = 'Some problem occur try again.';
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function findNameFromEmail($email){
	$names = R::getRow("SELECT fname,lname FROM admins WHERE email=?", array($email));
	$admins_name = $names['fname']." ".$names['lname'];
	    return $admins_name;
}

function RetrieveBudgetInMonthCorresponded($year,$month) {
	$responseData = array('status' => 'failed', 'data' => "we couldn't retrieve any Budget Info","totalBudget"=>0,"totalExpense"=>0,"totalremain"=>0);
	try {
		$responseData['data'] = R::getAll("SELECT * FROM budget WHERE budgetyear=? AND budgetmonth=?",array($year,$month));
		for($i=0; $i<sizeof($responseData['data']); $i++){
			$responseData['data'][$i]['all'] = unserialize($responseData['data'][$i]['serializeddata']);		
			for($y=0;$y<sizeof($responseData['data'][$i]['all']);$y++){
			     $arrayofserial = explode(",",$responseData['data'][$i]['all'][$y]);
			      //$responseData['data'][$i]['all'][$y]['adminnames'] = findNameFromEmail($arrayofserial[0]);
			}
			
			if($responseData['data'][$i]['budgetremaining'] == $responseData['data'][$i]['budgetamount'] && $responseData['data'][$i]['budgetexpense'] == 0){
			     	$responseData['data'][$i]['status'] = '0';
					}else if($responseData['data'][$i]['budgetremaining'] == 0){
						$responseData['data'][$i]['status'] = '2';
					}else{
						$responseData['data'][$i]['status'] = '1';
					}						
				}	
		
		$responseData['totalBudget'] = R::getCell("SELECT SUM(budgetamount) AS budgetamount_name FROM budget WHERE budgetyear='{$year}' AND budgetmonth='{$month}'");
		$responseData['totalExpense'] = R::getCell("SELECT SUM(budgetexpense) AS budgetexpense_name FROM budget WHERE budgetyear='{$year}' AND budgetmonth='{$month}'");
		$responseData['totalremain'] = R::getCell("SELECT SUM(budgetremaining) AS budgetremain_name FROM budget WHERE budgetyear='{$year}' AND budgetmonth='{$month}'");
 
 if($responseData){
		$responseData['status'] ="success";

	 }else{
		 $responseData['data'] = 'There is no setted Budget for now.';
	 }
		return $responseData;
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
} 

function add_workers($app) {
	$responseData = array('status' => 'failed', 'data' => 'Unable to add a new worker' . PHP_EOL);
	try {
		$worker = json_decode(Encoding::toUTF8($app -> request -> getBody()), true);

		$user = R::findOne("workers", "email=?", array($worker['email']));
		if ($user) {
			$responseData['data'] = 'Dear ' . $worker['lname'] . ' this email "' . $worker['email'] . '" already exists';
			return $responseData;
		}
		$add_worker = R::dispense('workers');
		$add_worker -> fname = $worker['fname'];
		$add_worker -> lname = $worker['lname'];
		$add_worker -> email = $worker['email'];
		$add_worker -> phone = $worker['phone'];
		$add_worker -> sex = $worker['sex'];
		$add_worker -> age = $worker['age'];
		$add_worker -> idnumber = $worker['idnumber'];
		$add_worker -> status = $worker['statusi'];
		$add_worker -> education = $worker['user_education'];
		$add_worker -> experience = $worker['prev_experience'];
		$add_worker -> affiliation = $worker['affiliation'];
		$add_worker -> department = $worker['user_depart'];
		$add_worker -> salary = $worker['salary'];
		$add_worker -> regdate = date("Y-m-d H:i:s");
		$id = R::store($add_worker);
		if ($id >= 1) {
			$responseData['data'] = ' This worker ' . $worker['fname'] . ' well added!';
			$responseData['status'] = 'success';
		} else {
			$responseData['data'] = 'Some problem occur try again.';
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function add_network($app) {
	$responseData = array('status' => 'failed', 'data' => 'Unable to add a network' . PHP_EOL);
	try {
		$network = json_decode(Encoding::toUTF8($app -> request -> getBody()), true);
		$net = R::findOne("network", "networkname=?", array($network['networkname']));
		if ($net) {
			$responseData['data'] = 'This network Name already exists!';
			return $responseData;
		}
		$add_net = R::dispense('network');
		$add_net -> networkname = trim($network['networkname']);
		$add_net -> creator = $_SESSION['id'];
		$add_net -> serialdata = serialize($network['emails']);
		$add_net -> creationdate = date("Y-m-d H:i:s");
		$add_net -> status = '0';

		$id = R::store($add_net);
		if ($id >= 1) {
			$responseData['data'] = ' Network well added!';
			$responseData['status'] = 'success';
		} else {
			$responseData['data'] = 'Some problem occur try again.';
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function chatting($app) {
	$responseData = array('status' => 'failed', 'data' => 'Unable to send message' . PHP_EOL);
	try {
		$chat = json_decode(Encoding::toUTF8($app -> request -> getBody()), true);
		$add_chat = R::dispense('messages');
		$add_chat -> network_id = $chat['networkid'];
		$add_chat -> messages = $chat['chatMessage'];
		$add_chat -> creator = $chat['networkcreatorid'];
		$add_chat -> author = $chat['author'];
		$add_chat -> audience = serialize($chat['networkaudience']);
		$add_chat -> messagedate = date("Y-m-d H:i:s");
		$id = R::store($add_chat);
		if ($id >= 1) {
			$responseData['data'] = ' Message sent';
			$responseData['status'] = 'success';
		} else {
			$responseData['data'] = 'Message not sent.';
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function updateAdminStatus($app) {
	$responseData = array('status' => 'failed', 'data' => ' Can\'t update the administrator status');
	try {
		$admin = json_decode($app -> request -> getBody(), true);
		$admin_row = R::findOne("admins", "status=? AND id=? ", array($admin['status'], $admin['id']));
		if ($admin_row) {
			if ($admin['status'] == '0') {
				$admin_row -> status = '1';
			} elseif ($admin['status'] == '1') {
				$admin_row -> status = '0';
			}
			$id = R::store($admin_row);
			if ($id >= 1) {
				$responseData['data'] = ' The admin is well updated!';
				$responseData['status'] = 'success';
			} else {
				$responseData['data'] = 'An error occured';
			}
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function updateMemberStatus($app) {
	$responseData = array('status' => 'failed', 'data' => 'Sorry! Can\'t update the Member status now');
	try {
		$member = json_decode($app -> request -> getBody(), true);
		$member_row = R::findOne("members", "status=? AND id=? ", array($member['status'], $member['id']));
		if ($member_row) {
			if ($member['status'] == '0') {
				$member_row -> status = '1';
			} elseif ($member['status'] == '1') {
				$member_row -> status = '0';
			}
			$id = R::store($member_row);
			if ($id >= 1) {
				$responseData['data'] = ' The member is well updated!';
				$responseData['status'] = 'success';
			} else {
				$responseData['data'] = 'An error occured';
			}
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function updateAdminPrivilege($userid, $priv) {
    $responseData = array('status' => 'failed', 'data' => "Sorry,Member not updated");	
    try {
    	if (authorization($_SESSION['authorize']) != 2) {
			$responseData['data'] = 'you don\'t have permission to change the privilege.';
			return $responseData;
		}
        $id_found = R::findOne('admins', 'id=?', array($userid));
        if ($id_found) {
            $id_found->privilege = $priv;
            $id = R::store($id_found);
            if ($id >= 1) {
                $responseData['status'] = 'success';
                $responseData ['data'] = 'Member has been updated successfully!.';
                return $responseData;
            }
        }
    } catch (Exception $e) {
        $responseData['data'] = ' error in  ' . $e->getMessage() . ' trace ' . $e->getTraceAsString();
    }
    return $responseData;
}

function Retrieveworkercount() {
	$responseData = array('status' => 'failed', 'count_female' => 0, 'count_male' => 0, 'count_depart' => 0);
	try {
		$responseData['status'] = "success";
		$responseData['count_depart'] = sizeof(R::getAll("SELECT * FROM department"));
		$responseData['count_female'] = sizeof(R::getAll("SELECT * FROM workers WHERE sex='female'"));
		$responseData['count_male'] = sizeof(R::getAll("SELECT * FROM workers WHERE sex='male'"));
		return $responseData;
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function authorization($auto) {
	try {
		if ($auto == '2') {
			return 2;
		}
		if ($auto == "1") {
			return 1;
		}
	} catch(Exception $e) {
		echo ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return;
}

function getannualyFinance($year) {
	$responseData = array(
	'status' => 'failed',
	 'amountExpected' => 0,
	 'amountavailable' => 0,
	 'amountremain' => 0,
	 'annualLyRequestAmount'=> 0,
	 'annualLyRequestApproved'=> 0,
	 'annualLyRequestSuspended'=> 0,
	 'annualLyRequestDisapproved'=> 0
	 );
	try {
	  $contributiontCount = R::getAll("SELECT table_name from information_schema.tables where table_schema = 'asid_coperative' AND table_name like '%contribution".$year."%'");
     
	  $annualLyRequestAmount = intval(R::getCell("SELECT SUM(amount)AS totalRequestAmount FROM membersrequest WHERE sentdate LIKE '".$year."%'"));
	   $annualLyRequestApproved = intval(R::getCell("SELECT SUM(amount)AS totalRequestAmountA FROM membersrequest WHERE status='a' AND sentdate LIKE '".$year."%'"));
	    $annualLyRequestSuspended = intval(R::getCell("SELECT SUM(amount)AS totalRequestAmountS FROM membersrequest WHERE status='s' AND  sentdate LIKE '".$year."%'"));
		 $annualLyRequestDisapproved = intval(R::getCell("SELECT SUM(amount)AS totalRequestAmountD FROM membersrequest WHERE status='d' AND  sentdate LIKE '".$year."%'"));
      
      $sumTotalExpected = 0;
      $sumTotalAvailable = 0;
	  $mytables =array();
	  for($i=0;sizeof($contributiontCount)>$i;$i++){
	  	array_push($mytables,$contributiontCount[$i]['table_name']);
	  }
	    for($y=0;sizeof($mytables)>$y;$y++){
	    	$totalExpect[$y] = R::getCell("SELECT SUM(total)AS totalTableExpect FROM ".$mytables[$y]);
			$totalAvail[$y] = R::getCell("SELECT SUM(amount)AS totalTableAvail FROM ".$mytables[$y]);
	  	$sumTotalExpected+=$totalExpect[$y];
		$sumTotalAvailable+=$totalAvail[$y];
	  }
		if(sizeof($mytables>=1)){
			$responseData['status']='success';
			$responseData['amountExpected']=$sumTotalExpected;
			$responseData['amountavailable']=$sumTotalAvailable;
			$responseData['amountremain']=$sumTotalExpected-$sumTotalAvailable;
			$responseData['annualLyRequestAmount'] = $annualLyRequestAmount;
			$responseData['annualLyRequestApproved'] = $annualLyRequestApproved;
			$responseData['annualLyRequestSuspended'] = $annualLyRequestSuspended;
			$responseData['annualLyRequestDisapproved'] = $annualLyRequestDisapproved;
		}
    return $responseData;
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}


function RetrieveWorkersStatistics() {
	$responseData = array('status' => 'failed', 'data' => "we couldn't retrieve stats");
	try {
		$responseData['data'] = R::getAll("SELECT fname,lname,affiliation FROM workers ORDER BY affiliation ASC");
		$timetoday = date("Y-m-d H:i:s");
		$timecompany = '2006-01-01 00:00:00';
		$durationcompany = strtotime($timetoday) - strtotime($timecompany);
		for ($i = 0; count($responseData['data']) > $i; $i++) {
			$responseData['data'][$i]['percentworker'] = SystemUtils::format_percentage((strtotime($timetoday) - strtotime($responseData['data'][$i]['affiliation'])), $durationcompany);
			$responseData['data'][$i]['companyduration'] = SystemUtils::nicetime($timecompany);
			$responseData['data'][$i]['workerduration'] = SystemUtils::nicetime($responseData['data'][$i]['affiliation']);

			if ($responseData['data'][$i]['percentworker'] < 0) {
				$responseData['data'][$i]['percentworker'] = 0;
				$responseData['data'][$i]['percentage_status'] = "Undefined";
			}
			if ($responseData['data'][$i]['percentworker'] <= 25) {
				$responseData['data'][$i]['percentage_status'] = "4";
			}
			if ($responseData['data'][$i]['percentworker'] > 25 && $responseData['data'][$i]['percentworker'] <= 50) {
				$responseData['data'][$i]['percentage_status'] = "3";
			}
			if ($responseData['data'][$i]['percentworker'] > 50 && $responseData['data'][$i]['percentworker'] <= 75) {
				$responseData['data'][$i]['percentage_status'] = "2";
			}
			if ($responseData['data'][$i]['percentworker'] > 75 && $responseData['data'][$i]['percentworker'] <= 100) {
				$responseData['data'][$i]['percentage_status'] = "1";
			}
		}
		if (sizeof($responseData['data']) >= 1) {
			$responseData['status'] = 'success';
		} else {
			$responseData['data'] = 'There are no worker at this time.';
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function RetrieveAdmins() {
	$admins = array('status' => 'failed', 'data' => "we couldn't retrieve any administrator");
	try {
		$admins['data'] = R::getAll("SELECT LPAD(id,5,0) AS id_modified,id,fname,lname,phone,email,case `status` WHEN '0' THEN 'Inactive' WHEN '1' THEN 'Active' end AS status_name,status,DATE_FORMAT(regdate,'%b %D %Y  at %h:%i %p') AS registrationDate,lastlogin FROM admins");
		for ($i = 0; sizeof($admins['data']) > $i; $i++) {
			if ($admins['data'][$i]['lastlogin'] == null) {
				$admins['data'][$i]['last_login'] = "Never";
			}
			if ($admins['data'][$i]['lastlogin'] != null) {
				$admins['data'][$i]['last_login'] = SystemUtils::nicetime($admins['data'][$i]['lastlogin']);
			}
		}
		if (sizeof($admins['data']) >= 1) {
			$admins['status'] = 'success';
		} else {
			$admins['data'] = 'There are no registered administrator at this time.';
		}
	} catch (Exception $e) {
		$admins['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $admins;
}

function retrieveStatisticsdetail() {
	try {
		$admins['membercount'] = R::getRow("SELECT count(id)AS membercount FROM members");
		$admins['female'] = R::getRow("SELECT count(id)AS femalecount FROM members WHERE sex='female'");
		$admins['male'] = R::getRow("SELECT count(id)AS malecount FROM members WHERE sex='male'");
		return $admins;
	} catch(exception $e) {
		echo "error in " . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
}


function memberSentReq($app) {
	$responseData = array('status' => 'failed', 'data' => 'Sorry, Unable to send your request for now' . PHP_EOL);
	try {
		$member_req = json_decode(Encoding::toUTF8($app -> request -> getBody()), true);

		$req = R::dispense('membersrequest');
		$req -> title = $member_req['request_title'];
		$req -> amount = $member_req['request_amount'];
		$req -> description = $member_req['request_description'];
		$req -> paybackdate = $member_req['payback_period'];
		$req -> status = 'r';
		$req -> memberid = $_SESSION['id'];
		$req -> sentdate = date("Y-m-d H:i:s");
		$id = R::store($req);
		if ($id >= 1) {
			$responseData['data'] = ' Request successfully sent.';
			$responseData['status'] = 'success';
		} else {
			$responseData['data'] = 'Some problem occur, Please try again.';
		}
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}


function retrieveProjects() {
	$projects = array('status' => 'failed', 'data' => "we couldn't retrieve any project");
	try {
		$projects['data'] = R::getAll("SELECT * FROM projects");
		if($projects< 1){
			$projects['data'] ="There are no projects currently.";
		}
			$projects['status'] = "success";
			
	} catch (Exception $e) {
		$projects['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $projects;
}


function contrHistory($member_id){	
		$responseData = array('status' => 'failed', 'data' => 'Sorry, Unable to find member historic');
	try{
     $contributionsT = R::getAll("SELECT table_name from information_schema.tables where table_schema = 'asid_coperative' AND table_name like '%contribution%'");
		  $member_contribus = array();
		  $mytables =array();
		  for($i=0;sizeof($contributionsT)>$i;$i++){
		  	array_push($mytables,$contributionsT[$i]['table_name']);
		  }
		    for($y=0;sizeof($mytables)>$y;$y++){
		    	$totals[$y] = R::getRow("SELECT * FROM ".$mytables[$y]."  WHERE contributorid=? ", array($member_id));		    	
		    	 if(intval($totals[$y]['remaining'])>0){
		    	 		if($totals[$y]['remaining'] == $totals[$y]['total'] && $totals[$y]['amount'] == 0){
			     	$totals[$y]['status'] = '0';
					}else if($totals[$y]['remaining'] == 0){
						$totals[$y]['status'] = '2';
					}else{
						$totals[$y]['status'] = '1';
					}
		    		 array_push($member_contribus,$totals[$y]);
		    	}else{
		    		continue;
		    	}   
		    }
	      $responseData['status']= "success";	
		  if(sizeof($member_contribus)>=1){
		  $responseData['data']= $member_contribus;		
		  }else{
		  	$responseData['data']= $member_contribus;	
		  }			 
	    return $responseData;
	}catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function contrHistoryAll($member_id){	
		$responseData = array('status' => 'failed', 'data' => 'Sorry, Unable to find member historic');
	try{
     $contributionsT = R::getAll("SELECT table_name from information_schema.tables where table_schema = 'asid_coperative' AND table_name like '%contribution%'");
		  $member_contribus = array();
		  $mytables =array();
		  for($i=0;sizeof($contributionsT)>$i;$i++){
		  	array_push($mytables,$contributionsT[$i]['table_name']);
		  }
		    for($y=0;sizeof($mytables)>$y;$y++){
		    	$totals[$y] = R::getRow("SELECT * FROM ".$mytables[$y]."  WHERE contributorid=? ", array($member_id));		    			
					if($totals[$y]['remaining'] == $totals[$y]['total'] && $totals[$y]['amount'] == 0){
			     	$totals[$y]['status'] = '0';
					}else if($totals[$y]['remaining'] == 0){
						$totals[$y]['status'] = '2';
					}else{
						$totals[$y]['status'] = '1';
					}				    	
	    		 array_push($member_contribus,$totals[$y]);
		    }
	
	      $responseData['status']= "success";	
		  if(sizeof($member_contribus)>=1){
		  $responseData['data']= $member_contribus;		
		  }else{
		  	$responseData['data']= $member_contribus;	
		  }			 
	    return $responseData;
	}catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function selectSingleRequest($member_id,$request_id){
		$request = array('status' => 'failed', 'data' => "we couldn't retrieve member request details");
	try {
		  $info = R::getRow("SELECT *,(SELECT fname FROM members WHERE id=".$member_id.")AS firstname ,(SELECT lname FROM members WHERE id=".$member_id.")AS lastname,DATE_FORMAT(paybackdate,'%b %D %Y') AS paybackdatechanged FROM membersrequest WHERE id=?", array($request_id));
	     $info['deadlinecount'] = SystemUtils::nicetimewith($info['sentdate'],$info['paybackdate']);
		 $info['days'] = floor((strtotime($info['paybackdate'])-strtotime($info['sentdate']))/(60 * 60 * 24));
		if(sizeof($info)>=1){
			$request['status'] = "success";
			$request['data'] =$info;
		}					
	} catch (Exception $e) {
		$request['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $request;
}

function assumedInterestAfterSelectDat ($req_id,$s_dte,$r_amount,$prposed_date,$interest){
		$request = array('status' => 'failed', 'data' => "sorry!");
	try {
			$s_dte_new = strtotime($s_dte);
			$prposed_date_new = time();	
			if($s_dte_new<$prposed_date_new){
				$request['data'] = "please pick a date after today date"; 
				return $request;
			}		
			$datediff = $s_dte_new - $prposed_date_new;
			$inter_duration = floor($datediff / (60 * 60 * 24));
			$amount_and_interest = (($r_amount*$interest)/(100*30))*$inter_duration;		
			$request['status'] = "success";
			$request['data'] ='Interest: frw '.$amount_and_interest;
						
	} catch (Exception $e) {
		$request['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $request;
}

function selectRequestById($member_id){
		$request = array('status' => 'failed', 'data' => "we couldn't retrieve member request details");
	try {
		  $request['data'] = R::getAll("SELECT *,DATE_FORMAT(sentdate,'%b %D %Y') AS sentdateChange,DATE_FORMAT(submissiondate,'%b %D %Y') AS submissiondateChange,DATE_FORMAT(dealine,'%b %D %Y') AS dealineChange,(SELECT fname FROM members WHERE id=$member_id)AS firstname ,(SELECT lname FROM members WHERE id=$member_id)AS lastname FROM membersrequest WHERE memberid=?", array($member_id));
		if(sizeof($request['data'])< 1){
			$request['data'] ="There are no request detail for this one.";
		}
			$request['status'] = "success";
			
	} catch (Exception $e) {
		$request['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $request;
}

function Retrieveuserlogininfo() {
	$responseData = array('status' => 'failed', 'data' => 'info not found');
	try {
	$info = R::getRow("SELECT * FROM admins WHERE email=?", array($_SESSION['username']));
	if($info){
		$responseData['status']='success';
		$responseData['data'] =$info;
	    }
		return $responseData;
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}


function RetrieveMemberlogininfo() {
	$responseData = array('status' => 'failed', 'data' => 'info not found');
	try {
	$info = R::getRow("SELECT * FROM members WHERE email=?", array($_SESSION['member']));
	if($info){
		$responseData['status']='success';
		$responseData['data'] =$info;
	    }
		return $responseData;
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function RetrieveMembersRequestsDetail() {
	$responseData = array('status' => 'failed', 'data' => 'There are no request for now','count'=>0);
	try {
	  $info = R::getAll("SELECT *,(SELECT fname FROM members WHERE id=memberid)AS firstname ,(SELECT lname FROM members WHERE id=memberid)AS lastname,(SELECT profile FROM members WHERE id=memberid)AS coverurl FROM membersrequest WHERE status=?", array('r'));
	  $count =sizeof($info);
	  for($i=0;$count>$i;$i++){
	  	$info[$i]['sentdate'] = SystemUtils::nicetime($info[$i]['sentdate']);
	  }
	if($count>=1){
		$responseData['status']='success';
		$responseData['data'] =$info;
		$responseData['count'] =$count;
	    }
		return $responseData;
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}
function RetrieveMembersRequestsList() {
	$responseData = array('status' => 'failed', 'data' => 'There are no request for now','count'=>0);
	try {
	  $info = R::getAll("SELECT *,DATE_FORMAT(sentdate,'%b %D %Y') AS sentdateChange,case `status` WHEN 'r' THEN 'Requested' WHEN 'a' THEN 'Approved' WHEN 's' THEN 'Suspended' WHEN 'd' THEN 'Disapproved' end AS status_name,(SELECT fname FROM members WHERE id=memberid)AS firstname ,(SELECT lname FROM members WHERE id=memberid)AS lastname,(SELECT profile FROM members WHERE id=memberid)AS coverurl FROM membersrequest");
	if(sizeof($info)>=1){
		$responseData['status']='success';
		$responseData['data'] =$info;
	    }
		return $responseData;
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}
function RetrieveIncomeList() {
	$responseData = array('status' => 'failed', 'data' => 'There are no income for now');
	try {
	  $info = R::getAll("SELECT *,LPAD(id,3,0) AS id_modified,DATE_FORMAT(addedon,'%b %D %Y') AS addedon,numberof AS count FROM incomes");	  
	if(sizeof($info)>=1){
		$responseData['status']='success';
		$responseData['data'] =$info;
	    }
		return $responseData;
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function RetrieveIncomeListForTabsHavingChildren() {
	$responseData = array('status' => 'failed', 'data' => 'There are no income for now');
	try {
		$myarray = array();
	  $info = R::getAll("SELECT *,LPAD(id,3,0) AS id_modified,DATE_FORMAT(addedon,'%b %D %Y') AS addedon FROM incomes");	  
	  for($i=0; $i<sizeof($info); $i++){	  		
	  		$info[$i]['countstatusone'] = getNumberOfChild($info[$i]['name']); 	
		  if($info[$i]['countstatusone']>=1){
			   array_push($myarray, $info[$i]);
		  }
		  else{
		  continue;
		 }
	  }	  
	if(sizeof($myarray)>=1){
		$responseData['status']='success';
		$responseData['data'] =$myarray;
	    }
		return $responseData;
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}
      function getNumberOfChild($name){
		$mycount = R::count($name, "status=?", array('1'));
        return $mycount;
		}


function popIncomeDetails($pop_income_name){	
		$responseData = array('status' => 'failed', 'data' => 'Sorry, Unable to find sub income');
	try{
       $the_income_content = R::getAll("SELECT *, LPAD(id,4,0) AS id_modified,case `type` WHEN '1' THEN 'Daily' WHEN '2' THEN 'Weekly' WHEN '3' THEN 'Monthly' WHEN '4' THEN 'Irregular' end AS type_name FROM ".$pop_income_name);

		  if(sizeof($the_income_content)>=1){
		  	$responseData['status']= "success";
		  $responseData['data']= $the_income_content;		
		  }else{
		  	$responseData['status']= "success";
		  	$responseData['data']= "the are no income details by now";	
		  }			 
	    return $responseData;
	}catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function subincomeHavingChildren($pop_income_name){	
		$responseData = array('status' => 'failed', 'data' => 'Sorry, Unable to find sub income');
	try{
       $the_income_content = R::getAll("SELECT *, LPAD(id,4,0) AS id_modified,case `type` WHEN '1' THEN 'Daily' WHEN '2' THEN 'Weekly' WHEN '3' THEN 'Monthly' end AS type_name FROM ".$pop_income_name." WHERE status=1");

		  if(sizeof($the_income_content)>=1){
		  	$responseData['status']= "success";
		  $responseData['data']= $the_income_content;		
		  }else{
		  	$responseData['status']= "success";
		  	$responseData['data']= "the are no income details by now";	
		  }			 
	    return $responseData;
	}catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}


function RetrieveMembersapproveDetail() {
	$responseData = array('status' => 'failed', 'data' => 'There are no approve for now','count'=>0);
	try {
	  $info = R::getAll("SELECT *,(SELECT fname FROM members WHERE id=memberid)AS firstname ,(SELECT lname FROM members WHERE id=memberid)AS lastname,(SELECT profile FROM members WHERE id=memberid)AS coverurl FROM membersrequest WHERE status=? ORDER BY sentdate DESC", array('a'));
	  $count =sizeof($info);
	  for($i=0;$count>$i;$i++){
	  	$info[$i]['sentdate'] = SystemUtils::nicetime($info[$i]['sentdate']);
	  }
	if($count>=1){
		$responseData['status']='success';
		$responseData['data'] =$info;
		$responseData['count'] =$count;
	    }
		return $responseData;
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}
function RetrieveMembersspendedDetail() {
	$responseData = array('status' => 'failed', 'data' => 'There are no suspended for now','count'=>0);
	try {
	  $info = R::getAll("SELECT *,(SELECT fname FROM members WHERE id=memberid)AS firstname ,(SELECT lname FROM members WHERE id=memberid)AS lastname,(SELECT profile FROM members WHERE id=memberid)AS coverurl FROM membersrequest WHERE status=?", array('s'));
	  $count =sizeof($info);
	  for($i=0;$count>$i;$i++){
	  	$info[$i]['sentdate'] = SystemUtils::nicetime($info[$i]['sentdate']);
	  }
	if($count>=1){
		$responseData['status']='success';
		$responseData['data'] =$info;
		$responseData['count'] =$count;
	    }
		return $responseData;
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}

function RetrieveMembersdisapproveDetail() {
	$responseData = array('status' => 'failed', 'data' => 'There are no disapproved for now','count'=>0);
	try {
	  $info = R::getAll("SELECT *,(SELECT fname FROM members WHERE id=memberid)AS firstname ,(SELECT lname FROM members WHERE id=memberid)AS lastname,(SELECT profile FROM members WHERE id=memberid)AS coverurl FROM membersrequest WHERE status=?", array('d'));
	  $count =sizeof($info);
	  for($i=0;$count>$i;$i++){
	  	$info[$i]['sentdate'] = SystemUtils::nicetime($info[$i]['sentdate']);
	  }
	if($count>=1){
		$responseData['status']='success';
		$responseData['data'] =$info;
		$responseData['count'] =$count;
	    }
		return $responseData;
	} catch (Exception $e) {
		$responseData['data'] = ' error in  ' . $e -> getMessage() . ' trace ' . $e -> getTraceAsString();
	}
	return $responseData;
}



function uploadImage($email) {
    try {
        if (strlen($email) < 1) {
            return -504;
        }
        $accepted_imagetypes = array(
            'image/jpeg',
            'image/jpg',
            'image/jpeg',
            'image/x-png',
            'image/png'
        );

        if (isset($_FILES ["upl"])) {
            if (isset($_FILES ["upl"]['name']) && is_array($_FILES ["upl"]['name'])) {
                $myFile = array('name' => $_FILES ["upl"]['name'][0],
                    'tmp_name' => $_FILES ["upl"]['tmp_name'][0],
                    'type' => $_FILES ["upl"]['type'][0],
                    'size' => $_FILES ["upl"]['size'][0],
                    'error' => $_FILES ["upl"]['error'][0]
                ); //only single&serial uploads are allowed
            } else {
                $myFile = $_FILES ["upl"];
            }
        }

        if ($myFile ["error"] !== 0) {
            if (is_string($myFile ["tmp_name"])) {
                unlink($myFile ["tmp_name"]);
            }
            //SystemUtils::logActivity('user', $_SESSION['app'], 'failed to upload with  upload error ' . $myFile ["error"]);
            return -503;
        }
        $type = $myFile ["type"];
        $size = $myFile ["size"];

        if (strlen($type) < 3) {
            $type = SystemUtils::mime_file_content_type($myFile ["tmp_name"]);
        }

        if (!in_array(trim($type), $accepted_imagetypes)) {
            unlink($myFile ["tmp_name"]);
            return - 300;
        } else {
            if ($size < 1024) {
                $size = filesize($myFile ["tmp_name"]);
            }
            if ($size >= 10485760) {
                unlink($myFile ["tmp_name"]);
                return -1000;
            }

            // ensure a safe filename
            $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile ["name"]);
            if (strlen($name) >= 100) {
                $name = substr($name, -100);
            }

            $DestinationFolder = './uploaded/' . date("Ymd") . '/';
            if (!is_dir($DestinationFolder)) {
                if (!mkdir($DestinationFolder, 0777, true)) {
                    unlink($myFile ["tmp_name"]);
                    return - 100;
                }
            }

            // preserve file from temporary directory
            $saveFile = move_uploaded_file($myFile ["tmp_name"], $DestinationFolder . $name);
            if (!$saveFile) {
                unlink($myFile ["tmp_name"]);
                return - 400;
            } else {
                return saveImage($email, $DestinationFolder . $name);
            }
        }
    } catch (Exception $e) {
       echo 'user',' failed to upload ....trace' . $e->getTraceAsString() . ' message' . $e->getMessage() . ' line' . $e->getLine();
        return - 700;
    }
    return -201;
}

function saveImage($email, $location) {
	$response = array('status'=>'failed','data'=>'image not saved');
	 $bean = R::findOne('admins', 'email=?', array($email));
            if ($bean) {                
                $bean->profile = $location;
                $id = R::store($bean);
				if($id>0){
				$response['status']='success';	
					$response['data']='image saved';
				}else{
					$response['data']='image failed to be saved';
				}
            }
			return $response;
        }

        
   //===========================EXPORT DATA========================
   
   function exportSpreadSheet() {

    try {
        exportRegistrations(R::getAll("SELECT fname,"
                        . "lname,"
                        . "sex,"
                        . "contact,"
                        . "email,"
                        . "username,"
                        . "nationalid"
                        . " FROM members"));
    } catch (Exception $e) {
        echo ' exportSpreadSheet() ...  An application exception caught at ' . $e->getTraceAsString() . ' message ' . $e->getMessage();
    }
}
   
function exportRegistrations($individuals) {

    if (file_exists('./lib/libs/classes/PHPExcel.php')) {
        require_once './lib/libs/classes/PHPExcel.php';
    } else {
        echo 'Application Library not found';
        return;
    }

    $xls = new PHPExcel();
// Set document properties
    $xls->getProperties()->setCreator("stella")
            ->setLastModifiedBy("stella")
            ->setTitle("Members list " . date("Y-m-d"))
            ->setSubject("stella")
            ->setDescription("This XLS form has been exported from ASI-Distribution")
            ->setKeywords("Made in Rwanda!!")
            ->setCategory("members  exported for offline view");


 // Rename worksheet
// Add title data
    $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'First Name')
            ->setCellValue('B1', 'Last Name')
            ->setCellValue('C1', 'Sex')
            ->setCellValue('D1', 'Phone')
            ->setCellValue('E1', 'Email')
            ->setCellValue('F1', 'Username');
          
    $xls->getActiveSheet()->getColumnDimension('A')->setWidth(32);
    $xls->getActiveSheet()->getColumnDimension('B')->setWidth(32);
    $xls->getActiveSheet()->getColumnDimension('C')->setWidth(40);
    $xls->getActiveSheet()->getColumnDimension('D')->setWidth(15);
    $xls->getActiveSheet()->getColumnDimension('E')->setWidth(40);
    $xls->getActiveSheet()->getColumnDimension('F')->setWidth(24);


    $xls->getActiveSheet()->setTitle('Members');
    $xls->setActiveSheetIndex(0);
    $xls->getActiveSheet()->getRowDimension(1)->setRowHeight(20);
    $xls->getActiveSheet()->getStyle(1)->applyFromArray(array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => 'FFFFFF'),
            'size' => 13,
            'name' => 'Verdana'
    )));

    if (sizeof($individuals) >= 1) {
        $row = 1;
        for ($i = 0; $i < sizeof($individuals); $i++) {
            $row++;
            $xls->setActiveSheetIndex(0)
                    ->setCellValue('A' . $row, $individuals[$i]['fname'])
                    ->setCellValue('B' . $row, $individuals[$i]['lname'])
                    ->setCellValue('C' . $row, $individuals[$i]['sex'])
                    ->setCellValue('D' . $row, $individuals[$i]['contact'])
                    ->setCellValue('E' . $row, $individuals[$i]['email'])
                    ->setCellValue('F' . $row, $individuals[$i]['username']);

        }
    } else {
        $xls->setActiveSheetIndex(0)->setCellValue('A4', 'No registrations of individuals with membership of status');
    }
//
    $xls->createSheet();
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $xls->setActiveSheetIndex(0);

    // Redirect output to a client’s web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . date("Y-m-d_H") . 'Members.xlsx"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');
    // If you're serving to IE over SSL, then the following may be needed
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0
    $objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');
    ob_end_clean();
    ob_end_flush();
    $objWriter->save('php://output');
}
//=========================== CREATE TABLE DYNAMICALY ========================

function createTableMonthContribution($year,$month,$amount,$deadline) {
    try {
    	$responseData = array('status' => 'failed', 'data' => 'Unable to set Contribution');
       R::exec("CREATE TABLE IF NOT EXISTS `contribution" . $year ."".$month."` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contributorid` varchar(255) NOT NULL,
  `month` varchar(25) NOT NULL,
  `year` varchar(25) NOT NULL,
  `amount` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `remaining` int(11) NOT NULL,
  `serializationdata` TEXT NOT NULL,
  `deadline` DATETIME NOT NULL,
   `payeddate` DATETIME NOT NULL,
  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
		for($i=0;sizeof($_SESSION['members_to_put_into_created_table'])>$i;$i++){
			saveMembersIntoTableCreated($year,$month,$amount, $_SESSION['members_to_put_into_created_table'][$i]['id'],$deadline);
		}
		$responseData = array('status' => 'success', 'data' => 'Contribution Setted.');
		return $responseData;
    } catch (Exception $e) {
        echo 'user failed to createTableImportsRecord ' . $e->getMessage() . ' trace ' . $e->getTraceAsString();
    }
    return false;
}

function createTableMonthContributionyearly($year,$amount) {
    try {
    	$responseData = array('status' => 'failed', 'data' => 'Unable to set Contribution');

    	for($var_month=1;$var_month<=12;$var_month++){
    		if($var_month<10){
    		$var_month ="0".$var_month;	
    		}else{
    			$var_month =$var_month;
    		}
    		switch($var_month){
				case "01":
				$deadline = $year."-".$var_month."-31";
				break;
				case "02":
				$deadline = $year."-".$var_month."-28";
				break;
				case "03":
				$deadline = $year."-".$var_month."-31";
				break;
				case "04":
				$deadline = $year."-".$var_month."-30";
				break;
				case "05":
				$deadline = $year."-".$var_month."-31";
				break;
				case "06":
				$deadline = $year."-".$var_month."-30";
				break;
				case "07":
				$deadline = $year."-".$var_month."-31";
				break;
				case "08":
				$deadline = $year."-".$var_month."-31";
				break;
				case "09":
				$deadline = $year."-".$var_month."-30";
				break;
				case "10":
				$deadline = $year."-".$var_month."-31";
				break;
				case "11":
				$deadline = $year."-".$var_month."-30";
				break;
				case "12":
				$deadline = $year."-".$var_month."-31";
				break;
    		}
       R::exec("CREATE TABLE IF NOT EXISTS `contribution" . $year ."".$var_month."` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `contributorid` varchar(255) NOT NULL,
			  `month` varchar(25) NOT NULL,
			  `year` varchar(25) NOT NULL,
			  `amount` int(11) NOT NULL,
			  `total` int(11) NOT NULL,
			  `remaining` int(11) NOT NULL,
			  `serializationdata` TEXT NOT NULL,
			  `deadline` DATETIME NOT NULL,
			   `payeddate` DATETIME NOT NULL,			  
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");	
								for($i=0;sizeof($_SESSION['members_to_put_into_created_table'])>$i;$i++){
						saveMembersIntoTableCreated($year,$var_month,$amount, $_SESSION['members_to_put_into_created_table'][$i]['id'],$deadline);	
			   }
			  }

		$responseData = array('status' => 'success', 'data' => 'Contribution Setted.');
		return $responseData;
    } catch (Exception $e) {
        echo 'user failed to createTableImportsRecord ' . $e->getMessage() . ' trace ' . $e->getTraceAsString();
    }
    return false;
}

function saveMembersIntoTableCreated($year,$month,$amount,$memberid,$deadline) {
		$member = R::findOne("contribution". $year ."".$month, "contributorid=?", array($memberid));
		if ($member) {
           continue;
		}
    $bean = R::dispense('contribution'. $year .''.$month);
    $bean->contributorid = $memberid;
    $bean->year = $year;
    $bean->month = $month;
    $bean->total = $amount;
    $bean->amount = 0;
    $bean->remaining = $amount;
    $bean->deadline = $deadline;
    return R::store($bean);
}




//============================*********************THIS IS FOR IMPORT EXPORT******************===============================

function importFromExcelSheets($context) {
    $res = array('status' => 'failed', 'data' => 'Unable to import ' . $context . PHP_EOL);
    try {
        $accepted_mimes = array('text/csv',
            'application/vnd.ms-excel',
            'application/msexcel',
            'application/x-msexcel',
            'application/x-ms-excel',
            'application/x-excel',
            'application/x-dos_ms_excel',
            'application/xls',
            'application/x-xls',
            'application/vnd.oasis.opendocument.spreadsheet',
            'application/vnd.oasis.opendocument.spreadsheet-template',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-excel',
            'application/msexcel',
            'application/x-msexcel',
            'application/x-ms-excel',
            'application/x-excel',
            'application/x-dos_ms_excel',
            'application/xls',
            'application/x-xls',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if (!empty($_FILES ["upl"])) {
            $myFile = $_FILES ["upl"];
            if ($myFile ["error"] !== 0) {
                unlink($myFile ["tmp_name"]);
                $res['data'].='An error occured while uploading spreadsheet ' . $myFile ["error"];
                return $res;
            }
            $type = $myFile ["type"];
            $size = $myFile ["size"];
            if (strlen($type) < 3) {
                $type = mime_file_content_type($myFile ["tmp_name"]);
            }
            if (!in_array(trim($type), $accepted_mimes)) {
                unlink($myFile ["tmp_name"]);
                $res['data'].='The uploaded file is not a supported sheet file .i.e ' . $type;
                return $res;
            } else {
                if ($size < 1024) {
                    $size = filesize($myFile ["tmp_name"]);
                }
                if ($size >= 10485760) { //no more than 10 MB
                    unlink($myFile ["tmp_name"]);
                    $res['data'].='The uploaded file is not too large .i.e ' . $size . ' bytes';
                    return $res;
                }
            }
            $name = './' . $context . '_' . date("Ymd") . '_' . preg_replace("/[^A-Z0-9._-]/i", "_", $myFile ["name"]);
            move_uploaded_file($myFile ["tmp_name"], $name);
            if (!file_exists($name)) {
                $res['data'].='unable to locate file at ' . $name;
                return $res;
            } else {
                $res['file'] = 'file is at ' . $name;
            }
            
            $res = importRegistration($name, 'return',7);
            if ($res['status'] == 'success') {
                    if (createTableImportsRecord(date("Ym"))) {
                        saveImportedRecord(date("Ym"), $context, serialize($res['data']));
                    }           
            }
        } else {
            $res['data'].='The upload was empty...please change your browser';
            return $res;
        }
    } catch (Exception $e) {
        echo 'user The app  ' . $context . ' failed to....trace' . $e->getTraceAsString() . ' message' . $e->getMessage() . ' line' . $e->getLine();
        $res['data'] = 'An error occurred ... ' . $e->getMessage();
    }
    return $res;
}

function importRegistration($source, $destination, $maxCol) {
    $res = array('status' => 'failed', 'data' => 'Unable to process spreadsheet ... ' . PHP_EOL);
    try {
        if (@file_exists('./lib/libs/classes/excel/excel_reader.php')) {
            require_once('./lib/libs/classes/excel/excel_reader.php');
        } else {
            $res['data'] = 'Unable to load excel reader library';
            return $res;
        }
        if (@file_exists('./lib/libs/classes/excel/SpreadsheetReader.php')) {
            require_once('./lib/libs/classes/excel/SpreadsheetReader.php');
        } else {
            $res['data'] = 'Unable to load spreadsheet reader library';
            return $res;
        }
        if (file_exists('./lib/libs/classes/enconding.php')) {
            require_once './lib/libs/classes/enconding.php';
        } else {
            $res['data'] = 'Unable to load Encoding library';
            return $res;
        }
        $Spreadsheet = new SpreadsheetReader($source);
        $Sheets = $Spreadsheet->Sheets();
        $res['data'] = array();
        foreach ($Sheets as $Index => $Name) {
            array_push($res['data'], array('sheet' => $Name, 'rows' => array()));
            $Spreadsheet->ChangeSheet($Index);
            $row_position = 0;
            $row_id = 1;
            foreach ($Spreadsheet as $Key => $Row) {
                $cols = array();
                if (isset($Row[2]) && strlen(SystemUtils::trimToNumeric($Row[2])) >= 6) {
                    if ($maxCol > sizeof($Row)) {
                        $maxCol = sizeof($Row);
                    }
                    $Row[0] = $row_id;
                    for ($i = 0; $i < $maxCol; $i++) {
                        array_push($cols, trim(Encoding::toUTF8($Row[$i])));
                    }
                    $cols[$maxCol] = 0;
                    $row_id++;
                    $row_position++;
                    unset($Row);
                    array_push($res['data'][$Index]['rows'], $cols);
                }
            }
            array_unshift($res['data'][$Index]['rows'], array('No', 'First Name', 'Last Name', 'Sex', 'phone', 'email', 'username'));
        }
        if (isset($res['data'][0]['rows']) && sizeof($res['data'][0]['rows']) >= 1) {
            $res['status'] = 'success';
        }
        if ('return' == $destination) {
            return $res;
        } else {
            if (file_put_contents($destination, json_encode($res['data'], true), FILE_APPEND)) {
                $res['status'] = 'success';
                $res['data'] = 'The excel data has been exported to json and saved at ' . $destination;
            } else {
                $res['status'] = 'failed';
                $res['data'] = 'The excel data has been exported to json but not saved at ' . $destination;
            }
        }
    } catch (Exception $e) {
        $res['data'] = 'Unable to process spreadsheet' . PHP_EOL . ' An exception ' . $e->getMessage() . ' trace ' . $e->getTraceAsString();
        SystemUtils::logActivity('user', $_SESSION['app'], 'failed to import Registration with excel_reader ' . $e->getMessage() . ' trace ' . $e->getTraceAsString());
    }
    return $res;
}

function createTableImportsRecord($postfix) {
    try {
        R::exec("CREATE TABLE IF NOT EXISTS `imports" . $postfix . "` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userkey` varchar(255) NOT NULL,
  `context` varchar(25) NOT NULL,
  `import` longtext,
  `import_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
        return true;
    } catch (Exception $e) {
        SystemUtils::logActivity('user', $_SESSION['app'], 'failed to createTableImportsRecord ' . $e->getMessage() . ' trace ' . $e->getTraceAsString());
    }
    return false;
}

function saveImportedRecord($postfix, $context, $data) {
    $bean = R::dispense('imports' . $postfix);
    $bean->context = $context;
    $bean->import = $data;
    $bean->import_date = date("Y-m-d H:i:s");
    return R::store($bean);
}


function processImportedRegistrationSheet($data, $ip, $type) {

    $added = sizeof($data);
    if ($added < 1) {
        return array('status' => 'failed', 'added' => 0);
    }
    $i = 0;
    $count = $added;
    while ($i < $count) {
        try {
            if (intval(SystemUtils::trimToNumeric($data[$i][0])) >= 1) { //No. mendatory to avoid headers
                $data[$i][1] = explode(' ', $data[$i][1]); //names
                $data[$i][1][0] = ucfirst(strtolower(trim($data[$i][1][0]))); //first name
                if (!isset($data[$i][1][1])) {
                    $data[$i][1][1] = '  ';
                } else {
                    $data[$i][1][1] = ucfirst(strtolower(trim($data[$i][1][1])));  //last name
                }
                $data[$i][2] = trim($data[$i][2]); //ID / passport
                if ($type == 'business' && strlen($data[$i][2]) != 9) {
                    $added--;
                    $i++;
                    continue;
                }
                if (strlen($data[$i][3]) < 10) { //phone --unique key
                    $data[$i][3] = '250700' . $data[$i][0] . rand(10000, 99999);
                } else {
                    $data[$i][3] = SystemUtils::trimToNumeric($data[$i][3]);
                }
                $email = $data[$i][3] . '@nfnv.rw';
                $data[$i][3] = SystemUtils::formatPhoneNumber($data[$i][3]);
                $data[$i][4] = strtolower(trim($data[$i][4])); //Province
                if (strpos($data[$i][4], 'rengerazuba') || strpos($data[$i][4], 'west')) {
                    $data[$i][4] = 'Iburengerazuba';
                } else if (strpos($data[$i][4], 'rasirarazuba') || strpos($data[$i][4], 'ast')) {
                    $data[$i][4] = 'Iburasirazuba';
                } else if (strpos($data[$i][4], 'ruguru') || strpos($data[$i][4], 'north')) {
                    $data[$i][4] = 'Amajyaruguru';
                } else if (strpos($data[$i][4], 'epfo') || strpos($data[$i][4], 'south')) {
                    $data[$i][4] = 'Amajyepfo';
                }
                $data[$i][4] = ucfirst($data[$i][4]);
                $data[$i][5] = ucfirst(strtolower(trim($data[$i][5]))); //District
                $data[$i][6] = ucfirst(strtolower(trim($data[$i][6]))); //Sector
                $data[$i][7] = ucfirst(strtolower(trim($data[$i][7]))); //Cell
                $data[$i][8] = ucfirst(strtolower(trim($data[$i][8]))); //Profession Text
                $data[$i][9] = SystemUtils::trimToNumeric($data[$i][9]); //Category
                if (!isset($data[$i][9])) {
                    $data[$i][9] = 0;
                }
                $Bean = R::findOne('registrations', 'registrant_id=? OR  SUBSTRING(registrant_phone,-14)=?', array($data[$i][2], substr(SystemUtils::formatPhoneNumber($data[$i][3]), -14)));
                if ($Bean) {
                    $Bean->registrant_firstname = $data[$i][1][0];
                    $Bean->registrant_lastname = $data[$i][1][1];
                    $Bean->registrant_id = $data[$i][2];
                    $Bean->registrant_phone = $data[$i][3];
                    $Bean->registrant_province = $data[$i][4];
                    $Bean->registrant_district = $data[$i][5];
                    $Bean->registrant_sector = $data[$i][6];
                    $Bean->registrant_cell = $data[$i][7];
                    $Bean->assigned_income = $data[$i][9];
                    $Bean->profession_text = $data[$i][8];
                    $Bean->datelastlogin = date("Y-m-d H:i:s");
                    $Bean->ipaccess = $ip;
                    if (R::store($Bean) < 1) {
                        $added--;
                    }
                } else {
                    $pin = '-' . rand(1000000, 9999999);
                    $Bean = R::dispense('registrations');
                    $Bean->registrant_key = SystemUtils::generateKey(250, false, true);
                    $Bean->registrant_pin = $pin;
                    $Bean->registrant_firstname = $data[$i][1][0];
                    $Bean->registrant_lastname = $data[$i][1][1];
                    $Bean->registrant_id = $data[$i][2];
                    $Bean->registrant_type = $type;
                    $Bean->registrant_email = $email;
                    $Bean->registrant_ref = $_SESSION['admin_fname'] . ' ' . $_SESSION['admin_lname'];
                    $Bean->registrant_phone = $data[$i][3];
                    $Bean->registrant_province = $data[$i][4];
                    $Bean->registrant_district = $data[$i][5];
                    $Bean->registrant_sector = $data[$i][6];
                    $Bean->registrant_cell = $data[$i][7];
                    $Bean->assigned_income = $data[$i][9];
                    $Bean->profession_text = $data[$i][8];
                    $Bean->dateregistered = date("Y-m-d H:i:s");
                    $Bean->datelastlogin = date("Y-m-d H:i:s");
                    $Bean->ipaccess = $ip;
                    if (R::store($Bean) < 1) {
                        $added--;
                    }
                }
            } else {
                $added--;
            }
        } catch (Exception $e) {
            $added--;
           echo 'user', $_SESSION['app'], 'failed to process Imported RegistrationSheet with msg ' . $e->getMessage() . ' trace ' . $e->getTraceAsString();
        }
        $i++;
    }
    if ($added < 1) {
        return array('status' => 'failed', 'added' => 0);
    }
    return array('status' => 'success', 'added' => $added);
}

function saveImportedRegistrations($data, $ip, $type) {
    $res = array('status' => 'failed', 'data' => 'Unable to process data ... ' . PHP_EOL);
    if (!in_array($type, array('Members', 'business'))) {
        $res['data'] .= ' Only individual and business registrations can be imported.';
        return $res;
    }
    try {
        if (!isset($data[0]['rows'])) {
            $res['data'] .= ' Data format is bad.';
            return $res;
        }
        R::begin();
        $added = 0;
        for ($i = 0; $i < sizeof($data); $i++) {
            $sheet = processImportedRegistrationSheet($data[$i]['rows'], $ip, $type);
            if ($sheet['status'] == 'success') {
                $added+= $sheet['added'];
            }
        }
        if ($added > 1) {
            R::commit();
            $res['data'] = $added . ' registrants have been added to NFNV registration directory';
            $res['status'] = 'success';
            fixOldPins();
        } else {
            $res['data'] = ' No registrant has been added to NFNV registration directory';
        }
    } catch (Exception $e) {
        $res['data'] = 'Unable to process save imported registrations  ' . PHP_EOL . ' An exception ' . $e->getMessage() . ' trace ' . $e->getTraceAsString();
        echo 'user', $_SESSION['app'], 'failed to saveImportedRegistrations with excel_reader ' . $e->getMessage() . ' trace ' . $e->getTraceAsString();
    }
    return $res;
}

