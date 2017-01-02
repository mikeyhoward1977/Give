<?php

/**
 * @group email_tags
 */
class Tests_Email_Tags extends Give_Unit_Test_Case {
	public function setUp() {
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
	}

	/**
	 * Test function give_email_tag_first_name
	 *
	 * @since 1.9
	 * @cover give_email_tag_first_name
	 */
	function test_give_email_tag_first_name() {
		/*
		 * Case 1: First name from payment.
		 */
		$payment_id = Give_Helper_Payment::create_simple_payment();
		$firstname  = give_email_tag_first_name( array( 'payment_id' => $payment_id ) );

		$this->assertEquals( 'Admin', $firstname );

		/*
		 * Case 2: First name from user_id.
		 */
		$firstname = give_email_tag_first_name( array( 'user_id' => 1 ) );
		$this->assertEquals( 'Admin', $firstname );

		/*
		 * Case 3: First name with filter
		 */
		add_filter( 'give_email_tag_first_name', array( $this, 'give_first_name' ), 10, 2 );

		$firstname = give_email_tag_first_name( array( 'donor_id' => 1 ) );
		$this->assertEquals( 'Give', $firstname );

		remove_filter( 'give_email_tag_first_name', array( $this, 'give_first_name' ), 10 );
	}

	/**
	 * Add give_email_tag_first_name filter to give_email_tag_first_name function.
	 *
	 * @since 1.9
	 *
	 * @param string $firstname
	 * @param array  $tag_args
	 *
	 * @return string
	 */
	public function give_first_name( $firstname, $tag_args ) {
		if ( array_key_exists( 'donor_id', $tag_args ) ) {
			$firstname = 'Give';
		}

		return $firstname;
	}

	/**
	 * Test function give_email_tag_fullname
	 *
	 * @since 1.9
	 * @cover give_email_tag_fullname
	 */
	function test_give_email_tag_fullname() {
		/*
		 * Case 1: Full name from payment.
		 */
		$payment_id = Give_Helper_Payment::create_simple_payment();
		$fullname  = give_email_tag_fullname( array( 'payment_id' => $payment_id ) );

		$this->assertEquals( 'Admin User', $fullname );

		/*
		 * Case 2: Full name from user_id.
		 */
		$fullname = give_email_tag_fullname( array( 'user_id' => 1 ) );
		$this->assertEquals( 'Admin User', $fullname );

		/*
		 * Case 3: Full name with filter
		 */
		add_filter( 'give_email_tag_fullname', array( $this, 'give_fullname' ), 10, 2 );

		$fullname = give_email_tag_fullname( array( 'donor_id' => 1 ) );
		$this->assertEquals( 'Give WP', $fullname );

		remove_filter( 'give_email_tag_fullname', array( $this, 'give_fullname' ), 10 );
	}

	/**
	 * Add give_email_tag_fullname filter to give_email_tag_fullname function.
	 *
	 * @since 1.9
	 *
	 * @param string $fullname
	 * @param array  $tag_args
	 *
	 * @return string
	 */
	public function give_fullname( $fullname, $tag_args ) {
		if ( array_key_exists( 'donor_id', $tag_args ) ) {
			$fullname = 'Give WP';
		}

		return $fullname;
	}

	/**
	 * Test function give_email_tag_username
	 *
	 * @since 1.9
	 * @cover give_email_tag_username
	 */
	function test_give_email_tag_username() {
		/*
		 * Case 1: User name from payment.
		 */
		$payment_id = Give_Helper_Payment::create_simple_payment();
		$username  = give_email_tag_username( array( 'payment_id' => $payment_id ) );

		$this->assertEquals( 'admin', $username );

		/*
		 * Case 2: User name from user_id.
		 */
		$username = give_email_tag_username( array( 'user_id' => 1 ) );
		$this->assertEquals( 'admin', $username );

		/*
		 * Case 3: User name with filter
		 */
		add_filter( 'give_email_tag_username', array( $this, 'give_username' ), 10, 2 );

		$username = give_email_tag_username( array( 'donor_id' => 1 ) );
		$this->assertEquals( 'give', $username );

		remove_filter( 'give_email_tag_username', array( $this, 'give_username' ), 10 );
	}

	/**
	 * Add give_email_tag_username filter to give_email_tag_username function.
	 *
	 * @since 1.9
	 *
	 * @param string $username
	 * @param array  $tag_args
	 *
	 * @return string
	 */
	public function give_username( $username, $tag_args ) {
		if ( array_key_exists( 'donor_id', $tag_args ) ) {
			$username = 'give';
		}

		return $username;
	}

