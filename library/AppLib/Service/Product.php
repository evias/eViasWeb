<?php

class AppLib_Service_Product
	extends AppLib_Service
{
	public function getAll() {
		$arrayOutput = array();

		// should only proceed to database access
		// if the adapter is set
		if (! empty(self::$_db)) {

		}

		return $arrayOutput;
	}

	// STATIC FUNCTIONS

	static public function listAll() {
		$arrayOutput = array();

		// should only proceed to database access
		// if the adapter is set
		if (! empty(self::$_db)) {

		}

		return $arrayOutput;
	}
}
