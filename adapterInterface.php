<?php

interface adapter {
        public function create($array, $path);
        public function read($path);
}