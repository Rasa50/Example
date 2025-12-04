<?php
class DataBinder {
    public static function bind($data, $object) {
        foreach ($data as $key => $value) {
            if (property_exists($object, $key)) {
                $object->$key = htmlspecialchars(strip_tags($value));
            }
        }
        return $object;
    }
}
?>