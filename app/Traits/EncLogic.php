<?php

namespace App\Traits;

trait EncLogic {

	public function getEncIdAttribute() {
		return enc($this->attributes['id']);
	}

	public function getDncIdAttribute() {
		return dnc($this->attributes['id']);
	}
}