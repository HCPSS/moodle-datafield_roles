<?php

class data_field_roles extends data_field_base {
    public $type = 'roles';

    public function display_add_field($recordid = 0, $formdata = null) {
        return $this->display();
    }

    private function display() {
        global $USER;

        $context = context_module::instance($this->cm->id);
        $roles = get_user_roles($context, $USER->id);

        $role_names = array_unique(array_map(function ($role) {
            return $role->shortname;
        }, $roles));

        return implode($this->field->param1, $role_names);
    }

    public function define_field($data) {
        parent::define_field($data);

        if (isset($data->param2)) {
            $this->field->param2 = $data->param2;
        }

        return true;
    }

    public function display_browse_field($recordid, $template) {
        return $this->display();
    }

    public function update_content($recordid, $value, $name = '') {
        return true;
    }

    public function get_sort_sql($fieldname) {
        return $fieldname;
    }

    public static function get_content_value($content) {
        return trim($content->content, "\r\n ");
    }

    function name() {
        return get_string('fieldtypelabel', "datafield_$this->type");
    }
    
    public function display_search_field($value = '') {
        return '';
    }
}
