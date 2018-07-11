var app = angular.module('myAsid', ['asid.services', 'angularUtils.directives.dirPagination']);

//================================  this is the control of the login page   ==================================//

app.controller('ctr_login', function($scope, Data, $window) {
	var adminSex = "male";
	$scope.idAdmin = 0;
	$scope.idMember = 0;
	$scope.hideLogin = function() {
		_('form_login').style.display = 'none';
		_('register').style.display = 'block';
	};
	$scope.hideLoginWorker = function() {
		_('form_login_worker').style.display = 'none';
		_('register_worker').style.display = 'block';
	};
	$scope.hideRegistration = function() {
		_('form_login').style.display = 'block';
		_('register').style.display = 'none';
		_('form_login_worker').style.display = 'block';
		_('register_worker').style.display = 'none';
	};

	$scope.login = function() {
		var logins = {};
		var username = _('log_username').value;
		var log_password = _('log_password').value;

		if (username == "" || log_password == "") {
			_('isa_error_login').style.display = "block";
			_('isa_error_message_login').innerHTML = "Please fill the form correctly";
			setTimeout(hidden_error_sign_in, 3000);
			return false;
		}
		logins.usr = username;
		logins.pswd = log_password;
		_('img_succes_loading').style.visibility = "visible";
		Data.post('/login/credentials', {
			dashData : logins
		}).success(function(response) {
			_('img_succes_loading').style.visibility = "hidden";
			if (response.status == "success") {
				$window.location.href = response.data;
			} else {
				_('isa_error_login').style.display = "block";
				_('isa_error_message_login').innerHTML = response.data;
				setTimeout(hidden_error_sign_in, 10000);
			}
		}).error(function(err) {
			console.log(err);
		});
	};

	$scope.loginWorker = function() {
		var loginsWorker = {};
		var username = _('W_username').value;
		var password = _('W_password').value;

		if (username == "" || password == "") {
			_('isa_error_login_worker').style.display = "block";
			_('isa_error_message_login_worker').innerHTML = "  Please Fill the Form Correctly";
			setTimeout(hidden_error_sign_in_worker, 4000);
			return false;
		}
		loginsWorker.usr = username;
		loginsWorker.pswd = password;
		_('img_succes_loading_login_worker').style.visibility = "visible";
		Data.post('/login/credentials/worker', {
			dashData : loginsWorker
		}).success(function(response) {
			_('img_succes_loading_login_worker').style.visibility = "hidden";
			if (response.status == "success") {
				$window.location.href = response.data;
			} else {
				_('isa_error_login_worker').style.display = "block";
				_('isa_error_message_login_worker').innerHTML = response.data;
				setTimeout(hidden_error_sign_in_worker, 4000);
			}
		}).error(function(err) {
			console.log(err);
		});
	};

	$scope.toggleSex = function(sex) {
		adminSex = sex;
		return adminSex;
	};

	$scope.register = function() {
		var admins = {};
		var f_name = _('f_name').value;
		var l_name = _('l_name').value;
		var id_number = _('id_number').value;
		var email = _('email').value;
		var phone = _('phone').value;
		var sex = adminSex;
		var age = _('age').value;
		var username = _('username').value;
		var password = _('password').value;
		var password2 = _('password2').value;

		if (f_name == "" || f_name.length < 2) {
			_('isa_error_register').style.display = "block";
			_('isa_error_message_register').innerHTML = f_name + ' is not a firstname';
			setTimeout(hidden_error_register, 3000);
			return false;
		}
		if (l_name == "" || l_name.length < 2) {
			_('isa_error_register').style.display = "block";
			_('isa_error_message_register').innerHTML = 'check if ' + l_name + ' is empty or valid lastname';
			setTimeout(hidden_error_register, 3000);
			return false;
		}

		if (id_number == "" || !(validateNumber(id_number))) {
			_('isa_error_register').style.display = "block";
			_('isa_error_message_register').innerHTML = 'check if ' + id_number + ' is empty or valid ID number';
			setTimeout(hidden_error_register, 3000);
			return false;
		}
		if (validateEmail(email) == false) {
			_('isa_error_register').style.display = "block";
			_('isa_error_message_register').innerHTML = email + '  is not a valide email';
			setTimeout(hidden_error_register, 3000);
			return false;
		}
		if (phone == "" || !(validateNumber(phone))) {
			_('isa_error_register').style.display = "block";
			_('isa_error_message_register').innerHTML = phone + '  is not a valid phone number';
			setTimeout(hidden_error_register, 3000);
			return false;
		}
		if (sex == "") {
			_('isa_error_register').style.display = "block";
			_('isa_error_message_register').innerHTML = ' select the gender please';
			setTimeout(hidden_error_register, 3000);
			return false;
		}
		if (age == "" || !(validateNumber(age))) {
			_('isa_error_register').style.display = "block";
			_('isa_error_message_register').innerHTML = age + ' age must be a number ';
			setTimeout(hidden_error_register, 3000);
			return false;
		}
		if (username == "" || username.length <= 4) {
			_('isa_error_register').style.display = "block";
			_('isa_error_message_register').innerHTML = 'your username ' + username + ' is empty or under 5 character ';
			setTimeout(hidden_error_register, 3000);
			return false;
		}
		if (password == "" || password.length < 8) {
			_('isa_error_register').style.display = "block";
			_('isa_error_message_register').innerHTML = 'Your password field is empty or less than 8 characters ';
			setTimeout(hidden_error_register, 3000);
			return false;
		}
		if (password2 == "") {
			_('isa_error_register').style.display = "block";
			_('isa_error_message_register').innerHTML = 'fill the second password field';
			setTimeout(hidden_error_register, 3000);
			return false;
		}
		if (password != password2) {
			_('isa_error_register').style.display = "block";
			_('isa_error_message_register').innerHTML = ' Your passwords do not match';
			setTimeout(hidden_error_register, 3000);
			return false;
		}

		admins.fname = f_name;
		admins.lname = l_name;
		admins.idnumber = id_number;
		admins.email = email;
		admins.phone = phone;
		admins.sex = sex;
		admins.age = age;
		admins.usernme = username;
		admins.pass = password;

		_('img_succes_loading').style.visibility = "visible";
		Data.post('/register/admin', {
			dashData : admins
		}).success(function(response) {
			_('img_succes_loading').style.visibility = "hidden";
			if (response.status == "success") {
				$scope.idAdmin = response.id;
				_('isa_success_register').style.display = "block";
				_('isa_success_message_register').innerHTML = response.data;
				_('registration_form').reset();
				setTimeout(hidden_registration_form, 6000);

			} else {
				_('isa_error_register').style.display = "block";
				_('isa_error_message_register').innerHTML = response.data;
				setTimeout(hidden_error_register, 10000);
			}
		}).error(function(err) {
			console.log(err);
		});
	};

	$scope.register_member = function() {
		var admins_member = {};
		var f_name = _('f_name_worker').value;
		var l_name = _('l_name_worker').value;
		var email = _('email_worker').value;
		var phone = _('phone_worker').value;
		var id_card = _('id_card_worker').value;
		var sex = adminSex;
		var username = _('username_worker').value;
		var password = _('password_worker').value;

		if (f_name == "" || f_name.length < 2) {
			_('isa_error_register_worker').style.display = "block";
			_('isa_error_message_register_worker').innerHTML = f_name + ' is not a firstname';
			setTimeout(hidden_error_register_worker, 3000);
			return false;
		}
		if (l_name == "" || l_name.length < 2) {
			_('isa_error_register_worker').style.display = "block";
			_('isa_error_message_register_worker').innerHTML = 'check if ' + l_name + ' is empty or valid lastname';
			setTimeout(hidden_error_register_worker, 3000);
			return false;
		}

		if (validateEmail(email) == false) {
			_('isa_error_register').style.display = "block";
			_('isa_error_message_register_worker').innerHTML = email + '  is not a valide email';
			setTimeout(hidden_error_register_worker, 3000);
			return false;
		}
		if (phone == "" || !(validateNumber(phone))) {
			_('isa_error_register_worker').style.display = "block";
			_('isa_error_message_register_worker').innerHTML = phone + '  is not a valid phone number';
			setTimeout(hidden_error_register_worker, 3000);
			return false;
		}
		if (id_card == "" || !(validateNumber(id_card))) {
			_('isa_error_register_worker').style.display = "block";
			_('isa_error_message_register_worker').innerHTML = id_card + '  is not a valid ID Card number';
			setTimeout(hidden_error_register_worker, 3000);
			return false;
		}
		if (sex == "") {
			_('isa_error_register_worker').style.display = "block";
			_('isa_error_message_register_worker').innerHTML = ' select the gender please';
			setTimeout(hidden_error_register_worker, 3000);
			return false;
		}
		if (username == "" || username.length <= 4) {
			_('isa_error_register_worker').style.display = "block";
			_('isa_error_message_register_worker').innerHTML = 'your username ' + username + ' is empty or under 5 character ';
			setTimeout(hidden_error_register_worker, 3000);
			return false;
		}
		if (password == "" || password.length < 8) {
			_('isa_error_register_worker').style.display = "block";
			_('isa_error_message_register_worker').innerHTML = 'Your password field is empty or less than 8 characters ';
			setTimeout(hidden_error_register_worker, 3000);
			return false;
		}

		admins_member.fname = f_name;
		admins_member.lname = l_name;
		admins_member.email = email;
		admins_member.phone = phone;
		admins_member.id_card = id_card;
		admins_member.sex = sex;
		admins_member.usernme = username;
		admins_member.pass = password;

		_('img_succes_loading_worker').style.visibility = "visible";
		Data.post('/registration/member', {
			dashData : admins_member
		}).success(function(response) {
			_('img_succes_loading_worker').style.visibility = "hidden";
			if (response.status == "success") {
				$scope.idMember = response.id;
				_('isa_success_register_worker').style.display = "block";
				_('isa_success_message_register_worker').innerHTML = response.data;
				_('registration_form_worker').reset();
				setTimeout(hidden_registration_form_worker, 5000);

			} else {
				_('isa_error_register_worker').style.display = "block";
				_('isa_error_message_register_worker').innerHTML = response.data;
				setTimeout(hidden_error_register_worker, 5000);
			}
		}).error(function(err) {
			console.log(err);
		});
	};

});

