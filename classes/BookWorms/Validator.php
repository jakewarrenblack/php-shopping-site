<?php
namespace BookWorms;

class Validator {
    private $data = null;
    private $errors = null;

    public function __construct() {
    }
    //-----------------------------------------------------------------------------------------------
    // private validation methods
    //-----------------------------------------------------------------------------------------------
    private function is_present($key) {
        if (!array_key_exists($key, $this->data)) {
            return FALSE;
        }
        $value = $this->data[$key];
    	if (is_array($value)) {
            return TRUE;
        }
        else {
            $trimmed_value = trim($value);
            return isset($trimmed_value) && $trimmed_value !== "";
        }
    }
    private function has_length($key, $options=[]) {
        if (!array_key_exists($key, $this->data)) {
            return TRUE;
        }
        $value = $this->data[$key];
    	if(isset($options['max']) && (strlen($value) > (int)$options['max'])) {
    		return false;
    	}
    	if(isset($options['min']) && (strlen($value) < (int)$options['min'])) {
    		return false;
    	}
    	if(isset($options['exact']) && (strlen($value) != (int)$options['exact'])) {
    		return false;
    	}
    	return true;
    }
    private function has_no_html_tags($key) {
        if (!array_key_exists($key, $this->data)) {
            return TRUE;
        }
        $value = $this->data[$key];
        return strcmp($value, strip_tags($value)) === 0;
    }
    private function is_safe_email($key) {
        if (!array_key_exists($key, $this->data)) {
            return TRUE;
        }
        $email = $this->data[$key];
        $sanitized_email = filter_var($email, FILTER_SANITIZE_EMAIL);
        return strcmp($email, $sanitized_email) === 0;
    }
    private function is_valid_email($key) {
        if (!array_key_exists($key, $this->data)) {
            return TRUE;
        }
        $email = $this->data[$key];
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== FALSE;
    }
    private function is_safe_float($key) {
        if (!array_key_exists($key, $this->data)) {
            return TRUE;
        }
        $float = $this->data[$key];
        $sanitized_float = filter_var($float, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        return strcmp($float, $sanitized_float) === 0;
    }
    private function is_valid_float($key) {
        if (!array_key_exists($key, $this->data)) {
            return TRUE;
        }
        $float = $this->data[$key];
        $options = array(
            'options' => [ "decimal" => "."],
            'flags' => FILTER_FLAG_ALLOW_FRACTION,
        );
        return filter_var($float, FILTER_VALIDATE_FLOAT, $options) !== FALSE;
    }
    private function is_safe_integer($key) {
        if (!array_key_exists($key, $this->data)) {
            return TRUE;
        }
        $integer = $this->data[$key];
        $sanitized_integer = filter_var($integer, FILTER_SANITIZE_NUMBER_INT);
        return strcmp($integer, $sanitized_integer) === 0;
    }
    private function is_valid_integer($key, $range = []) {
        if (!array_key_exists($key, $this->data)) {
            return TRUE;
        }
        $integer = $this->data[$key];
        $options = array("options" => $range);
        return filter_var($integer, FILTER_VALIDATE_INT, $options) !== FALSE;
    }
    private function is_valid_boolean($key) {
        if (!array_key_exists($key, $this->data)) {
            return TRUE;
        }
        $boolean = $this->data[$key];
        return filter_var($boolean, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) !== NULL;
    }
    private function is_match($key, $regex) {
        if (!array_key_exists($key, $this->data)) {
            return TRUE;
        }
        $value = $this->data[$key];
        return preg_match($regex, $value) === 1;
    }
    private function is_element($key, $set) {
        if (!array_key_exists($key, $this->data)) {
            return TRUE;
        }
        $value = $this->data[$key];
        return in_array($value, $set);
    }
    private function is_subset($key, $set) {
        if (!array_key_exists($key, $this->data)) {
            return TRUE;
        }
        $values = $this->data[$key];
        if (!is_array($values)) {
            return FALSE;
        }
        else {
            return (count(array_diff($values, $set)) === 0);
        }
    }
    //-----------------------------------------------------------------------------------------------
    // private rule validation methods
    //-----------------------------------------------------------------------------------------------
    private function validate_rule($key, $rule_str) {
        if ($rule_str === "") {
            throw new Exception("Error in validation rule for " . $key);
        }
        $valid = TRUE;
        $rule_parts = explode(":", $rule_str);
        $rule_name = $rule_parts[0];
        if (count($rule_parts) > 1) {
            $options = array_slice($rule_parts, 1);
        }
        else {
            $options = [];
        }
        switch ($rule_name) {
            case "present"        : $valid = $this->validate_rule_present($key, $options);        break;
            case "minlength"    : $valid = $this->validate_rule_minlength($key, $options);    break;
            case "maxlength"    : $valid = $this->validate_rule_maxlength($key, $options);    break;
            case "email"            : $valid = $this->validate_rule_email($key, $options);            break;
            case "float"            : $valid = $this->validate_rule_float($key, $options);            break;
            case "integer"        : $valid = $this->validate_rule_integer($key, $options);        break;
            case "min"                : $valid = $this->validate_rule_min($key, $options);                break;
            case "max"                : $valid = $this->validate_rule_max($key, $options);                break;
            case "boolean"        : $valid = $this->validate_rule_boolean($key, $options);        break;
            case "match"            : $valid = $this->validate_rule_match($key, $options);            break;
            case "in"                 : $valid = $this->validate_rule_in($key, $options);                 break;
            case "not_in"         : $valid = $this->validate_rule_not_in($key, $options);         break;
            case "subset"         : $valid = $this->validate_rule_subset($key, $options);         break;
            case "not_subset" : $valid = $this->validate_rule_not_subset($key, $options); break;
            default                     : 
                throw new Exception("Error in validation rule for " . $key);
                break;
            }
        return $valid;
    }
    private function validate_rule_present($key, $options) {
        if (!empty($options)) {
            throw new Exception("Error in validation rule for " . $key);
        }
        $valid = TRUE;
        if (!$this->is_present($key)) {
            $valid = FALSE;
            $this->errors[$key] = "Please enter a value for " . $key;
        }
        return $valid;
    }
    private function validate_rule_minlength($key, $options) {
        if (count($options) !== 1 || 
                (filter_var($options[0], FILTER_VALIDATE_INT) === false) ||
                (int)$options[0] < 1) 
        {
            throw new Exception("Error in validation rule for " . $key);
        }
        $valid = TRUE;
        $min = $options[0];
        if (!$this->has_length($key, ["min" => $min])) {
            $valid = FALSE;
            $this->errors[$key] = "Please enter at least " .$min . " characters for " . $key;
        }
        return $valid;
    }
    private function validate_rule_maxlength($key, $options) {
        if (count($options) !== 1 || 
                (filter_var($options[0], FILTER_VALIDATE_INT) === false) ||
                (int)$options[0] < 1) 
        {
            throw new Exception("Error in validation rule for " . $key);
        }
        $valid = TRUE;
        $max = $options[0];
        if (!$this->has_length($key, ["max" => $max])) {
            $valid = FALSE;
            $this->errors[$key] = "Please enter at most " .$max . " characters for " . $key;
        }
        return $valid;
    }
    private function validate_rule_email($key, $options) {
        if (!empty($options)) {
            throw new Exception("Error in validation rule for " . $key);
        }
        $valid = TRUE;
        if (!$this->is_safe_email($key) || !$this->is_valid_email($key)) {
            $valid = FALSE;
            $this->errors[$key] = "Please enter a valid email for " . $key;
        }
        return $valid;
    }
    private function validate_rule_float($key, $options) {
        if (!empty($options)) {
            throw new Exception("Error in validation rule for " . $key);
        }
        $valid = TRUE;
        if (!$this->is_safe_float($key) || !$this->is_valid_float($key)) {
            $valid = FALSE;
            $this->errors[$key] = "Please enter a valid float for " . $key;
        }
        return $valid;
    }
    private function validate_rule_integer($key, $options) {
        if (!empty($options)) {
            throw new Exception("Error in validation rule for " . $key);
        }
        $valid = TRUE;
        if (!$this->is_safe_integer($key) || !$this->is_valid_integer($key)) {
            $valid = FALSE;
            $this->errors[$key] = "Please enter a valid integer for " . $key;
        }
        return $valid;
    }
    private function validate_rule_min($key, $options) {
        if (count($options) !== 1 || (filter_var($options[0], FILTER_VALIDATE_INT) === false)) {
            throw new Exception("Error in validation rule for " . $key);
        }
        $valid = TRUE;
        $min = $options[0];
        if (!$this->is_safe_integer($key) || !$this->is_valid_integer($key, ["min_range" => $min])) {
            $valid = FALSE;
            $this->errors[$key] = "Please enter a valid integer greater than or equal to " . $min ." for " . $key;
        }
        return $valid;
    }
    private function validate_rule_max($key, $options) {
        if (count($options) !== 1 || (filter_var($options[0], FILTER_VALIDATE_INT) === false)) {
            throw new Exception("Error in validation rule for " . $key);
        }
        $valid = TRUE;
        $max = $options[0];
        if (!$this->is_safe_integer($key) || !$this->is_valid_integer($key, ["max_range" => $max])) {
            $valid = FALSE;
            $this->errors[$key] = "Please enter a valid integer less than or equal to " . $max ." for " . $key;
        }
        return $valid;
    }
    private function validate_rule_boolean($key, $options) {
        if (!empty($options)) {
            throw new Exception("Error in validation rule for " . $key);
        }
        $valid = TRUE;
        if (!$this->is_valid_boolean($key)) {
            $valid = FALSE;
            $this->errors[$key] = "Please enter a boolean value for " . $key;
        }
        return $valid;
    }
    private function validate_rule_match($key, $options) {
        $regex = implode(":", $options);
        if (count($options) === 0 || preg_match($regex, "") === FALSE) {
            throw new Exception("Error in validation rule for " . $key);
        }
        $valid = TRUE;
        if (!$this->is_match($key, $regex)) {
            $valid = FALSE;
            $this->errors[$key] = "Please enter string that matches the pattern " . $regex . " for " . $key;
        }
        return $valid;
    }
    private function validate_rule_in($key, $options) {
        if (count($options) !== 1 || $options[0] === "") {
            throw new Exception("Error in validation rule for " . $key);
        }
        $valid = TRUE;
        $values_string = $options[0];
        $values_array = explode(",", $values_string);
        if (!$this->is_element($key, $values_array)) {
            $valid = FALSE;
            $this->errors[$key] = "Please enter a value in the list " . $values_string . " for " . $key;
        }
        return $valid;
    }
    private function validate_rule_not_in($key, $options) {
        if (count($options) !== 1 || $options[0] === "") {
            throw new Exception("Error in validation rule for " . $key);
        }
        $valid = TRUE;
        $values_string = $options[0];
        $values_array = explode(",", $values_string);
        if ($this->is_element($key, $values_array)) {
            $valid = FALSE;
            $this->errors[$key] = "Please enter a value not in the list " . $values_string . " for " . $key;
        }
        return $valid;
    }
    private function validate_rule_subset($key, $options) {
        if (count($options) !== 1 || $options[0] === "") {
            throw new Exception("Error in validation rule for " . $key);
        }
        $valid = TRUE;
        $values_string = $options[0];
        $values_array = explode(",", $values_string);
        if (!$this->is_subset($key, $values_array)) {
            $valid = FALSE;
            $this->errors[$key] = "Please enter values in the list " . $values_string . " for " . $key;
        }
        return $valid;
    }
    private function validate_rule_not_subset($key, $options) {
        if (count($options) !== 1 || $options[0] === "") {
            throw new Exception("Error in validation rule for " . $key);
        }
        $valid = TRUE;
        $values_string = $options[0];
        $values_array = explode(",", $values_string);
        if ($this->is_subset($key, $values_array)) {
            $valid = FALSE;
            $this->errors[$key] = "Please enter values not in the list " . $values_string . " for " . $key;
        }
        return $valid;
    }
    private function set_allowed_data($allowed_params=[]) {
        $allowed_array = [];
        foreach($allowed_params as $param) {
            if(isset($this->data[$param])) {
                $allowed_array[$param] = $this->data[$param];
            }
            else {
                $allowed_array[$param] = NULL;
            }
        }
        $this->data = $allowed_array;
    }
    //-----------------------------------------------------------------------------------------------
    // public methods
    //-----------------------------------------------------------------------------------------------
    public function validate($rules=[], $data=[]) {
        $this->data = $data;
        $this->set_allowed_data(array_keys($rules));
        $this->errors = [];
        foreach ($rules as $field_name => $field_rules_str) {
            $field_rules_array = explode("|", $field_rules_str);
            foreach ($field_rules_array as $field_rule_str) {
                if (!$this->validate_rule($field_name, $field_rule_str)) {
                    break;
                }
            }
        }
        return $this->errors;
    }
}
