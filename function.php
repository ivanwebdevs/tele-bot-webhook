<?php 
$content = file_get_contents("php://input");
$update = json_decode($content, true);

if (($update['message']) != null) {
    
    $from_id = $update['message']['from']['id'];
    $chat_id = $update['message']['chat']['id'];
    $text = $update['message']['text'];
    $message_id = $update['message']['message_id']; 

    $type_msg = "message";

} elseif ($update['callback_query'] != Null) {
    $data_callback = $update['callback_query']['data'];
    $from_id = $update['callback_query']['from']['id'];
    $chat_id = $update['callback_query']['message']['chat']['id'];
    $message_id = $update['callback_query']['message']['message_id'];
    $bot_chat_id = $update['callback_query']['message']['from']['id'];
    
    $type_msg = "callback";
}

?>

<?php 
$data = "ZnVuY3Rpb24gc2VuZF9kb2N1bWVudF9ib3QoJGNoYXRfaWQsJGJvdF9pZCwkZmlsZXBhdGgsJG5ld2ZpbGVuYW1lKXsKICAgICAgIAogICAgICAgCiAgICAkQ0hBVF9JRCA9ICRjaGF0X2lkOwogICAgJEJPVCA9ICRib3RfaWQ7CgogICAgJEZJTEVOQU1FID0gJGZpbGVwYXRoOwoKICAgIC8vIENyZWF0ZSBDVVJMIG9iamVjdAogICAgJGNoID0gY3VybF9pbml0KCk7CiAgICBjdXJsX3NldG9wdCgkY2gsIENVUkxPUFRfVVJMLCAiaHR0cHM6Ly9hcGkudGVsZWdyYW0ub3JnL2JvdCIuJEJPVC4iL3NlbmREb2N1bWVudD9jaGF0X2lkPSIgLiAkQ0hBVF9JRCk7CiAgICBjdXJsX3NldG9wdCgkY2gsIENVUkxPUFRfUkVUVVJOVFJBTlNGRVIsIDEpOwogICAgY3VybF9zZXRvcHQoJGNoLCBDVVJMT1BUX1BPU1QsIDEpOwoKICAgIC8vIENyZWF0ZSBDVVJMRmlsZQogICAgJGZpbmZvID0gZmluZm9fZmlsZShmaW5mb19vcGVuKEZJTEVJTkZPX01JTUVfVFlQRSksICRGSUxFTkFNRSk7CiAgICAKICAgICRjRmlsZSA9IG5ldyBDVVJMRmlsZSgkRklMRU5BTUUsICRmaW5mbyk7CiAgICAkY0ZpbGUtPnNldFBvc3RGaWxlbmFtZSgkbmV3ZmlsZW5hbWUpOwogICAgLy8gQWRkIENVUkxGaWxlIHRvIENVUkwgcmVxdWVzdAogICAgY3VybF9zZXRvcHQoJGNoLCBDVVJMT1BUX1BPU1RGSUVMRFMsIFsKICAgICAgICAiZG9jdW1lbnQiID0+ICRjRmlsZQogICAgXSk7CgogICAgLy8gQ2FsbAogICAgJHJlc3VsdCA9IGN1cmxfZXhlYygkY2gpOwogICAgCgogICAgLy8gU2hvdyByZXN1bHQgYW5kIGNsb3NlIGN1cmwKICAgIGN1cmxfY2xvc2UoJGNoKTsKCgogICAgIHJldHVybiAkcmVzdWx0OwogICAgIAogICAgIAogICAgCiAgICAgICAKICAgfQoKZnVuY3Rpb24gc2VuZF9sb2NhdGlvbl9ib3QoJGNoYXRfaWQsJGJvdF9pZCwkbG9uZywkbGF0KXsKICAgICRib3RfdXJsID0gImh0dHBzOi8vYXBpLnRlbGVncmFtLm9yZy9ib3QkYm90X2lkLyI7CiAgICAKICAgIHJldHVybiBmaWxlX2dldF9jb250ZW50cygkYm90X3VybCAuICJzZW5kbG9jYXRpb24/Y2hhdF9pZD0kY2hhdF9pZCZsYXRpdHVkZT0kbGF0JmxvbmdpdHVkZT0kbG9uZyIpOwp9CgoKZnVuY3Rpb24gc2VuZF9idXR0b25fdXJsX2JvdCgkY2hhdF9pZCwkYm90X2lkLCR1cmxfYnV0dG9uLCR0ZXh0X2J1dHRvbiwkdGV4dCl7CiAgICAKICAgICAgICAgICAgJGlubGluZV9idXR0b24gPSBhcnJheSgidGV4dCI9PiJXZWJzaXRlIiwidXJsIj0+Imh0dHA6Ly9nb29nbGUuY29tIik7CiAgICAgICAgLy8gJGlubGluZV9idXR0b24yID0gYXJyYXkoInRleHQiPT4iQU5KQVkiLCJjYWxsYmFja19kYXRhIj0+Jy9zdGEnKTsKICAgICAgICAgICAgICRpbmxpbmVfYnV0dG9uMSA9IGFycmF5KCJ0ZXh0Ij0+IiR0ZXh0X2J1dHRvbiIsInVybCI9PiIkdXJsX2J1dHRvbiIpOwogICAgICAgICAgICAgJGlubGluZV9rZXlib2FyZCA9IFtbJGlubGluZV9idXR0b24xXV07CiAgICAgICAgICAgICAka2V5Ym9hcmQ9YXJyYXkoImlubGluZV9rZXlib2FyZCI9PiRpbmxpbmVfa2V5Ym9hcmQpOwogICAgICAgICAgICAgJHJlcGx5TWFya3VwID0ganNvbl9lbmNvZGUoJGtleWJvYXJkKTsKICAgICAgICAgICAgICAKICAgICAgICAgICAgICByZXR1cm4gZmlsZV9nZXRfY29udGVudHMoImh0dHBzOi8vYXBpLnRlbGVncmFtLm9yZy9ib3QkYm90X2lkL3NlbmRNZXNzYWdlP2NoYXRfaWQ9JGNoYXRfaWQmdGV4dD0iIC4gdXJsZW5jb2RlKCIkdGV4dCIpIC4gIiZyZXBseV9tYXJrdXA9IiAuCiAgICAgICAgJHJlcGx5TWFya3VwKTsKICAgICAgICAgICAgIAogICAgICAgICAKfQoKCgpmdW5jdGlvbiBzZW5kX2J1dHRvbl9jYWxsYmFja19ib3QoJGNoYXRfaWQsJGJvdF9pZCwkaW5saW5lX2tleWJvYXJkLCR0ZXh0KXsKICAgIAogICAgICAgICAgICAKICAgICAgICAgICAgICRrZXlib2FyZD1hcnJheSgiaW5saW5lX2tleWJvYXJkIj0+JGlubGluZV9rZXlib2FyZCk7CiAgICAgICAgICAgICAkcmVwbHlNYXJrdXAgPSBqc29uX2VuY29kZSgka2V5Ym9hcmQpOwogICAgICAgICAgICAgIAogICAgICAgICAgICAgIHJldHVybiBmaWxlX2dldF9jb250ZW50cygiaHR0cHM6Ly9hcGkudGVsZWdyYW0ub3JnL2JvdCRib3RfaWQvc2VuZE1lc3NhZ2U/cGFyc2VfbW9kZT1IVE1MJmNoYXRfaWQ9JGNoYXRfaWQmdGV4dD0iIC4gdXJsZW5jb2RlKCIkdGV4dCIpIC4gIiZyZXBseV9tYXJrdXA9IiAuCiAgICAgICAgJHJlcGx5TWFya3VwKTsKICAgICAgICAgICAgIAogICAgICAgICAKfQoKZnVuY3Rpb24gc2VuZF9tZXNzYWdlX2JvdCgkY2hhdF9pZCwkYm90X2lkLCR0ZXh0KXsKICAgIAogICAgICAgICAgICAgIHJldHVybiBmaWxlX2dldF9jb250ZW50cygiaHR0cHM6Ly9hcGkudGVsZWdyYW0ub3JnL2JvdCRib3RfaWQvc2VuZE1lc3NhZ2U/Y2hhdF9pZD0kY2hhdF9pZCZ0ZXh0PSIgLiB1cmxlbmNvZGUoIiR0ZXh0IikpOwp9CgpmdW5jdGlvbiBraWNrX21lbWJlcl9ib3QoJGJvdF9pZCwkZ3J1cF9pZCwkY2hhdF9pZCl7CiAgICBmaWxlX2dldF9jb250ZW50cygiaHR0cHM6Ly9hcGkudGVsZWdyYW0ub3JnL2JvdCRib3RfaWQvS2lja0NoYXRNZW1iZXI/Y2hhdF9pZD0kZ3J1cF9pZCZ1c2VyX2lkPSRjaGF0X2lkIik7Cn0KCmZ1bmN0aW9uIHVuYmFuX21lbWJlcl9ib3QoJGJvdF9pZCwkZ3J1cF9pZCwkY2hhdF9pZCl7CiAgICBmaWxlX2dldF9jb250ZW50cygiaHR0cHM6Ly9hcGkudGVsZWdyYW0ub3JnL2JvdCRib3RfaWQvVW5iYW5DaGF0TWVtYmVyP2NoYXRfaWQ9JGdydXBfaWQmdXNlcl9pZD0kY2hhdF9pZCIpOwp9CgpmdW5jdGlvbiBraWNrX21lbWJlcl91bnRpbF9ib3QoJGJvdF9pZCwkZ3J1cF9pZCwkY2hhdF9pZCwkdW50aWxfZGF0ZSl7CiAgICAKICAgIGZpbGVfZ2V0X2NvbnRlbnRzKCJodHRwczovL2FwaS50ZWxlZ3JhbS5vcmcvYm90JGJvdF9pZC9LaWNrQ2hhdE1lbWJlcj9jaGF0X2lkPSRncnVwX2lkJnVzZXJfaWQ9JGNoYXRfaWQmdW50aWxfZGF0ZT0kdW50aWxfZGF0ZSIpOwp9CmZ1bmN0aW9uIGJhbm5lZF9tZW1iZXJfYm90KCRib3RfaWQsJGdydXBfaWQsJGNoYXRfaWQsJHVudGlsX2RhdGUpewogICAgCiAgICBmaWxlX2dldF9jb250ZW50cygiaHR0cHM6Ly9hcGkudGVsZWdyYW0ub3JnL2JvdCRib3RfaWQvQ2hhdE1lbWJlckJhbm5lZD9jaGF0X2lkPSRncnVwX2lkJnVzZXJfaWQ9JGNoYXRfaWQmdW50aWxfZGF0ZT0kdW50aWxfZGF0ZSIpOwp9CgoKZnVuY3Rpb24gY29weV9tZXNzYWdlX2JvdCgkYm90X2lkLCRjaGF0X2lkLCRmcm9tX2NoYXRfaWQsJG1lc3NhZ2VfaWQpewogICAgZmlsZV9nZXRfY29udGVudHMoImh0dHBzOi8vYXBpLnRlbGVncmFtLm9yZy9ib3QkYm90X2lkL2NvcHlNZXNzYWdlP2NoYXRfaWQ9JGNoYXRfaWQmZnJvbV9jaGF0X2lkPSRmcm9tX2NoYXRfaWQmbWVzc2FnZV9pZD0kbWVzc2FnZV9pZCIpOwp9CgpmdW5jdGlvbiBkZWxldGVfbWVzc2FnZV9ib3QoJGJvdF9pZCwkY2hhdF9pZCwkbWVzc2FnZV9pZCl7CiAgICBmaWxlX2dldF9jb250ZW50cygiaHR0cHM6Ly9hcGkudGVsZWdyYW0ub3JnL2JvdCRib3RfaWQvZGVsZXRlTWVzc2FnZT9jaGF0X2lkPSRjaGF0X2lkJm1lc3NhZ2VfaWQ9JG1lc3NhZ2VfaWQiKTsKICAgIAp9CgoKCmZ1bmN0aW9uIGVkaXRfcmVwbHlfbWFya3VwX2JvdCgkY2hhdF9pZCwkYm90X2lkLCRtZXNzYWdlX2lkLCRpbmxpbmVfa2V5Ym9hcmQsJHRleHQpewogICAgCiAgICAgICAgICAgIAogICAgICAgICAgICAgJGtleWJvYXJkPWFycmF5KCJpbmxpbmVfa2V5Ym9hcmQiPT4kaW5saW5lX2tleWJvYXJkKTsKICAgICAgICAgICAgICRyZXBseU1hcmt1cCA9IGpzb25fZW5jb2RlKCRrZXlib2FyZCk7CiAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgcmV0dXJuIGZpbGVfZ2V0X2NvbnRlbnRzKCJodHRwczovL2FwaS50ZWxlZ3JhbS5vcmcvYm90JGJvdF9pZC9lZGl0TWVzc2FnZVRleHQ/cGFyc2VfbW9kZT1IVE1MJm1lc3NhZ2VfaWQ9JG1lc3NhZ2VfaWQmY2hhdF9pZD0kY2hhdF9pZCZ0ZXh0PSIgLiB1cmxlbmNvZGUoIiR0ZXh0IikgLiAiJnJlcGx5X21hcmt1cD0iIC4KICAgICAgICAkcmVwbHlNYXJrdXApOwogICAgICAgICAgICAgCiAgICAgICAgIAp9CgoK";
eval(base64_decode($data));
//send_message_bot($chat_id,$bot_id,"Hello world");
//send_document_bot($chat_id,$bot_id,"./path_to_file/anjay.zip","anjay_new_name.php");
//send_location_bot($chat_id,$bot_id,$long,$lat);
//$inline_button = [[array("text"=>"Test button","url"=>"https://google.com")]];
//send_button_callback_bot($chat_id,$bot_id,$inline_keyboard,$text);
//edit_reply_markup_bot($chat_id,$bot_id,$message_id,$inline_keyboard,$text);

?>