//================================ this is the control of members (add, view and edit)  ===============
app.controller('ctr_members', function($scope, Data, $window) {
	var memberSex = "male";
	$scope.pagerecord = 10;
	$scope.pagerecordadminscoop = 6;
	$scope.import_message = "Please wait...";
	$scope.spreadsheets = [];
	$scope.header_row = ['No', 'First Name', 'Last Name', 'Sex', 'Country', 'Dob', 'Crime date', 'Crime type'];

	$scope.logout = function() {
		Data.
		delete ('/logout').success(function(response) {
			location.reload();
		}).error(function(err) {
			console.log('connection failed.');
		});
	};

	$scope.startmembertools = function(btnid, adminId, btn, waitMessage) {
		$scope.displayuserprofile();
		$scope.uploadexcel(btn, waitMessage);
		$scope.members();
		$scope.adminsCoop();
		$scope.uploadProfile(btnid, adminId);
	};

	$scope.getdetailStatistics = function() {
		Data.get('/member/statistics').success(function(response) {
			$scope.membercount = response.membercount.membercount;
			$scope.countFemale = response.female.femalecount;
			$scope.countMale = response.male.malecount;
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.adminsCoop = function() {
		_('refresh_admins').style.visibility = 'visible';
		Data.get('/admins/cooperative/list').success(function(response) {
			$scope.adminsCooperative_list = response.data;
			_('refresh_admins').style.visibility = 'hidden';
		}).error(function(err) {
			console.warn(err);
			_('refresh_admins').style.visibility = 'hidden';
		});
	};

	$scope.members = function() {
		_('refresh_memebers').style.visibility = "visible";
		Data.get('/members/list').success(function(response) {
			$scope.members_list = response.data;
			_('refresh_memebers').style.visibility = "hidden";
			$scope.profile(response.data[0]);
			$scope.getdetailStatistics();
		}).error(function(err) {
			console.warn(err);
			_('refresh_memebers').style.visibility = "hidden";
		});
	};

	$scope.toggleSex = function(sex) {
		memberSex = sex;
		return memberSex;
	};

	$scope.displayuserprofile = function() {
		Data.get('/user/login/info').success(function(response) {
			$scope.user_profile = response.data;
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.addMember = function() {
		var members = {};
		var f_name = _('f_name').value;
		var l_name = _('l_name').value;
		var sex = memberSex;
		var birthday = _('birthday').value;
		var phone = _('phone').value;
		var email = _('email').value;
		var location = _('location').value;
		var ID = _('ID').value;
		var admitted_year = _('admitted_year').value;
		var username = _('username').value;
		var password = _('pswd').value;

		if (f_name == "" || f_name.length <= 2) {
			_('isa_error_add_member').style.display = "block";
			_('isa_error_message_add_member').innerHTML = ' ' + 'Check if ' + '<b>' + f_name + '<b>' + ' is empty or at least greater than 2 characters';
			setTimeout(hidden_error_add_member, 3000);
			return false;
		}
		if (l_name == "" || l_name.length < 2) {
			_('isa_error_add_member').style.display = "block";
			_('isa_error_message_add_member').innerHTML = ' ' + 'Check if ' + '<b>' + l_name + '<b>' + ' is empty or at least greater than 2 characters';
			setTimeout(hidden_error_add_member, 3000);
			return false;
		}
		if (sex == "") {
			_('isa_error_add_member').style.display = "block";
			_('isa_error_message_add_member').innerHTML = ' ' + ' select the gender please';
			setTimeout(hidden_error_add_member, 3000);
			return false;
		}
		if (phone == "" || !(validateNumber(phone))) {
			_('isa_error_add_member').style.display = "block";
			_('isa_error_message_add_member').innerHTML = ' ' + phone + '  is not a valid phone number';
			setTimeout(hidden_error_add_member, 3000);
			return false;
		}
		if (validateEmail(email) == false) {
			_('isa_error_add_member').style.display = "block";
			_('isa_error_message_add_member').innerHTML = ' ' + email + '  is not a valide email';
			setTimeout(hidden_error_add_member, 3000);
			return false;
		}
		if (ID == "" || !(validateNumber(ID))) {
			_('isa_error_add_member').style.display = "block";
			_('isa_error_message_add_member').innerHTML = ' ' + 'check if ' + ID + ' is empty or valid ID number';
			setTimeout(hidden_error_add_member, 3000);
			return false;
		}
		if (username == "") {
			_('isa_error_add_member').style.display = "block";
			_('isa_error_message_add_member').innerHTML = 'Your username field is empty ';
			setTimeout(hidden_error_add_member, 3000);
			return false;
		}

		if (password == "" || password.length < 8) {
			_('isa_error_add_member').style.display = "block";
			_('isa_error_message_add_member').innerHTML = 'Your password field is empty or less than 8 characters ';
			setTimeout(hidden_error_add_member, 3000);
			return false;
		}

		members.fname = f_name;
		members.lname = l_name;
		members.sex = sex;
		members.birthday = birthday;
		members.phone = phone;
		members.email = email;
		members.location = location;
		members.ID = ID;
		members.admitted_year = admitted_year;
		members.usernme = username;
		members.pass = password;

		_('img_succes_loading').style.visibility = "visible";
		Data.post('/add/member', {
			dashData : members
		}).success(function(response) {
			_('img_succes_loading').style.visibility = "hidden";
			if (response.status == "success") {
				//$scope.idAdmin = response.id;
				_('add_member').style.display = "none";
				_('isa_success_add_member').style.display = "block";
				_('isa_success_message_add_member').innerHTML = response.data;
				_('form_addnewmember').reset();
				setTimeout(hidden_error_add_member, 5000);
				_('add_member').style.display = "block";
				$scope.members();

			} else {
				_('isa_error_add_member').style.display = "block";
				_('isa_error_message_add_member').innerHTML = response.data;
				setTimeout(hidden_error_add_member, 5000);
				_('add_member').style.display = "block";

			}
		}).error(function(err) {
			console.log(err);
		});
	};

	$scope.editMember = function(obj) {
		_('add_member').style.display = "none";
		_('edit_member').style.display = "block";
		$scope.f_name = obj.fname;
		$scope.l_name = obj.lname;
		$scope.sex = obj.sex;
		$scope.birthday = obj.birthday;
		$scope.phone = obj.contact;
		$scope.email = obj.email;
		$scope.location = obj.postaddress;
		$scope.ID = obj.nationalid;
		//$scope.payment = parseInt(obj.payment);
		$scope.admitted_year = obj.admittedyear;
		$scope.username = obj.username;
		$scope.pswd = obj.password;
		$scope.member_id = obj.id;
		if (obj.sex == "male") {
			_("male").checked = true;
			_("female").checked = false;
		} else {
			_("male").checked = false;
			_("female").checked = true;
		}

		var memberToEdit = [{
			"f_name" : obj.fname
		}, {
			"l_name" : obj.lname
		}, {
			"$scope.sex" : obj.sex
		}, {
			"$scope.birthday" : obj.birthday
		}, {
			"$scope.phone" : obj.contact
		}, {
			"$scope.email" : obj.email
		}, {
			"$scope.location" : obj.postaddress
		}, {
			"$scope.ID" : obj.nationalid
		}, {
			"$scope.payment" : parseInt(obj.payment)
		}, {
			"$scope.admitted_year" : obj.admittedyear
		}, {
			"$scope.member_id" : obj.id
		}];
		return memberToEdit;
	};

	$scope.editMemberFinal = function(id, f_name, l_name, birthday, phone, email, location, ID, payment, admitted_year, username, pswd) {

		if (f_name == "" || f_name.length <= 2) {
			_('isa_error_add_member').style.display = "block";
			_('isa_error_message_add_member').innerHTML = ' ' + 'Check if ' + '<b>' + f_name + '<b>' + ' is empty or at least greater than 2 characters';
			setTimeout(hidden_error_add_member, 3000);
			return false;
		}
		if (l_name == "" || l_name.length < 2) {
			_('isa_error_add_member').style.display = "block";
			_('isa_error_message_add_member').innerHTML = ' ' + 'Check if ' + '<b>' + l_name + '<b>' + ' is empty or at least greater than 2 characters';
			setTimeout(hidden_error_add_member, 3000);
			return false;
		}

		if (validateEmail(email) == false) {
			_('isa_error_add_member').style.display = "block";
			_('isa_error_message_add_member').innerHTML = ' ' + email + '  is not a valide email';
			setTimeout(hidden_error_add_member, 3000);
			return false;
		}
		if (ID == "" || !(validateNumber(ID))) {
			_('isa_error_add_member').style.display = "block";
			_('isa_error_message_add_member').innerHTML = ' ' + 'check if ' + ID + ' is empty or valid ID number';
			setTimeout(hidden_error_add_member, 3000);
			return false;
		}

		var info = {};
		info.id = id;
		info.f_name = f_name;
		info.l_name = l_name;
		info.sex = memberSex;
		info.birthday = birthday;
		info.phone = phone;
		info.email = email;
		info.location = location;
		info.username = username;
		info.passwd = pswd;
		info.idcard = ID;
		//info.payment = payment;
		info.admitted_year = admitted_year;
		Data.post('/edit/member', {
			dashData : info
		}).success(function(response) {
			if (response.status == "success") {
				_('edit_member').style.display = "none";
				_('isa_success_add_member').style.display = "block";
				_('isa_success_message_add_member').innerHTML = response.data;
				_('form_addnewmember').reset();
				setTimeout(hidden_error_add_member, 3000);
				_('add_member').style.display = "block";
				$scope.members();
			} else {
				_('edit_member').style.display = "none";
				_('add_member').style.display = "none";
				_('isa_error_add_member').style.display = "block";
				_('isa_error_message_add_member').innerHTML = response.data;
				setTimeout(hidden_error_add_member, 3000);
				_('add_member').style.display = "block";

			}
		}).error(function(err) {
			console.log(err);
		});

	};

	$scope.profile = function(member) {
		$scope.details_profile = member.profile;
		$scope.details_admitted = member.admitted_year;
		$scope.details_fname = member.fname;
		$scope.details_lname = member.lname;
		$scope.details_email = member.email;
		$scope.details_postaddress = member.postaddress;
		$scope.details_birthday = member.birthday;
		$scope.details_contact = member.contact;
		$scope.details_nationalid = member.nationalid;
		$scope.details_sex = member.sex;
	};

	$scope.addAdminCoop = function() {
		var admin_coop = {};
		var f_name = _('admin_fname').value;
		var l_name = _('admin_lname').value;
		var birthday = _('admin_birthday').value;
		var email = _('admin_email').value;
		var phone = _('admin_phone').value;
		var id_card = _('admin_ID').value;
		var adminSex = memberSex;
		var sex = adminSex;
		var address = _('admin_address').value;
		var position = _('admin_position').value;
		var username = _('admin_username').value;
		var pswd = _('admin_pswd').value;

		if (f_name == "" || f_name.length < 2) {
			_('isa_error_add_admin').style.display = "block";
			_('isa_error_message_add_admin').innerHTML = ' ' + 'Check if ' + '<b> firstname <b>' + ' is empty or at least greater than 2 characters';
			setTimeout(hidden_error_add_admin_coop, 3000);
			return false;
		}
		if (l_name == "" || l_name.length < 2) {
			_('isa_error_add_admin').style.display = "block";
			_('isa_error_message_add_admin').innerHTML = ' ' + 'Check if ' + '<b>  lastname  <b>' + ' is empty or at least greater than 2 characters';
			setTimeout(hidden_error_add_admin_coop, 3000);
			return false;
		}

		if (id_card == "" || !(validateNumber(id_card))) {
			_('isa_error_add_admin').style.display = "block";
			_('isa_error_message_add_admin').innerHTML = id_card + '  must be only in numbers';
			setTimeout(hidden_error_add_admin_coop, 3000);
			return false;
		}
		if (validateEmail(email) == false) {
			_('isa_error_add_admin').style.display = "block";
			_('isa_error_message_add_admin').innerHTML = email + ' It is not a valide email';
			setTimeout(hidden_error_add_admin_coop, 3000);
			return false;
		}
		if (phone == "" || !(validateNumber(phone))) {
			_('isa_error_add_admin').style.display = "block";
			_('isa_error_message_add_admin').innerHTML = phone + ' It is not a valide phone number';
			setTimeout(hidden_error_add_admin_coop, 3000);
			return false;
		}
		if (sex == "") {
			_('isa_error_add_admin').style.display = "block";
			_('isa_error_message_add_admin').innerHTML = ' Select the gender please';
			setTimeout(hidden_error_add_admin_coop, 3000);
			return false;
		}

		admin_coop.fname = f_name;
		admin_coop.lname = l_name;
		admin_coop.birthday = birthday;
		admin_coop.email = email;
		admin_coop.phone = phone;
		admin_coop.idnumber = id_card;
		admin_coop.sex = sex;
		admin_coop.address = address;
		admin_coop.position = position;
		admin_coop.username = username;
		admin_coop.pswd = pswd;
		_('img_succes_loading').style.visibility = "visible";
		Data.post('/add/admin/coop', {
			dashData : admin_coop
		}).success(function(response) {
			_('img_succes_loading').style.visibility = "hidden";
			if (response.status == "success") {
				_('isa_success_add_admin').style.display = "block";
				_('isa_success_message_add_admin').innerHTML = response.data;
				_('add_admin_coop_form').reset();
				setTimeout(hidden_error_add_admin_coop, 5000);
				$scope.adminsCoop();
			} else {
				_('isa_error_add_admin').style.display = "block";
				_('isa_error_message_add_admin').innerHTML = response.data;
				setTimeout(hidden_error_add_admin_coop, 5000);
			}
		}).error(function(err) {
			console.log(err);
		});

	};

	$scope.editStatus = function(status, id) {
		var status_id_pair = {};
		var new_status = status;
		var new_id = id;

		status_id_pair.status = new_status;
		status_id_pair.id = new_id;

		Data.post('/update/admin/status', {
			dashData : status_id_pair
		}).success(function(response) {
			if (response.status == "success") {
				var priority = 'success';
				var title = 'success';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});
				$scope.adminsCoop();
			} else {
				var priority = 'error';
				var title = 'error';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});
			}
		}).error(function(err) {
			console.warn(err);
		});

	};

	$scope.editStatusOfMember = function(status, id) {
		var status_id_pair = {};
		var new_status = status;
		var new_id = id;

		status_id_pair.status = new_status;
		status_id_pair.id = new_id;

		Data.post('/update/member/status', {
			dashData : status_id_pair
		}).success(function(response) {
			if (response.status == "success") {
				var priority = 'success';
				var title = 'success';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});
				$scope.members();
			} else {
				var priority = 'error';
				var title = 'error';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});
			}
		}).error(function(err) {
			console.warn(err);
		});
	};
	$scope.editPrivilege = function(id, prive) {
		Data.get('/update/admin/privilege/' + id + '/' + prive).success(function(response) {
			if (response.status === "success") {
				$scope.adminsCoop();
				swal("YES", response.data, "success");
			} else {
				swal("OOPS...", response.data, "error");
			}
		}).error(function(err) {
			console.log(err);
		});
	};

	//upload photo
	$scope.uploadProfile = function(idbtn, email) {
		var btn = _(idbtn);
		var progressBar = _('progressBar2');
		var progressOuter = _('progressOuter2');
		new ss.SimpleUpload({
			button : btn,
			url : '/admin/image/' + email,
			name : 'upl',
			multipart : true,
			noParams : true,
			hoverClass : 'hover',
			focusClass : 'focus',
			responseType : 'json',
			allowedExtensions : ['jpg', 'jpeg', 'png'],
			startXHR : function() {
				progressOuter.style.display = 'block';
				this.setProgressBar(progressBar);
			},
			onComplete : function(filename, response) {
				progressOuter.style.display = 'none';
				if (response.status === "success") {
					alert(response.data);
					$scope.displayuserprofile();
				} else {
					alert(response.data);
				}
			},
			onError : function() {
				progressOuter.style.display = 'none';
			}
		});
	};

	//excel here...

	$scope.uploadexcel = function(btn, waitMessage) {
		var mybtn = _(btn);
		new ss.SimpleUpload({
			button : mybtn,
			url : '/admin/import/registration',
			name : 'upl',
			multipart : true,
			noParams : true,
			hoverClass : 'hover',
			focusClass : 'focus',
			responseType : 'json',
			allowedExtensions : [],
			onSubmit : function() {
				_(waitMessage).style.visibility = 'visible';
			},
			onComplete : function(filename, response) {
				if (response.status === "success") {
					var priority = 'success';
					var title = 'success';
					var message = 'file uploaded successful';
					$.toaster({
						priority : priority,
						title : title,
						message : message
					});
					$scope.spreadsheets = response.data;
					$scope.import_message = 'Processing ... it may take a while.';
					setTimeout(deletemyMessage, 30000);
				} else {
					var priority = 'error';
					var title = 'error';
					var message = response.data;
					$.toaster({
						priority : priority,
						title : title,
						message : message
					});
				}
			}
		});
	};

	$scope.save_excel = function(data, context) {
		$scope.import_message = 'Please wait ...';
		Data.post('/admin/import/registration/' + context, {
			dashData : data
		}).success(function(responce) {
			if (responce.status === "success") {
				$scope.import_message = responce.data;
				setTimeout(deletemyMessage, 5000);
			} else {
				$scope.import_message = responce.data;
				setTimeout(deletemyMessage, 5000);
			}
		}).error(function(err) {
			console.log('connection failed.');
		});
	};

	$scope.choosecontext = function(context) {
		_('twobtngroup').style.visibility = 'visible';
		$scope.context = context;
	};

});

