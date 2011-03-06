<?php
// Connection.class.php
// Copyright (c) 2010 Ronald B. Cemer
// All rights reserved.
// This software is released under the BSD license.
// Please see the accompanying LICENSE.txt for details.

abstract class Connection {
	// Close a connection.
	public abstract function close();

	// Encode a value for SQL usage.
	// $val is any allowable type (string, int, float/double, boolean, null).
	// Returns the SQL representation of the value.
	public abstract function encode($val);

	// Execute an updating query.
	// Returns true if success; false if failure.
	public abstract function executeUpdate($preparedStatement);

	// Execute a query and return a result set.
	// Returns a result set identifier which can be used fetch the result rows.
	public abstract function executeQuery($preparedStatement);

	// Fetch the next row of a result set identifier as an associative array.
	// Returns null if there are no more rows.
	// If $freeResultBeforeReturn is true, frees the result set before returning.
	public abstract function fetchArray($resultSetIdentifier, $freeResultBeforeReturn = false);

	// Fetch the next row of a result set identifier as an object.
	// Returns null if there are no more rows.
	// If $freeResultBeforeReturn is true, frees the result set before returning.
	public abstract function fetchObject($resultSetIdentifier, $freeResultBeforeReturn = false);

	// Fetch the remaining rows of a result set identifier as an array of associative arrays.
	// If $freeResultBeforeReturn is true, frees the result set before returning.
	public function fetchAllArrays($resultSetIdentifier, $freeResultBeforeReturn = false) {
		$rows = array();
		while ($row = $this->fetchArray($resultSetIdentifier, false)) $rows[] = $row;
		if ($freeResultBeforeReturn) $this->freeResult($resultSetIdentifier);
		return $rows;
	}

	// Fetch the remaining rows of a result set identifier as an array of objects.
	// If $freeResultBeforeReturn is true, frees the result set before returning.
	public function fetchAllObjects($resultSetIdentifier, $freeResultBeforeReturn = false) {
		$rows = array();
		while ($row = $this->fetchObject($resultSetIdentifier, false)) $rows[] = $row;
		if ($freeResultBeforeReturn) $this->freeResult($resultSetIdentifier);
		return $rows;
	}

	// Free a result set identifier.
	public abstract function freeResult($resultSetIdentifier);

	// Get the last insert Id.
	// Returns false if none.
	public abstract function getLastInsertId();

	// Begin a transaction.
	// For database engines which don't support nested transactions, only
	// the first transaction begun will be honored.  In this case, a counter
	// will be used to keep track of the virtual transaction depth, and only
	// transitions from 0 to 1 and 1 to 0 will actually take any action.
	public abstract function beginTransaction();

	// Commit a transaction.
	// For database engines which don't support nested transactions, only
	// the first transaction begun will be honored.  In this case, a counter
	// will be used to keep track of the virtual transaction depth, and only
	// transitions from 0 to 1 and 1 to 0 will actually take any action.
	public abstract function commitTransaction();

	// Rollback a transaction.
	// For database engines which don't support nested transactions, only
	// the first transaction begun will be honored.  In this case, a counter
	// will be used to keep track of the virtual transaction depth, and only
	// transitions from 0 to 1 and 1 to 0 will actually take any action.
	public abstract function rollbackTransaction();
}
