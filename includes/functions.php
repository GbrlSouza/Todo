<?php
define('XML_FILE', __DIR__ . '/../config/xml_data.xml');

function load_xml_data() {
    if (!file_exists(XML_FILE) || filesize(XML_FILE) === 0) {
        $xml_content = '<?xml version="1.0" encoding="UTF-8"?><tasks></tasks>';
        file_put_contents(XML_FILE, $xml_content);
    }
    
    return simplexml_load_file(XML_FILE);
}

function save_xml_data($xml) { return $xml->asXML(XML_FILE); }

function get_all_tasks() {
    $xml = load_xml_data();
    return $xml->task;
}

function add_task($title) {
    $xml = load_xml_data();
    $next_id = 1;

    if ($xml->task) {
        $max_id = 0;

        foreach ($xml->task as $task) {
            $current_id = (int) $task['id'];
            if ($current_id > $max_id) {
                $max_id = $current_id;
            }
        }

        $next_id = $max_id + 1;
    }

    $newTask = $xml->addChild('task');
    $newTask->addAttribute('id', $next_id);
    $newTask->addChild('title', htmlspecialchars($title));
    $newTask->addChild('completed', 'false');

    return save_xml_data($xml);
}

function toggle_task_status($id) {
    $xml = load_xml_data();
    $id = (int) $id;

    $result = $xml->xpath("//task[@id='$id']");

    if (!empty($result)) {
        $task = $result[0];
        $current_status = (string) $task->completed;
        $new_status = ($current_status === 'true') ? 'false' : 'true';
        
        $task->completed = $new_status;
        return save_xml_data($xml);
    }

    return false;
}

function delete_task($id) {
    $xml = load_xml_data();
    $id = (int) $id;
    $result = $xml->xpath("//task[@id='$id']");

    if (!empty($result)) {
        $task = $result[0];
        $dom = dom_import_simplexml($task);
        $dom->parentNode->removeChild($dom);
        
        return save_xml_data($xml);
    }

    return false;
}

load_xml_data();
