<?php
// PreparedStatement.class.php
// Copyright (c) 2010 Ronald B. Cemer
// All rights reserved.
// This software is released under the BSD license.
// Please see the accompanying LICENSE.txt for details.

class PreparedStatement {
	private $sqlPieces;
	private $params = array();
	private $paramIdx = 0;
	public $selectOffset = 0, $selectLimit = 0;

	public function PreparedStatement($sql, $selectOffset = 0, $selectLimit = 0) {
		$this->sqlPieces = explode('?', trim($sql, " \t\n\r\x00\x0b;"));
		$this->selectOffset = max(0, (int)$selectOffset);
		$this->selectLimit = max(0, (int)$selectLimit);
	}

	public function setBoolean($val) {
		if ($val === null) $this->params[$this->paramIdx] = null;
		$this->params[$this->paramIdx] = (boolean)$val;
		$this->paramIdx++;
	}

	public function setInt($val) {
		if ($val === null) $this->params[$this->paramIdx] = null;
		$this->params[$this->paramIdx] = (int)$val;
		$this->paramIdx++;
	}

	public function setFloat($val) {
		if ($val === null) $this->params[$this->paramIdx] = null;
		$this->params[$this->paramIdx] = (float)$val;
		$this->paramIdx++;
	}

	public function setDouble($val) {
		if ($val === null) $this->params[$this->paramIdx] = null;
		$this->params[$this->paramIdx] = (double)$val;
		$this->paramIdx++;
	}

	public function setString($val) {
		if ($val === null) $this->params[$this->paramIdx] = null;
		$this->params[$this->paramIdx] = (string)$val;
		$this->paramIdx++;
	}

	public function toSQL($connection) {
		$sql = $this->sqlPieces[0];
		for ($i = 1; $i < count($this->sqlPieces); $i++) {
			$sql .= $connection->encode($this->params[$i-1]).$this->sqlPieces[$i];
		}
		return $sql;
	}
}
