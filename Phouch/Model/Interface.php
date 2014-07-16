<?php

namespace Phouch\Model;

interface Model {
    public function create();
    public function store();
    public function remove();
}