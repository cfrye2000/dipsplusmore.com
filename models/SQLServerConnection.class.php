<?php
// SQLServerConnection.class.php
// Copyright (c) 2010 Ronald B. Cemer
// All rights reserved.
// This software is released under the BSD license.
// Please see the accompanying LICENSE.txt for details.

if (!class_exists('Connection', true)) include(dirname(__FILE__).'/Connection.class.php');

class SQLServerConnection extends Connection {
	private $conn;
	private $transactionDepth = 0;

	public function SQLServerConnection($server, $username, $password, $database) {
		$this->transactionDepth = 0;
		$this->conn = odbc_connect
			('DRIVER={SQL Server};SERVER='.$server.';DATABASE='.$database, $username, $password);
	}

	public function close() {
		$this->transactionDepth = 0;
		if ($this->conn !== false) {
			$cn = $this->conn;
			$this->conn = false;
			odbc_close($cn);
		}
	}

	public function encode($val) {
		if ($val === null) return 'null';
		if (is_bool($val)) return $val ? '1' : '0';
		if (is_string($val)) return "'".str_replace('\'', '\'\'', $s)."'";
		return (string)$val;
	}

	public function executeUpdate($preparedStatement) {
		$result = odbc_exec($this->conn, $preparedStatement->toSQL($this));
		if ( ($result === true) || ($result === false) ) return $result;
		// This looks like a query.  Better free the result set.
		odbc_free_result($result, $this->conn);
		return true;
	}

	public function executeQuery($preparedStatement) {
		$sql = $preparedStatement->toSQL($this);
		if (($preparedStatement->selectOffset > 0) || ($preparedStatement->selectLimit > 0)) {
			if ((strlen($sql) >= 6) &&
				(strncasecmp($sql, 'select', 6) == 0) &&
				(ctype_space($sql[6]))) {
				$sql =
					substr($sql, 0, 6).
					sprintf(
						'top %d ',
						$preparedStatement->selectOffset+$preparedStatement->selectLimit).
					substr($sql, 6);
			} else {
				throw new Exception(
					'selectOffset and selectLimit cannot be applied to'.
					' the specified SQL statement');
			}
		}
		$result = odbc_exec($sql, $this->conn);
		if ($result === false) return $result;
		// This looks like an update.
		// Better return 0 so callers expecting a result set don't blow up.
		if ($result === true) return 0;
		return $result;
	}

	public function fetchArray($resultSetIdentifier, $freeResultBeforeReturn = false) {
		$result = odbc_fetch_array($resultSetIdentifier);
		if ($freeResultBeforeReturn) $this->freeResult($resultSetIdentifier);
		return $result;
	}

	public function fetchObject($resultSetIdentifier, $freeResultBeforeReturn = false) {
		$result = odbc_fetch_object($resultSetIdentifier);
		if ($freeResultBeforeReturn) $this->freeResult($resultSetIdentifier);
		return $result;
	}

	public function freeResult($resultSetIdentifier) {
		odbc_free_result($resultSetIdentifier);
	}

	public function getLastInsertId() {
		$rs = odbc_exec('select @@IDENTITY as ID');
		if ($rs !== false) {
			$row = odbc_fetch_array($rs);
			odbc_free_result($rs);
			if ( ($row) && (isset($row['ID'])) ) return $row['ID'];
		}
		return false;
	}

	public function beginTransaction() {
		$this->transactionDepth++;
		if ($this->transactionDepth == 1) {
			odbc_exec('begin transaction txn');
		}
	}

	public function commitTransaction() {
		if ($this->transactionDepth > 0) {
			$this->transactionDepth--;
			if ($this->transactionDepth == 0) {
				odbc_exec('commit transaction txn');
			}
		}
	}

	public function rollbackTransaction() {
		if ($this->transactionDepth > 0) {
			$this->transactionDepth--;
			if ($this->transactionDepth == 0) {
				odbc_exec('rollback transaction txn');
			}
		}
	}
}