//================================  this is the control of the finance-contribution page   ==================================//\
app.controller('ctr_financecontrib', function($scope, Data, $window) {

	$scope.thisyear = parseInt(new Date().getFullYear());

	if (parseInt(new Date().getMonth() + 1).length > 1) {
		$scope.thisyMonth = parseInt(new Date().getMonth() + 1);
	} else {
		$scope.thisyMonth = '0' + parseInt(new Date().getMonth() + 1);
	}

	//FEES ng-selected
	$scope.collapse = true;
	$scope.monthselected = $scope.thisyMonth;
	$scope.yearselected = $scope.thisyear;
	//BUDGET ng-selected
	$scope.monthselected_budget = $scope.thisyMonth;
	$scope.yearselected_budget = $scope.thisyear;

	$scope.collapsetoggle = function(myvalue, myid) {
		$('#' + myid).slideToggle();
		$scope.collapse = myvalue;
	};

	$scope.logout = function() {
		Data.
		delete ('/logout').success(function(response) {
			location.reload();
		}).error(function(err) {
			console.log('connection failed.');
		});
	};

	$scope.addInterest = function() {
		var interset = _("interest_perc").value;
		if (interset == "" || interset < 0 || interset > 100) {
			_('isa_error_interest').style.display = "block";
			_('isa_error_message_interest').innerHTML = "The interset must be a number between '0' and '100'";
			return;
		}
		Data.post('/add/interset', {
			dashData : {
				"interset" : interset
			}
		}).success(function(response) {
			if (response.status == "success") {
				_('isa_success_interest').style.display = "block";
				_('isa_success_message_interest').innerHTML = "Successfully changed.";
				$scope.interest_perc = response.data;
			} else {
				_('isa_error_interest').style.display = "block";
				_('isa_error_message_interest').innerHTML = response.data;
				;
			}
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.startFinContr = function(btnid, adminId) {
		$scope.membersRequestsDetail();
		$scope.membersapproveDetail();
		$scope.memberssuspendedDetail();
		$scope.membersdisapproveDetail();
		$scope.uploadProfile(btnid, adminId);
		$scope.displayuserprofile();
		$scope.selectBudgetByMonth($scope.thisyMonth, $scope.thisyear);
		$scope.getCooperativeFinance();
		$scope.selectMemberByMonth($scope.thisyMonth, $scope.thisyear);
	};

	$scope.getCooperativeFinance = function() {
		Data.get('/tables/count/contribution').success(function(response) {
			$scope.copstartingDate = response.startingDate;
			$scope.copfinanceamounttotal = response.amountTotalCop;
			$scope.copDurationCop = response.DurationCop;
			$scope.cooperativeCapital = response.cooperativeCapital;
			$scope.interest_perc = response.cooperativeRequestInterset;
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.showYearDeatailFinance = function(year) {
		_('loadingif1').style.display = "block";
		Data.get('/annualy/finance/' + year).success(function(response) {
			_('loadingif1').style.display = "none";
			$scope.amountExpected = response.amountExpected;
			$scope.amountavailable = response.amountavailable;
			$scope.amountavailablePercent = parseInt(($scope.amountavailable * 100) / $scope.amountExpected);
			$scope.annualLyRequestAmount = response.annualLyRequestAmount;
			$scope.annualLyRequestApproved = response.annualLyRequestApproved;
			$scope.annualLyRequestSuspended = response.annualLyRequestSuspended;
			$scope.annualLyRequestDisapproved = response.annualLyRequestDisapproved;
			$scope.annualLyRequestApprovedPercent = parseInt(($scope.annualLyRequestApproved * 100) / $scope.annualLyRequestAmount);
			$scope.annualLyRequestSuspendedPercent = parseInt(($scope.annualLyRequestSuspended * 100) / $scope.annualLyRequestAmount);
			$scope.annualLyRequestDisapprovedPercent = parseInt(($scope.annualLyRequestDisapproved * 100) / $scope.annualLyRequestAmount);
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.assumedInterest = function(req_id, selected_date, r_amount, prposed_date, interest) {
		if (selected_date == undefined) {
			swal("OOPS...", "You must pick a date before proceed.", "error");
			return;
		}
		Data.get('/assumed/interest/' + req_id + '/ ' + selected_date + '/' + r_amount + '/' + prposed_date + '/' + interest).success(function(response) {
			$scope.will_pay = response.data;
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.SetmonthTable = function(year, month, amount, deadline) {
		if (!validateNumber(amount)) {
			_('isa_error_setmonth').style.display = "block";
			_('isa_error_message_setmonth').innerHTML = "Make sure that the amount is only in numbers";
			setTimeout(hidden_error_setmonth, 4000);
			return false;
		}
		_('spinnermonthly').style.visibility = "visible";
		Data.get('/set/month/' + year + '/' + month + '/' + amount + '/' + deadline).success(function(response) {
			_('spinnermonthly').style.visibility = "hidden";
			if (response.status == "success") {
				$scope.selectMemberByMonth(month, year);
				_('isa_success_setmonth').style.display = "block";
				_('isa_success_message_setmonth').innerHTML = response.data;
				setTimeout(hidden_error_setmonth, 4000);
			} else {
				_('isa_success_setmonth').style.display = "none";
				_('isa_error_setmonth').style.display = "block";
				_('isa_error_message_setmonth').innerHTML = response.data;
				setTimeout(hidden_error_setmonth, 4000);
			}
		}).error(function(err) {
			console.warn(err);
			_('spinnermonthly').style.visibility = "hidden";
		});
	};

	$scope.SetmonthTableyear = function(year, amount) {

		if (!validateNumber(amount)) {
			_('isa_error_setmonthyear').style.display = "block";
			_('isa_error_message_setmonthyear').innerHTML = "Make sure that the amount is only in numbers";
			setTimeout(hidden_error_setmonth, 4000);
			return false;
		}
		_('spinneryearly').style.visibility = "visible";
		Data.get('/set/month/yearly/' + year + '/' + amount).success(function(response) {
			_('spinneryearly').style.visibility = "hidden";
			if (response.status == "success") {
				$scope.selectMemberByMonth("01", year);
				_('isa_success_setmonthyear').style.display = "block";
				_('isa_success_message_setmonthyear').innerHTML = response.data;
				setTimeout(hidden_error_setmonth, 4000);
			} else {
				_('isa_success_setmonthyear').style.display = "none";
				_('isa_error_setmonthyear').style.display = "block";
				_('isa_error_message_setmonthyear').innerHTML = response.data;
				setTimeout(hidden_error_setmonth, 4000);
			}
		}).error(function(err) {
			console.warn(err);
			_('spinneryearly').style.visibility = "hidden";
		});
	};
	$scope.popContribMember = function(member_id, input_id) {
		_(input_id).disabled = false;
	};

	$scope.popContribMemberSave = function(member_id, input_id, month, year, total) {
		var update_contr = {};
		var amount = _(input_id).value;
		update_contr.member_id = member_id;
		update_contr.amount = amount;
		update_contr.month = month;
		update_contr.year = year;

		Data.post('/member/contribution/update', {
			dashData : update_contr
		}).success(function(response) {
			if (response.status == "success") {
				var priority = 'success';
				var title = 'success';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});
				$scope.selectMemberByMonth(month, year);
			} else {
				var priority = 'error';
				var title = 'error';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});
			}
		}).error(function(err) {
			console.warn(err);
		});
	};
	$scope.budgetHistCorrespond = function(myid, mybudgethistory) {
		$scope.contrib_historic_modal = myid;
		var i = (mybudgethistory.length) - 1;
		$scope.myhistorybudget_ = [];
		for (i; i >= 0; i--) {
			$scope.myhistorybudget_.push({
				"h_email" : mybudgethistory[i].split(',')[0],
				"h_amount" : mybudgethistory[i].split(',')[1],
				"h_desc" : mybudgethistory[i].split(',')[2],
				"h_date" : mybudgethistory[i].split(',')[3]
			});
		}
	};

	$scope.getCorresponda = function(myid, myhist, fname, lname) {
		$scope.mycorresponded = myid;
		$scope.myhist = myhist;
		$scope.memberHistname = fname + " " + lname;
	};

	$scope.selectMemberByMonth = function(month, year) {
		_('loadingif').style.display = "block";
		_('contributionSpinner').style.visibility = "visible";
		$scope.monthsetted = month;
		$scope.yearsetted = year;
		$scope.monthselected = month;
		$scope.yearselected = year;
		$scope.myhistories = [];
		Data.get('/members/list/contribution/' + year + '/' + month).success(function(response) {
			_('loadingif').style.display = "none";
			_('contributionSpinner').style.visibility = "hidden";
			if (response.status == "success") {
				$scope.contributions = response.data;
				$scope.sum_total = response.sum_total[0];
				$scope.sum_remaining = response.sum_remaining[0];
				$scope.sum_payed = response.sum_payed[0];
			} else {
				var priority = 'error';
				var title = 'error';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});
			}
			$scope.showYearDeatailFinance($scope.thisyear);

		}).error(function(err) {
			console.warn(err);
			_('loadingif').style.display = "none";
			_('contributionSpinner').style.visibility = "hidden";
		});
	};

	$scope.displayuserprofile = function() {
		Data.get('/user/login/info').success(function(response) {
			$scope.user_profile = response.data;
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.membersRequestsDetail = function() {
		Data.get('/members/request/detail').success(function(response) {
			$scope.members_requestsDetail = response.data;
			$scope.members_requests = response.count;
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.membersRequestslist = function() {
		Data.get('/members/request/list').success(function(response) {
			$scope.members_requests_list = response.data;
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.membersapproveDetail = function() {
		Data.get('/members/approve/detail').success(function(response) {
			$scope.members_approveDetail = response.data;
			$scope.members_approves = response.count;
		}).error(function(err) {
			console.warn(err);
		});
	};
	$scope.memberssuspendedDetail = function() {
		Data.get('/members/spended/detail').success(function(response) {
			$scope.members_suspendedDetail = response.data;
			$scope.members_suspended = response.count;
		}).error(function(err) {
			console.warn(err);
		});
	};
	$scope.membersdisapproveDetail = function() {
		Data.get('/members/disapprove/detail').success(function(response) {
			$scope.members_disapproveDetail = response.data;
			$scope.members_dispprove = response.count;
		}).error(function(err) {
			console.warn(err);
		});
	};

	//upload photo
	$scope.uploadProfile = function(idbtn, email) {
		var btn = _(idbtn);
		var progressBar = _('progressBar2');
		var progressOuter = _('progressOuter2');
		new ss.SimpleUpload({
			button : btn,
			url : '/admin/image/' + email,
			name : 'upl',
			multipart : true,
			noParams : true,
			hoverClass : 'hover',
			focusClass : 'focus',
			responseType : 'json',
			allowedExtensions : ['jpg', 'jpeg', 'png'],
			startXHR : function() {
				progressOuter.style.display = 'block';
				this.setProgressBar(progressBar);
			},
			onComplete : function(filename, response) {
				progressOuter.style.display = 'none';
				if (response.status === "success") {
					alert(response.data);
					$scope.displayuserprofile();
				} else {
					alert(response.data);
				}
			},
			onError : function() {
				progressOuter.style.display = 'none';
			}
		});
	};

	$scope.readRequestlist = function(member_id, request_id) {
		$scope.membersRequestslist();
		Data.get('/member/request/' + member_id).success(function(response) {
			$scope.requestes_list = response.data;
			$scope.readRequest(member_id, request_id);
			$scope.readMemberHistory(member_id);
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.readMemberHistory = function(member_id) {
		Data.get('/member/history/' + member_id).success(function(response) {
			for (var i = 0; response.length > i; i++) {
				response[i].month = $scope.switchmonth(response[i].month);
			}
			$scope.memberhistory_list = response.data;
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.readRequest = function(member_id, request_id) {
		_('readRequest').style.display = "block";
		Data.get('/member/request/' + member_id + '/' + request_id).success(function(response) {
			$scope.requestes = response.data;
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.dismissRequest = function() {
		_('readRequest').style.display = "none";
	};

	$scope.Disaprove = function(id, mId, reason) {
		Data.get('/disaprouve/request/' + id + '/' + reason).success(function(response) {
			if (response.status == "success") {
				var priority = 'success';
				var title = 'success';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});
				$scope.membersRequestsDetail();
				$scope.membersapproveDetail();
				$scope.memberssuspendedDetail();
				$scope.membersdisapproveDetail();
				$scope.readRequestlist(mId, id);
			} else {
				var priority = 'error';
				var title = 'error';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});
			}
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.Suspend = function(id, mId, reason, adminDate) {
		Data.get('/suspend/request/' + id + '/' + reason + '/' + adminDate).success(function(response) {
			if (response.status == "success") {
				var priority = 'success';
				var title = 'success';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});
				$scope.membersRequestsDetail();
				$scope.membersapproveDetail();
				$scope.memberssuspendedDetail();
				$scope.membersdisapproveDetail();
				$scope.readRequestlist(mId, id);
			} else {
				var priority = 'error';
				var title = 'error';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});
			}
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.reaprove = function(id, mId) {
		Data.get('/reaprove/request/' + id).success(function(response) {
			if (response.status == "success") {
				var priority = 'success';
				var title = 'success';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});
				$scope.membersRequestsDetail();
				$scope.membersapproveDetail();
				$scope.memberssuspendedDetail();
				$scope.membersdisapproveDetail();
				$scope.readRequestlist(mId, id);
			} else {
				var priority = 'error';
				var title = 'error';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});
			}
		}).error(function(err) {
			console.warn(err);
		});
	};
	$scope.aprove = function(id, mId, capital, request, interest, deadline) {
		Data.get('/aprove/request/' + id + '/' + capital + '/' + request + '/' + deadline + '/' + interest).success(function(response) {
			if (response.status == "success") {
				var priority = 'success';
				var title = 'success';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});
				$scope.membersRequestsDetail();
				$scope.membersapproveDetail();
				$scope.memberssuspendedDetail();
				$scope.membersdisapproveDetail();
				$scope.readRequestlist(mId, id);
				$scope.getCooperativeFinance();
				swal("APPROVED", response.data, "success");
			} else {
				var priority = 'error';
				var title = 'error';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});
			}
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.popLoanMember = function(input_id) {
		_(input_id).disabled = false;
	};

	$scope.popLoanMemberSave = function(loan_id, member_id, input_id) {
		var update_loan = {};
		var loan_settlement = _(input_id).value;
		update_loan.loan_id = loan_id;
		update_loan.member_id = member_id;
		update_loan.loan_settlement = loan_settlement;
		Data.post('/member/loan/update', {
			dashData : update_loan
		}).success(function(response) {
			if (response.status == "success") {
				var priority = 'success';
				var title = 'success';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});
				_(input_id).disabled = true;
				$scope.readRequestlist(member_id, loan_id);
			} else {
				var priority = 'error';
				var title = 'error';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});
			}
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.selectBudgetByMonth = function(month, year) {
		_('loadingif_budget').style.display = "block";
		_('budgetSpinner').style.visibility = "visible";
		$scope.monthsetted_budget = month;
		$scope.yearsetted_budget = year;
		$scope.monthselected_budget = month;
		$scope.yearselected_budget = year;
		Data.get('/monthly/budget/list/' + year + '/' + month).success(function(response) {
			_('loadingif_budget').style.display = "none";
			_('budgetSpinner').style.visibility = "hidden";
			if (response.status == "success") {
				$scope.budget_details = response.data;
				$scope.sum_amount = response.totalBudget;
				$scope.sum_expense = response.totalExpense;
				$scope.sum_remain = response.totalremain;

			} else {
				var priority = 'error';
				var title = 'error';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});
			}
		}).error(function(err) {
			console.warn(err);
			_('loadingif_budget').style.display = "none";
			_('budgetSpinner').style.visibility = "hidden";
		});
	};

	$scope.setMonthBudget = function(capital) {
		var the_budget = {};
		var budget_name = _('budget_name').value;
		var budget_month = _('budgetmonthselected').value;
		var budget_year = _('budgetyearselected').value;
		var budget_amount = _('budget_amount').value;
		the_budget.budget_name = budget_name;
		the_budget.budget_month = budget_month;
		the_budget.budget_year = budget_year;
		the_budget.budget_amount = budget_amount;
		the_budget.capital = capital;

		Data.post('/add/month/budget', {
			dashData : the_budget
		}).success(function(response) {
			if (response.status == "success") {
				_('isa_success_budget').style.display = "block";
				_('isa_success_message_budget').innerHTML = response.data;
				setTimeout(hidden_error_budget, 3000);
				$scope.getCooperativeFinance();
				$scope.selectBudgetByMonth(budget_month, budget_year);
			} else {
				_('isa_error_budget').style.display = "block";
				_('isa_error_message_budget').innerHTML = response.data;
				setTimeout(hidden_error_budget, 3000);
			}
		}).error(function(err) {
			console.log(err);
		});
	};

	$scope.editBudget = function(modalpop, id, name, amount, year, month) {
		$scope.budget_edit_modal = modalpop;
		$scope.budget_edit_id = id;
		$scope.name_edit_budget = name;
		$scope.budget_edit_amount = amount;
		$scope.budget_edit_year = year;
		$scope.budget_edit_month = month;
	};

	$scope.amountToIncrementOnBudget = function(budget_edit_id, new_budget, state, current_budg, year, month) {
		switch(state) {
			case 'increment':
				Data.get('/increment/budget/' + budget_edit_id + '/' + new_budget).success(function(response) {
					if (response.status == "success") {
						_('isa_success_edit_budget').style.display = "block";
						_('isa_success_message_edit_budget').innerHTML = response.data;
						setTimeout(hidden_error_budget, 5000);
						$scope.budget_edit_amount = response.new_budg_total;
						$scope.selectBudgetByMonth(month, year);
					} else {
						_('isa_error_edit_budget').style.display = "block";
						_('isa_error_message_edit_budget').innerHTML = response.data;
						setTimeout(hidden_error_budget, 10000);
						$scope.budget_edit_amount = current_budg;
					}
				}).error(function(err) {
					console.warn(err);
				});
				break;
			case 'decrement':
				Data.get('/decrement/budget/' + budget_edit_id + '/' + new_budget).success(function(response) {
					if (response.status == "success") {
						_('isa_success_edit_budget').style.display = "block";
						_('isa_success_message_edit_budget').innerHTML = response.data;
						setTimeout(hidden_error_budget, 5000);
						$scope.budget_edit_amount = response.new_budg_total;
						$scope.selectBudgetByMonth(month, year);
					} else {
						_('isa_error_edit_budget').style.display = "block";
						_('isa_error_message_edit_budget').innerHTML = response.data;
						setTimeout(hidden_error_budget, 10000);
						$scope.budget_edit_amount = current_budg;
					}
				}).error(function(err) {
					console.warn(err);
				});
				break;
		}
	};

	$scope.getTheBudgetDetails = function(obj) {
		$scope.mybudgetobj = obj;
		$scope.budg_name = obj.budgetname;
		$scope.budg_remain = obj.budgetremaining;
	};

	$scope.registNewExpense = function(budg_id_, budg_name_, budg_remain_, budg_year_, budg_month_) {
		console.log(budg_id_, budg_name_, budg_remain_, budg_year_, budg_month_);
		var the_expense = {};
		var exp_amount = parseInt(_('exp_amount').value);
		var exp_descr = _('exp_descr').value;

		if (exp_amount == "") {
			_('isa_error_expense').style.display = "block";
			_('isa_error_message_expense').innerHTML = "Set the expense amount Please";
			setTimeout(hidden_error_budget, 4000);
			return;
		}
		if (exp_amount > parseInt(budg_remain_)) {
			_('isa_error_expense').style.display = "block";
			_('isa_error_message_expense').innerHTML = " The expense is greater than the remaing!";
			setTimeout(hidden_error_budget, 4000);
			return;
		}
		if (exp_descr == "") {
			_('isa_error_expense').style.display = "block";
			_('isa_error_message_expense').innerHTML = "Set the expense description Please";
			setTimeout(hidden_error_budget, 4000);
			return;
		}

		the_expense.budg_id = budg_id_;
		the_expense.budg_name = budg_name_;
		the_expense.budg_year = budg_year_;
		the_expense.budg_month = budg_month_;
		the_expense.exp_amount = exp_amount;
		the_expense.exp_descr = exp_descr;

		Data.post('/add/expense', {
			dashData : the_expense
		}).success(function(response) {
			if (response.status == "success") {
				_('isa_success_expense').style.display = "block";
				_('isa_success_message_expense').innerHTML = response.data;
				$scope.selectBudgetByMonth(budg_month_, budg_year_);
				$scope.getSingleBudgetRemain(budg_id_);
				_('exp_amount').value = "";
				_('exp_descr').value = "";
				setTimeout(hidden_error_budget, 4000);
			} else {
				_('isa_error_expense').style.display = "block";
				_('isa_error_message_expense').innerHTML = response.data;
				setTimeout(hidden_error_budget, 4000);
			}
		}).error(function(err) {
			console.log(err);
		});
	};

	$scope.getSingleBudgetRemain = function(id) {
		Data.get('/single/budget/remain/' + id).success(function(response) {
			if (response.status == "success") {
				$scope.budg_remain = response.data;
			} else {
				$scope.budg_remain = "Not Available";
			}
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.getincomeslist = function() {
		Data.get('/root/income/name').success(function(response) {
			if (response.status == "success") {
				$scope.incomeslist = response.data;
			}
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.getincomeslisthavingchildren = function(state, myvalue) {
		$scope.incomeslisthavingchildren="";
		$scope.mysub_income_tabs_withChildren = "";		
		Data.get('/root/income/name/having/children').success(function(response) {
			if (response.status == "success") {
				$scope.incomeslisthavingchildren = response.data;
				if (state == "initial" || response.data.length>=1) {
					$scope.subtabsHavingChildren(response.data[0].name);
				} else {
					$scope.subtabsHavingChildren(myvalue);
				}
			}
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.addIncome = function() {
		var root_income_name = _('root_income_name').value;
		if (root_income_name == "") {
			_('isa_error_root_income').style.display = "block";
			_('isa_error_message_root_income').innerHTML = "Specify the name please";
			setTimeout(hidden_error_income, 3000);
			return false;
		}
		Data.post('/add/root/income/name', {
			dashData : {
				"income_name" : root_income_name
			}
		}).success(function(response) {
			if (response.status == "success") {
				_('isa_success_root_income').style.display = "block";
				_('isa_success_message_root_income').innerHTML = response.data;
				$scope.getincomeslist();
				_('root_income_name').value = "";
				setTimeout(hidden_error_income, 3000);
			} else {
				_('isa_error_root_income').style.display = "block";
				_('isa_error_message_root_income').innerHTML = response.data;
				setTimeout(hidden_error_income, 3000);
			}
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.addChildToRootIncome = function(income_master) {
		var the_child = {};
		var income_name = _('income_name').value;
		var income_responsible = _('income_responsible').value;
		var income_responsible_phone = _('income_responsible_phone').value;
		var income_type = _('income_type').value;
		var income_location = _('income_location').value;
		var income_description = _('income_description').value;
		var income_payment = _('income_payment').value;


		if (income_name == "") {
			_('isa_error_add_income').style.display = "block";
			_('isa_error_message_add_income').innerHTML = "Specify the name please";
			setTimeout(hidden_error_income, 3000);
			return false;
		}
		if (income_responsible == "") {
			_('isa_error_add_income').style.display = "block";
			_('isa_error_message_add_income').innerHTML = "Specify who is in charge please";
			setTimeout(hidden_error_income, 3000);
			return false;
		}
		if (income_responsible_phone == "" || !validateNumber(income_responsible_phone)) {
			_('isa_error_add_income').style.display = "block";
			_('isa_error_message_add_income').innerHTML = "Specify the phone and make sure it is a number";
			setTimeout(hidden_error_income, 3000);
			return false;
		}
		if (income_type == "") {
			_('isa_error_add_income').style.display = "block";
			_('isa_error_message_add_income').innerHTML = "Select the payment type please";
			setTimeout(hidden_error_income, 3000);
			return false;
		}
		if (income_location == "") {
			_('isa_error_root_income').style.display = "block";
			_('isa_error_message_root_income').innerHTML = "Specify the location please";
			setTimeout(hidden_error_income, 3000);
			return false;
		}

		if (income_description == "") {
			_('isa_error_add_income').style.display = "block";
			_('isa_error_message_add_income').innerHTML = "Make a description please";
			setTimeout(hidden_error_income, 3000);
			return false;
		}
		if (income_payment == "" || !validateNumber(income_payment)) {
			_('isa_error_add_income').style.display = "block";
			_('isa_error_message_add_income').innerHTML = "Specify the amount and make sure it is a number";
			setTimeout(hidden_error_income, 3000);
			return false;
		}
		the_child.income_master = income_master;
		the_child.income_name = income_name;
		the_child.income_responsible = income_responsible;
		the_child.income_responsible_phone = income_responsible_phone;
		the_child.income_type = income_type;
		the_child.income_location = income_location;
		the_child.income_description = income_description;
		the_child.income_payment = income_payment;

		Data.post('/add/income/child', {
			dashData : the_child
		}).success(function(response) {
			if (response.status == "success") {
				_('isa_success_add_income').style.display = "block";
				_('isa_success_message_add_income').innerHTML = response.data;
				setTimeout(hidden_error_income, 3000);
				_('form_addIncome').reset();
				$scope.getincomeslist();
				$scope.getincomeslisthavingchildren('notinitial',income_master);
			} else {
				_('isa_error_add_income').style.display = "block";
				_('isa_error_message_add_income').innerHTML = response.data;
				setTimeout(hidden_error_income, 3000);
			}
		}).error(function(err) {
			console.log(err);
		});
	};

	$scope.subIncome = function(pop_id, pop_name) {
		$scope.sub_incoome = pop_id;
		$scope.my_pop_name = pop_name;
		$scope.mysub_income = [];
		Data.get('/all/sub/income/' + $scope.my_pop_name).success(function(response) {
			if (response.status == "success") {
				$scope.mysub_income = response.data;
			}
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.subtabsHavingChildren = function(name) {
		$scope.sub_inc_tab_content = "";
		$scope.sub_inc_tab_content.name = name;
		$scope.mysub_income_tabs_withChildren = "";
		Data.get('/all/sub/income/having/children/' + name).success(function(response) {
			if (response.status == "success") {
				$scope.mysub_income_tabs_withChildren = response.data;
			}
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.subtabs = function(name) {
		$scope.sub_inc_tab_content = "";
		$scope.sub_inc_tab_content.name = name;
		$scope.mysub_income_tabs = [];
		Data.get('/all/sub/income/' + name).success(function(response) {
			if (response.status == "success") {
				$scope.mysub_income_tabs = response.data;
			}
		}).error(function(err) {
			console.warn(err);
		});

	};

	$scope.clickIncome = function() {
		$scope.getincomeslist();
		$scope.getincomeslisthavingchildren('initial', "ok");
	};

	$scope.editSubIncomeStatus = function(status, id, table_name) {
		console.log(status, id, table_name);
		Data.get('/subincome/status/' + status + '/' + id + '/' + table_name).success(function(response) {
			if (response.status == "success") {
				var priority = 'success';
				var title = 'success';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});
				$scope.getincomeslisthavingchildren('notinitial',table_name);
			} else {
				var priority = 'error';
				var title = 'error';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});
			}
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.popEditIncomeName = function(income_id, input_id) {
		_(input_id).disabled = false;
	};

	$scope.popEditIncomeNameSave = function(input_id, id) {
		var table_name = _(input_id).value;
		Data.get('/edit/income/name/' + id + '/' + table_name).success(function(response) {
			if (response.status == "success") {
				var priority = 'success';
				var title = 'success';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});

			} else {
				var priority = 'error';
				var title = 'error';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});
			}
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.editAllSubIncome = function(input_Name, input_responsable, input_phone, input_payment, input_location, input_description) {
		_(input_Name).disabled = false;
		_(input_responsable).disabled = false;
		_(input_phone).disabled = false;
		_(input_payment).disabled = false;
		_(input_location).disabled = false;
		_(input_description).disabled = false;

	};

	$scope.editAllSubIncomeSave = function(my_pop_name, id, name, responsable, phone, payment, location, description, input_Name, input_responsable, input_phone, input_payment, input_location, input_description) {
		var name = _(input_Name).value;
		var responsable = _(input_responsable).value;
		var phone = _(input_phone).value;
		var payment = _(input_payment).value;
		var location = _(input_location).value;
		var description = _(input_description).value;

		Data.get('/edit/all/subincome/' + my_pop_name + '/' + id + '/' + name + '/' + responsable + '/' + phone + '/' + payment + '/' + location + '/' + description).success(function(response) {
			if (response.status == "success") {
				var priority = 'success';
				var title = 'success';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});
				_(input_Name).disabled = true;
				_(input_responsable).disabled = true;
				_(input_phone).disabled = true;
				_(input_payment).disabled = true;
				_(input_location).disabled = true;
				_(input_description).disabled = true;

			} else {
				var priority = 'error';
				var title = 'error';
				var message = response.data;
				$.toaster({
					priority : priority,
					title : title,
					message : message
				});
			}
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.editSubIncomePayment = function(tab_picked, input_Amount, input_date) {
		_(input_Amount).disabled = false;
		_(input_date).disabled = false;

	};

	$scope.editSubIncomePaymentSave = function(table_name, id, input_amount, input_date) {
		var amount = _(input_amount).value;
		var picked_date = _(input_date).value;
		console.log(table_name, id, amount, picked_date);

		// Data.get('/edit/all/subincome/' + my_pop_name + '/' + id + '/' + name +  '/' + description).success(function(response) {
		// if (response.status == "success") {
		// var priority = 'success';
		// var title = 'success';
		// var message = response.data;
		// $.toaster({
		// priority : priority,
		// title : title,
		// message : message
		// });
		// $scope.subincomeHavingChildren(my_pop_name);
		// _(input_Name).disabled = true;
		// _(input_responsable).disabled = true;
		// _(input_phone).disabled = true;
		// _(input_payment).disabled = true;
		// _(input_location).disabled = true;
		// _(input_description).disabled = true;
		//
		// } else {
		// var priority = 'error';
		// var title = 'error';
		// var message = response.data;
		// $.toaster({
		// priority : priority,
		// title : title,
		// message : message
		// });
		// }
		// }).error(function(err) {
		// console.warn(err);
		// });
	};


$(document).ready(function() {
 
    $(window).on('focus', function(event) {
        $('.show-focus-status > .alert-danger').addClass('hidden');
        $('.show-focus-status > .alert-success').removeClass('hidden');
    }).on('blur', function(event) {
        $('.show-focus-status > .alert-success').addClass('hidden');
        $('.show-focus-status > .alert-danger').removeClass('hidden');
    });    
    
    $('.date-picker').each(function () {
        var $datepicker = $(this),
            cur_date = ($datepicker.data('date') ? moment($datepicker.data('date'), "YYYY/MM/DD") : moment()),
            format = {
                "weekday" : ($datepicker.find('.weekday').data('format') ? $datepicker.find('.weekday').data('format') : "dddd"),                
                "date" : ($datepicker.find('.date').data('format') ? $datepicker.find('.date').data('format') : "MMMM Do"),
                "year" : ($datepicker.find('.year').data('year') ? $datepicker.find('.weekday').data('format') : "YYYY")
            };

        function updateDisplay(cur_date) {    
            $datepicker.find('.date-container > .weekday').text(cur_date.format(format.weekday));
            $datepicker.find('.date-container > .date').text(cur_date.format(format.date));
            $datepicker.find('.date-container > .year').text(cur_date.format(format.year));
            $datepicker.data('date', cur_date.format('YYYY/MM/DD'));
            $datepicker.find('.input-datepicker').removeClass('show-input');
        }
        
        updateDisplay(cur_date);

        $datepicker.on('click', '[data-toggle="calendar"]', function(event) {
            event.preventDefault();
            $datepicker.find('.input-datepicker').toggleClass('show-input');
        });

        $datepicker.on('click', '.input-datepicker > .input-group-btn > button', function(event) {
            event.preventDefault();
            var $input = $(this).closest('.input-datepicker').find('input'),
                date_format = ($input.data('format') ? $input.data('format') : "YYYY/MM/DD");
            if (moment($input.val(), date_format).isValid()) {
               updateDisplay(moment($input.val(), date_format));
            }else{
                alert('Invalid Date');
            }
        });
        
        $datepicker.on('click', '[data-toggle="datepicker"]', function(event) {
            event.preventDefault();
            
            var cur_date = moment($(this).closest('.date-picker').data('date'), "YYYY/MM/DD"),
                date_type = ($datepicker.data('type') ? $datepicker.data('type') : "days"),
                type = ($(this).data('type') ? $(this).data('type') : "add"),
                amt = ($(this).data('amt') ? $(this).data('amt') : 1);
                
            if (type == "add") {
                cur_date = cur_date.add(date_type, amt);
            }else if (type == "subtract") {
                cur_date = cur_date.subtract(date_type, amt);
            }
            
            updateDisplay(cur_date);
        });
        
        if ($datepicker.data('keyboard') == true) {
            $(window).on('keydown', function(event) {
                if (event.which == 37) {
                    $datepicker.find('span:eq(0)').trigger('click');  
                }else if (event.which == 39) {
                    $datepicker.find('span:eq(1)').trigger('click'); 
                }
            });
        }
        
    });
});


	// var piechart = _("pieChart");
	//
	// MotionChart = new Chart(piechart, {
	// type : 'pie',
	// data : {
	// labels : ["Moving", "Idle", "Parked"],
	// datasets : [{
	// data : [300, 50, 100],
	// backgroundColor : ["#27AE60", "#f1c40f", "#C0392B"],
	// hoverBackgroundColor : ["#27AE60", "#f1c40f", "#C0392B"]
	// }]
	// }
	// });
	//
	// var barchart = _("barChart");
	// var myBarChart = new Chart(barchart, {
	// type : 'bar',
	// data : {
	// labels : ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
	// datasets : [{
	// label : "My First dataset",
	// backgroundColor : ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)', 'rgba(107, 125, 15, 0.2)', 'rgba(45, 57, 225, 0.2)', 'rgba(77, 180, 50, 0.2)', 'rgba(120, 12, 58, 0.2)', 'rgba(99, 200, 15, 0.2)', 'rgba(42, 5, 120, 0.2)'],
	// borderColor : ['rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)', 'rgba(107, 125, 15, 1)', 'rgba(45, 57, 225, 1)', 'rgba(80, 180, 50,1)', 'rgba(120, 12, 58, 1)', 'rgba(99, 200, 15, 1)', 'rgba(42, 5, 120, 1)'],
	// borderWidth : 1,
	// data : [65, 59, 80, 81, 56, 55, 40,20,58,90,12,150],
	// }]
	// },
	//
	// });

});

//================================  this is the control of the communication page   ==================================//

app.controller('ctr_communication', function($scope, Data, $window) {
	$scope.descrLimit = 30;
	$scope.listOfemail = [];
	$scope.name = '';
	$scope.networkid = 0;
	$scope.logout = function() {
		Data.
		delete ('/logout').success(function(response) {
			location.reload();
		}).error(function(err) {
			console.log('connection failed.');
		});
	};

	$scope.communicationCtr = function(btnid, adminId) {
		$scope.displayuserprofile();
		$scope.uploadProfile(btnid, adminId);
		$scope.members();
		$scope.networks();
	};
	$scope.displayuserprofile = function() {
		Data.get('/user/login/info').success(function(response) {
			$scope.user_profile = response.data;
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.members = function() {
		Data.get('/members/list').success(function(response) {
			$scope.members_list = response.data;
		}).error(function(err) {
			console.warn(err);
		});
	};
	$scope.uploadProfile = function(idbtn, email) {
		var btn = _(idbtn);
		var progressBar = _('progressBar2');
		var progressOuter = _('progressOuter2');
		new ss.SimpleUpload({
			button : btn,
			url : '/admin/image/' + email,
			name : 'upl',
			multipart : true,
			noParams : true,
			hoverClass : 'hover',
			focusClass : 'focus',
			responseType : 'json',
			allowedExtensions : ['jpg', 'jpeg', 'png'],
			startXHR : function() {
				progressOuter.style.display = 'block';
				this.setProgressBar(progressBar);
			},
			onComplete : function(filename, response) {
				progressOuter.style.display = 'none';
				if (response.status === "success") {
					alert(response.data);
					$scope.displayuserprofile();
				} else {
					alert(response.data);
				}
			},
			onError : function() {
				progressOuter.style.display = 'none';
			}
		});
	};

	$scope.checkClickEvent = function(id, email) {
		if ($("#" + id).is(':checked')) {
			$scope.listOfemail.push(email);
		}
		if (!($("#" + id).is(':checked'))) {
			var index = $scope.listOfemail.indexOf(email);
			$scope.listOfemail.splice(index, 1);
		}
	};

	$scope.errorNetworkBlur = function() {
		if (_('network').value === "" || _('network').value.length < 5) {
			_('error_network_name').style.visibility = "visible";
		} else {
			$scope.name = _('network').value;
			_('error_network_name').style.visibility = "hidden";
		}
	};

	$scope.createNetwork = function() {
		if (_('network').value === "" || _('network').value.length < 5) {
			_('error_network_name').style.visibility = "visible";
			return;
		}
		if ($scope.listOfemail.length < 2) {
			swal("OOPS...", "Network must must have at least 2 People.", "error");
			return;
		}
		Data.post('/add/network', {
			dashData : {
				"networkname" : $scope.name,
				"emails" : $scope.listOfemail
			}
		}).success(function(response) {
			if (response.status == "success") {
				$scope.networks();
				_('isa_success_net').style.display = "block";
				_('isa_success_message_net').innerHTML = response.data;
				setTimeout(hidden_error_communication, 5000);
			} else {
				_('isa_error_net').style.display = "block";
				_('isa_error_message_add_net').innerHTML = response.data;
				setTimeout(hidden_error_communication, 5000);
			}
		}).error(function(err) {
			console.log(err);
		});
	};

	$scope.networks = function() {
		Data.get('/list/networks').success(function(response) {
			$scope.networkings = response.data;
			$scope.selectNetwork(response.data[0]);
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.changeStatus = function(state, id) {
		switch(state) {
			case 'active':
				Data.get('/active/network/' + id).success(function(response) {
					$scope.networks();
				}).error(function(err) {
					console.warn(err);
				});
				break;
			case 'desactive':
				Data.get('/desactive/network/' + id).success(function(response) {
					$scope.networks();
				}).error(function(err) {
					console.warn(err);
				});
				break;
		}
	};

	$scope.switchmonth = function(month) {
		switch(month) {
			case '01':
				month = 'Jan';
				break;
			case '02':
				month = 'Feb';
				break;
			case '03':
				month = 'Mar';
				break;
			case '04':
				month = 'Apr';
				break;
			case '05':
				month = 'May';
				break;
			case '06':
				month = 'Jun';
				break;
			case '07':
				month = 'Jul';
				break;
			case '08':
				month = 'Aug';
				break;
			case '09':
				month = 'Sep';
				break;
			case '10':
				month = 'Oct';
				break;
			case '11':
				month = 'Nov';
				break;
			case '12':
				month = 'Dec';
				break;
		}
		return month;
	};

	$scope.selectNetwork = function(info) {
		$scope.networkname = info.networkname;
		$scope.networkstatus = info.status;
		$scope.networkcreatorid = info.creator;
		$scope.networkid = info.id;
		$scope.networkaudience = info.serialdata;
		$scope.members_network = [];
		$scope.messagesInNetwork($scope.networkid);
		var i = 0;
		while (info.names.length > i) {
			$scope.members_network.push({
				"m_names" : info.names[i],
				"m_profiles" : info.profiles[i]
			});
			i++;
		}
	};

	$scope.sendChat = function(c1, n2, a4, n5) {
		_('sendMessage').innerHTML = "Sending...";
		Data.post('/chat/message', {
			dashData : {
				"chatMessage" : c1,
				"networkcreatorid" : n2,
				"networkid" : $scope.networkid,
				"author" : a4,
				"networkaudience" : n5
			}
		}).success(function(response) {
			_('sendMessage').innerHTML = "Please wait...";
			if (response.status == "success") {
				$scope.chatMessage = "";
				_('sendMessage').innerHTML = "Sent.";
				$scope.messagesInNetwork($scope.networkid);
				_('sendMessage').innerHTML = "Send";
			} else {
				_('sendMessage').innerHTML = response.data;
			}
		}).error(function(err) {
			console.log(err);
		});
	};

	$scope.messagesInNetwork = function() {
		$scope.messagesin = [];
		Data.get('/list/message/' + $scope.networkid).success(function(response) {
			$scope.messagesin = response.data;
		}).error(function(err) {
			console.warn(err);
		});
	};

});

//================================  this is the control of the news page   ==================================//

app.controller('ctr_news', function($scope, Data, $window) {
	var mp_in_all = {};
	$scope.logout = function() {
		Data.
		delete ('/logout').success(function(response) {
			location.reload();
		}).error(function(err) {
			console.log('connection failed.');
		});
	};

	$scope.startNews = function(btnid, adminId) {
		$scope.displayuserprofile();
		$scope.uploadProfile(btnid, adminId);

	};

	$scope.displayuserprofile = function() {
		Data.get('/user/login/info').success(function(response) {
			$scope.user_profile = response.data;
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.placeNext = function() {
		var place = _('mp_place').value;
		if (place == "") {
			_('isa_error_place').style.display = "block";
			_('isa_error_message_place').innerHTML = "  Enter the place please";
			setTimeout(hidden_error_marketplace, 3000);
		}
		mp_in_all.place = place;
	};

	$scope.productNext = function() {
		var product = _('mp_product').value;
		if (product == "") {
			_('isa_error_product').style.display = "block";
			_('isa_error_message_product').innerHTML = "  Enter the product please";
			setTimeout(hidden_error_marketplace, 3000);
		}
		mp_in_all.product = product;
	};

	$scope.priceNext = function() {
		var price = _('mp_price').value;
		if (price == "") {
			_('isa_error_price').style.display = "block";
			_('isa_error_message_price').innerHTML = "  Enter the price please";
			setTimeout(hidden_error_marketplace, 3000);
		}
		mp_in_all.price = price;
	};
	$scope.saveMarketPlace = function(place, product, price, email) {
		Data.post('/add/marketplace', {
			dashData : {
				"place" : place,
				"product" : product,
				"price" : price,
				"email" : email
			}
		}).success(function(response) {
			if (response.status == "success") {
				_('isa_success_marketplace').style.display = "block";
				_('isa_success_message_marketplace').innerHTML = response.data;
				setTimeout(hidden_error_communication, 3000);
			} else {
				_('isa_error_marketplace').style.display = "block";
				_('isa_error_message_marketplace').innerHTML = response.data;
				setTimeout(hidden_error_communication, 3000);
			}
		}).error(function(err) {
			console.log(err);
		});
	};

	//upload photo
	$scope.uploadProfile = function(idbtn, email) {
		var btn = _(idbtn);
		var progressBar = _('progressBar2');
		var progressOuter = _('progressOuter2');
		new ss.SimpleUpload({
			button : btn,
			url : '/admin/image/' + email,
			name : 'upl',
			multipart : true,
			noParams : true,
			hoverClass : 'hover',
			focusClass : 'focus',
			responseType : 'json',
			allowedExtensions : ['jpg', 'jpeg', 'png'],
			startXHR : function() {
				progressOuter.style.display = 'block';
				this.setProgressBar(progressBar);
			},
			onComplete : function(filename, response) {
				progressOuter.style.display = 'none';
				if (response.status === "success") {
					alert(response.data);
					$scope.displayuserprofile();
				} else {
					alert(response.data);
				}
			},
			onError : function() {
				progressOuter.style.display = 'none';
			}
		});
	};
	$scope.addNews = function(title, desc) {
		if (title === "" || desc === "") {
			_('isa_error_news').style.display = "block";
			_('isa_error_message_news').innerHTML = "please fill your form.";
			return false;
		}
		Data.post('/add/news', {
			dashData : {
				"title" : title,
				"desc" : desc
			}
		}).success(function(response) {
			if (response.status == "success") {
				_('isa_success_news').style.display = "block";
				_('isa_success_message_news').innerHTML = response.data;
				$scope.title = "";
				$scope.desc = "";
				setTimeout(hidden_error_marketplace, 5000);
			} else {
				_('isa_error_news').style.display = "block";
				_('isa_error_message_news').innerHTML = response.data;
				setTimeout(hidden_error_marketplace, 5000);
			}
		}).error(function(err) {
			console.log(err);
		});
	};

});

//================================  this is the control of the project page   ==================================//

app.controller('ctr_landing', function($scope, Data, $window) {
	$scope.descrLimit = 30;

	$scope.logout = function() {
		Data.
		delete ('/logout').success(function(response) {
			location.reload();
		}).error(function(err) {
			console.log('connection failed.');
		});
	};

	$scope.startlanding = function(btnid, adminId) {
		$scope.displaymemberprofile();
		$scope.uploadProfile(btnid, adminId);
		$scope.displaynews();
		$scope.getdetailStatistics();
	};

	$scope.displaymemberprofile = function() {
		Data.get('/member/login/info').success(function(response) {
			$scope.member_profile = response.data;
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.displaymemberprofile = function() {
		Data.get('/member/login/info').success(function(response) {
			$scope.member_profile = response.data;
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.getdetailStatistics = function() {
		Data.get('/member/statistics').success(function(response) {
			$scope.membercount = response.membercount.membercount;
			$scope.countFemale = response.female.femalecount;
			$scope.countMale = response.male.malecount;
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.sendRequest = function() {
		var request = {};
		var request_title = _('request_title').value;
		var request_amount = _('request_amount').value;
		var request_description = _('request_description').value;
		var payback_period = _('payback').value;

		if (request_title == "" || request_amount == "" || request_description == "" || payback_period == "") {
			_('isa_error_member_send_req').style.display = "block";
			_('isa_error_message_member_send_req').innerHTML = "  Please Fill all the fields ";
			setTimeout(hidden_error_member_send_req_coop, 4000);
			return false;
		}
		if (!validateNumber(request_amount)) {
			_('isa_error_member_send_req').style.display = "block";
			_('isa_error_message_member_send_req').innerHTML = "Check the amount and make sure it's a number";
			setTimeout(hidden_error_member_send_req_coop, 4000);
			return false;
		}

		request.request_title = request_title;
		request.request_amount = request_amount;
		request.request_description = request_description;
		request.payback_period = payback_period;
		_('img_succes_loading').style.visibility = "visible";
		Data.post('/member/send/request', {
			dashData : request
		}).success(function(response) {
			_('img_succes_loading').style.visibility = "hidden";
			if (response.status == "success") {
				_('isa_success_member_send_req').style.display = "block";
				_('isa_success_message_member_send_req').innerHTML = response.data;
				_('memberLoanReq_form').reset();
				setTimeout(hidden_error_member_send_req_coop, 5000);
			} else {
				_('isa_error_member_send_req').style.display = "block";
				_('isa_error_message_member_send_req').innerHTML = response.data;
				setTimeout(hidden_error_member_send_req_coop, 5000);
			}
		}).error(function(err) {
			console.log(err);
		});
	};
	//upload photo
	$scope.uploadProfile = function(idbtn, email) {
		var btn = _(idbtn);
		var progressBar = _('progressBar2');
		var progressOuter = _('progressOuter2');
		new ss.SimpleUpload({
			button : btn,
			url : '/admin/image/' + email,
			name : 'upl',
			multipart : true,
			noParams : true,
			hoverClass : 'hover',
			focusClass : 'focus',
			responseType : 'json',
			allowedExtensions : ['jpg', 'jpeg', 'png'],
			startXHR : function() {
				progressOuter.style.display = 'block';
				this.setProgressBar(progressBar);
			},
			onComplete : function(filename, response) {
				progressOuter.style.display = 'none';
				if (response.status === "success") {
					alert(response.data);
					$scope.displayuserprofile();
				} else {
					alert(response.data);
				}
			},
			onError : function() {
				progressOuter.style.display = 'none';
			}
		});
	};

	$scope.networks = function(email) {
		Data.get('/list/networks/' + email).success(function(response) {
			$scope.networkings = response.data;
			$scope.selectNetwork(response.data[0]);
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.selectNetwork = function(info) {
		$scope.networkname = info.networkname;
		$scope.networkstatus = info.status;
		$scope.networkcreatorid = info.creator;
		$scope.networkid = info.id;
		$scope.networkaudience = info.serialdata;
		$scope.members_network = [];
		$scope.messagesInNetwork($scope.networkid);
		var i = 0;
		while (info.names.length > i) {
			$scope.members_network.push({
				"m_names" : info.names[i],
				"m_profiles" : info.profiles[i]
			});
			i++;
		}
	};

	$scope.sendChat = function(c1, n2, a4, n5) {
		_('sendMessage').innerHTML = "Sending...";
		Data.post('/chat/message', {
			dashData : {
				"chatMessage" : c1,
				"networkcreatorid" : n2,
				"networkid" : $scope.networkid,
				"author" : a4,
				"networkaudience" : n5
			}
		}).success(function(response) {
			_('sendMessage').innerHTML = "Please wait...";
			if (response.status == "success") {
				$scope.chatMessage = "";
				_('sendMessage').innerHTML = "Sent.";
				$scope.messagesInNetwork($scope.networkid);
				_('sendMessage').innerHTML = "Send";
			} else {
				_('sendMessage').innerHTML = response.data;
			}
		}).error(function(err) {
			console.log(err);
		});
	};

	$scope.messagesInNetwork = function() {
		$scope.messagesin = [];
		Data.get('/list/message/' + $scope.networkid).success(function(response) {
			$scope.messagesin = response.data;
		}).error(function(err) {
			console.warn(err);
		});
	};

	$scope.displaynews = function() {
		Data.get('/list/news').success(function(response) {
			$scope.didyouknow = response.data;
		}).error(function(err) {
			console.warn(err);
		});
	};
});

//function that help me to minimizing my codes
function _(x) {
	return document.getElementById(x);
}

function hidden_error_income() {
	_('isa_error_root_income').style.display = 'none';
	_('isa_success_root_income').style.display = 'none';
	_('isa_error_add_income').style.display = 'none';
	_('isa_success_add_income').style.display = 'none';
	;
}

function hidden_error_budget() {
	_('isa_success_budget').style.display = 'none';
	_('isa_error_budget').style.display = 'none';
	_('isa_success_expense').style.display = 'none';
	_('isa_error_expense').style.display = 'none';
	_('isa_error_edit_budget').style.display = 'none';
	_('isa_success_edit_budget').style.display = 'none';
}

function hidden_error_communication() {
	_('isa_success_net').style.display = 'none';
	_('isa_error_net').style.display = 'none';
}

function hidden_error_marketplace() {
	_('isa_error_news').style.display = "none";
	_('isa_success_news').style.display = "none";
	_('isa_success_setmonth').style.display = 'none';
	_('isa_error_setmonth').style.display = 'none';
}

function hidden_error_marketplace() {
	_('isa_error_place').style.display = 'none';
	_('isa_error_product').style.display = 'none';
	_('isa_error_price').style.display = 'none';
}

function hidden_error_register() {
	_('isa_error_register').style.display = 'none';
	_('isa_success_register').style.display = 'none';
}

function hidden_error_register_worker() {
	_('isa_error_register_worker').style.display = 'none';
	_('isa_success_register_worker').style.display = 'none';
}

function hidden_error_add_member() {
	_('isa_error_add_member').style.display = 'none';
	_('isa_success_add_member').style.display = 'none';
}

function hidden_error_month_contr() {
	_('isa_error_month_contr').style.display = 'none';
	_('isa_success_month_contr').style.display = 'none';
}

function hidden_error_sign_in() {
	_('isa_error_login').style.display = 'none';
}

function hidden_error_add_admin_coop() {
	_('isa_error_add_admin').style.display = "none";
	_('isa_success_add_admin').style.display = "none";
}

function hidden_error_member_send_req_coop() {
	_('isa_error_member_send_req').style.display = 'none';
	_('isa_success_member_send_req').style.display = 'none';
}

function hidden_error_sign_in_worker() {
	_('isa_error_login_worker').style.display = 'none';
}

function hidden_error_register_worker() {
	_('isa_error_project').style.display = 'none';
	_('isa_success_project').style.display = 'none';
}

function validateEmail(email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}

function hidden_registration_form() {
	_('register').style.display = 'none';
	_('form_login').style.display = 'block';
}

function hidden_registration_form_worker() {
	_('register_worker').style.display = 'none';
	_('form_login_worker').style.display = 'block';
}

function hidden_worker_form() {
	_('isa_success_register').style.display = 'none';
	_('isa_error_register').style.display = 'none';
}

function validateNumber(number) {
	var re = /^\d+$/;
	return re.test(number);
}

