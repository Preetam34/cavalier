<?php
if (isset($_POST['action'])) { // Checking for submit action
	$my_email = 'support@affapress.com'; // Change with your email address

	if ($_POST['action'] == 'add') {
		$first_name = trim(strip_tags(addslashes($_POST['first_name'])));
		$last_name = trim(strip_tags(addslashes($_POST['last_name'])));
		$phone = trim(strip_tags(addslashes($_POST['phone'])));
		$email = trim(strip_tags(addslashes($_POST['email'])));
		$pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';

		if ($email != '') {
			if (preg_match($pattern, $email)) {
				$subject_a = 'User registration: ' . $email;
				$subject_b = 'Registration details from ' . $my_email;

				$messages = '';
				if (!empty($first_name) || !empty($last_name)) {
					$messages .= 'Full name:';
					if (!empty($first_name)) $messages .= ' ' . $first_name;
					if (!empty($last_name)) $messages .= ' ' . $last_name;
					$messages .=  "\n";
				}
				if (!empty($phone)) $messages .= 'Phone number: ' . $phone . "\n";
				$messages .= 'Email address: ' . $email;

				$headers_a = 'From: ' . $email . "\r\n";
				$headers_b = 'From: ' . $my_email . "\r\n";

				$mail = mail($my_email, $subject_a, $messages, $headers_a);
				$mail = mail($email, $subject_b, $messages, $headers_b);

				if ($mail) echo 'success|Thanks for your data submission, we will be in touch shortly.';
				else echo 'error|Mail function error occurred.';
			} else {
				echo 'error|Please enter a valid email address!';
			}
		} else {
			echo 'error|Please fill all the required fields!';
		}
	}
} else { // Submit through invalid form
	echo 'error|Please submit data through a valid form!';
}
