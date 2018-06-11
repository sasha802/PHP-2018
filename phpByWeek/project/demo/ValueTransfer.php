<?php

    class ValueTransfer
    {
        private $_data;

        public function setVar($key, $value) {

            $this->_data[$key] = $value;
        }

        public function getVar($key, $default = '') {

            if ( isset($this->_data[$key]) ) {

                return $this->_data[$key];

            } else {

                return $default;
            }
        }

    }