<?php 

namespace Services\Notices;

interface NoticesInterface {
	public function setNoticeData($title = null, $body = null, $author = null, $subject = null, $type = null);
	public function setNoticeTarget($notice_target = array());
	public function insertNotice();
}

