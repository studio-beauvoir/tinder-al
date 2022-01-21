<?php


class User {
    public function getGender() {
        return DB::where('id', $this->genderId);
    }
}