	/**
	 * Test function give_email_tag_user_email
	 *
	 * @since 1.9
	 * @cover give_email_tag_user_email
	 */
	function test_give_email_tag_user_email() {
		/*
		 * Case 1: User email from payment.
		 */
		$payment_id = Give_Helper_Payment::create_simple_payment();
		$user_email  = give_email_tag_user_email( array( 'payment_id' => $payment_id ) );

		$this->assertEquals( 'admin@example.org', $user_email );

		/*
		 * Case 2: User email from user_id.
		 */
		$user_email = give_email_tag_user_email( array( 'user_id' => 1 ) );
		$this->assertEquals( 'admin@example.org', $user_email );

		/*
		 * Case 3: User email with filter
		 */
		add_filter( 'give_email_tag_user_email', array( $this, 'give_user_email' ), 10, 2 );

		$user_email = give_email_tag_user_email( array( 'donor_id' => 1 ) );
		$this->assertEquals( 'give@givewp.com', $user_email );

		remove_filter( 'give_email_tag_user_email', array( $this, 'give_user_email' ), 10 );
	}

	/**
	 * Add give_email_tag_user_email filter to give_email_tag_user_email function.
	 *
	 * @since 1.9
	 *
	 * @param string $user_email
	 * @param array  $tag_args
	 *
	 * @return string
	 */
	public function give_user_email( $user_email, $tag_args ) {
		if ( array_key_exists( 'donor_id', $tag_args ) ) {
			$user_email = 'give@givewp.com';
		}

		return $user_email;
	}

	/**
	 * Test function give_email_tag_billing_address
	 *
	 * @since 1.9
	 * @cover give_email_tag_billing_address
	 */
	function test_give_email_tag_billing_address() {
		/*
		 * Case 1: User email from payment.
		 */
		$payment_id = Give_Helper_Payment::create_simple_payment();
		$billing_address  = give_email_tag_billing_address( array( 'payment_id' => $payment_id ) );

		$this->assertEquals( '', trim( str_replace( "\n", '', $billing_address ) ) );

		/*
		 * Case 2: User email with filter
		 */
		add_filter( 'give_email_tag_billing_address', array( $this, 'give_billing_address' ), 10, 2 );

		$billing_address = give_email_tag_billing_address( array( 'user_id' => 1 ) );
		$this->assertEquals( 'San Diego, CA', $billing_address );

		remove_filter( 'give_email_tag_billing_address', array( $this, 'give_billing_address' ), 10 );
	}

	/**
	 * Add give_email_tag_billing_address filter to give_email_tag_billing_address function.
	 *
	 * @since 1.9
	 *
	 * @param string $billing_address
	 * @param array  $tag_args
	 *
	 * @return string
	 */
	public function give_billing_address( $billing_address, $tag_args ) {
		if ( array_key_exists( 'user_id', $tag_args ) ) {
			$billing_address = 'San Diego, CA';
		}

		return $billing_address;
	}

	/**
	 * Test function give_email_tag_date
	 *
	 * @since 1.9
	 * @cover give_email_tag_date
	 */
	function test_give_email_tag_date() {
		/*
		 * Case 1: User email from payment.
		 */
		$payment_id = Give_Helper_Payment::create_simple_payment();
		$date  = give_email_tag_date( array( 'payment_id' => $payment_id ) );

		$this->assertEquals( 'January 2, 2017', $date );

		/*
		 * Case 2: User email with filter
		 */
		add_filter( 'give_email_tag_date', array( $this, 'give_date' ), 10, 2 );

		$date = give_email_tag_date( array( 'user_id' => 1 ) );
		$this->assertEquals( 'December 7, 2014', $date );

		remove_filter( 'give_email_tag_date', array( $this, 'give_date' ), 10 );
	}

	/**
	 * Add give_email_tag_date filter to give_email_tag_date function.
	 *
	 * @since 1.9
	 *
	 * @param string $date
	 * @param array  $tag_args
	 *
	 * @return string
	 */
	public function give_date( $date, $tag_args ) {
		if ( array_key_exists( 'user_id', $tag_args ) ) {
			$date = 'December 7, 2014';
		}

		return $date;
	}

	/**
	 * Test function give_email_tag_amount
	 *
	 * @since 1.9
	 * @cover give_email_tag_amount
	 */
	function test_give_email_tag_amount() {
		/*
		 * Case 1: User email from payment.
		 */
		$payment_id = Give_Helper_Payment::create_simple_payment();
		$amount  = give_email_tag_amount( array( 'payment_id' => $payment_id ) );

		$this->assertEquals( '$20.00', $amount );

		/*
		 * Case 2: User email with filter
		 */
		add_filter( 'give_email_tag_amount', array( $this, 'give_amount' ), 10, 2 );

		$amount = give_email_tag_amount( array( 'user_id' => 1 ) );
		$this->assertEquals( '$30.00', $amount );

		remove_filter( 'give_email_tag_amount', array( $this, 'give_amount' ), 10 );
	}

	/**
	 * Add give_email_tag_amount filter to give_email_tag_amount function.
	 *
	 * @since 1.9
	 *
	 * @param string $amount
	 * @param array  $tag_args
	 *
	 * @return string
	 */
	public function give_amount( $amount, $tag_args ) {
		if ( array_key_exists( 'user_id', $tag_args ) ) {
			$amount = '$30.00';
		}

		return $amount;
	}
}