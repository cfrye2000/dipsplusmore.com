<?php
// MySQLConnection.class.php
// Copyright (c) 2010 Ronald B. Cemer
// All rights reserved.
// This software is released under the BSD license.
// Please see the accompanying LICENSE.txt for details.

if (!class_exists('Connection', true)) include(dirname(__FILE__).'/Connection.class.php');

class MySQLConnection extends Connection {
	private $conn;
	private $transactionDepth = 0;

	public function MySQLConnection($server, $username, $password, $database) {
		$this->transactionDepth = 0;
		$this->conn = mysql_connect($server, $username, $password);
		if ($this->conn !== false) mysql_select_db($database, $this->conn);
	}

	public function close() {
		$this->transactionDepth = 0;
		if ($this->conn !== false) {
			$cn = $this->conn;
			$this->conn = false;
			mysql_close($cn);
		}
	}

	public function encode($val) {
		if ($val === null) return 'null';
		if (is_bool($val)) return $val ? '1' : '0';
		if (is_string($val)) return "'".mysql_real_escape_string($val, $this->conn)."'";
		return (string)$val;
	}

	public function executeUpdate($preparedStatement) {
		$result = mysql_unbuffered_query($preparedStatement->toSQL($this), $this->conn);
		if ( ($result === true) || ($result === false) ) return $result;
		// This looks like a query.  Better free the result set.
		mysql_free_result($result, $this->conn);
		return true;
	}

	public function executeQuery($preparedStatement) {
		$sql = $preparedStatement->toSQL($this);
		if (($preparedStatement->selectOffset > 0) || ($preparedStatement->selectLimit > 0)) {
			if ((strlen($sql) >= 6) &&
				(strncasecmp($sql, 'select', 6) == 0) &&
				(ctype_space($sql[6]))) {
				if ($preparedStatement->selectLimit > 0) {
					$sql .= sprintf(
						' limit %d,%d',
						$preparedStatement->selectOffset,
						$preparedStatement->selectLimit
					);
				} else {
					$sql .= sprintf(
						' limit %d,18446744073709551615',
						$preparedStatement->selectOffset
					);
				}
			} else {
				throw new Exception(
					'selectOffset and selectLimit cannot be applied to'.
					' the specified SQL statement');
			}
		}
		$result = mysql_unbuffered_query($sql, $this->conn);
		if ($result === false) return $result;
		// This looks like an update.
		// Better return 0 so callers expecting a result set don't blow up.
		if ($result === true) return 0;
		return $result;
	}

	public function fetchArray($resultSetIdentifier, $freeResultBeforeReturn = false) {
		$result = mysql_fetch_assoc($resultSetIdentifier);
		if ($freeResultBeforeReturn) $this->freeResult($resultSetIdentifier);
		return $result;
	}

	public function fetchObject($resultSetIdentifier, $freeResultBeforeReturn = false) {
		$result = mysql_fetch_object($resultSetIdentifier);
		if ($freeResultBeforeReturn) $this->freeResult($resultSetIdentifier);
		return $result;
	}

	public function freeResult($resultSetIdentifier) {
		mysql_free_result($resultSetIdentifier);
	}

	public function getLastInsertId() {
		$result = mysql_insert_id($this->conn);
		if ( ($result === false) || ($result == 0) ) return false;
		return $result;
	}

	public function beginTransaction() {
		$this->transactionDepth++;
		if ($this->transactionDepth == 1) {
			mysql_unbuffered_query('start transaction');
		}
	}

	public function commitTransaction() {
		if ($this->transactionDepth > 0) {
			$this->transactionDepth--;
			if ($this->transactionDepth == 0) {
				mysql_unbuffered_query('commit');
			}
		}
	}

	public function rollbackTransaction() {
		if ($this->transactionDepth > 0) {
			$this->transactionDepth--;
			if ($this->transactionDepth == 0) {
				mysql_unbuffered_query('rollback');
			}
		}
	}
}
